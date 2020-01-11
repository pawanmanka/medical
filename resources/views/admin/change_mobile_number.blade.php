@extends('admin.layouts.app')
<?php $title = "Change Mobile Number For ".$record->name; ?>
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

                        <form method="post" enctype="multipart/form-data" id='amenities_form'>
                            @csrf
                             @if(!isset($mobile_number))
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Enter New Mobile Number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="mobile_number" value="" class="form-control required">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Send Opt</button>
                                </div>
                            </div>
                            @else 
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Enter Opt</label>
                                <div class="col-sm-10">
                                    <input type="text" name="otp" value="" class="form-control required">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit" name='send_type' value="confirm_otp">Confirm Otp</button>
                                    <button class="btn btn-primary btn-sm" type="submit" name='send_type' value="resend_otp">Resend Opt</button>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>


@endsection


@section('customScript')
     <script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
     <script src="{{ baseUrl('admin/scripts/amenities.js') }}"></script>
     <script>
       var amenitiesObj = new AmenitiesFn();
       jQuery(document).ready(function(){
         amenitiesObj.initForm();
       })
     </script>
@endsection