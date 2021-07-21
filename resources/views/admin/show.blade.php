@extends("admin.layouts.layout")

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right Fonty">لوحة التحكم</h1>

        </div>

        <div class="row" >

        <?php

            $id = $donation->id;

        $paid = 0;
        $total = 0;
        foreach ($donor as $val):

            $total += (int)$val->money;

            if($val->paid){
                $paid += (int)$val->money;
            }
        endforeach;
        ?>
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
                                <div class="font-weight-bold text-dark text-uppercase mb-1 text-right Fonty">عنوان الحملة</div>
                                <!--                                TODO: Print all emp numer-->
                                <div class="h5 mb-0 font-weight-bold text-gray-800  pl-3"> {{$donation->title}}</div>
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
                                <div class="Fonty font-weight-bold text-dark text-uppercase mb-1 text-right">أجمالي عدد المتبرعين</div>
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>مبلغ</th>
                                    <th>حالة الدفع</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($donor as $user)
                                    <tr>
                                        <td><a href="../editDonor/{{$donation->id}}/{{$user->donors_Id}}" class="btn-link"> {{$user->name}}   <i class="fas fa-edit"></i></a></td>
                                        <td>{{$user->money}}</td>
                                        <td><?php echo ($user->paid ? '<i class="fas fa-check-circle text-success"></i><span style="display: none">1</span>' : '<i class="fas fa-times-circle text-danger"></i><span style="display: none">0</span>'); ?></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            <a href="#" data-toggle="modal" data-target="#edit-form" class="btn btn-info btn-icon-split"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text"> تعديل </span></a>
                            &nbsp;
                            <a href="#" data-toggle="modal" data-target="#edit-remove" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text"> حذف </span></a>
                        </div>

                    </div>
                </div>
            </div>



        </div>
        <div class="text-center m-2" dir="rtl">
                    <textarea name="" cols="50" rows="10" class="form-control" id="myInput" ><?php
                        $result = DB::select("SELECT * FROM `donors` WHERE `donation_id` = $id ORDER BY `donors`.`paid` DESC");
                        $i = 1; foreach($result as $user) :  echo $i . " - ". $user->name . " " . $user->money ." ريال"; if($user->paid == 1){echo "  ✅";}else{echo "❌";} echo "\n"; ?><?php $i++; endforeach; ?></textarea>
            <br>
            <button class="btn btn-info" onclick="myFunction()" > نسخ </button>
        </div>
    </div>

    <div id="edit-form" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white"> تعديل البيانات </h4>
                </div>

                <div class="modal-body" style="font-size: 16px;">
                    <div class=" text-right p-3"  >
                        {!! Form::open(['action' => ['DonationController@update',$donation->id] , 'method'=> 'PUT']) !!}
                        <div class="form-group">
                            <label class="text-dark">أسم الحملة</label>
                            {{ Form::text('donationName',$donation->title ,['class'=>'form-control text-right'])}}
                        </div>

                        <div class="form-group">
                            <label class="text-dark">المبلغ المطلوب</label>
                            {{ Form::text('target',$donation->target ,['class'=>'form-control text-right'])}}
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-info" name="submit" value="تحديث">
                            &nbsp;
                            <a href="#" class="btn btn-danger"> حذف الحملة </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="edit-remove" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white"> حذف الحملة </h4>
                </div>

                <div class="modal-body" style="font-size: 16px;">
                    <div class=" text-center p-3"  >
                        هل متاكد من حذف الحملة؟
                        <br>
                        <a href="../removeDonation/{{$donation->id}}" class="btn btn-danger"> حذف </a>
                    </div>
                </div>
            </div>

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
