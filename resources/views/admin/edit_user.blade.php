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
                                      <li><a class="nav-link" data-toggle="tab" href="#tab-appointment">Reviews</a></li>
                                      <li><a class="nav-link" data-toggle="tab" href="#tab-appointment">Reviews</a></li>
                                    @endif
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-appointment">Appointment</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                           <form method="post" class="contact-form" enctype="multipart/form-data" id='amenities_form'>
                                                @csrf
                                           
                                                @include('_patient_register_fields')
                                                <div class="form-group row">
                                                    <div class="col-sm-4 col-sm-offset-2">
                                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>     
                                        </div>
                                    </div>
                                  
                                    <div role="tabpanel" id="tab-extra_info" class="tab-pane">
                                        <div class="panel-body">
                                            <strong>Donec quam felis</strong>
        
                                            <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                                and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>
        
                                            <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                                sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                        </div>
                                    </div>
                                    <div role="tabpanel" id="tab-appointment" class="tab-pane">
                                        <div class="panel-body">
                                            <strong>Donec quam felis</strong>
        
                                            <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                                and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>
        
                                            <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                                sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                        </div>
                                    </div>
                                </div>
        
        
                            </div>
                        </div>
                     
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