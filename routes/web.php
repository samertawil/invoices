<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\Auth\LoginController;




Auth::routes();

Route::get('/',function(){
return view('auth.mylogin');
});


Route::get('invoice',function(){
return view('print_pdf');
});


Route::prefix('main')->middleware('auth')->group(function(){

    Route::resource('invoices', InvoicesController::class);


    Route::get('invoice/inv_data',[InvoicesController::class,'inv_data_method'])->name('inv_data');

    // ----------------------------- Contacts Routes
    Route::get('contacts/cont_main_index',[InvoicesController::class,'index_cont'])->name('cont_main_index');
    Route::POST('contacts/cont_post',[InvoicesController::class,'post_cont'])->name('cont_post');
    Route::delete('contacts/cont_destroy/{id}',[InvoicesController::class,'destroy_cont'])->name('cont_destroy');
    Route::delete('invoices/destroy_item/{id}',[InvoicesController::class,'destroy_item'])->name('destroy_item');


// ------------------------------------add phone number from INVOICES (not used for now)
    Route::post('invoices/add2',[InvoicesController::class,'add2_method'])->name('add2');
//----------------------------------------------------------


// --------------------------------------------------print invoice
    Route::get('invoices/print_pdf/{id}',[InvoicesController::class,'print_pdf'])->name('print_pdf');
    Route::get('invoices/print_invoice_html/{id}',[InvoicesController::class,'print_invoice_html'])->name('print_invoice_html');
//----------------------------------------------------------

    Route::put('invoices/pic_del/{id}' ,[InvoicesController::class,'delete_pic'])->name('delete_pic');

    });


// ------------------- TEST EDIT IN LINE TABLE
 Route::get('tabledit',[InvoicesController::class,'index1']);

 Route::post('tabledit',[InvoicesController::class,'action'])->name('tabledit.action');

// ---------------------------------------
