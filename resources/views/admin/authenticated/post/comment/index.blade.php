@extends('admin.authenticated.layouts.app')

@section('title','Comment')

@section('main-content')

  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Comment
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
            {{ $comments->links() }}
          </div>
            
        <div class="table-wrapper container">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>User <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <div class="search-box">
                            <i class="material-icons">&#xE8B6;</i>
                            <input type="text" id="myInput" class="form-control" placeholder="Search&hellip;">
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>User_id</th>
                        <th>Admin_id</th>
                        <th>Post_id <i class="fa fa-sort"></i></th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Approve</th>
                        <th>Created At <i class="fa fa-sort"></i></th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                  @forelse($comments as $comment)
                    <tr>  
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->user_id }}</td>
                        <td>{{ $comment->admin_id }}</td>
                        <td>{{ $comment->post_id }}</td>
                        <td>{{ $comment->title }}</td>
                        <td>{{ $comment->description }}</td>
                        <td>{{ $comment->approve }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>{{ $comment->updated_at }}</td>
                        <td>
                  <!-- check if current comment has relationship with any post/this happens when the comment is created without post yet/probably the admin created the comment/just use forlse so you dont need to worry about empty array -->
                          
                     <!-- [] is required since we may have just a single array/not object array-->     
                            
                            <a href="{{ route('admin.comment.edit',['id' => $comment->id]) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>

                            <!-- For Delete Icon-->
                            <a href="#" onclick="if(confirm('Delete comment id {{ $comment->id }}?')){
                              document.getElementById({{ $comment->id }}).submit();}" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>

                        <form id="{{ $comment->id }}" action="{{ route('admin.comment.destroy',['id' => $comment->id]) }}" method="post">
                          @method('DELETE')
                          @csrf
                        </form>



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
              <a type="button" class="btn btn-primary" href="{{ route('admin.comment.create') }}">Add Comment</a>
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