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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        Niveles de un Cliente
                        <div class="pull-right">
                            {!! Form::open([
                                 'method' => 'GET',
                                 'route' => ['niveles.create'],
                                 'class' => 'navbar-form navbar-left pull-left'                                                         
                            ]) !!}

                            {!! Form::submit('Nuevo Nivel', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}           
                        </div>
                    </h1>
                </div>
                <div class="panel-body">                       
                    <table class="table table-striped task-table">
                        <thead>
                            <th>idNivel</th>
                            <th>Descripci&oacute;n</th>
                            <th>Color</th> 
                           <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($niveles as $nivel)
                                <tr>
                                    <td class="table-text"><div>{{ $nivel->idNivel }}</div></td>
                                    <td class="table-text"><div>{{ $nivel->Descripcion }}</div></td>
                                    <td class="table-text"><span class="badge" style="background-color:{{ ($nivel->codColor) }}">   </span> </td>                                 
                                    <!--Editar nivel-->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'GET',
                                            'route' => ['niveles.edit', $nivel->idNivel]                                
                                        ]) !!}
                                        {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}                                              
                                         {!! Form::close() !!}                                              
                                    </td>
                                    <!-- Task Delete Button -->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['niveles.destroy', $nivel->idNivel],
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