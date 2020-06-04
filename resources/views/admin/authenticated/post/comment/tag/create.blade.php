@extends('admin.authenticated.layouts.app')

@section('title','Tag')

@section('main-content')

	<div class="wrapper">
      <div class="content-wrapper">

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Titles</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.tag.store') }}" method="post">
              @method('post')
              @csrf
                   
              <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                      <div class="form-group">
                        <label for="name">Tag Title</label>

                        @if ($errors->has('name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong><br/>{{ $errors->first('name') }}</strong>
                              </span>
                        @endif
                        
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="tag title..">
                      
                      </div>
                      <div class="form-group">
                        <label for="slug">Tag Slug</label>

                        @if ($errors->has('slug'))
                              <span class="invalid-feedback" role="alert">
                                  <strong><br/>{{ $errors->first('slug') }}</strong>
                              </span>
                        @endif
                        
                        <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" id="slug" name="slug" placeholder="tag slug..">
                      </div>
		              <div class="form-group">
		                <button type="submit" class="btn btn-primary">Submit</button>
		              </div>
		            </div>
		          </div>
		       </div>
	          </div>
	      </form>
     </div>
   </div>
@endsection

