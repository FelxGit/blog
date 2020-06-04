@extends('user.authenticated.layouts.app')

@section('title','Blog')

@section('brand-name','Fels Blog')
<!-- header image -->
@section('bg-img', asset('user/authenticated/header-files/themes/clean-blog/img/post-bg.jpg'))

@section('header-title','Create')

@section('sub-heading','Share us your stories.')

@section('main-content')
<div class="col-md-10 offset-md-1">
<form action="{{ route('user.post.update',['post' => $post->slug]) }}" method="POST" role="form">
            @csrf
            @method('PUT')
            <div class="box">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif

                    </div>
                    <div class="form-group">
                      <label for="title">Post Title</label>
                      @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong><br/>{{ $errors->first('title') }}</strong>
                            </span>

                      @endif

                      <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                      name="title" id="title" value="@if(!empty(old('title'))) {{ old('title') }}@elseif(!empty($post->title)) {{ $post->title }}@endif" placeholder="title..">
                    </div>
                    <div class="form-group">
                      <label for="subtitle">Post Sub Title</label>

                      @if ($errors->has('subtitle'))
                            <span class="invalid-feedback" role="alert">
                                <strong><br/>{{ $errors->first('subtitle') }}</strong>
                            </span>
                      @endif

                      <input type="text" class="form-control{{ $errors->has('subtitle') ? ' is-invalid' : '' }}" id="subtitle" name="subtitle" 
                      value="@if(!empty(old('subtitle'))) {{ old('subtitle') }}@elseif(!empty($post->subtitle)) {{ $post->subtitle }}@endif" placeholder="subtitle..">
                    </div>
                    <div class="form-group">
                      <label for="slug">Post Slug</label>
                      @if ($errors->has('slug'))
                            <span class="invalid-feedback" role="alert">
                                <strong><br/>{{ $errors->first('slug') }}</strong>
                            </span>
                      @endif
                      <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" id="slug" name="slug"
                      value="@if(!empty(old('slug'))) {{ old('slug') }}@elseif(!empty($post->slug)) {{ $post->slug }}@endif" placeholder="slug..">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="status" @if(!empty(old('status'))) {{ old('status') }}@elseif(!empty($post->status)) {{ __('checked') }}  }}@endif> Publish
                        </label>
                      </div>
                    </div>
                  <div class="form-group" >
                    <label>Tags</label>
                    <div class="{{ $errors->has('tags') ? ' is-invalid' : '' }}">
                    <select class="form-control select2" multiple="multiple" data-placeholder="Select a tag"
                            style="width: 100%;" name="tags[]">

                            @forelse($post->tags as $tag)
                              <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                            @empty
                            <optgroup>Empty</optgroup>
                            @endforelse

                    </select>
                  </div>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <div class="{{ $errors->has('tags') ? ' is-invalid' : '' }}">
                    <select class="form-control{{ $errors->has('categories') ? ' is-invalid' : '' }} select2" multiple="multiple" data-placeholder="Select a category"
                            style="width: 100%;" name="categories[]">

                            @forelse($post->categories as $category)
                              <option value="{{ $category->id }}" selected>{{ $category->name}}</option>
                            @empty
                            <optgroup>Empty</optgroup>
                            @endforelse

                    </select>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Write Post Body here
                  <small>Simple and fast</small>
                </h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button data-toggle="collapse" data-target="#textarea" type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.box-header -->

              <div class="box-body pad {{ $errors->has('body') ? ' is-invalid' : '' }}" id="textarea">

                    @if ($errors->has('body'))
                          <span class="invalid-feedback" role="alert">
                              <strong><br/>{{ $errors->first('body') }}</strong>
                          </span>
                    @endif

                  <textarea id="editor1" class="textarea"  name="body" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if(!empty(old('body'))) {{ old('body') }}@elseif(!empty($post->body)) {!! $post->body !!}@endif</textarea>
              </div>
            </div>

            <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
</div>
@endsection