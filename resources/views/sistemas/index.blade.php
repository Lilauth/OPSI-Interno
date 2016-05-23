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
                         <h1>Sistemas de Clientes</h1>                    
                    </div>
                    <div>
                        {!! Form::open([
                             'method' => 'GET',
                             'route' => ['sistemas.create'],
                             'class' => 'navbar-form navbar-left pull-left'                                                         
                        ]) !!}

                        {!! Form::submit('Nuevo Sistema', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}           
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
                                                'route' => ['sistemas.destroy', $sistema->idSistema],
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
                         {!! $sistemas->render() !!}
                        </div>                        
                    </div>                
                </div>         
        </div>    
    </div>

@endsection