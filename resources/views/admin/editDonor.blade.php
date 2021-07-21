@extends("admin.layouts.layout")

@section('content')



    <!-- Begin Page Content -->
    <div class="container-fluid" >

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right Fonty"> تعديل بيانات المبترع </h1>

        </div>
        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-12 col-lg-12">

                <!-- Dropdown Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 ">
                        <h5 class="m-0 font-weight-bold text-dark text-center">نموذج التعديل</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="direction: ltr;">

                        {!! Form::open(['action' => ['DonorConroller@update',$donor->donors_Id] , 'method'=> 'PUT']) !!}

                        <div class="form-group text-right" style="direction: rtl;">
                            {{ Form::label('donorName', 'أسم المتبرع', ['class' => 'text-dark'])}}
                            {{ Form::text('donorName',$donor->name ,['class'=>'form-control text-right'])}}
                        </div>

                        <div class="form-group text-right" style="direction: rtl;">
                            {{ Form::label('donorMoney', 'المبلغ', ['class' => 'text-dark'])}}
                            {{ Form::text('donorMoney',$donor->money ,['class'=>'form-control text-right'])}}
                            {{ Form::hidden('donation_id',$donor->donation_id )}}
                        </div>


                        <div class="form-group text-right" style="direction: rtl;">

                            {{ Form::label('donateStates', 'تحويل المبلغ', ['class' => 'text-dark'])}}
                            <select class="form-control form-control text-right" name="statues">
                                <option value="0" <?php  if(!$donor->paid){ echo  'selected' ;}    ?> >لم يتم التحويل </option>
                                <option value="1" <?php  if($donor->paid) { echo  'selected' ;}    ?> >تم التحويل</option>
                            </select>
                        </div>
                        <div class="text-center" dir="rtl">
                            <button class="btn btn-info btn-icon-split" name="add"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text">  تعديل </span></button>
                            &nbsp;
                            <a href="#" onclick="myf({{$donor->donation_id}},{{$donor->donors_Id}})" class="btn btn-danger"> حذف المشارك </a>
                        </div>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="delete-lost" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white"> </h4>
                </div>
                <div class="modal-body" style="font-size: 16px;">
                    <div class="text-center">
                        <p class="text-justify text-dark text-center">
                            هل متاكد من حذف هذا المبترع من هذه الحملة؟
                        </p>
                        <a href="#" id="delete-link" class="btn btn-dark"> نعم </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function  myf(donation_id,donor_id){
            $("#delete-link").attr("href", "../../removeDonor/"+donation_id+"/"+donor_id);
            $("#delete-lost").modal("show");
        }
    </script>

@endsection
