<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/invoice_style.css') }}" rel="stylesheet">


    <title>طباعة فاتورة رقم {{ $invoice->invoice_no }}</title>

    <style>
        body {
            direction: ltr;

        }


        .invoice-box {
            max-width: 800px;
            margin: auto;
            /* margin-top: 40px; */
            padding: 30px;

            line-height: 24px;

        }

        .invoice-box table {
            width: 100%;

        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;

        }




        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: right;
        }

        /* ---------------------------- */
        .t1 {

            direction: rtl;
        }

        .heading {
            background: #ddd;
            font-weight: bold;

        }

        .tbody {
            text-align: center;
        }

        .tbody td {
            border-bottom: 1px solid #eee;
        }

        .price_c {
            text-align: left;
            margin: 0px 20px;
        }

        .note {
            margin: 10px 20px;
            text-align: right;
        }

        /* #print_btn{
    display: none;
} */

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('img/1.png') }}" style="width: 100%; max-width: 100px" />
                            </td>


                            <td>
                                رقم الفاتورة : {{ $invoice->id }}<br />
                                تاريخ : {{ date('d/m/Y', strtoTime($invoice->buy_date)) }}<br />

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="text-danger">
                                مجوهرات الحداد<br />
                                غزة - البلدة القديمة<br />
                            </td>

                            <td>
                                <span> السيد/ة :</span>{{ ' ' . $invoice->name1 }}<br />
                                John Doe<br />
                                john@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


        </table>

        <table class="t1 table-bordered">

            <thead>
                <tr class="heading text-center ">
                    <th>م</th>

                    <th>الصنف</th>
                    <th>وزن الصنف</th>
                    <th>سعر الجرام</th>
                    <th>السعر</th>
                    <th>ملاحظات للصنف</th>


                </tr>
            </thead>

            @foreach ($invoice_item as $inv_data)
                <tbody class="tbody">

                    <tr>
                        <td>{{ $inv_data->count }}</td>

                        <td>{{ $inv_data->item_name }}</td>
                        <td>{{ $inv_data->grams . ' جرام ' }}</td>
                        <td>{{ $inv_data->gram_price . '  ' . $inv_data->status_name }}</td>
                        <td>{{ $inv_data->item_price . '  ' . $inv_data->status_name }}</td>
                        <td>{{ $inv_data->item_note }}</td>


                    </tr>
            @endforeach
            </tbody>
        </table>

        </table>

        {{-- <button type="button" class="btn btn-success my-1" onclick="window.print();">Print Invoice</button> --}}

    </div>
</body>
<div class="container">

    <div class="price_c">

        <td> المبلغ الاجمالي : {{ $invoice->price . ' ' . $invoice->status_name }} </td>

    </div>

    @if ($invoice->invoice_note)
        <div class="note">

            <td> ملاحظات : {{ $invoice->invoice_note }} </td>

        </div>

</div>
@endif

<script>
    window.onload = function() {
        window.print();
    }
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</html>
