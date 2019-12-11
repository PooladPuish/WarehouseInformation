@extends('layouts.master')
@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">ویرایش مشخصات نماینده فروش</h3>
        </div>
    @include('massage.msg')
    <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('admin.sales.user.store')}}">
                @csrf
                <input type="hidden" name="id" value="{{$id->id}}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>نام و نام خانوادگی</label>
                            <input type="text" name="name" class="form-control" value="{{$id->name}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>نام کاربری</label>
                            <input type="text" name="email" class="form-control" value="{{$id->email}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>وضعیت</label>
                            <select name="success" class="form-control">
                                <option value="1" @if($id->success == 1) selected @endif>فعال</option>
                                <option value="0" @if($id->success == 0) selected @endif>غیر فعال</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>تغییر کلمه عبور</label>
                            <input type="text" name="password" class="form-control">
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
