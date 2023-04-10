     <style>
         table td,
         table tr {
             vertical-align: middle;
             align-content: center;

         }

         .container {
             margin: 10px auto;
         }

         #print_btn {
             font-size: 21px;
             color: green;
             margin-right: 7px;
         }

     </style>

     @extends('layouts.master')
     @section('content')
         @include('layouts._alert_session')

         <div class="row justify-content-between">

             <h1 class="h5 mb-4 text-danger text-right col-3">الاستعلام عن فواتير البيع</h1>
             <a class="collapse-item col-2" href="{{ route('invoices.create') }}">فاتورة جديدة</a>
         </div>
         <hr>
         <br>

         <form action="" method="GET">
             {{-- search area-------------------------- --}}
             <div class="container ">
                 <div class="row justify-content-around my-5 ">

                     <div class="col-3">
                         <label>اسم المشتري</label>
                         <input type="text" name="name_search" placeholder="اسم المشتري" class="form-control"
                             value="{{ request()->name_search }}">
                     </div>

                     <div class="row col-4 date_search justify-content-center">
                         <div class="col-5">
                             <label>من تاريخ</label>
                             <input type="date" name="from_data_search" class="form-control"
                                 value="{{ request()->from_data_search }}">

                         </div>

                         <div class="col-5">
                             <label>الي تاريخ</label>
                             <input type="date" name="to_data_search" class="form-control"
                                 value="{{ request()->to_data_search }}">
                         </div>
                     </div>

                     <div class="col-1">
                         <label>رقم الفاتورة</label>
                         <input type="text" name="invoice_no_search" class="form-control"
                             value="{{ request()->invoice_no_search }}">
                     </div>


                     <div class="col-3">
                         <label>اسم الصنف</label>
                         <input type="text" name="item_search" placeholder="اسم الصنف" class="form-control"
                             value="{{ request()->item_search }}">
                     </div>
                     <div class="col-1  d-flex align-items-end">
                         <button class=" btn btn-success px-4 ">بحث</button>
                     </div>

                 </div>
             </div>

         </form>

         {{-- search area-------------------------- --}}


         <!-- row opened -->
         <div class="row row-sm">

             <div class="col-xl-12">
                 <div class="card mg-b-20">
                     <div class="card-header pb-0">
                         <div class="d-flex justify-content-between">


                         </div>

                         <form action="" id="filter_form" class="d-flex align-items-center justify-content-end"
                             method="GET">
                             @if (request()->page)
                                 <input type="hidden" name="page" value="{{ request()->page }}" />
                             @endif

                             عدد الفواتير بالصفحة

                             <select class="mx-2 px-3" name="item_count" id="item_count">

                                 <option {{ request()->item_count == 10 ? 'selected' : '' }}>10</option>
                                 <option {{ request()->item_count == 20 ? 'selected' : '' }}>20</option>
                                 <option {{ request()->item_count == 30 ? 'selected' : '' }}>30</option>
                                 <option {{ request()->item_count == 40 ? 'selected' : '' }}>40</option>
                                 <option {{ request()->item_count == 50 ? 'selected' : '' }}>50</option>

                             </select>


                         </form>
                     </div>
                     <div class="card-body">
                         <div class="table-responsive">
                             <table id="example" class="table key-buttons text-md-nowrap table-striped table-bordered">
                                 <thead>
                                     <tr class="table-info">
                                         <th class="border-bottom-0 font-weight-bold">م</th>
                                         <th class="border-bottom-0 font-weight-bold text-center" style="width:20%;">اسم
                                             المشتري</th>
                                         <th class="border-bottom-0">الفاتورة</th>
                                         <th class="border-bottom-0">تاريخ الشراء</th>
                                         <th class="border-bottom-0">الصنف</th>
                                         <th class="border-bottom-0">وزن الصنف</th>
                                         <th class="border-bottom-0">سعر الجرام</th>
                                         <th class="border-bottom-0">اجمالي الفاتورة</th>
                                         <th class="border-bottom-0">ملاحظات للصنف</th>
                                         <th class="border-bottom-0 text-center" style="width:15%;">الاجراءات</th>


                                     </tr>
                                 </thead>
                                 <tbody>
                                     @forelse ($inv as $inv_data)
                                         <tr>
                                             <td>{{ $inv_data->id }}</td>
                                             <td>{{ $inv_data->name1 }}</td>
                                             <td>{{ $inv_data->invoice_no_year }} </td>
                                             <td>{{ date('d/m/Y', strtotime($inv_data->buy_date)) }}</td>
                                             <td>{{ $inv_data->item_name }}</td>
                                             <td>{{ $inv_data->grams . ' جرام ' }}</td>
                                             <td>{{ $inv_data->gram_price . '  ' . $inv_data->status_name }}</td>
                                             <td>{{ $inv_data->price . '  ' . $inv_data->status_name }}</td>
                                             <td>{{ $inv_data->item_note }}</td>
                                             <td>


                                                 <button class="d-inline btn  btn-sm  edit_btn ">
                                                     <a class="d-inline "
                                                         href="{{ route('invoices.edit', $inv_data->id) }}">
                                                         <i class="fas fa-edit" style="font-size: 22px;"></i></a>
                                                 </button>

                                                 <form class="d-inline"
                                                     action="{{ route('invoices.destroy', $inv_data->id) }}"
                                                     method="POST">

                                                     @csrf
                                                     @method('delete')
                                                     <button
                                                         onclick=" return confirm('هل انت متاكد من  مسح الفاتورة كاملا؟')"
                                                         class="btn btn-danger btn-sm" type="submit"><i
                                                             class="fas fa-trash" style="font-size: 12px;"></i></button>
                                                 </form>

                                                 <form class="d-inline mr-2"
                                                     action="{{ route('destroy_item', $inv_data->items_id_pk) }}"
                                                     method="post">
                                                     @csrf
                                                     @method('delete')
                                                     <button onclick=" return confirm(' هل انت متأكد من مسح الصنف ؟ ')"
                                                         class="btn btn-warning btn-sm" type="submit"><i
                                                             class="fas fa-trash" style="font-size: 12px;"></i></button>

                                                 </form>


                                                 <a class="d-inline"
                                                     href="{{ Route('print_invoice_html', $inv_data->id) }}"
                                                     target="_blank"><i class="fa fa-print" id="print_btn"
                                                         aria-hidden="true"></i></a>

                                             </td>


                                         </tr>
                                     @empty
                                         <tr>
                                             <td colspan="10" class="text-center">لا توجد بيانات</td>
                                         </tr>
                                     @endforelse

                                 </tbody>
                             </table>
                             {{ $inv->appends($_GET)->links() }}
                         </div>
                     </div>
                 </div>
             </div>


         </div>

         </div>

         </div>
     @endsection
     @section('js')
         <script src="{{ asset('js/jQuery.js') }}"></script>
         <script src="{{ asset('js/bootstrap.js') }}"></script>

         <script>
             $('#item_count').change(function() {

                 $('#filter_form').submit();
             });
         </script>
     @endsection
