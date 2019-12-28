@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
	<!-- DOCTOR-1 DETAILS -->
    <section id="doctor-1-details" class="doctor-details-section division pd-0">	
        <div class="container-fluid pl-0">
                    <div class="row mt-20">
                        <div class="col-md-6 col-lg-8 offset-lg-2 col-md-offset-2">
                               
                            <div class="mt-20">

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                      <a class="nav-link active" data-toggle="tab" href="#feedback">My Feedback</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" data-toggle="tab" href="#qa">My Q&A</a>
                                    </li>
                                   
                                  </ul>
                                  
                                  <!-- Tab panes -->
                                  <div class="tab-content">
                                    <div class="tab-pane container active" id="feedback">
                                        <div class="table-responsive">
                                            <table id="feedback_table" class="table" >
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
                                    <div class="tab-pane container fade" id="qa">
                                        <div class="table-responsive">
                                            <table id="qa_table" class="table" >
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

                               
                            </div>
                     </div>
                    </div>
                    
        </div>	   <!-- End container -->
    </section>  <!-- END DOCTOR-1 DETAILS -->
@include('_review_message_show_modal')
@include('_answer_form_modal')
@endsection

@section('customStyle')
<link rel="stylesheet" href="{{ baseUrl('admin/css/plugins/dataTables/datatables.min.css') }}">

@endsection
@section('customScript')
<script src="{{ baseUrl('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>

     <script src="{{ baseUrl('scripts/profile.js') }}"></script>
     <script>
       var profileObj = new ProfileFn();
       jQuery(document).ready(function(){
        profileObj.initFeedback()
       })
     </script>
@endsection