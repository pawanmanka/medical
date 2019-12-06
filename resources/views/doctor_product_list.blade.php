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
                        <div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
                                <div class="text-right">
                                        <a class="btn btn-primary" href="{{ url('/create-slots') }}">Add</a>
                                </div>
                            <div class="mt-20">
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
                    
        </div>	   <!-- End container -->
    </section>  <!-- END DOCTOR-1 DETAILS -->

@endsection

@section('customStyle')
<link rel="stylesheet" href="{{ baseUrl('admin/css/plugins/dataTables/datatables.min.css') }}">

@endsection
@section('customScript')
<script src="{{ baseUrl('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ baseUrl('scripts/products.js') }}"></script>
     <script>
       var productObj = new ProductFn();
       jQuery(document).ready(function(){
         productObj.init();
       })
     </script>
@endsection