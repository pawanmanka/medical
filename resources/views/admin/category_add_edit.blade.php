@extends('admin.layouts.app')
<?php $title = isset($category->id)?"Category Edit":"Category Add"; ?>
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

                        <form method="post" enctype="multipart/form-data" id='category_form'>
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Super Category</label>
                                <div class="col-sm-10">
                                     {!! selectBox('super_category_id',config('application.super_categories'),old('super_category_id',(isset($category->super_category_id)?$category->super_category_id:'')),array('class'=>'form-control'),'Select Super Category') !!}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Parent Category</label>
                                <div class="col-sm-10">
                                     {!! selectBox('parent_id',$parentCategory,old('parent_id',(isset($category->parent_id)?$category->parent_id:'')),array('class'=>'form-control'),'Select Parent Category') !!}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ old('name',(isset($category->name)?$category->name:'')) }}" class="form-control required">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-4">
                                         <img  {{  isset($category->image_url)?'style="display:none;"':'' }}  class="imagePreview" id="categoryImage" src="{{ isset($category->image_url)?$category->image_url:'' }}">
                                        <div class="custom-file">
                                            <input id="categoryImageUpload" type="file" name="image" class="custom-file-input">
                                            <label for="categoryImageUpload" class="custom-file-label">Choose file...</label>
                                        </div> 

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


@section('customScript')
     <script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
     <script src="{{ baseUrl('admin/scripts/category.js') }}"></script>
     <script>
       var categoryObj = new CategoryFn();
       jQuery(document).ready(function(){
         categoryObj.initForm();
       })
     </script>
@endsection