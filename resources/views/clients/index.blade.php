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
                     <h1>Clientes</h1>                    
                </div>
                <div>
                {!! Form::open([
                    'method' => 'GET',
                    'route' => ['client.create'],
                    'class' => 'navbar-form navbar-left pull-left'                              
                    ]) !!}

                    {!! Form::submit('Nuevo Cliente', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}           
                </div> 
                <div>                        
                     {!! Form::open([
                                    'method' => 'GET',
                                    'route' => ['client.index'],
                                    'class' => 'navbar-form navbar-left pull-right',
                                    'role' => 'search'                                
                                     ]) !!}
                     {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nombre o Contacto']) !!}                        
                        <button type="submit" class="btn btn-default">Buscar</button>
                     {!! Form::close() !!} 
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
                                <tr>
                                    <td class="table-text"><div>{{ $cliente->IdCliente }}</div></td>
                                    <td class="table-text"><div>{{ $cliente->NombreCliente }}</div></td>
                                    <td class="table-text"><div>{{ $cliente->Telefono }}</div></td>
                                    <td class="table-text"><div>{{ $cliente->OtrosNombres }}</div></td>                                        
                                    <td>
                                        {!! Form::open([
                                            'method' => 'GET',
                                            'route' => ['client.edit', $cliente->IdCliente]                                
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
                                            'route' => ['client.destroy', $cliente->IdCliente],
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
                     {!! $clientes->render() !!}
                    </div>
                </div>                
            </div>
        </div>    
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

    $(document).ready(function(){
        $("input[name='name']").focus();
    });

    </script>
@endsection