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
         <!-- Current Clients -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <h1>Mensajes Telef&oacute;nicos</h1>                    
                    </div>
                    <div>
                        {!! Form::open([
                             'method' => 'GET',
                             'route' => ['mensajes.create'],
                             'class' => 'navbar-form navbar-left pull-left'                                                         
                        ]) !!}

                        {!! Form::submit('Nuevo Mensaje', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}           
                    </div> 

                    <div>                        
                         {!! Form::open([
                                        'method' => 'GET',
                                        'route' => ['mensajes.index'],
                                        'class' => 'navbar-form navbar-left pull-right',                                                                        
                                         ]) !!}
                         {!! Form::label('Estado', 'Visto:', ['class' => 'control-label']) !!}                                    
                         {!! Form::select('visto', [
                             '1' => 'Visto',
                             '2' => 'No Vistos',
                             '3' => 'Todos'], $visto, ['class' => 'form-control']
                        ) !!}

                         {!! Form::label('Para', 'Para:', ['class' => 'control-label']) !!}                                    
                         {!! Form::select('para', $desarrolladores_sel, $id_desarrollador, ['class' => 'form-control']) !!}                     
                            <button type="submit" class="btn btn-default">Filtrar</button>
                         {!! Form::close() !!} 
                    </div> 
                                        
                    <div class="panel-body">                       
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Mensaje</th> 
                                <th>Para</th>                               
                               <!-- <th>&nbsp;</th>-->
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($mensajes as $mensaje)
                                    <tr>
                                        <td class="table-text"><div>{{ $mensaje->Fecha }}</div></td>
                                        <td class="table-text"><div>{{ $mensaje->Cliente }}</div></td>
                                        <td class="table-text"><div>{{ $mensaje->Mensaje }}</div></td>                                       
                                        <td class="table-text"><div>{{ $mensaje->desarrollador->NombreDesarrollador }}</div></td>                                       
                                        <!--Editar Mensaje-->
                                        <td>
                                            {!! Form::open([
                                                'method' => 'GET',
                                                'route' => ['mensajes.edit', $mensaje->idMensaje]                                
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
                                                'route' => ['mensajes.destroy', $mensaje->idMensaje],
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
                         {!! $mensajes->render() !!}
                        </div>
                    </div>                
                </div>         
        </div>    
    </div>

@endsection