@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
	<!-- DOCTOR-1 DETAILS -->
    <section id="doctor-1-details" class="doctor-details-section division pd-0">	
        <div class="container pl-0">
                    <div class="row mt-20">
                        <div class="col-md-12">
                            @include('flash::message')
                            <div class="mt-20">
                                <div class="row mlr-0">
                                    <div class="col-lg-6">
                                        <h4>My wallet Balance ( {{$amount}} )</h4>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        @hasanyrole(config('application.extra_info_roles'))
                                         <a href="{{url('request-for-money')}}" class="btn btn-primary">Request for money</a>
                                        @endhasanyrole
                                    </div>
                               </div>
                            </div>   
                            <div class="mt-20 mlr-0 col-12">
                            <h4>My last Payment receive statement</h4>
                            </div>
                            <div class="mt-20 mlr-0">
                                
                                <div class="">
                                    <div class="row mb-20 mlr-0">
                                         <div class="col-lg-6"></div>
                                         <div class="col-lg-6 text-right">
                                            @hasanyrole(config('application.wallet_add_roles')) 
                                            <a href="#"  id="addWalletMoneyShow"  class="btn btn-primary">Add Amount</a>
                                            @endhasanyrole
                                         </div>
                                    </div>
                                    <table id="wallet_table" class="table" >
                                    <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                       
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
@include('_wallet_add_form_modal')
@endsection

@section('customStyle')
<link rel="stylesheet" href="{{ baseUrl('admin/css/plugins/dataTables/datatables.min.css') }}">

@endsection
@section('customScript')
<script src="{{ baseUrl('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var SITEURL = '{{URL::to('')}}';
    var YouName = '{{auth()->user()->name}}';
    var Email = '{{auth()->user()->email}}';
    var Phone = '{{auth()->user()->username}}';
    var ApiKey = '{{config("application.rez_api_key")}}';
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); 
   

 </script>
     <script src="{{ baseUrl('scripts/wallet.js') }}"></script>
     <script>
       var walletObj = new WalletFn();
       jQuery(document).ready(function(){
        walletObj.init()
       })
     </script>
@endsection