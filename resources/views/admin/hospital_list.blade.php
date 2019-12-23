@extends('admin.layouts.app')

@section('title',$title.' List')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>{{$title}} List</h5>
                     
                    </div>
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        @include('flash::message')

                      <div class="row">
                             <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="user_table" class="table" >
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Contact No.</th>
                                        <th>Information</th>
                                        <th>Extra Information</th>
                                        <th>Appointment</th>
                                        <th>Subscription</th>
                                        <th>Review</th>
                                        <th>Request Money</th>
                                        <th>Wallet Amount</th>
                                        <th>Action</th>
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
       var userObj = new UserFn();
       userObj.currentSegment = "{{ $current_segment }}"   
       jQuery(document).ready(function(){
        userObj.init();
       })
     </script>
@endsection