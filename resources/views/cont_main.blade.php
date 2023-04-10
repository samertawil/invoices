     @extends('layouts.master')

     <style>
         table td,
         table tr {
             vertical-align: middle;
             align-content: center;

         }


     </style>


     @section('content')

         @include('auth.validate')
         @include('layouts._alert_session')

         <h1 class="h5 mb-4 text-danger text-right">جهات الاتصال</h1>
         <hr>
         <br>


         <span>اضافة جهة اتصال</span>
         <form action="{{ route('cont_post') }}" method="POST" class="d-flex align-items-end">
             @csrf

             <div class="row  container  div_color_input   mr-0 pr-0">

                 <div class="col-3">

                     <label>الاسم</label>
                     <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                         placeholder="الاسم">
                     @error('full_name')
                         <span class="invalid-feedback" role="alert">
                             <small>{{ $message }}</small>
                         </span>
                     @enderror
                 </div>

                 <div class="col-2">
                     <label>جوال 1</label>
                     <input type="text" name="phone_num1" class="form-control @error('phone_num1') is-invalid @enderror">

                     @error('phone_num1')
                         <span class="invalid-feedback" role="alert">
                             <small>{{ $message }}</small>
                         </span>
                     @enderror
                 </div>


                 <div class="col-2">
                     <label>جوال 2</label>
                     <input type="text" name="phone_num2" class="form-control @error('phone_num2') is-invalid @enderror">

                     @error('phone_num2')
                         <span class="invalid-feedback" role="alert">
                             <small>{{ $message }}</small>
                         </span>
                     @enderror

                 </div>


                 <div class="col-3">
                     <label>ملاحظات</label>
                     <input type="text" name="note" class="form-control">
                 </div>



                 <div class="col-1 d-flex align-items-end">
                     <button class="btn btn-info px-3">حفظ</button>
                 </div>

             </div>

         </form>

         {{-- search area ------------------ --}}
         <span>البحث عن جهة اتصال</span>

         <form action="" method="get">
             @csrf


             <div class=" container div_color_input    mr-0 pr-0">

                 <div class="row   my-2">

                     <div class="col-3 pr-4 ">
                         <label>الاسم</label>
                         <input type="text" name="full_name_search" class="form-control " placeholder="الاسم"
                             value="{{ request()->full_name_search }}">
                     </div>

                     <div class="col-2">
                         <label>جوال 1</label>
                         <input type="text" name="phone_num1_search" class="form-control"
                             value="{{ request()->phone_num1_search }}">
                     </div>

                     <div class="col-2">
                         <label>جوال 2</label>
                         <input type="text" name="phone_num2_search" class="form-control"
                             value="{{ request()->phone_num2_search }}">
                     </div>

                     <div class="col-1  d-flex align-items-end">
                         <button class=" btn btn-success px-3 ">بحث</button>
                     </div>
                 </div>
             </div>
         </form>


         {{-- end search area ------------------ --}}

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

                        
                             عدد السجلات بالصفحة
                           
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
                                         <th class="border-bottom-0 font-weight-bold" style="width:30%;">اسم الجهة</th>
                                         <th class="border-bottom-0">جوال 1</th>
                                         <th class="border-bottom-0">جوال 2</th>
                                         <th class="border-bottom-0">ملاحظات</th>
                                         <th class="border-bottom-0" style="width:10%;">الاجراءات</th>


                                     </tr>
                                 </thead>
 
                                 <tbody>
                                     @forelse ($cont as $key=> $cont_data)
                                         <tr>
                                             <td>{{  $key+1}}</td>
                                             <td>{{ $cont_data->full_name }}</td>
                                             <td>{{ $cont_data->phone_num1 }} </td>
                                             <td>{{ $cont_data->phone_num2 }} </td>
                                             <td>{{ $cont_data->note }}</td>
                                             <td>
                  {{-- to get datasource view , the name and phone data from contact table or invoice table --}}
                                                 <input type="hidden" name="data_source" class="data_source"
                                                     value="{{ $cont_data->data_source }}">
                  {{-- -- to get number of record that return for query to use it in i loop count in js file --}}
                                                 <input type="hidden" id="count_var" value="{{ $count_var }}">
                  {{-- -- to return back url when save message in controller  --}}
                                                 {{-- <input type="text" name="BackToUrl" value="{{ URL::previous() }}"> --}}

                                          
                                                 <button class="d-inline btn  btn-sm  edit_btn ">
                                                    <a class="d-inline "
                                                        href="{{ route('invoices.edit', $cont_data->id) }}">
                                                        <i class="fas fa-edit" style="font-size: 21px;"></i></a>
                                                </button>


                                                 <form class="d-inline"
                                                     action="{{ route('cont_destroy', $cont_data->id) }}" method="POST">

                                                     @csrf
                                                     @method('delete')
                                                     <button onclick=" return confirm('هل انت متاكد من عملية المسح ؟')"
                                                         class="btn btn-danger btn-sm del_btn" type="submit" id="del_btn"><i
                                                             class="fas fa-trash" style="font-size: 12px;"></i></button>

                                                 </form>


                                             </td>

                                         </tr>
                                     @empty
                                         <tr>
                                             <td colspan="10" class="text-center">لا توجد بيانات</td>
                                         </tr>
                                     @endforelse

                                 </tbody>
                             </table>
                             {{ $cont->appends($_GET)->links() }}
                         </div>
                     </div>
                 </div>
             </div>


         </div>


     @stop
     @section('js')
         <script>
             $('#item_count').change(function() {

                 $('#filter_form').submit();
             });
         </script>
         <script src="{{ asset('js/ContactsJs.js') }}"></script>



     @endsection
