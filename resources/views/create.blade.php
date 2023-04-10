@extends('layouts.master')

<style>
    #btn_remove {
        width: 32px !important;
        height: 32px !important;
        display: flex;
        position: relative;
        justify-content: center;
        align-items: center;
        border-radius: 0.25rem;
        font-size: 12px;
        opacity: .9;
        margin-top: 5px;

    }

    #sum_input {
        display: flex;
        position: relative;
        top: 14px;
        right: 627px;
        width: 90px;
    }

    #btn_remove:hover {
        opacity: 1;
    }

  #print_btn{
    text-decoration: none;
    color: white;


  }

</style>





@section('content')
    @include('layouts._alert_session')

    @include('auth.validate')

    <div class="row justify-content-between">
        <h1 class="col-2 h5 mb-4 text-danger text-right">اصدار فاتورة </h1>
        <a class="col-2" href="{{ route('inv_data') }}">الاستعلام عن فاتورة</a>
    </div>
    <hr>
    <br>

    <form class="form" action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        @include('layouts._form_input_invoice')


<div class=" item-wrapper div_color_input">
    <div class="row item">
        <div class="col-1" style="width: 7%;">
            <label># :</label>
            <input type="number" class="form-control" placeholder="#" required name="count[]" value="1" />

        </div>


        <div class="col-3">
            <label>الصنف :</label>
            <input type="text" class="form-control" placeholder="الصنف" name="item_name[]"
                value="{{ old('item_name') }}" />

        </div>

        <div class="col-1">
            <label>الوزن :</label>
            <input type="number" onkeyup="calc_rows()" class="form-control gram_row" placeholder="الوزن"
                name="grams[]" value="{{ old('grams') }}" id="grams" />

        </div>



        <div class="col-1">
            <label>سعر الجرام:</label>
            <input type="text" onkeyup="calc_rows()" class="form-control gram_price_row" placeholder="$"
                name="gram_price[]" value="{{ old('gram_price') }}" id="gram_price" />

        </div>


        <div class="col-1">
            <label>اجمالي :</label>
            <input type="text" class="form-control total_row" placeholder="$" name="item_price[]"
                value="{{ old('item_price') }}" id="total" />

        </div>


        <div class="col-4">
            <label>ملاحظات :</label>
            <div class="row">
                <div class="col-10">
                    <input type="text" class="form-control " placeholder="ملاحظة" name="item_note[]"
                        value="{{ old('item_note') }}" />
                </div>

                <div class="text-left col-1">
                    <button class="btn btn-success  px-2  " type="button" id="add_row"><i class="fa fa-plus-circle"
                            aria-hidden="true"></i></button>
                </div>
            </div>
        </div>



    </div>




    </div>



    <div>

        <input id="sum_input" class="form-control" type="text" placeholder="اجمالي" name="price" value="0">

    </div>


        <div class="text-left mt-5">
            <button class="btn btn-info font-weight-bold mr-2 px-3 save_btn">حفظ</button>
            <button class="btn btn-warning  font-weight-bold mr-1 px-4 reset" type="reset">إلغاء</button>
@if ( $invoice_last_id)


            <button type="button" class="btn btn-success font-weight-bold mr-4 px-3" style=" border:none; background-color:green !important;">
                <a id="print_btn" href="{{ route('print_invoice_html', $invoice_last_id) }}"  target="_blank">طباعة</a>
            </button>
            @endif
        </div>

    </form>



@endsection



@section('js')
<script>
    var i = 0;

    var b = i + 1;
    var c = i - 1;
    $("#add_row").click(function() {
        ++i;
        ++b;
        c++;
        $(".item-wrapper").append(`<div class="row item mt-2"><div class="col-1" style="width: 7%;">

            <input " type="number"  id="count_var" class="form-control count_item_row" placeholder="#" required  name="count[]""
            value="` + b + `"/>
            </div>


            <div class="col-3">

                <input type="text" class="form-control item_class" placeholder="الصنف" name="item_name[]"
                    value="{{ old('item_name') }}" />

            </div>
            <div class="col-1">

                <input type="number" onkeyup="calc_rows()"   class="form-control gram_row" placeholder="الوزن" name="grams[]"
                    value="{{ old('grams') }}" id="gram" />

            </div>



            <div class="col-1">

                <input type="text" onkeyup="calc_rows()" class="form-control gram_price_row" placeholder="$" name="gram_price[]"
                    value="{{ old('gram_price') }}" id="gram_price" />

            </div>


            <div class="col-1">

                <input type="text"  class="form-control total_row" placeholder="$" name="item_price[]"
                    value="{{ old('item_price') }}" id="total" />

            </div>
            <div class="col-4">

                <div class="row">
                    <div class="col-10">
                        <input type="text" class="form-control " placeholder="ملاحظة" name="item_note[]"
                            value="{{ old('item_note') }}" />
                    </div>

                    <div class="text-left col-1">
                                   <button  onclick="remove_fn(this)" id="btn_remove" type="button" class="btn btn-danger px-3" >
               <i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>


            </div>`);

            resort_add(); //  اعادة ترقيم مسلسل الصنف لسد الgap

    });


</script>
<script src="{{ asset('js/invoicesjs2.js') }}"></script>
@endsection
