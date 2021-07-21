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
                        <h5 class="m-0 font-weight-bold text-dark text-center">بيانات المشرفين</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="direction: ltr;">


                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                <thead dir="">
                                <tr>
                                    <th>الاسم</th>
                                    <th>الائميل</th>
                                    <th>تعديل</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>admin</td>
                                    <td><a href="mailto:admin@mai2l.com"> admin@mai2l.com </a></td>
                                    <td><a href="edit-user.php?id=1&role" class="btn btn-primary">تعديل</a> &nbsp; <a href="#dlete" onclick="myf(1)" class="btn btn-danger">حذف</a> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            <a href="#" data-toggle="modal" data-target="#add-user-form" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text"> أضافة مشرف</span></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    @endsection
