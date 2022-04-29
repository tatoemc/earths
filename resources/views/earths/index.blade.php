@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css-rtl/bootstrap-datepicker.css') }}" rel="stylesheet">
@endsection

@section('title')
    قطع الاراضي
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاراضي</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كل
                    الاراضي</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">


        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add_earths'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة  القطعة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('earth_edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم التعديل بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('delete_earth'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف  قطعة الارض بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-sm-1 col-md-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('earths.create') }}">اضافة </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: right;">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">الاسم</th>
                                    <th class="border-bottom-0">النوع</th>
                                    <th class="border-bottom-0">الرقم الوطني</th>
                                    <th class="border-bottom-0">رقم الهاتف</th>
                                    <th class="border-bottom-0">رقم القطعة</th>
                                    <th class="border-bottom-0">المساحة</th>
                                    <th class="border-bottom-0">المربع</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($earths as $index => $earth)
                                    <tr>
                                        <td>{{ $earth->id }}</td>
                                        <td>{{ $earth->name }} </td>
                                        <td>{{ $earth->gender }} </td>
                                        <td>{{ $earth->SSN }} </td>
                                        <td>{{ $earth->phone }} </td>
                                        <td>{{ $earth->enumber }} </td>
                                        <td>{{ $earth->space }} </td>
                                        <td>{{ $earth->square->name }} </td>
                                        <td>
                                              <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">

                                                    <a class="dropdown-item"  href="{{ route('earths.show', $earth->id) }}">
                                                           <i class="text-success fas fa-eye"></i>&nbsp;&nbsp;عرض
                                                    </a>


                                                    <a class="dropdown-item"  href="{{ route('earths.edit', $earth->id) }}">
                                                           <i class="text-success fas fa-edit"></i>&nbsp;&nbsp;تعديل
                                                    </a>

                                                    <a class="dropdown-item" data-earth_id="{{ $earth->id }}"
                                                        data-toggle="modal" data-target="#delete_earth"
                                                        href="Print_earth/{{ $earth->id }}"><i
                                                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                    </a>

                                                     <a class="dropdown-item" href="Print_earth/{{ $earth->id }}"><i
                                                                class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                            الفاتورة
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit_earth" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">تعديل قطعة ارض</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::model($earth, ['route' => ['earths.update', $earth->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
                                                    {{ method_field('patch') }}
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" id="id" value="{{ $earth->id }}">
                                                        <label for="recipient-name" class="col-form-label">الاسم :</label>
                                                        <input class="form-control" name="name" id="name" type="text" value="{{ $earth->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">الرقم
                                                            الوطني:</label>
                                                        <input class="form-control" name="SSN" id="SSN" type="text"
                                                            value="{{ $earth->SSN }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">رقم الهاتف:</label>
                                                        <input class="form-control" name="phone" id="phone" type="text" value="{{ $earth->phone }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">رقم القطعة:</label>
                                                        <input class="form-control" name="enumber" id="enumber" value="{{ $earth->enumber }}"
                                                            type="text">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">المساحة:</label>
                                                        <input class="form-control" name="space" id="space" type="text" value="{{ $earth->space }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">المربع:</label>
                                            
                                                           <select class="form-control" name="square_id">
	                                                         <option value='1'{{ $earth->square->name == '1' ? 'selected' : ''}}> 1 </option>
	                                                        <option value='2'{{ $earth->square->name == '2' ? 'selected' : ''}}> 2 </option>
                                                            <option value='3'{{ $earth->square->name == '3' ? 'selected' : ''}}> 3 </option>
                                                            <option value='4'{{ $earth->square->name == '4' ? 'selected' : ''}}> 4 </option>
	                                                        <option value='5'{{ $earth->square->name == '5' ? 'selected' : ''}}> 5 </option>
                                                            <option value='6'{{ $earth->square->name == '6' ? 'selected' : ''}}> 6 </option>
                                                            <option value='7'{{ $earth->square->name == '7' ? 'selected' : ''}}> 7 </option>
	                                                        <option value='8'{{ $earth->square->name == '8' ? 'selected' : ''}}> 8 </option>
                                                            <option value='9'{{ $earth->square->name == '9' ? 'selected' : ''}}> 9 </option>
                                                            <option value='10'{{ $earth->square->name == '10' ? 'selected' : ''}}> 10 </option>
	                                                        <option value='11'{{ $earth->square->name == '11' ? 'selected' : ''}}> 11 </option>
                                                            <option value='12'{{ $earth->square->name == '12' ? 'selected' : ''}}> 12 </option>
                                                              </select> 

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">تاكيد</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">اغلاق</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
    </div>
    <!-- row closed -->
   
    <!-- حذف  قطعة -->
    <div class="modal fade" id="delete_earth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الكافل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('earths.destroy', 'delete') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="earth_id" id="earth_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit -->


    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.js') }}"></script>


    <script>
        $('#delete_earth').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var earth_id = button.data('earth_id')
            var modal = $(this)
            modal.find('.modal-body #earth_id').val(earth_id);
        })
    </script>
@endsection
