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
                        Clientes
                        <div class="pull-right">
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['client.create'],
                            'class' => 'navbar-form navbar-left pull-left'                              
                            ]) !!}

                            {!! Form::submit('Nuevo Cliente', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}           
                        </div> 
                    </h1>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading"> 
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['client.index'],
                            'class' => 'navbar-form',
                            'role' => 'search'                                
                        ]) !!}
                        {!! Form::text('name', '', ['class' => 'form-control enfocar', 'placeholder' => 'Nombre o Contacto']) !!}                        
                        {!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>idCliente</th>
                            <th>Nombre</th>
                            <th>Tel&eacute;fono</th>
                            <th>Contacto</th>
                            <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr style="background-color: {{ $cliente->nivel['codColor'] }}">
                                    <td class="table-text"><div>{{ $cliente->IdCliente }}</div></td>
                                    <td class="table-text"><div>{{ $cliente->NombreCliente }}</div></td>
                                    <td class="table-text"><div>{{ $cliente->Telefono }}</div></td>
                                    <td class="table-text"><div>{{ $cliente->OtrosNombres }}</div></td>                                        
                                    <td>
                                        {!! Form::open([
                                            'method' => 'GET',
                                            'route' => ['client.edit', $cliente->IdCliente]                                
                                        ]) !!}

                                        {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}

                                         {!! Form::close() !!}                                              
                                    </td>
                                    <!-- Task Delete Button -->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['client.destroy', $cliente->IdCliente],
                                            'onsubmit' => 'return ConfirmDelete()'                  
                                        ]) !!}

                                        {!! Form::button('Delete <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

                                        {!! Form::close() !!}                                           
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                     {!! $clientes->render() !!}
                    </div>
                </div>                
            </div>
        </div>    
    </div>

@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
@endsection