@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تعديل قسم
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل قسم</span>
            </div>
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

    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('earths.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    {!! Form::model($earth, ['route' => ['earths.update', $earth->id], 'method' => 'PUT']) !!}
                    {{ csrf_field() }}

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>الاسم: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                    name="name" required="" type="text" value="{{ $earth->name }}">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>الرقم الوطني: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                    name="SSN"  type="text" value="{{ $earth->SSN }}">
                            </div>
                        </div>

                         <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>رقم القطعة: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                    name="enumber" required="" type="text" value="{{ $earth->enumber }}">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label> المساحة: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                    name="space" required="" type="text" value="{{ $earth->space }}">
                            </div>
                        </div>


                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label> رقم المربع: <span class="tx-danger">*</span></label>
                                <select class="form-control" name="square_id">
                                    <option value='1' {{ $earth->square->name == '1' ? 'selected' : '' }}> 1 </option>
                                    <option value='2' {{ $earth->square->name == '2' ? 'selected' : '' }}> 2 </option>
                                    <option value='3' {{ $earth->square->name == '3' ? 'selected' : '' }}> 3 </option>
                                    <option value='4' {{ $earth->square->name == '4' ? 'selected' : '' }}> 4 </option>
                                    <option value='5' {{ $earth->square->name == '5' ? 'selected' : '' }}> 5 </option>
                                    <option value='6' {{ $earth->square->name == '6' ? 'selected' : '' }}> 6 </option>
                                    <option value='7' {{ $earth->square->name == '7' ? 'selected' : '' }}> 7 </option>
                                    <option value='8' {{ $earth->square->name == '8' ? 'selected' : '' }}> 8 </option>
                                    <option value='9' {{ $earth->square->name == '9' ? 'selected' : '' }}> 9 </option>
                                    <option value='10' {{ $earth->square->name == '10' ? 'selected' : '' }}> 10 </option>
                                    <option value='11' {{ $earth->square->name == '11' ? 'selected' : '' }}> 11 </option>
                                    <option value='12' {{ $earth->square->name == '12' ? 'selected' : '' }}> 12 </option>
                                     <option value='13' {{ $earth->square->name == '13' ? 'selected' : '' }}> 13 </option>
                                      <option value='14' {{ $earth->square->name == '14' ? 'selected' : '' }}> 14 </option>
                                       <option value='15' {{ $earth->square->name == '15' ? 'selected' : '' }}> 15 </option>
                                </select>
                                </select>
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label> النوع: <span class="tx-danger">*</span></label>
                                <select class="form-control" name="gender">
                                    <option value='ذكر' {{ $earth->gender == 'ذكر' ? 'selected' : '' }}> ذكر
                                    </option>
                                    <option value='انثى' {{ $earth->gender == 'انثى' ? 'selected' : '' }}> انثى
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>رقم الهاتف: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                    name="phone" type="text" value="{{ $earth->phone }}">
                            </div>
                        </div>


                    </div>


                    <div class="row row-sm mg-b-20">

                    </div>

                    <div class="row mg-b-20">

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->


@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>



    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>


@endsection
