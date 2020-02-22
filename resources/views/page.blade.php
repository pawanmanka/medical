@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection
@section('content')


			<!-- BANNER-5
			============================================= -->
			<section id="banner-5" class="pt-20 banner-section division">
				<div class="container">

                           {!! $content !!}



				</div>	   <!-- End container -->	
			</section>	<!-- END BANNER-5 -->


@endsection