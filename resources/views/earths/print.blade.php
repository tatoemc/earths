@extends('layouts.master')
@section('css')
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    تفاصيل قطعة الارض
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قطع الاراضي</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل قطعة ارض</span>
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
                    <div  class="table-responsive " id="print">
                        <table class="table mg-b-0 text-md-nowrap" >
                            <thead>
                            <tr>
                             <th colspan="2"> <center><h2>لجنة الاجراءات الاولية </h2></center> </th>
                             </tr>
                             <tr>
                               <th colspan="2"> <h3>بيانات القطعة رقم : {{ $earth->enumber }}</h3> </th>
                             </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td>الاسم</td>
                                    <td>{{ $earth->name }}</td>
                                </tr>
                                <tr>
                                    <td>النوع</td>
                                    <td>{{ $earth->gender }}</td>
                                </tr>
                              
                                <tr>
                                    <td>المساحة</td>
                                    <td>{{ $earth->space }}</td>
                                </tr>
                                <tr>
                                    <td>رقم المربع</td>
                                    <td>{{ $earth->square->name }}</td>
                                </tr>
                                <tr>
                                    <td>رقم الهاتف</td>
                                    <td>{{ $earth->phone }}</td>
                                </tr>
                                <tr>
                                    <td>الرقم الوطني</td>
                                    <td>{{ $earth->SSN }}</td>
                                    <br><br>
                                </tr>
                               
                                <tr>
                                    <td>توقيع مقرر اللجنة : </td>
                                    <td>توقيع رئيس اللجنة : </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                    
                </div>
                  <button class="btn btn-primary  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
            </div>

        </div>
        <!-- /row -->


    @endsection
    @section('js')
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

       <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>
        

@endsection
