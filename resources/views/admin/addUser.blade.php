@extends("admin.layouts.layout")

@section('content')



    <!-- Begin Page Content -->
    <div class="container-fluid" >

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right Fonty">أضافة مشرف جديد</h1>

        </div>
        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-12 col-lg-12">

                <!-- Dropdown Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 ">
                        <h5 class="m-0 font-weight-bold text-dark text-center">نموذج الاضافة</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="direction: ltr;">


                        {!! Form::open(['action' => 'UserController@store' , 'method'=> 'POST']) !!}

                            <div class="form-group text-right" style="direction: rtl;">
                                {{ Form::label('userName', 'أسم المشرف', ['class' => 'text-dark'])}}
                                {{ Form::text('userName','',['class'=>'form-control text-right', 'required'])}}
                            </div>

                        <div class="form-group text-right" style="direction: rtl;">
                                {{ Form::label('userEmail', 'الائميل المشرف', ['class' => 'text-dark'])}}
                                {{ Form::email('userEmail','',['class'=>'form-control text-right', 'required'])}}
                            </div>

                        <div class="form-group text-right" style="direction: rtl;">
                                {{ Form::label('password', 'كلمة السر', ['class' => 'text-dark'])}}
                                 {{ Form::password('password', ['class' => 'form-control text-right'])}}
                            </div>


{{--                            <div class="form-group text-right" style="direction: rtl;">--}}

{{--                                {{ Form::label('donateStates', 'حالة حملة التبرع', ['class' => 'text-dark'])}}--}}
{{--                                <select class="form-control form-control text-right" name="statues">--}}
{{--                                    <option value="1">فعالة</option>--}}
{{--                                    <option value="0">غير فعالة (مؤرشفة)</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="text-center">
                                <button class="btn btn-success btn-icon-split" name="add"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة </span></button>
                            </div>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>

    </div>

    @endsection
