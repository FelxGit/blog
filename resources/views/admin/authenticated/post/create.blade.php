@extends('admin.authenticated.layouts.app')

@section('title','Post')

@section('main-content')
  <div class="wrapper">
    <div class="content-wrapper">

      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-tit  le">Post Title</h3>
          </div>

          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('admin.post.store') }}" method="POST" role="form">
            @csrf
            @method('POST')
            <div class="box">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title">Post Title</label>
                      @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong><br/>{{ $errors->first('title') }}</strong>
                            </span>

                      @endif

                      <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                      name="title" id="title" value="{{ old('title') }}" placeholder="title..">
                    </div>
                    <div class="form-group">
                      <label for="subtitle">Post Sub Title</label>

                      @if ($errors->has('subtitle'))
                            <span class="invalid-feedback" role="alert">
                                <strong><br/>{{ $errors->first('subtitle') }}</strong>
                            </span>
                      @endif

                      <input type="text" class="form-control{{ $errors->has('subtitle') ? ' is-invalid' : '' }}"" id="subtitle" name="subtitle" 
                      value="{{ old('subtitle') }}" placeholder="subtitle..">
                    </div>
                    <div class="form-group">
                      <label for="slug">Post Slug</label>
                      @if ($errors->has('slug'))
                            <span class="invalid-feedback" role="alert">
                                <strong><br/>{{ $errors->first('slug') }}</strong>
                            </span>
                      @endif
                      <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" id="slug" name="slug"
                      value="{{ old('slug') }}" placeholder="slug..">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" id="image" name="image">
                      <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="status" {{ old('status')? 'checked' : '' }}> Publish
                        </label>
                      </div>
                    </div>
                  <div class="form-group">
                    <label>Tags</label>
                    <select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
                            style="width: 100%;" name="tags[]">
                            
                            <!-- for instance purpose only -->
                            @if(!empty($tags = DB::table('tags')->get()))

                              @forelse($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name}}</option>
                              @empty
                              <optgroup>Empty</optgroup>
                              @endforelse

                            @endif

                    </select>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
                            style="width: 100%;" name="categories[]">

                            <!-- for instance purpose only -->
                            @if(!empty($categories = DB::table('categories')->get()))

                              @forelse($categories as $category)
                                      <option value="{{ $category->id }}">{{ $category->name}}</option>
                                    @empty
                                    <optgroup>Empty</optgroup>
                              @endforelse

                            @endif
                    </select>
                  </div>
                  </div>
                </div>
              </div>
            </div>


<!-- text editor - wysiHTML5-->
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Write Post Body here
                  <small>Simple and fast</small>
                </h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.box-header -->

              <div class="box-body pad">

                    @if ($errors->has('body'))
                          <span class="invalid-feedback" role="alert">
                              <strong><br/>{{ $errors->first('body') }}</strong>
                          </span>
                    @endif

                  <textarea id="editor1" class="textarea{{ $errors->has('body') ? ' is-invalid' : '' }}""  name="body" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('body') }}</textarea>
              </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
   </div>
  </div>
@endsection