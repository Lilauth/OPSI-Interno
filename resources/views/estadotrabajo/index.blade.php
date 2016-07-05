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
                 <h1>
                    Estados de un Trabajo
                    <div class="pull-right">
                        {!! Form::open([
                             'method' => 'GET',
                             'route' => ['estadostrabajo.create'],
                             'class' => 'navbar-form navbar-left pull-left'                                                         
                        ]) !!}

                        {!! Form::submit('Nuevo Estado', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}           
                    </div>
                 </h1>
            </div>
            <div class="panel-body">                       
                <table class="table table-striped task-table">
                    <thead>
                        <th>idEstado</th>
                        <th>Estado</th>
                        <th>Color</th> 
                       <!-- <th>&nbsp;</th>-->
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($estadosTrabajo as $estadoTrabajo)
                            <tr>
                                <td class="table-text"><div>{{ $estadoTrabajo->idEstado }}</div></td>
                                <td class="table-text"><div>{{ $estadoTrabajo->Estado }}</div></td>
                                <td class="table-text"><span class="badge" style="background-color:{{ ($estadoTrabajo->codColor) }}; color: {{ ($estadoTrabajo->codColor) }}"> # </span> </td>                                 
                                <!--Editar estadoTrabajo-->
                                <td>
                                    {!! Form::open([
                                        'method' => 'GET',
                                        'route' => ['estadostrabajo.edit', $estadoTrabajo->idEstado]                                
                                    ]) !!}

                                    {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}                                        
                                     
                                    {!! Form::close() !!}                                              
                                </td>
                                <!-- Task Delete Button -->
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['estadostrabajo.destroy', $estadoTrabajo->idEstado],
                                        'onsubmit' => 'return ConfirmDelete()'                  
                                    ]) !!}

                                    {!! Form::button('Delete <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

                                    {!! Form::close() !!}                                           
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>                
        </div>         
    </div>    
@endsection