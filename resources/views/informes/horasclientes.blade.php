@extends('layouts.app')

@section('content')

<div class="container">        
    
    @include('partials.alerts.js_confirm')  
    <!-- success messages -->
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif 
     <!-- Current trabajo -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Horas de Clientes</h1>             
        </div>
        <div class="panel panel-info">
            <div class="panel-heading"> 
                {!! Form::open([
                                'method' => 'GET',
                                'route' => ['horascliente.index'],
                                'class' => 'navbar-form',
                                'role' => 'search'                                
                                 ]) !!}
                 <!--SELECCIÓN DE FECHA DESDE FILTRAR, UN MES ATRÁS POR DEFECTO-->
                {!! Form::label('Desde', 'Desde:', ['class' => 'control-label']) !!}
                {!! Form::text('desde', $desde->format('d-m-Y'), ['class' => 'datepicker form-control']) !!}

                 <!--SELECCIÓN DE FECHA HASTA PARA FILTRAR, FECHA ACTUAL POR DEFECTO-->
                {!! Form::label('Hasta', 'Hasta:', ['class' => 'control-label']) !!}
                {!! Form::text('hasta', $hasta->format('d-m-Y'), ['class' => 'datepicker form-control']) !!}

                 <!--SELECCIÓN DE DESARROLLADOR, LOGUEADO POR DEFECTO-->
                {!! Form::label('Desarrollador', 'Desarrollador:', ['class' => 'control-label']) !!}
                {!! Form::select('desarrollador', $desarrolladores, $id_desarrollador, ['class' => 'form-control enfocar']) !!}

                {!! Form::submit('Buscar', ['class' => 'btn btn-default'])  !!}
                {!! Form::close() !!}
            </div>
		</div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Cliente</th>                                
                    <th>Horas</th>                                
                </thead>
                <tbody>
                    @foreach ($horas as $hora)
                        <tr>
                            <td class="table-text"><div>{{ $hora->cliente }}</div></td>
                            <td class="table-text"><div>{{ $hora->horas }}</div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
            </div>
        </div>                
    </div>
</div>

@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
    {!!Html::script('js/funciones/datepicker.js')!!}
@endsection