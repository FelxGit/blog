@extends('admin.authenticated.layouts.app')

@section('title','Comment')

@section('main-content')
  <div class="wrapper">
      <div class="content-wrapper">

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Titles</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.comment.update',[$comment->id]) }}" method="post">
              @method('put')
              @csrf
                   
              <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-4">
                      <div class="form-group">
                        <label for="title">Comment Title</label>

                        @if ($errors->has('title'))
                              <span class="invalid-feedback" role="alert">
                                  <strong><br/>{{ $errors->first('title') }}</strong>
                              </span>
                        @endif
                        
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" value="{{ (old('title'))? old('title') : $comment->title }}" placeholder="comment title..">
                      
                      </div>
                      <div class="form-group">
                        <label for="description">Comment Description</label>

                        @if ($errors->has('description'))
                              <span class="invalid-feedback" role="alert">
                                  <strong><br/>{{ $errors->first('description') }}</strong>
                              </span>
                        @endif
                        
                        <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" placeholder="comment description..">{{ (old('description'))? old('description') : $comment->description }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="title">Post_ID</label>

                        @if ($errors->has('post_id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong><br/>{{ $errors->first('post_id') }}</strong>
                              </span>
                        @endif
                        
                        <input type="number" class="form-control{{ $errors->has('post_id') ? ' is-invalid' : '' }}"  value="{{ (old('post_id'))? old('post_id') : $comment->post_id }}" name="post_id" id="post_id" placeholder="post_id">
                      
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

