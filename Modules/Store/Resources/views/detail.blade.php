@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">جزییات انبار</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="th-sm">نام محصول
                            </th>
                            <th class="th-sm">کد محصول
                            </th>
                            <th class="th-sm">تعداد تولید
                            </th>
                            <th class="th-sm">تاریخ تولید
                            </th>
                            <th class="th-sm">عملیات
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stores as $store)
                            <tr>
                                <td>{{$store->name}}</td>
                                <td>{{$store->code}}</td>
                                <td>{{$store->number}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($store->created_at)->ago()}}</td>
                                <td></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection
