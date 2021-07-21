@extends("admin.layouts.layout")

@section('content')



    <!-- Begin Page Content -->
    <div class="container-fluid" >

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right Fonty">أضافة حملة تبرع جديدة</h1>

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

                        @if($donation->first())
                        <div class="alert alert-warning text-right" style="direction: rtl">
                            <b>تنبيه:</b>
                            يوجد حملة فعالة بأسم
                            <a href="show/{{$donation[0]->id}}">{{$donation[0]->title}}</a>
                            يجب أرشفتها حتى تستطيع أنشاء حملة جديدة
                        </div>
                        @endif

                        {!! Form::open(['action' => 'DonationController@store' , 'method'=> 'POST']) !!}

                            <div class="form-group text-right" style="direction: rtl;">
                                {{ Form::label('donateName', 'أسم حملة التبرع', ['class' => 'text-dark'])}}
                                {{ Form::text('donateName','',['class'=>'form-control text-right', 'required'])}}
                            </div>

                            <div class="form-group text-right" style="direction: rtl;">
                                {{ Form::label('donateTarget', 'المبلغ المطلوب', ['class' => 'text-dark'])}}
                                {{ Form::number('donateTarget','',['class'=>'form-control text-right', 'required','placeholder'=>'مثال: 800 '])}}
                            </div>


{{--                            <div class="form-group text-right" style="direction: rtl;">--}}

{{--                                {{ Form::label('donateStates', 'حالة حملة التبرع', ['class' => 'text-dark'])}}--}}
{{--                                <select class="form-control form-control text-right" name="statues">--}}
{{--                                    <option value="1">فعالة</option>--}}
{{--                                    <option value="0">غير فعالة (مؤرشفة)</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="text-center">
                                <button class="btn btn-success btn-icon-split" name="add"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة الحملة </span></button>
                            </div>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>

    </div>

    @endsection
