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
                                
                            <div class="mt-20">
                              <!-- Contact Form Input -->
                              <form  method="POST" id="add_edit_lab_from" enctype="multipart/form-data" class="row contact-form">
                                @csrf                        
                                <div  class="col-md-12">
                                    <input type="text" name="name" value="{{old('name',isset($record)?$record->name:'')}}"  class="form-control required " placeholder="Name"  > 
                                </div>
                                @if($segment =='my-packages')
                                <div  class="col-md-12">
                                    <textarea name="description" class="form-control required "   placeholder="Description"   cols="30" rows="10">{{old('description',isset($record)?$record->description:'')}}</textarea>
                                   
                                </div>
                                @endif
                                <div  class="col-md-12">
                                    <input type="text" name="actual_fee" value="{{old('actual_fee',isset($record)?$record->actual_price:'')}}" class="form-control required " placeholder="Fee"  > 
                                </div>

                                <div  class="col-md-12">
                                    <input type="text" name="discount_fee" value="{{old('discount_fee',isset($record)?$record->discount_price:'')}}" class="form-control required " placeholder="Discount Fee"  > 
                                </div>            

                                <div class="col-lg-12 mt-15 form-btn">  
                                    <button type="submit" class="btn btn-blue blue-hover">Save</button> 
                                </div>                         
                                </form> 
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
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>

     <script src="{{ baseUrl('scripts/products.js') }}"></script>
     <script>
       var productObj = new ProductFn();
       jQuery(document).ready(function(){
         productObj.initLabFrom();
       })
     </script>
@endsection