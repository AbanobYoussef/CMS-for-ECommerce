 <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

     @include('admin.layout.menu')
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('/')}}/design/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{admin()->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
    


         
          <li class="treeview  {{active_menu('')[0]}} {{active_menu('settings')[0]}}">
             <a href="#">
                <i class="fa fa-list"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
            <ul class="treeview-menu " style="{{active_menu('')[1]}} {{active_menu('settings')[1]}}">
              <li class=""><a href="{{ aurl('') }}" >
                <i class="fa fa-cog"></i> <span>Dashbord</span>
                <span class="pull-right-container">
                </span>
              </a>
            </li>
            <li class=""><a href="{{ aurl('settings') }}"  >
              <i class="fa fa-cog"></i> <span>Settings</span>
              <span class="pull-right-container">
              </span>
            </a>
            </li>
          </ul>
        </li>





        <li class="treeview {{active_menu('admin')[0]}}">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>{{trans('admin.admin')}}</span>
            </span>
          </a>
          <ul class="treeview-menu" style="{{active_menu('admin')[1]}}">
            <li><a href="{{ aurl('admin') }}"><i class="fa fa-users"></i>{{trans('admin.admin')}}</a></li>
           
          </ul>
        </li>


        <li class="treeview {{active_menu('users')[0]}}">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Users</span>
            </span>
          </a>
          <ul class="treeview-menu" style="{{active_menu('users')[1]}}">
            <li><a href="{{ aurl('users') }}"><i class="fa fa-users"></i>All Users</a></li>
            <li><a href="{{ aurl('users') }}?level=user"><i class="fa fa-users"></i>Users</a></li>
            <li><a href="{{ aurl('users') }}?level=vendor"><i class="fa fa-users"></i>Vendors</a></li>
            <li><a href="{{ aurl('users') }}?level=company"><i class="fa fa-users"></i>Companies</a></li>
          </ul>
        </li>



        <li class="treeview {{active_menu('countries')[0]}}">
          <a href="#">
            <i class="fa fa-flag"></i>
            <span>Countries</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('countries')[1]}}">
            <li><a href="{{ aurl('countries') }}"><i class="fa fa-flag"></i>Countries</a></li>
            <li><a href="{{ aurl('countries/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>
 

        <li class="treeview {{active_menu('cities')[0]}}">
          <a href="#">
            <i class="fa fa-flag"></i>
            <span>Cities</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('cities')[1]}}">
            <li><a href="{{ aurl('cities') }}"><i class="fa fa-flag"></i>Cities</a></li>
            <li><a href="{{ aurl('cities/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>


        <li class="treeview {{active_menu('states')[0]}}">
          <a href="#">
            <i class="fa fa-flag"></i>
            <span>States</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('states')[1]}}">
            <li><a href="{{ aurl('states') }}"><i class="fa fa-flag"></i>States</a></li>
            <li><a href="{{ aurl('states/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>


        <li class="treeview {{active_menu('departments')[0]}}">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Departments</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('departments')[1]}}">
            <li><a href="{{ aurl('departments') }}"><i class="fa fa-list"></i>Departments</a></li>
            <li><a href="{{ aurl('departments/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>



        <li class="treeview {{active_menu('tradMarks')[0]}}">
          <a href="#">
            <i class="fa fa-cube"></i>
            <span>Trad Marks</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('tradMarks')[1]}}">
            <li><a href="{{ aurl('tradMarks') }}"><i class="fa fa-cube"></i>Trad Marks</a></li>
            <li><a href="{{ aurl('tradMarks/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>



        <li class="treeview {{active_menu('manifactories')[0]}}">
          <a href="#">
            <i class="fa fa-gavel"></i>
            <span>Manifactories</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('manifactories')[1]}}">
            <li><a href="{{ aurl('manifactories') }}"><i class="fa fa-gavel"></i>Manifactories</a></li>
            <li><a href="{{ aurl('manifactories/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>
   


        <li class="treeview {{active_menu('shapings')[0]}}">
          <a href="#">
            <i class="fa fa-truck"></i>
            <span>Manifactories</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('shapings')[1]}}">
            <li><a href="{{ aurl('shapings') }}"><i class="fa fa-truck"></i>Shapings</a></li>
            <li><a href="{{ aurl('shapings/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>



        <li class="treeview {{active_menu('malls')[0]}}">
          <a href="#">
            <i class="fa fa-building"></i>
            <span>Malls</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('malls')[1]}}">
            <li><a href="{{ aurl('malls') }}"><i class="fa fa-building"></i>Malls</a></li>
            <li><a href="{{ aurl('malls/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>



        <li class="treeview {{active_menu('colors')[0]}}">
          <a href="#">
            <i class="fa fa-paint-brush"></i>
            <span>Colors</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('colors')[1]}}">
            <li><a href="{{ aurl('colors') }}"><i class="fa fa-paint-brush"></i>Colors</a></li>
            <li><a href="{{ aurl('colors/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>



        <li class="treeview {{active_menu('size')[0]}}">
          <a href="#">
            <i class="fa fa-info-circle"></i>
            <span>size</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('size')[1]}}">
            <li><a href="{{ aurl('size') }}"><i class="fa fa-info-circle"></i>size</a></li>
            <li><a href="{{ aurl('size/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>


        <li class="treeview {{active_menu('weights')[0]}}">
          <a href="#">
            <i class="fa fa-info-circle"></i>
            <span>weights</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('weights')[1]}}">
            <li><a href="{{ aurl('weights') }}"><i class="fa fa-info-circle"></i>weights</a></li>
            <li><a href="{{ aurl('weights/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>


        <li class="treeview {{active_menu('weights')[0]}}">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>products</span>
            </span>
          </a>
          <ul class="treeview-menu"style="{{active_menu('products')[1]}}">
            <li><a href="{{ aurl('products') }}"><i class="fa fa-product-hunt"></i>products</a></li>
            <li><a href="{{ aurl('products/create') }}"><i class="fa fa-plus"></i>Add</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>