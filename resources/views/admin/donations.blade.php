@extends("admin.layouts.layout")

@section('content')

    <style>
        .switch{
            position:relative;
            display:inline-block;
            width:60px;
            height:34px
        }
        .switch input{
            opacity:0;
            width:0;
            height:0
        }
        .slider{
            position:absolute;
            cursor:pointer;
            top:0;
            left:0;
            right:0;
            bottom:0;
            background-color:#ccc;
            -webkit-transition:.4s;
            transition:.4s
        }
        .slider:before{
            position:absolute;
            content:"";
            height:26px;
            width:26px;
            left:4px;
            bottom:4px;
            background-color:#fff;
            -webkit-transition:.4s;
            transition:.4s
        }
        input:checked+.slider{
            background-color:#2196f3
        }
        input:focus+.slider{
            box-shadow:0 0 1px #2196f3
        }
        input:checked+.slider:before{
            -webkit-transform:translateX(26px);
            -ms-transform:translateX(26px);
            transform:translateX(26px)
        }
        .slider.round{
            border-radius:34px
        }
        .slider.round:before{
            border-radius:50%
        }
    </style>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right Fonty">لوحة التحكم</h1>

        </div>
        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-12 col-lg-12">

                <!-- Dropdown Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 ">
                        <h5 class="m-0 font-weight-bold text-dark text-center">جميع حملات التبرع</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="direction: ltr;">


                        <div class="table-responsive">
                            <table class="table table-striped text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                <thead dir="">
                                <tr>
                                    <th>أسم الحملة</th>
                                    <th>اجمالي المبلغ المدفوع</th>
                                    <th>الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($donation as $val)
                                <tr>
                                    <td ><a href="show/{{$val->id}}" class=" btn-link ">{{$val->title}} <i class="far fa-edit"></i></a>  </td>
                                    <?php
                                    $total = 0;
                                    $x = $donor::where('donation_id',$val->id)->get();
                                    foreach ($x as $donor){
                                        if($donor->paid)
                                            $total +=  $donor->money;
                                    }
                                    ?>
                                    <td>{{$total}}</td>

{{--                                    <td> <?php echo ($val->statues ? '<span class="text-info">فعالة</span>' : '<span class="text-dark">مؤرشفة</span>'); ?>  <a href="edit/{{$val->id}}" data-toggle="modal" data-target="#edit-form-{{$val->id}}" class="btn-link"><i class="fas fa-edit"></i></a> </td>--}}
                                    <td>
                                        <span style="display: none"><?php echo ($val->statues ? '1' : '0'); ?></span>
                                        <label class="switch">
                                            <input type="checkbox" id="donation_{{$val->id}}" onclick="updatePaied({{$val->id}},'<?php echo ($val->statues ? 'off' : 'on'); ?>')"  <?php echo ($val->statues ? 'checked' : ''); ?>  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            <a href="add"  class="btn btn-info btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة حملة جديدة</span></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    @foreach($donation as $val)
    <div id="edit-form-{{$val->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white"> تعديل البيانات </h4>
                </div>

                <div class="modal-body" style="font-size: 16px;">
                    <div class=" text-right p-3"  >
                        {!! Form::open(['action' => ['DonationController@update',$val->id] , 'method'=> 'PUT']) !!}
                            <div class="form-group">
                                <label class="text-dark">أسم الحملة</label>
                                {{ Form::text('donationName',$val->title ,['class'=>'form-control text-right'])}}
                            </div>
                        <div class="form-group text-right" style="direction: rtl;">

                            {{ Form::label('donateStates', 'حالة الحملة', ['class' => 'text-dark'])}}
                            <select class="form-control form-control text-right" name="statues">
                                <option value="0" <?php  if(!$val->statues){ echo  'selected' ;}    ?> > مؤرشفة  </option>
                                <option value="1" <?php  if($val->statues) { echo  'selected' ;}    ?> > فعالة </option>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-info" name="submit" value="تحديث">
                            &nbsp;
                            <a href="#" onclick="myf({{$val->id}})" class="btn btn-danger"> حذف الحملة </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endforeach

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
                            هل متاكد من حذف الحملة؟
                        </p>
                        <a href="#" id="delete-link" class="btn btn-dark"> نعم </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function  myf(id){
            $("#edit-form-"+id).modal("toggle");
            $("#delete-link").attr("href", "removeDonation/"+id);
            $("#delete-lost").modal("show");
        }
    </script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updatePaied(id,type) {
            var title = ""
            var icon = ""
            $.ajax({

                url:'archived/'+id,
                type: 'GET',
                data: {type: type},


                success: function(xdata){
                    // var json = $.parseJSON(data);

                    if(xdata){
                        const obj = JSON.parse(xdata);

                        if(obj.type){
                            title = "حسناً"
                            icon = "success"
                            if(obj.is == 'on'){
                                $('#donation_'+id).attr("onclick","updatePaied("+id+",'off')");
                            }else{
                                $('#donation_'+id).attr("onclick","updatePaied("+id+",'on')");
                            }

                        } else{
                            title = "خطأ"
                            icon = "info"
                            $('#donation_'+id).prop("checked",null)

                        }
                        Swal.fire({
                            title: title,
                            text: obj.msg,
                            icon: icon,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'موافق',
                        })

                       // setTimeout(function () {location.reload();}, 1000);

                    }else {
                        Swal.fire({
                            title: 'خطأ',
                            text: 'حدث خطأ عند محاولة التحديث',
                            icon: 'error',
                            confirmButtonText: 'موافق'
                        })
                    }

                }
            });
        }

    </script>

@endsection
