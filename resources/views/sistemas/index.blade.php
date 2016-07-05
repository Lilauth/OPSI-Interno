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
         <!-- Current Sistema -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        Sistemas de Clientes
                        <div class="pull-right">
                            {!! Form::open([
                                 'method' => 'GET',
                                 'route' => ['sistemas.create'],
                                 'class' => 'navbar-form navbar-left pull-left'                                                         
                            ]) !!}
                            {!! Form::submit('Nuevo Sistema', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}          
                        </div>
                    </h1>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">                      
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['sistemas.index'],
                            'class' => 'navbar-form',
                            'role' => 'search'                                
                        ]) !!}
                        {!! Form::text('name', '', ['class' => 'form-control enfocar', 'placeholder' => 'Descripci&oacute;n']) !!}
                        {!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                     </div>
                </div>
                <div class="panel-body">                       
                    <table class="table table-striped task-table">
                        <thead>
                            <th>idSistema</th>
                            <th>Descripci&oacute;n</th>
                           <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($sistemas as $sistema)
                                <tr>
                                    <td class="table-text"><div>{{ $sistema->idSistema }}</div></td>
                                    <td class="table-text"><div>{{ $sistema->Descripcion }}</div></td>
                                    <!--Editar sistema-->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'GET',
                                            'route' => ['sistemas.edit', $sistema->idSistema]                                
                                        ]) !!}
                                        {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}                                              
                                    </td>
                                    <!-- Task Delete Button -->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['sistemas.destroy', $sistema->idSistema],
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
                        {!! $sistemas->render() !!}
                    </div>                        
                </div>                
            </div>         
    </div>
@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
@endsection