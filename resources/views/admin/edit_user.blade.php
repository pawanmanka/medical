@extends('admin.layouts.app')
@section('title',$title)

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>{{$title}}</h5>
                       
                    </div>
                    <br>
                    <div class="ibox-content">
                        @include('flash::message')
                        <div class="">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Profile</a></li>
                                    @if ($record->role_name  != config('application.patient_role')) 
                                      <li><a class="nav-link" data-toggle="tab" href="#tab-extra_info">Extra Info</a></li>
                                      <li><a class="nav-link" data-toggle="tab" href="#tab-bank_detail">Bank Detail</a></li>
                                      <li><a class="nav-link" data-toggle="tab" href="#tab-reviews">Reviews</a></li>
                                      <li><a class="nav-link" data-toggle="tab" href="#tab-questions">Questions</a></li>
                                    @endif
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-appointment">Appointment</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                           <form method="post" class="contact-form" enctype="multipart/form-data" id='amenities_form'>
                                                @csrf
                                                @if ($record->role_name  != config('application.patient_role')) 
                                                <div  class="col-md-12">
                                                    <input type="text" name="default_margin" class="form-control required digit" value="{{old('default_margin',isset($record)?$record->default_percentage*100:'')}}" placeholder="Default Admin Margin*"  > 
                                                </div>
                                                @endif 
                                                @if($record->role_name == config('application.patient_role'))
                                                @include('_patient_register_fields')
                                                @elseif($record->role_name == config('application.doctor_role'))
                                                @include('_doctor_register_fields',array('record'=>$record)) 
                                                @elseif($record->role_name == config('application.hospital_role'))
                                                    @include('_hospital_register_fields',array('record'=>$record)) 
                                                @elseif($record->role_name == config('application.lab_role'))
                                                    @include('_lab_register_fields',array('record'=>$record)) 
                                                @endif  
                                               
                                                <div class="form-group row">
                                                    <div class="col-sm-4 col-sm-offset-2">
                                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>     
                                        </div>
                                    </div>
                                  
                                    <div role="tabpanel" id="tab-bank_detail" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="contact-form only_view">
                                                @include('_bank_detail',array('record'=>$record)) 
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" id="tab-extra_info" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="contact-form only_view">
                                                @if($record->role_name == config('application.doctor_role'))
                                                @include('_doctor_extra_infromation_fields',array('record'=>$record->getUserInformation)) 
                                                @elseif($record->role_name == config('application.hospital_role'))
                                                    @include('_hospital_extra_information_fields',array('record'=>$record->getUserInformation)) 
                                                @elseif($record->role_name == config('application.lab_role'))
                                                    @include('_lab_extra_information_fields',array('record'=>$record->getUserInformation)) 
                                                @endif     
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div role="tabpanel" id="tab-appointment" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table id="appointment_table" class="table" >
                                                <thead>
                                                <tr>
                                                    <th>SR. NO</th>
                                                    <th>Name</th>
                                                    @if($record->role_name != config('application.patient_role'))
                                                    <th>Gender</th>
                                                    @endif
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Code</th>
                                                    @if($record->role_name != config('application.patient_role'))
                                                    <th>Amount</th>
                                                    <th>Admin Amount</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                </table>
                                         </div> 
                                        </div>
                                    </div>
                                    <div role="tabpanel" id="tab-reviews" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table id="reviews_table" class="table" >
                                                <thead>
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Name</th>
                                                    <th>Visited for</th>
                                                    <th>Rating</th>
                                                    <th>Message</th>
                                                    <th>Publish</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                </table>
                                         </div> 
                                        </div>
                                    </div>
                                    <div role="tabpanel" id="tab-questions" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table id="questions_table" class="table" >
                                                <thead>
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                    <th>Publish</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                </table>
                                         </div> 
                                        </div>
                                    </div>
                                    @include('_review_message_show_modal')

                                </div>
        
        
                            </div>
                        </div>
                     
                    </div>
                </div>
            </div>
            </div>
        </div>


@endsection



@section('customStyle')
<link rel="stylesheet" href="{{ baseUrl('admin/css/plugins/dataTables/datatables.min.css') }}">

@endsection
@section('customScript')
<script src="{{ baseUrl('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ baseUrl('admin/scripts/users.js') }}"></script>
     <script>
           var categoryArr = {!! json_encode($categoryArr) !!}

       var userObj = new UserFn();
       var userId ="{{$record->id}}";
       jQuery(document).ready(function(){
        userObj.categorySubCategory(categoryArr);

        userObj.initEditForm();
       })
     </script>
@endsection