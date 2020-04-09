@extends('layouts.app')
@section('title',$title)
@section('meta_title',$record->meta_title)
@section('description',$record->meta_description)
@section('keywords',$record->meta_keyword)
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