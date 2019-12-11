@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">درخواست های نمایندگان فروش</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped data-table">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام و نام خانوادگی</th>
                            <th>شماره تماس</th>
                            <th>تاریخ درخواست</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    paginate: {
                        next: 'بعدی', // or '→'
                        previous: 'قبلی' // or '←'
                    },
                    search: 'جستجو',
                    sZeroRecords: 'موردی با این مشخصات یافت نشد!',
                    lengthMenu: "نمایش _MENU_ مورد",
                    info: "نمایش مورد _PAGE_ از _PAGES_",

                },
                ajax: "{{ route('admin.sales.user.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

    </script>
@endsection
