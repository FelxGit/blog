@extends('admin.authenticated.layouts.app')

@section('title','Post')

@section('main-content')

  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Post
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
              {{ $posts->links() }}
            </div>
            
        <div class="table-wrapper">
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
            <table style="overflow: scroll" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Posted By</th>
                        <th>Title <i class="fa fa-sort"></i></th>
                        <th>Subtitle</th>
                        <th>Slug<i class="fa fa-sort"></i></th>
                        <th>Body</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Like</th>
                        <th>Dislike</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                  @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->posted_by }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->subtitle }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->body }}</td>
                        <td>{{ $post->status }}</td>
                        <td>{{ $post->image }}</td>
                        <td>{{ $post->like }}</td>
                        <td>{{ $post->dislike }}</td>
                        <td>{{ $post->created_at }}</td>                                            
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <a href="{{ route('user.post.show',['slug' => $post->slug]) }}" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                            
                            <a href="{{ route('admin.post.edit',['id' => $post->id]) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>

                            <!-- For Delete Icon-->
                            <a href="#" onclick="if(confirm('Delete user id {{ $post->id }}?')){
                              document.getElementById({{ $post->id }}).submit();}" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>

                        <form id="{{ $post->id }}" action="{{ route('admin.post.destroy',['id' => $post->id]) }}" method="post">
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
              <a type="button" class="btn btn-primary" href="{{ route('admin.post.create') }}">Add Post</a>
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