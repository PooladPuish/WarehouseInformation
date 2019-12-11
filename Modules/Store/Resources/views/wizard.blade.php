<?php
//$stores = \Modules\Store\Entities\Store::get();
//foreach ($stores as $store)
//    if (!empty($store)) {
//
//    }
//
//?>

@extends('layouts.master')
@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">انبار</h3>
        </div>
    @include('massage.msg')
    <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('admin.store.user.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>نام محصول</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>کد محصول</label>
                            <input type="text" name="code" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>تعداد</label>
                            <input type="number" name="number" class="form-control">
                        </div>
                    </div>


                </div>
                <div class="col-md-1">
                    <input type="submit" value="ثبت" class="form-control btn btn-success">
                </div>
                <div class="col-md-1">
                    <a href="{{route('admin.sales.user.show')}}" class="form-control btn btn-danger">برگشت</a>
                </div>
            </form>
        </div>
    </div>


@endsection
