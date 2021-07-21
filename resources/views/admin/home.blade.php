<?php use Illuminate\Support\Facades\DB; ?>
@extends("admin.layouts.layout")

@section('content')

    <?php

    foreach ($donation as $don):
        $title = $don->title;
        $id = $don->id;
        $target = $don->target;
        $token = $don->token_url;
    endforeach;

    $paid = 0;
    $total = 0;
    foreach ($donor as $val):

        $total += (int)$val->money;

        if($val->paid){
            $paid += (int)$val->money;
        }
    endforeach;


        //dd($paid);
        $degree =  ($paid <= 0) ? 0 : ($paid/$target) * 100;
        $degree = ($paid <= 0) ? 0 : floor(($degree*100))/100;
        if($paid <= 0){
            $degree = 0;
        }elseif ($degree >= 100){
            $degree = 100;
        }else{
            $degree = $degree;
        }
        #$degree = ($paid <= 0) ? 0 : ($degree >= 100)? 100 : $degree;
        if($paid <= 0){
            $rimaid = 0;
        }elseif ($target-$paid <= 0){
            $rimaid = 0;
        }else{
            $rimaid = $target-$paid;
        }
       # $rimaid = ($paid <= 0) ? 0 : ($target-$paid <= 0) ? 0 : $target-$paid ;

//        $degree = 0;

        $isComplete = ($target-$paid <= 0) ? true : false;
    ?>
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
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right Fonty">
                قطية
                <span class="text-dark">{{$title}}</span>

