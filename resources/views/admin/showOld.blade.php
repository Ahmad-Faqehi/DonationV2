@extends("admin.layouts.layout")
<?php  use App\Http\Controllers; ?>
@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right Fonty">لوحة التحكم</h1>

        </div>

        <div class="row" >

        <?php
            $total = 0; $paid = 0;
            foreach ($result as $value):
            if($value->pay == 1){
                $paid+=$value->money;
            }
            $total+=$value->money;
            endforeach;
        ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                            <div class="col mr-2">
                                <div class="Fonty font-weight-bold text-dark text-uppercase mb-1 text-right">أجمالي عدد المتبرعين</div>
                                <div class=" h5 mb-1 font-weight-bold text-gray-800 pl-3">{{count($result)}}</div>
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
                                <div class="Fonty font-weight-bold text-dark text-uppercase mb-1 text-right">أجمالي المبلغ</div>
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
                        <h5 class="m-0 font-weight-bold text-dark text-center">بيانات المبترعين</h5>
                    </div>
                    <div class="card-body" dir="ltr">
                        <div class="table-responsive">
                            <table class="table  text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>مبلغ</th>
                                    <th>حالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $user)
                                    <tr>
                                        <td><a href="#" class="btn-link"> {{$user->name}} </a></td>
                                        <td>{{$user->money}}</td>
                                        <td><?php echo ($user->pay ? '<i class="fas fa-check-circle text-success"></i><span style="display: none">1</span>' : '<i class="fas fa-times-circle text-danger"></i><span style="display: none">0</span>'); ?></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="text-center m-2" dir="rtl">
                    <textarea name="" cols="50" rows="10" class="form-control" id="myInput" ><?php

                        $i = 1; foreach($result as $user) :  echo $i . " - ". $user->name . " " . $user->money ." ريال"; if($user->pay == 1){echo "  ✅";}else{echo "❌";} echo "\n"; ?><?php $i++; endforeach; ?></textarea>
            <br>
            <button class="btn btn-info" onclick="myFunction()" > نسخ </button>
        </div>
    </div>
    <script>

        function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("تم النسخ بنجاح");
        }

    </script>
@endsection()
