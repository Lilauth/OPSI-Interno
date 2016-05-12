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
                         {!! Form::label('Desarrollador', 'Desarrollador:', ['class' => 'control-label']) !!}                                    
                         {!! Form::select('desarrollador', $desarrolladores_sel, $id_desarrollador, ['class' => 'form-control']) !!}                        
                            <button type="submit" class="btn btn-default">Buscar</button>
                         {!! Form::close() !!} 
                    </div>        
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Desarrollador</th>
                                <th>Fecha</th>                                
                                <th>Desde</th>                                
                                <th>Hasta</th>
                                <!-- <th>&nbsp;</th>-->
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($asistencias as $asistencia)
                                    <tr>
                                        <td class="table-text"><div>{{ $asistencia->desarrollador->NombreDesarrollador }}</div></td>
                                        <td class="table-text"><div>{{ (new \Carbon\Carbon($asistencia->fecha))->format('d/m') }}</div></td>
                                        <td class="table-text"><div>{{ (new \Carbon\Carbon($asistencia->desde))->format('h:s') }}</div></td>
                                        <td class="table-text"><div>{{ (new \Carbon\Carbon($asistencia->hasta))->format('h:s') }}</div></td>
                                      
                                        <td>
                                            {!! Form::open([
                                                'method' => 'GET',
                                                'route' => ['asistencias.edit', $asistencia->Iddesarrollador]                                
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
                                                'route' => ['asistencias.destroy', $asistencia->Iddesarrollador],
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