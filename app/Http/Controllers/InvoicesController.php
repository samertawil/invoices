<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\item;
use App\Models\contact;
use App\Models\invoice;
use App\Models\contact_vw;
use App\Models\invoice_item;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Symfony\Contracts\Service\Attribute\Required;

class InvoicesController extends Controller
{

// ---------------------------------------------------------------------------------------VALIDATION CLASS

    public $rules = [
        'name1' => ['required', 'min:3','unique:sssss:fdfdf',],
        'buy_date' => ['required', 'date'],
        'phone' => 'nullable|numeric',
       ];

    public $rule_message = [
        'name1.required' => 'الرجاء اضافة اسم الحقل قبل الحفظ :attribute',

    ];


    public function MyCustomeRole()
    {

        $rules = $this->rules;

        $rules['buy_date'][] = function ($attribute, $value, $fail) {

            if ($value > now())
                $fail('nooooo');
        };
        return $rules;
    }

// ---------------------------------------------------------------------------------------MAIN PAGE INDEX


    public function index()
    {
        return view('index');

    }

// ---------------------------------------------------------------------------------------DATA TABLE INDEX

    public function inv_data_method()
    {

        $count = 10;

        if (request()->has('item_count')) {
            $count = request()->item_count;
        }

        $inv = invoice_item::orderby('id', 'desc')->where('DELETE_status_id','!=',3)->paginate($count);

        $from_date= date('Y/m/d', strtotime(request()->from_data_search));
        $to_date= request()->to_data_search  ;



   if ($to_date)   {
    $inv= invoice_item::orderby('id','desc')
    ->where('name1','like', '%'. request()->name_search .'%')
    ->where('item_name','like', '%'. request()->item_search .'%')
    ->where('invoice_no_year','like', '%'. request()->invoice_no_search .'%')
    ->where('buy_date','>=',  $from_date.'%'  )
    ->where('buy_date','<=',  $to_date.'%'   )
    ->where('DELETE_status_id','!=',3)
    ->paginate($count);
   }else {
    $inv= invoice_item::orderby('id','desc')
    ->where('name1','like', '%'. request()->name_search .'%')
    ->where('item_name','like', '%'. request()->item_search .'%')
    ->where('invoice_no_year','like', '%'. request()->invoice_no_search .'%')
    ->where('buy_date','>=',  $from_date.'%'  )
    ->where('DELETE_status_id','!=','3')
    ->paginate($count);
   }



        return view('inv_data', compact('inv'));
    }


// ---------------------------------------------------------------------------------------add phone number from INVOICES
public function add2_method(Request $request){

$var1=contact::create([
'full_name'=>$request->add_name_contact,
'phone_num1'=>$request->add_phone_contact,

]);

// return back()->with('message','doooo');
session()->flash('message','dddd');

}


// ---------php ------------------------------------------------------------------------------CREATE INVOICES


public function create()
{
    $buy_year = date('Y', strtotime(now()));

    $today = date('Y-m-d');
    $inv_edit_data = new invoice();
    $invoice_no_var = (DB::table('invoices')
            ->where('year1', $buy_year)
            ->max('invoice_no')) + 1;

            $invoice_last_id = (DB::table('invoices')

            ->max('id')) ;


            $inv_edit_data_all=NEW ITEM();

    // return response()->json(['data' => 'mydata']);

    return view('create', compact('invoice_no_var', 'today', 'inv_edit_data','inv_edit_data_all','invoice_last_id'));
}


// ---------------------------------------------------------------------------------------POST INVOICES
    public function store(Request $request)
    {
        $buy_year = date('Y', strtotime($request->buy_date));

        $invoice_no_var = invoice::get()->where('year1', $buy_year)->max('invoice_no') + 1;

        // $request->validate($this->rules, $this->rule_message);
        // $request->validate($this->MyCustomeRole(), $this->rule_message);


        $att_var = $this->uploads_file($request); // upload files and pic

        DB::beginTransaction();
        try {

            $inv_date = invoice::create([
                'invoice_no' => $invoice_no_var,
                'buy_date' => $request->buy_date,
                'name1' => $request->name1,
                'phone' => $request->phone,
                'address' => $request->address,
                'invoice_note' => $request->invoice_note,
                'year1' => $buy_year,
                'status_id' => $request->status_id,
                'price' => $request->price,
                'currency' => $request->currency,
                'user_id' => Auth::user()->id,
                'attchments'=>$att_var,
            ]);

            $i = 0;
            foreach($request->item_name as $name) {

                $count=$request->count[$i];
                $item_name=$request->item_name[$i];
               $item_price=$request->item_price[$i];
               $grams=$request->grams[$i];
               $gram_price= $request->gram_price[$i];
               $item_note=$request->item_note[$i];

                item::create([
                    'invoices_id' => $inv_date->id,
                    'count' => $count,
                    'item_name' =>$item_name,
                    'item_price' =>$item_price,
                    'grams' =>$grams,
                    'gram_price' => $gram_price,
                    'item_note' => $item_note,

                ]);
                $i++;
            }

            DB::commit();

            // Alert::success('تم الحفظ بنجاح','   رقم الفاتورة   '.($invoice_no_var+1).'/'. $buy_year);

            return redirect()->back()->with('message', 'تم الحفظ')->with('type', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            // Alert::error('هناك خطأ');
            return redirect()->back()->with('message', 'فشلت عملية الحفظ')->with('type', 'danger');
        }

    }

// ---------------------------------------------------------------------------------------

    public function show($id)
    {
       return '1111';
    }

// --------------------------------------------------------------------------------------- EDIT
    public function edit($id)
    {


        $inv_edit_data = invoice::findorfail($id);

        $inv_edit_data_all = item::where('invoices_id', $id)->get();

        return view('edit', compact('inv_edit_data', 'inv_edit_data_all'));


    }

// --------------------------------------------------------------------------------------- UPDATE
public function update(Request $request, $id)
    {

        $buy_year = date('Y', strtotime($request->buy_date));

        $var1 = invoice::findorfail($id);

        $date1 = strtotime($var1->buy_date);

        if ($date1 == strtotime($request->buy_date)) {

            $invoice_no_var = $request->invoice_no;

        } else {

            $invoice_no_var = invoice::get()->where('year1', $buy_year)->max('invoice_no') + 1;
        }

    // if ($var1->attchments) {

    // $att_var=array_merge($var1->attchments ,$this->uploads_file($request));

    // }
    // else {

    //     $att_var=$this->uploads_file($request);
    // }

    $var1->attchments ? array_merge($var1->attchments ,$this->uploads_file($request)) : $att_var=$this->uploads_file($request);


        DB::beginTransaction();
        try {


            $inv_date = $var1->update([
                'invoice_no' => $invoice_no_var,
                'buy_date' => $request->buy_date,
                'name1' => $request->name1,
                'phone' => $request->phone,
                'address' => $request->address,
                'invoice_note' => $request->invoice_note,
                'year1' => $buy_year,
                'status_id' => $request->status_id,
                'price' => $request->price,
                'currency' => $request->currency,
                'user_id' => Auth::user()->id,
                'attchments' => $att_var,
            ]);


            foreach ($request->moreFields as $key => $value) {
                if (isset($value['id'])){
                $item = item::find($value['id']);

                    $item->update([
                        'count' => $value['count'],
                        'item_name' => $value['item_name'],
                        'item_price' => $value['item_price'],
                        'grams' => $value['grams'],
                        'gram_price' => $value['gram_price'],
                        'item_note' => $value['item_note'],

                    ]);
                }else{
                    item::create([
                        'invoices_id' => $var1->id,
                        'count' => $value['count'],
                        'item_name' => $value['item_name'],
                        'item_price' => $value['item_price'],
                        'grams' => $value['grams'],
                        'gram_price' => $value['gram_price'],
                        'item_note' => $value['item_note'],

                    ]);
                }
            }

            DB::commit();

            // Alert::success('تم الحفظ بنجاح','   رقم الفاتورة   '.($invoice_no_var+1).'/'. $buy_year);

            $back_var= $request->BackToUrl ;

            return redirect($back_var)->with('message', 'تم الحفظ')->with('type', 'success');

                  } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            // Alert::error('هناك خطأ');
            return redirect($back_var)->with('message', 'فشلت عملية الحفظ')->with('type', 'danger');
        }

    }


