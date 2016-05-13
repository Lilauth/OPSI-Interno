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
     <!-- Current asistencia -->
    @if (count($asistencias) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                 <h1>Asistencias</h1>                    
            </div>
            <div>
            {!! Form::open([
                'method' => 'GET',
                'route' => ['asistencias.create'],
                'class' => 'navbar-form navbar-left pull-left'                              
                ]) !!}

                {!! Form::submit('Nueva asistencia', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}           
            </div>
            <div>                        
                 {!! Form::open([
                                'method' => 'GET',
                                'route' => ['asistencias.index'],
                                'class' => 'navbar-form navbar-left pull-right',
                                'role' => 'search'                                
                                 ]) !!}
                 <!--SELECCIÓN DE AÑO PARA FILTRAR, ACTUAL POR DEFECTO-->
                 {!! Form::label('Anio', 'A&ntilde;o:', ['class' => 'control-label']) !!}
                 {!! Form::selectYear('anio', (((new \Carbon\Carbon())->year) - 3), ((new \Carbon\Carbon())->year), $anio, ['method' => 'GET', 'class' => 'form-control']) !!}

                 <!--SELECCIÓN DE MES PARA FILTRAR, ACTUAL POR DEFECTO-->
                 {!! Form::label('Mes', 'Mes:', ['class' => 'control-label']) !!}
                 {!! Form::selectMonth('mes', $mes, ['method' => 'GET', 'class' => 'form-control']) !!}

                 <!--SELECCIÓN DE DESARROLLADOR, LOGUEADO POR DEFECTO-->
                 {!! Form::label('Desarrollador', 'Desarrollador:', ['class' => 'control-label']) !!}
                 {!! Form::select('desarrollador', $desarrolladores_sel, $id_desarrollador, ['class' => 'form-control']) !!}
                    <button type="submit" class="btn btn-default">Buscar</button>
                 {!! Form::close() !!} 
            </div>        
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Fecha</th>                                
                        <th>Desde</th>                                
                        <th>Hasta</th>
                        <th>Debe</th>
                        <th>Recupera</th>
                        <th>Total Hs</th>
                        <th>Total Mm</th>                        
                        <th>Desarrollador</th>
                        <!-- <th>&nbsp;</th>-->
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($asistencias as $asistencia)
                            <tr>
                                <td class="table-text"><div>{{ (new \Carbon\Carbon($asistencia->fecha))->format('j F Y') }}</div></td>
                                <td class="table-text"><div>{{ (new \Carbon\Carbon($asistencia->desde))->format('H:i') }}</div></td>
                                <td class="table-text">
                                    <div>
                                        @if ((new \Carbon\Carbon($asistencia->hasta)) != (new \Carbon\Carbon()))
                                            {{ (new \Carbon\Carbon($asistencia->hasta))->format('H:i') }}
                                        @endif
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        @if ((new \Carbon\Carbon($asistencia->debe)) != (new \Carbon\Carbon()))
                                            {{ (new \Carbon\Carbon($asistencia->debe))->format('h:i') }}
                                        @endif
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        @if ((new \Carbon\Carbon($asistencia->recupera)) != (new \Carbon\Carbon()))
                                            {{ (new \Carbon\Carbon($asistencia->recupera))->format('h:i') }}
                                        @endif
                                    </div>
                                </td>                                        
                                <td class="table-text">
                                    <div>
                                        @if ((new \Carbon\Carbon($asistencia->hasta)) != (new \Carbon\Carbon()))
                                            {{
                                                ((new \Carbon\Carbon($asistencia->hasta))->hour) -
                                                ((new \Carbon\Carbon($asistencia->desde))->hour)
                                            }}
                                        @endif
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        @if ((new \Carbon\Carbon($asistencia->hasta)) != (new \Carbon\Carbon()))
                                            {{
                                                ((new \Carbon\Carbon($asistencia->hasta))->minute) -
                                                ((new \Carbon\Carbon($asistencia->desde))->minute)
                                            }}
                                        @endif
                                    </div>
                                </td>  
                                <td class="table-text"><div>{{ $asistencia->desarrollador->NombreDesarrollador }}</div></td>                                      
                                <td>
                                    {!! Form::open([
                                        'method' => 'GET',
                                        'route' => ['asistencias.edit', $asistencia->idDesarrollador]                                
                                    ]) !!}
                                      <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>Edit
                                        </button>
                                      </div>                                               
                                     {!! Form::close() !!}                                              
                                </td>
                                <!-- Task Delete Button -->
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['asistencias.destroy', $asistencia->idDesarrollador],
                                        'onsubmit' => 'return ConfirmDelete()'                  
                                    ]) !!}
                                    <div>
                                       <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>Delete
                                        </button>
                                    </div>  
                                    {!! Form::close() !!}                                           
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                {!! $asistencias->render() !!}
                </div>
            </div>                
        </div>
    @endif
    </div>    
</div>

@endsection