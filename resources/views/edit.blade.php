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
        right: 619px;
        width: 90px;
    }

    #btn_remove:hover {
        opacity: 1;
    }



</style>


@section('content')
    @include('layouts._alert_session')


    @include('auth.validate')



    <h1 class="h5 mb-4 text-danger text-right"> تعديل فاتورة </h1>
    <hr>
    <br>

  <form class="form" action="{{ route('invoices.update', $inv_edit_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        @include('layouts._form_input_invoice')

        {{-- --------------- --}}
      
        <div class="row mt-3">

            <p class="col-1" style="margin-right:10px;"> # </p>
            <p class="col-1 " style="margin: 0px 100px;"> الصنف </p>
            <p class="col-1">الوزن</p>
            <p class="col-1"> سعر الجرام </p>
            <p class="col-2"> اجمالي الصنف </p>
            <p class="col-1"> ملاحظات </p>
            <div class="text-left   col-1" style="margin-right:120px;">
                <button class="btn btn-success " style="margin-left: 100px;" type="button" id="add_edit_row"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i></button>
            </div>

        </div>

        <div class="item-wrapper">
            @php $i=0 @endphp
            @foreach ($inv_edit_data_all as $key => $inv_data)
                <input type="hidden" name="moreFields[{{ $key }}][id]" value="{{ $inv_data->id }}">

                <div class="row item ">

                    <div class="col-1 my-1" style="width: 7%;">
                        {{-- <label># :</label> --}}
                        <input type="number" class="form-control" placeholder="#"
                            name="moreFields[{{ $key }}][count]" value="{{ old('count', $inv_data->count) }}" />

                    </div>


                    <div class="col-3 my-1">
                        {{-- <label>الصنف :</label> --}}
                        <input type="text" class="form-control" placeholder="الصنف"
                            name="moreFields[{{ $key }}][item_name]"
                            value="{{ old('item_name', $inv_data->item_name) }}" />

                    </div>


                    <div class="col-1 my-1">
                        {{-- <label>الوزن :</label> --}}
                        <input type="number" class="form-control" placeholder="الوزن"
                            name="moreFields[{{ $key }}][grams]" value="{{ old('grams', $inv_data->grams) }}"
                            id="grams" />

                    </div>



                    <div class="col-1 my-1">
                        {{-- <label>سعر الجرام:</label> --}}
                        <input type="text" class="form-control" placeholder="$"
                            name="moreFields[{{ $key }}][gram_price]"
                            value="{{ old('gram_price', $inv_data->gram_price) }}" id="gram_price" />

                    </div>


                    <div class="col-1 my-1">
                        {{-- <label>اجمالي :</label> --}}
                        <input type="text" class="form-control" placeholder="$"
                            name="moreFields[{{ $key }}][item_price]"
                            value="{{ old('item_price', $inv_data->item_price) }}" id="total" />

                    </div>


                    <div class="col-4 my-1">
                        {{-- <label>ملاحظات :</label> --}}
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="form-control " placeholder="ملاحظة"
                                    name="moreFields[{{ $key }}][item_note]"
                                    value="{{ old('item_note', $inv_data->item_note) }}" />
                            </div>


                        </div>
                    </div>



                </div>
                @php $i++; @endphp
            @endforeach

        </div>
  
        <div>
              
            <input id="sum_input" class="form-control" type="text" placeholder="اجمالي" name="price" 
            value="{{  $inv_edit_data->price }}">
        
        </div>
    
        <input type="hidden" name="BackToUrl" value="{{ URL::previous() }}">
        {{-- ------------------ --}}


        <div class="text-left mt-5">
            <button class="btn btn-info font-weight-bold mr-2 px-3 save_btn">حفظ</button>
            <button class="btn btn-warning  font-weight-bold mr-2 px-4" id="abort_update">إلغاء</button>
        </div>


    </form>
   
@endsection



@section('js')
    <script>
        var i = {{ $i }};
        $("#add_edit_row").click(function() {
            ++i;
            $(".item-wrapper").append(`<div class="row item mt-2"><div class="col-1" style="width: 7%;">

                <input type="number" class="form-control" placeholder="#" name="moreFields[` + i + `][count]"
                value="{{ old('count') }}" />

                </div>
                <div class="col-3">

                    <input type="text" class="form-control" placeholder="الصنف" name="moreFields[` + i + `][item_name]"
                        value="{{ old('item_name') }}" />

                </div>
                <div class="col-1">

                    <input type="number" class="form-control" placeholder="الوزن" name="moreFields[` + i + `][grams]"
                        value="{{ old('grams') }}" id="grams" />

                </div>



                <div class="col-1">

                    <input type="text" class="form-control" placeholder="$" name="moreFields[` + i + `][gram_price]"
                        value="{{ old('gram_price') }}" id="gram_price" />

                </div>


                <div class="col-1">

                    <input type="text" class="form-control" placeholder="$" name="moreFields[` + i + `][item_price]"
                        value="{{ old('item_price') }}" id="total" />

                </div>
                <div class="col-4">

                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control " placeholder="ملاحظة" name="moreFields[` + i + `][item_note]"
                                value="{{ old('item_note') }}" />
                        </div>

                        <div class="text-left col-1">
                                       <button   id="btn_remove" class="btn btn-danger px-3" >
                   <i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>


                </div>`);
        });



        $('body').on('click', '#btn_remove', function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().parent().remove();
        });
    </script>
    <script src="{{ asset('js/invoicejs.js') }}"></script>
@endsection
@section('js2')
    <script>
        let abort_update = document.getElementById('abort_update');

        abort_update.onclick = function(e) {
            e.preventDefault();
            history.back();
        }
    </script>
@endsection
