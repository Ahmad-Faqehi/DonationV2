

<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>الصفحة الرئيسية</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css" rel="stylesheet')}}" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/process.js') }}"></script>

    <!-- Custom styles for this template-->
    <link href="{{asset('css/mystyle.css')}}" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        body{
            background-color: #f8f9fc;
        }
        form{
            text-align: right;
        }
        *{
            font-family: 'Tajawal', sans-serif;
        }
        @font-face {
            font-family: 'Amiri';
            font-style: italic;
            font-weight: 400;
            src: url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Slanted.eot);
            src: url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Slanted.eot?#iefix) format('embedded-opentype'),
            url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Slanted.woff2) format('woff2'),
            url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Slanted.woff) format('woff'),
            url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Slanted.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Amiri';
            font-style: normal;
            font-weight: 400;
            src: url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Regular.eot);
            src: url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Regular.eot?#iefix) format('embedded-opentype'),
            url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Regular.woff2) format('woff2'),
            url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Regular.woff) format('woff'),
            url(//themes.googleusercontent.com/static/fonts/earlyaccess/amiri/v2/Amiri-Regular.ttf) format('truetype');
        }

        p{
            font-family: "Amiri","Traditional Arabic" !important;
            font-size: 16pt !important;
            font-style: normal;
            font-variant: normal;
            line-height: 170%;
            direction: rtl;
            text-align: right;
        }
    </style>
</head>
<body id="page-top" class="sidebar-toggled">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->

            <!-- End of Topbar -->


            <!-- Begin Page Content -->

            <!-- Content Row -->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">

                        <br>
                        <br>


                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-info text-center Font-tajawal ">المشاركة في القطة  <span id="title"></span></h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div   class="collapse show" id="collapseCardExample" style="direction: rtl">
                                <div class="card-body">

                                    @include('inc.messages')

                                    @if(!$donation->first())
                                    <div class="text-center h3 text-dark"> خطاَ الرابط غير صحيح | 404 </div>
                                    @elseif(!$donation[0]->statues)
                                        <div class="text-center h3 text-dark"> نعتذر تم أيقاف التسجيل في هذة القطة </div>
                                        <script> document.getElementById("title").innerHTML = "{{$donation[0]->title}}"; </script>
                                    @else
                                        {!! Form::open(['action' => 'DonorConroller@store' , 'method'=> 'POST']) !!}
                                        {{ Form::hidden('donation_id',$donation[0]->id,['class'=>'form-control text-right',])}}
                                        {{ Form::hidden('donation_tok',$donation[0]->token_url,['class'=>'form-control text-right',])}}

                                        <div class="form-group">
                                        {{ Form::label('donorName', 'الاسم الثلاثي', ['class' => 'text-dark'])}}
                                        {{ Form::text('donorName','',['class'=>'form-control text-right','required'])}}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('donorMoney', 'المبلغ', ['class' => 'text-dark'])}}
                                            {{ Form::number('donorMoney','',['class'=>'form-control text-right','required'])}}
                                        </div>


                                        <input type="submit" name="create" value="ارسال" class="btn btn-info btn-block">

                                        {!! Form::close() !!}
                                        <script> document.getElementById("title").innerHTML = "{{$donation[0]->title}}"; </script>
                                    @endif

                                </div>
                            </div>

                        </div>

                        <!-- /.container-fluid -->
                    </div>
                    <!-- End of Main Content -->


                    <!-- Footer -->
                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->

            </div>
        </div>
    </div>
</div>
            <!-- End of Page Wrapper -->

            <!-- Logout Modal-->   <!-- Scroll to Top Button-->




            <!-- /Logout Modal-->   <!-- /Scroll to Top Button-->

            <!-- Secript Write here -->
            <!-- Bootstrap core JavaScript-->
            <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
            <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{asset('js/sb-admin-2.min.js')}}"></script> <!--/ Secript Write here -->
</body>

</html>
