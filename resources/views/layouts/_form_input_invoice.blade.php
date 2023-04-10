<div class="card-body  div_color_input  ">
    <div class="form-group row ">

        <div class="col-1">
            <label> الرقم :</label>
            <input type="text" class="form-control" placeholder="#" name="invoice_no"
                value="{{ $invoice_no_var ?? $inv_edit_data->invoice_no }}" />



        </div>

        <div class="col-2">
            <label> التاريخ :</label>
            <input type="date" name="buy_date" class="form-control @error('buy_date') is-invalid @enderror"
                value="{{ $today ?? date('Y-m-d', StrToTime($inv_edit_data->buy_date)) }}" autofocus />

            @error('buy_date')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </div>

        <div class="col-3">
            <label>اسم المشتري :</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" name="name1" id="name1_id" class="form-control @error('name1') is-invalid @enderror"
                    placeholder="اسم المشتري" value="{{ old('name1', $inv_edit_data->name1) }}"
                    autocomplete="name1" />
                @error('name1')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </div>

        </div>


        <div class="col-3">
            <label>العملة :</label>
            {{-- @dump( $inv_edit_data->currency ) --}}
            <div class="radio-inline">
                <label class="radio radio-solid mx-3 ">
                    <input type="radio" name="currency" checked="checked" value="2"
                        {{ $inv_edit_data->currency == 2 ? 'checked' : '' }} />
                    <span>دينار</span>

                </label>
                <label class="radio radio-solid">
                    <input type="radio" name="currency" value="3"
                        {{ $inv_edit_data->currency == 3 ? 'checked' : '' }} />
                    <span>دولار</span>

                </label>

                </label>
                <label class="radio radio-solid mx-3">
                    <input type="radio" name="currency" value="4"
                        {{ $inv_edit_data->currency == 4 ? 'checked' : '' }} />
                    <span>شيكل</span>

                </label>

            </div>

        </div>


    </div>
    <div class="form-group row">

        <div class="col-3">
            <label>العنوان :</label>
            <div class="input-group">
                <div class="input-group-append"><span class="input-group-text"><i
                            class="fa fa-map-marker text-dark"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="العنوان" name="address"
                    value="{{ old('address', $inv_edit_data->address) }}" />

            </div>
        </div>
        <div class="col-3">
            <label>جوال :</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input type="text" name="phone" id="phone1_id" class="form-control @error('phone') is-invalid @enderror"
                    placeholder="جوال" value="{{ old('phone', $inv_edit_data->phone) }}" />
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </div>


        </div>



        <div class="col-3">
            <label>ملاحظات :</label>
            <input type="text" class="form-control" placeholder="ملاحظة" name="invoice_note"
                value="{{ old('invoice_note', $inv_edit_data->invoice_note) }}" />

        </div>

        <div class="col-3">
            <label>حالة الفاتورة :</label>

            <div class="radio-inline">
                <label class="radio radio-solid mx-3 ">
                    <input type="radio" name="status_id" checked="checked" value="1"
                        {{ old('status_id') == '1' ? 'checked' : '' }} />
                    <span>منتهية</span>

                </label>
                <label class="radio radio-solid">
                    <input type="radio" name="status_id" value="0" {{ old('status_id') == '0' ? 'checked' : '' }} />
                    <span>قيد الاجراء</span>

                </label>
            </div>

        </div>

    </div>
    <div class="col-3 mt-4 mr-0 pr-0">
        <label>اضافة مرفقات</label>
        <input type="file" name="attchments[]" id="upload" accept="image/*, application/pdf" class="form-control"
            multiple style="border-radius: 0px;">
    </div>
    <br>

</div>

<div>
    <ul>
        @if ($inv_edit_data->attchments)

            {{-- <div>
                <form action={{ route('delete_pic', $inv_edit_data->id) }} method="post">
                    @csrf
                    @method('put')
                    <button onclick=" return confirm(' هل انت متأكد من مسح المرفقات ؟ ')"
                        class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"
                            style="font-size: 12px;"></i>
                    </button>
                </form>
            </div> --}}

            @foreach ($inv_edit_data->attchments as $attchment)
                <a href="{{ asset('storage/' . $attchment) }}" target="_blank" class="tag_a_default">
                    <li>{{ $attchment }}</li>
                </a>
            @endforeach
        @endif
    </ul>
</div>
{{-- //------------------------------ITEM PART---------------------------------------------------------- --}}
