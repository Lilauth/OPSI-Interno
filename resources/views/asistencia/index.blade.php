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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Asistencias</h1>                    

                <div>
                    <h3>Totales: {{ $totales['horas'] }} hs, {{ $totales['minutos'] }} min</h3>
                </div>                 
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
                {!! Form::submit('Buscar', ['class' => 'btn btn-default'])  !!}
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
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($asistencias as $asistencia)
                            <tr data-toggle="collapse" data-target=".accordion{{$asistencia->idAsistencia}}" class="clickable">
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
                                            {{ (new \Carbon\Carbon($asistencia->debe))->format('H:i') }}
                                        @endif
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        @if ((new \Carbon\Carbon($asistencia->recupera)) != (new \Carbon\Carbon()))
                                            {{ (new \Carbon\Carbon($asistencia->recupera))->format('H:i') }}
                                        @endif
                                    </div>
                                </td>                                        
                                <td class="table-text">
                                    <div>
                                        @if ((new \Carbon\Carbon($asistencia->hasta)) != (new \Carbon\Carbon()))
                                            {{
                                                \Carbon\Carbon::create(0, 0, 0, 
                                                floor((new \Carbon\Carbon($asistencia->hasta))->diffInMinutes((new \Carbon\Carbon($asistencia->desde))) / 60), 0, 0)->format('H:i')
                                            }}
                                        @endif
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        @if ((new \Carbon\Carbon($asistencia->hasta)) != (new \Carbon\Carbon()))
                                            {{
                                                \Carbon\Carbon::create(0, 0, 0, 0,
                                                (new \Carbon\Carbon($asistencia->hasta))->diffInMinutes((new \Carbon\Carbon($asistencia->desde))) % 60, 0)->format('H:i')
                                            }}
                                        @endif
                                    </div>
                                </td>  
                                <td class="table-text"><div>{{ $asistencia->desarrollador->NombreDesarrollador }}</div></td>

                                <td>
                                    {!! Form::open([
                                        'method' => 'GET',
                                        'route' => ['asistencias.edit', $asistencia->idAsistencia]                                
                                    ]) !!}
                                      <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i> Edit
                                        </button>
                                      </div>                                               
                                     {!! Form::close() !!}                                              
                                </td>
                                <!-- Task Delete Button -->
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['asistencias.destroy', $asistencia->idAsistencia],
                                        'onsubmit' => 'return ConfirmDelete()'                  
                                    ]) !!}
                                    <div>
                                       <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>  
                                    {!! Form::close() !!}                                           
                                </td>
                                <td>
                                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                    <button type="button" class="btn btn-success btn-create-tarea" data-id="{{$asistencia->idAsistencia}}" data-toggle="modal" data-target="#createModal">
                                    <i class="fa fa-bolt"></i> Tarea
                                    </button>
                                </td>
                            </tr>
                            <tr class="accordion{{$asistencia->idAsistencia}} collapse" style="background-color: white; color:grey; font-style: italic">
                                <td>&nbsp;</td>
                                <td><strong>Cliente</strong></td>
                                <td><strong>Descripcion</strong></td>                                
                                <td><strong>Horas</strong></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>                        
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>                                    
                            </tr>
                            @foreach ($asistencia->tareaDet as $tarea)
                                <tr class="accordion{{$asistencia->idAsistencia}} collapse" style="background-color: white; color:grey; font-style: italic">
                                    <td>&nbsp;</td>
                                    <td>
                                        @if($tarea->cliente)
                                            {{ $tarea->cliente->NombreCliente }}
                                        @endif
                                    </td>
                                    <td>{{ $tarea->Descripcion }}</td>
                                    <td>{{ (new \Carbon\Carbon($tarea->cantHoras))->format('H:i') }}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>                        
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        <button type="button" class="btn btn-primary btn-edit-tarea" data-id="{{$tarea->idTareaDet}}" data-toggle="modal" data-target="#editModal">
                                            <i class="fa fa-Pencil"></i> Edit
                                        </button>
                                    </td>
                                    </td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['tareasdet.destroy', $tarea->idTareaDet],
                                            'onsubmit' => 'return ConfirmDelete()'                  
                                        ]) !!}
                                        <div>
                                           <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>  
                                        {!! Form::close() !!} 
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <div>
                {!! $asistencias->render() !!}
                </div>
            </div>                
        </div>
    </div>    
</div>

@include('tareasdet.create')
@include('tareasdet.edit')

@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function(){
            $("select[name='desarrollador']").focus();
        });

    </script>

    <!--INICIALIZACIÓN DE TIMEPICKER DESDE Y HASTA (SON DE LA MISMA CLASE)-->
    <script>
        $(function() {
            $('.cantHoras').timepicker({'timeFormat': 'H:i', 'step': 10, 'scrollDefault': '00:00', 'minTime': '0:00am', 'maxTime': '08:00am',});
        });
    </script>

    {!!Html::script('js/asistencias/tareasCreate.js')!!}
    {!!Html::script('js/asistencias/tareasEdit.js')!!}
@endsection