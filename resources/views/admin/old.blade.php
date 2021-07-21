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
                        <h5 class="m-0 font-weight-bold text-dark text-center">  حملات التبرع القديمة</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="direction: ltr;">


                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" dir="rtl">
                                <thead dir="">
                                <tr>
                                    <th>#</th>
                                    <th>أسم الحملة</th>
                                    <th>اجمالي المبلغ المدفوع</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>1</td>
                                    <td><a href="showOld/1" class=" btn-link "> موسى حسين عطيف</a>  </td>
                                    <td>27900</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="showOld/2" class=" btn-link ">الشيخ قاسم عطيف</a>  </td>
                                    <td>9700</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="showOld/3" class=" btn-link "> قاسم علي عطيف</a>  </td>
                                    <td>10650</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><a href="showOld/4" class=" btn-link "> غالب محمد عطيف</a>  </td>
                                    <td>10150</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><a href="showOld/5" class=" btn-link "> صديق محمد ظافر</a>  </td>
                                    <td>17000</td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td><a href="showOld/6" class=" btn-link "> ماجد عنقري</a>  </td>
                                    <td>11350</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
