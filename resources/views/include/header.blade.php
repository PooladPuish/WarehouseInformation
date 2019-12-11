<!--گرفتن درخواست های نمایندگی -->
<?php

use Modules\SalesCustomers\Entities\SalesCustomers;

$client = new \GuzzleHttp\Client();
$res = $client->get('http://localhost:8000/SalesCustomers');
$response = $res->getBody()->getContents();
$checkUsers = \GuzzleHttp\json_decode($response);
for ($i = 0; $i <= count($checkUsers) - 1; $i += 1) {
    try {
        $user = new SalesCustomers();
        $user->agent_id = $checkUsers[$i]->agent_id;
        $user->name = $checkUsers[$i]->name;
        $user->email = $checkUsers[$i]->email;
        $user->password = $checkUsers[$i]->password;
        $user->success = $checkUsers[$i]->success;
        $user->created_at = $checkUsers[$i]->created_at;
        $user->updated_at = $checkUsers[$i]->updated_at;
        $user->save();
    } catch (\Exception $e) {
    }
}
?>
<?php
$userl = SalesCustomers::whereNull('success')->count();
?>
<?php
$api = new \GuzzleHttp\Client();
$res = $api->get('http://localhost:8000/api');
$response = $res->getBody()->getContents();
$checks = \GuzzleHttp\json_decode($response);

foreach ($checks as $check)
    if (!empty($check)) {
        $stores = \Modules\Store\Entities\Store::where('code', $check->code)->get();
        foreach ($stores as $store)
            \Modules\Store\Entities\Store::find($store->id)->update([
                'number' => $check->number,
            ]);
    }
?>
<?php


$clientt = new \GuzzleHttp\Client();
$res = $clientt->get('http://localhost:8000/buy');
$response = $res->getBody()->getContents();
$checkUser = \GuzzleHttp\json_decode($response);
for ($i = 0; $i <= count($checkUser) - 1; $i += 1) {
    try {
        $user = new \Modules\Buy\Entities\Buy();
        $user->user_id = $checkUser[$i]->user_id;
        $user->store_id = $checkUser[$i]->store_id;
        $user->number = $checkUser[$i]->number;
        $user->description = $checkUser[$i]->description;
        $user->created_at = $checkUser[$i]->created_at;
        $user->updated_at = $checkUser[$i]->updated_at;
        $user->save();
    } catch (\Exception $e) {
    }
}

?>
<?php
$buy = \Modules\Buy\Entities\Buy::whereNull('replay')->count();
?>

<!-- Logo -->
<a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">پولاد</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>کنترل پنل پولاد</b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-success">1</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">1 پیام خوانده نشده</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-right">
                                        <img src="dist/img/user2-160x160.jpg" class="img-circle"
                                             alt="User Image">
                                    </div>
                                    <h4>
                                        علیرضا
                                        <small><i class="fa fa-clock-o"></i> ۵ دقیقه پیش</small>
                                    </h4>
                                    <p>متن پیام</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">نمایش تمام پیام ها</a></li>
                </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>

                    <?php
                    $notfil = $buy + $userl;
                    ?>

                    <span class="label label-warning">{{$notfil}}</span>


                </a>
                <ul class="dropdown-menu">
                    <li class="header">{{$notfil}} اعلان جدید</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            @if(!empty($userl))
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i>{{$userl}} درخواست نمایندگی دارید
                                    </a>
                                </li>
                            @endif
                            @if(!empty($buy))
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i>{{$buy}} سفارش خرید دارید
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{auth()->user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                        <p>
                            {{auth()->user()->name}}
                            <small>پولاد</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                {{--                    <li class="user-body">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-xs-4 text-center">--}}
                {{--                                <a href="#">صفحه من</a>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-xs-4 text-center">--}}
                {{--                                <a href="#">فروش</a>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-xs-4 text-center">--}}
                {{--                                <a href="#">دوستان</a>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- /.row -->--}}
                {{--                    </li>--}}
                <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="#" class="btn btn-default btn-flat">پروفایل</a>
                        </div>
                        <div class="pull-left">


                            <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                خروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
