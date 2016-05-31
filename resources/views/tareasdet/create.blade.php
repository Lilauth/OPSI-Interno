@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Nueva Tarea</h1>                       
            </div>

            <div class="panel-body">                
                @include('partials.alerts.errors')
                <!-- success messages -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                         {{ Session::get('flash_message') }}
                    </div>
                @endif
                <!-- -->
                {!! Form::open(['url' => 'tareasdet']) !!}

                <div class="form-group">
                    {!! Form::open([
                                'method' => 'GET',
                                'route' => ['tareasdet.create'],
                                'class' => 'navbar-form navbar-left pull-right',
                                'role' => 'search'                                
                                 ]) !!}

                    {!! Form::label('cliente', 'Cliente:', ['class' => 'control-label']) !!}
                    {!! Form::select('idCliente', $clientes, null, ['method' => 'GET', 'class' => 'form-control']) !!}

                    {!! Form::submit('Aceptar', ['class' => 'btn btn-default'])  !!}
                    {!! Form::close() !!} 
                </div>

                <div class="form-group">
                    {!! Form::label('Trabajo', 'Trabajo:', ['class' => 'control-label']) !!}
                    {!! Form::select('idTrabajo', $trabajos, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Descripcion', 'Descripci&oacute;n:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('Descripcion', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('CantHoras', 'Cant. Horas:', ['class' => 'control-label']) !!}
                    {!! Form::text('cantHoras', '', ['id' => 'debe', 'class' => 'cantHoras form-control']) !!}                     
                </div>

                {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

                <div class="pull-right">
                    <a href="{{ route('tareasdet.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!}
            </div>    
        </div>    
    </div>    
@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function(){
            $("select[name='idCliente']").focus();
        });
    </script>

    <!--INICIALIZACIÓN DE TIMEPICKER DESDE Y HASTA (SON DE LA MISMA CLASE)-->
    <script>
        $(function() {
            $('.cantHoras').timepicker({'timeFormat': 'H:i', 'step': 10, 'scrollDefault': '00:00', 'minTime': '0:00am', 'maxTime': '08:00am',});
        });
    </script>  
@endsection