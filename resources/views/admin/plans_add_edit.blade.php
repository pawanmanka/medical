@extends('admin.layouts.app')
<?php $title = isset($record->id)?"Plan Edit":"Plan Add"; ?>
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

                        <form method="post" enctype="multipart/form-data" id='plans_form'>
                            @csrf
                       
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ old('name',(isset($record->name)?$record->name:'')) }}" class="form-control required">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price" value="{{ old('price',(isset($record->price)?$record->price:'')) }}" class="form-control number required">
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
     <script src="{{ baseUrl('admin/scripts/plans.js') }}"></script>
     <script>
       var plansObj = new PlansFn();
       jQuery(document).ready(function(){
         plansObj.initForm();
       })
     </script>
@endsection