{{--                <span class="h6" > <a href='{{asset("set/$token")}}' target="_blank">   صفحة القطية <i class="fas fa-paperclip"></i> </a> </span>--}}
            </h1>
            <a href="#" data-toggle="modal" data-target="#share-modal" class="btn btn-primary"> رابط القطية <i class="far fa-share-square"></i> </a>
        </div>

    <div class="row" >


    <!-- Earnings (Monthly) Card Example -->
{{--        <ul>--}}
{{--        @foreach($donation as $don)--}}
{{--            <li>{{$don->title}}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-tag fa-2x text-gray-300"></i>

                        </div>
                        <div class="col mr-2">
                            <div class="font-weight-bold text-dark text-uppercase mb-1 text-right Fonty">
                                @if($isComplete)
                                    مبلغ القطية أكتمل
                                @else
                                المبلغ المتبقي {{$rimaid}} من اصل {{$target}}
                                @endif
                            </div>

                            <div class="row no-gutters align-items-center" style="direction: ltr">
                                <div class="col-auto">
{{--                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>--}}
                                </div>
                                <div class="col">
                                    <div class="progress  mr-2" style="height: 20px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{$degree}}%" aria-valuenow="{{$degree}}" aria-valuemin="0" aria-valuemax="100"><span style="font-size: 16px;">{{$degree}}%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="Fonty font-weight-bold text-dark text-uppercase mb-1 text-right">أجمالي عدد الدافعين</div>
                            <div class=" h5 mb-1 font-weight-bold text-gray-800 pl-3">{{count($donor)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="Fonty font-weight-bold text-dark text-uppercase mb-1 text-right"> أجمالي المبلغ المسجل</div>
                            <!--                                TODO: Print all admin numer-->
                            <div class=" h5 mb-1 font-weight-bold text-gray-800 pl-3">{{$total}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-info"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="font-weight-bold text-dark text-uppercase mb-1 text-right Fonty">أجمالي المبلغ المدفوع</div>
                            <!--                                TODO: Print all evlete numer-->
                            <div class="h5 mb-0 font-weight-bold text-gray-800  pl-3">{{$paid}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <div class="row">

            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 ">
                        <h5 class="m-0 font-weight-bold text-dark text-center">بيانات المسجلين</h5>
                    </div>
                    <div class="card-body" dir="ltr">
                        <div class="table-responsive">

                            <table class="table  text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>مبلغ</th>
                                    <th id="spare" style="display: none">شغال</th>
                                    <th>حالة الدفع</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($donor as $user)
                                    <tr>
{{--                                        <td>{{$user->name}}</td>--}}
                                        <td><a href="editDonor/{{$id}}/{{$user->donors_Id}}" class="btn-link"> {{$user->name}}   <i class="fas fa-edit"></i></a></td>
                                        <td>SR {{$user->money}}</td>
                                        <td style="display: none" id="spare"> <?php echo ($user->paid ? '1' : '0'); ?>  </td>
                                        <td>
                                            <span style="display: none"><?php echo ($user->paid ? '1' : '0'); ?></span>
                                            <label class="switch">
                                                <input type="checkbox" id="state_match_1" onclick="updatePaied({{$user->donors_Id}})"  <?php echo ($user->paid ? 'checked' : ' '); ?>  >
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <a href="stopit/{{$id}}" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-hand-paper"></i></span><span class="text"> أيقاف استقبال القطيات</span></a>
                        </div>
                    </div>
                </div>

                <div class="text-center m-2" dir="rtl">
                    <textarea name="" cols="50" rows="10" class="form-control hide" id="myInput"  >@if(!$isComplete) المبلغ المتبقي {{$rimaid}} من اصل {{$target}}@endif<?php echo "\n"; $result = DB::select("SELECT * FROM `donors` WHERE `donation_id` = $id ORDER BY `donors`.`paid` DESC");
                        $i = 1; foreach($result as $user) :  echo $i . " - ". $user->name . " " . $user->money ." ريال"; if($user->paid == 1){echo "  ✅";}else{echo "❌";} echo "\n"; ?><?php $i++; endforeach; ?></textarea>
                    <br>
                    <button class="btn btn-info" onclick="myFunction('myInput')" > نسخ السجل </button>
                </div>

            </div>
        </div>

    </div>

    <div id="share-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white"> رابط الحملة </h4>
                </div>

                <div class="modal-body" style="font-size: 16px;">
                    <div class=" text-right p-3"  >
                        <form>

                            <div class="form-group">
                                <div class="row" style="direction: initial;">
                                    <div class="col-10">
                                    <input class="form-control" id="donationURL" dir="ltr"  type="text" value="{{asset("set/$token")}}" style="background: #f0f0f0;">
                                </div>
                                    <div class="col-2">
                                        <a href="#" class="btn btn-info" onclick="myFunction('donationURL')">نسخ</a>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="text-center">
{{--                                <a href="#" class="btn btn-primary">مشاركة الرابط</a>--}}
                                <a href="archived/8" class="btn btn-primary btn-icon-split" style="direction: ltr;"><span class="icon text-white-50"><i class="fab fa-whatsapp"></i>    </span><span class="text"> مشاركة الرابط</span></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>

        // Sort by column 1 and then re-draw

        function myFunction(id) {
            /* Get the text field */
            var copyText = document.getElementById(id);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            Swal.fire({
                title: 'حسناً',
                text: 'تم النسخ بنجاح',
                icon: 'success',
                showConfirmButton: true,
                confirmButtonText: 'موافق',
            })
        }

    </script>
@section('tb')
<script>
    var table = $('#dataTable').DataTable();
    // Sort by column 1 and then re-draw
    table
        .order( [ 2, 'desc' ] )
        .draw();
</script>
@endsection()

@section('sweetalert')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updatePaied(id) {

            $.ajax({

                url:'paid/'+id,
                type: 'GET',
                success: function(data){
                    // var json = $.parseJSON(data);

                    if(data){
                        Swal.fire({
                            title: 'حسناً',
                            text: 'تم تحديث حالة الدفع بنجاح',
                            icon: 'success',
                            showConfirmButton: false,
                            confirmButtonText: 'موافق',
                        })

                        setTimeout(function () {location.reload();}, 1000);

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

    @endsection()

@endsection()
