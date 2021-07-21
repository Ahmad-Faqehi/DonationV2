@extends("admin.layouts.layout")

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right Fonty">لوحة التحكم</h1>

        </div>

        <div class="row" >


            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                            </div>
                            <div class="col mr-2">
                                <div class="font-weight-bold text-dark text-uppercase mb-1 text-right Fonty"> لا توجد حمله حالياً </div>
                                <!--                                TODO: Print all emp numer-->
                                <div class="h5 mb-0 font-weight-bold text-gray-800  pl-3"> </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center" dir="ltr">
            <a href="add" class="btn btn-info btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة حملة </span> </a>
            <a href="donations" class="btn btn-info btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-street-view"></i></span><span class="text"> عرض الحملات </span> </a>
{{--            <button class="btn btn-success btn-icon-split" name="add"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة الحملة </span></button>--}}
        </div>


    </div>
@endsection()