    // --------------------------------------------------------------------------------------- DESTROY INVOICE

    public function destroy($id)
    {
        $item_rec = item::where('invoices_id', $id)->get();


        if ($item_rec) {



            invoice::where('id',$id)->update([
            'status_id'=>3,
            ]);


            return redirect()->back()->with('message', 'تم حذف الفاتورة بنجاح')->with('type', 'warning');
        } else {
            invoice::destroy($id);
            return redirect()->back()->with('message', 'تم حذف الفاتورة بنجاح')->with('type', 'warning');
        };


    }

   // --------------------------------------------------------------------------------------- DESTROY ITEM
    public function destroy_item($id) {


        item::destroy($id);
        return redirect()->back()->with('message', 'تم حذف الفاتورة بنجاح')->with('type', 'warning');
    }


//----------------------------------------------------------------------------TEST EDIT IN LINE TABLE
    function index1()
    {
        $data = DB::table('sample_datas')->get();
        return view('table_edit', compact('data'));
    }

    function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == 'edit') {
                $data = array(
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender
                );
                DB::table('sample_datas')
                    ->where('id', $request->id)
                    ->update($data);
            }
            if ($request->action == 'delete') {
                DB::table('sample_datas')
                    ->where('id', $request->id)
                    ->delete();
            }
            return response()->json($request);
        }
    }

    // ---------------------------------------------------Contacts index

    public function index_cont(){

        $count=10;

        if (request()->has('item_count')) {
            $count = request()->item_count;
        }

        $cont= contact_vw::orderBy('id','desc')->paginate($count);
        $count_var=($cont->total() );

$cont=contact_vw::OrderBy('id','desc')
->where('full_name','like', '%'.request()->full_name_search.'%' )
->where('phone_num1','like','%'.request()->phone_num1_search.'%')
->where('phone_num2','like','%'.request()->phone_num2_search.'%')
// ->orWhereNull('phone_num2')
->paginate($count);
        return view('cont_main',compact('cont','count_var'));
    }


