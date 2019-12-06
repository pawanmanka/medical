@extends('admin.layouts.app')
<?php $title = isset($user->id)?"Sub Admin Edit":"Sub Admin Add"; ?>

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

                        <form method="post" id='user_form'>
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                     {!! selectBox('role_id',$roleArr,old('role_id',(isset($user->role_id)?$user->role_id:'')),array('class'=>'form-control required'),'Select Role') !!}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ old('name',(isset($user->name)?$user->name:'')) }}" class="form-control required">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ old('email',(isset($user->email)?$user->email:'')) }}" class="form-control required">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" id="password" name="password"  class="form-control ">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password"  name="password_confirmation"  class="form-control">
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
     <script src="{{ baseUrl('admin/scripts/users.js') }}"></script>
     <script>
       var userObj = new UserFn();
       jQuery(document).ready(function(){
         userObj.initForm();
       })
     </script>
@endsection