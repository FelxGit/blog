@extends('admin.authenticated.layouts.app')

@section('title','User')

@section('main-content')
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          User
          <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Examples</a></li>
          <li class="active">Blank page</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Title</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div>
            @if(session('stored'))
               <strong class="text-success">{{ session('stored') }}</strong>
               <br/>
            @endif
            @if(session('updated'))
               <strong class="text-success">{{ session('updated') }}</strong>
               <br/>
            @endif
            @if(session('deleted'))
               <strong class="text-success">{{ session('deleted') }}</strong>
               <br/>
            @endif
            </div>
            <div class="pull-left">
              {{ $users->links() }}
            </div>

        <div class="table-wrapper" style="width: 100%">
            <div class="table-title">
                <div class="row">
                    <div class="col-md-8"><h2>User <b>Details</b></h2></div>
                    <div class="col-md-4">
                        <div class="search-box">
                            <i class="material-icons">&#xE8B6;</i>
                            <input type="text" id="myInput" class="form-control" placeholder="Search&hellip;">
                        </div>
                    </div>
                </div>
            </div>
            <table style="overflow: scroll" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Status</th>
                        <th>Profile Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Email Verified At</th>
                        <th>Remember Token</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                  @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->status }}</td>
                        <td>{{ $user->profile }}</td>
                        <th>{{ $user->name}}</th>
                        <th>{{ $user->email}}</th>
                        <th>{{ $user->email_verified_at}}</th>
                        <th>{{ $user->remember_token }}</th>
                        <td>{{ $user->created_at }}</td>                                            
                        <td>{{ $user->updated_at }}</td>
                        <td>
                        </td>
                    </tr>
                    @empty
                    <b>Your database is empty.</b>
                  @endforelse
                </tbody>
            </table>
            
        </div>

          <div class="pull-right">
            <div>
              <a type="button" class="btn btn-primary" href="{{ route('admin.user.create') }}">Add Post</a>
            </div>
          </div>    
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            Footer
          </div>
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
@endsection
