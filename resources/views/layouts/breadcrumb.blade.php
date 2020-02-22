<div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">						
                <div class="col">
                    <div class=" breadcrumb-holder">

                        <!-- Breadcrumb Nav -->
                        <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item"><a href="all-services.html">Our Services</a></li> --}}
                                @if(auth()->id() != null)
                                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                              </ol>
                        </nav>

                        <!-- Title -->
                        <h4 class="h4-sm steelblue-color">{{$title}}</h4>

                    </div>
                </div>
            </div>  <!-- End row -->	
        </div>	<!-- End container -->		
    </div>	<!-- END BREADCRUMB -->	