// ---------------------------------------------------Contacts post
    public function post_cont(Request $request){


$request->validate([
    'full_name'=>'required|min:3|unique:contacts,full_name',
    'phone_num1'=>'required|numeric',
    'phone_num2'=>'nullable|numeric',
]);

        contact::create([

        'full_name'=>$request->full_name,
        'phone_num1'=>$request->phone_num1,
        'phone_num2'=>$request->phone_num2,
        'note'=>$request->note,

        ]);

        return redirect()-> back()->with('message','تم الحفظ بنجاح')->with('type','success');


    }

    public function destroy_cont($id) {


        contact::destroy($id);

        return back()->with('message', 'تم حذف رقم الاتصال ')->with('type', 'warning');

    }

    public function print_invoice_html($id){

        $invoice_item= invoice_item::where('id',$id)->get();
        $invoice= invoice_item::findorfail($id);
        return  view('print_invoice_html',compact('invoice_item','invoice'));
    }


    public function print_pdf($id){

        $invoice_item= invoice_item::where('id',$id)->get();
        $invoice= invoice_item::findorfail($id);
       $filename = 'hello_world.pdf';

       $view = view('print_invoice_html2',compact('invoice_item','invoice'));

       $html = $view->render();

       $pdf = new TCPDF;

       $pdf::SetTitle('Hello World');
       $pdf::AddPage();
       $pdf::writeHTML($html, true, false, true, false, '');

       $pdf::Output(public_path($filename), 'F');

       return response()->download(public_path($filename));



    }

    public function uploads_file ( request $request) {

        if  (!$request->hasfile('attchments'))
        {
            return   ;
        }
        $files= $request->file('attchments') ;

        $att_var=[];

        foreach ($files as $file)
        {

        if ($file->isValid())
        {

        $path=$file->store('/',[
       'disk' =>'public',
        ]);

        $att_var[]=  $path;

        }

        }

                return $att_var;

    }

public function delete_pic(request $request ,$id) {

   $del_pic= invoice::findOrFail($id);
   $del_pic->update ([
    'attchments'=>null,
   ]);


}

}

