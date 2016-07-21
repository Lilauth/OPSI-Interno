@extends('layouts.app')

@section('content')
	<footer class="footer">
	    <div id="map">
			{!!$map['html']!!}
	    </div>
            <div class="panel panel-default"> 
                <div class="panel-heading">
                	<h2>Contacto</h2>
                </div>
                <div class="panel-body">
                    <ul class="contact-details">
                        <li><p><i class="fa fa-map-marker"></i> Calle 6 Esq. 529, La Plata, Buenos Aires</p></li>
                        <li><p><i class="fa fa-phone"></i> (221) 421-0628</p></li>
                        <li><p><i class="fa fa-envelope"></i> <a href=">openfg.soft@gmail.com">openfg.soft@gmail.com</a></p></li>
                    </ul>
				</div>
			</div>
	</footer>
@endsection

@section('scripts')
	@include('gmaps.headscripts')
@endsection