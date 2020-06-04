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
            <form role="form" action="{{ route('admin.comment.store') }}" method="post">
              @method('post')
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
                        
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" value="{{ old('title') }}" placeholder="comment title..">
                      
                      </div>
                      <div class="form-group">
                        <label for="description">Comment Description</label>

                        @if ($errors->has('description'))
                              <span class="invalid-feedback" role="alert">
                                  <strong><br/>{{ $errors->first('description') }}</strong>
                              </span>
                        @endif
                        
                        <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" placeholder="comment description..">{{ old('description') }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="title">Post Id</label>

                        @if ($errors->has('id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong><br/>{{ $errors->first('id') }}</strong>
                              </span>
                        @endif
                        
                        <input type="number" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}"  value="{{ old('id') }}" name="id" id="id" placeholder="id">
                      
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

