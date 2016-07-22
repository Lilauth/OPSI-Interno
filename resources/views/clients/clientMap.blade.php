@extends('layouts.app')

@section('content')
    <div class="container">  
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
                <h5>Haciendo click sobre un marcador, podrá ver el nombre del cliente</h5>
                <h6>Los clientes que no aparecen es porque no se ha informado su ubicaci&oacute;n en maps, puede hacerlo a trav&eacute;s de la herramienta "Edit" en el "Listado de Clientes"</h6>
                <div id="map">
                    {!!$map['html']!!}
                </div>                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('gmaps.headscripts')
@endsection