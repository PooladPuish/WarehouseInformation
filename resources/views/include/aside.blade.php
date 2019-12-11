<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-right image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-right info">
            <p>{{auth()->user()->name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i>آنلاین</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>داشبورد</span>
                <span class="pull-left-container">
            </span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-sellsy"></i> <span>مشتریان فروش</span>
                <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.sales.user.index')}}"><i class="fa fa-circle-o"></i>درخواست های جدید</a>
                </li>
                <li><a href="{{route('admin.sales.user.show')}}"><i class="fa fa-circle-o"></i>لیست مشتریان فروش</a>
                </li>
            </ul>
        </li>


        <li class="treeview">
            <a href="#">
                <i class="fa fa-save"></i> <span>انبار</span>
                <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.store.user.wizard')}}"><i class="fa fa-circle-o"></i>ثبت</a>
                </li>
                <li><a href="{{route('admin.store.user.show')}}"><i class="fa fa-circle-o"></i>مشاهده</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-buysellads"></i> <span>سفارشات</span>
                <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.buy.user.index')}}"><i class="fa fa-circle-o"></i>درخواست های خرید</a>
                </li>
                <li><a href="{{route('admin.buy.user.show')}}"><i class="fa fa-circle-o"></i>لیست سفارشات</a>
                </li>
            </ul>
        </li>


    </ul>
</section>
<!-- /.sidebar -->
