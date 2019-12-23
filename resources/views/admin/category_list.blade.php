@extends('admin.layouts.app')

@section('title','Category List')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Category List</h5>
                        <div class="ibox-tools top8">
                           <a class="btn btn-primary"  href="{{ url('administrator/category/add') }}">Add Category</a>
                        </div>
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
                                    <table id="category_table" class="table" >
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Slug</th>
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
     <script src="{{ baseUrl('admin/scripts/category.js') }}"></script>
     <script>
       var categoryObj = new CategoryFn();
       jQuery(document).ready(function(){
         categoryObj.init();
       })
     </script>
@endsection