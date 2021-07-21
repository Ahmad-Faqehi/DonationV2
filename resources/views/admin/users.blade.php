@extends("admin.layouts.layout")

@section('content')

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
                        <h5 class="m-0 font-weight-bold text-dark text-center">  حسابك </h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="direction: ltr;">


                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                <thead dir="">
                                <tr>
                                    <th>أسم الاسم</th>
                                    <th>الائميل</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>{{$users->name}} </td>
                                    <td>{{$users->email}} </td>
                                    <td><a href="#"  data-toggle="modal" data-target="#edit-form" class=" btn btn-primary ">تعديل</a>  </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


        <div id="edit-form" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-white"> تعديل بيانات المشرف </h4>
                    </div>

                    <div class="modal-body" style="font-size: 16px;">
                        <div class=" text-right p-3"  >
                            {!! Form::open(['action' => ['UserController@update',$users->id] , 'method'=> 'PUT']) !!}

                            <div class="form-group">
                                <label class="text-dark"> الاسم </label>
                                {{ Form::text('userName',$users->name ,['class'=>'form-control text-right'])}}
                            </div>

                            <div class="form-group">
                                <label class="text-dark"> الائميل </label>
                                {{ Form::text('userEmail',$users->email ,['class'=>'form-control text-right'])}}
                            </div>

                            <div class="form-group">
                                <label class="text-dark"> كلمة السر <small>(اختياري)</small> </label>
                                {{ Form::password('password', ['class' => 'form-control text-right', 'placeholder'=>'أتركه فارغ اذا لا تريد تغير كلمة السر'])}}
                            </div>

                            <div class="text-center">
                                <input type="submit" class="btn btn-info" name="submit" value="تحديث">
                                &nbsp;</div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>



<script>
    $("#edit-form").modal("show");

    function  myf(id){
        $("#edit-form").modal("toggle");
    }
</script>
</script>
@endsection

