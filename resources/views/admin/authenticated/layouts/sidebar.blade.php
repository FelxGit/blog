<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('storage/open/files/images/profile.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Fel Reind Entica</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree" >
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.post.index') }}"><i class="fa fa-circle-o"></i> Posts</a></li>
            <li><a href="{{ route('admin.comment.index') }}"><i class="fa fa-circle-o"></i> Comment</a></li>
            <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
            <li><a href="{{ route('admin.tag.index') }}"><i class="fa fa-circle-o"></i> Tags</a></li>
            <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>