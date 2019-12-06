@extends('admin.layouts.app')
<?php $title = isset($page->id)?"Page Edit":"Page Add"; ?>

@section('title',$title)
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>{{$title}}</h5>
                       
                    </div>
                    <div class="ibox-content">
                        @include('flash::message')

                        <form method="post" id='page_form'>
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Navigation Position</label>
                                <div class="col-sm-10">
                                     {!! selectBox('navigation_type',config('application.pageNavigationPlace'),old('navigation_type',(isset($page->navigation_type)?$page->navigation_type:'')),array('class'=>'form-control required'),'Select Navigation Position') !!}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ old('name',(isset($page->name)?$page->name:'')) }}" class="form-control required">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Content</label>
                                <div class="col-sm-10">
                                    <textarea id="page_content" name="content">{{ old('content',(isset($page->content)?$page->content:'')) }}</textarea>
                                </div>
                            </div>
                          
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Display Order</label>
                                <div class="col-sm-10">
                                    <input type="number" name="display_order" value="{{ old('display_order',(isset($page->display_order)?$page->display_order:'')) }}" class="form-control required">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>


@endsection

@section('customStyle')
<link rel="stylesheet" href="{{ baseUrl('admin/css/plugins/summernote/summernote-bs4.css') }}">

@endsection
@section('customScript')
<script src="{{ baseUrl('admin/js/plugins/summernote/summernote-bs4.js') }}"></script>
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
     <script src="{{ baseUrl('admin/scripts/pages.js') }}"></script>
     <script>
       var pageObj = new PageFn();
       jQuery(document).ready(function(){
         pageObj.initForm();
       })
     </script>
@endsection