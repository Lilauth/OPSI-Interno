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
     <!-- Current trabajo -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Trabajos</h1>             
        </div>
        <table class="table table-responsive">
            <thead style="background-color: #f5f5f5;">
                <th>
                    {!! Form::open([
                    'method' => 'GET',
                    'route' => ['trabajos.create'],
                    'class' => 'navbar-form navbar-left pull-left'
                    ]) !!}

                    {!! Form::submit('Nuevo trabajo', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </th>
                <th>    
                    {!! Form::open([
                                    'method' => 'GET',
                                    'route' => ['trabajos.index'],
                                    'class' => 'navbar-form navbar-left pull-right',
                                    'role' => 'search'                                
                                     ]) !!}
                </th>
                <th>
                     <!--SELECCIÓN DE FECHA DESDE FILTRAR, UN MES ATRÁS POR DEFECTO-->
                    {!! Form::label('Desde', 'Desde:', ['class' => 'control-label']) !!}
                    {!! Form::text('desde', \Carbon\Carbon::now()->subMonth()->format('d-m-Y'), ['class' => 'datepicker form-control']) !!}
                </th>
                <th>
                     <!--SELECCIÓN DE FECHA HASTA PARA FILTRAR, FECHA ACTUAL POR DEFECTO-->
                    {!! Form::label('Hasta', 'Hasta:', ['class' => 'control-label']) !!}
                    {!! Form::text('hasta', \Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'datepicker form-control']) !!}

                </th>
                <th>
                     <!--SELECCIÓN DE CLIENTE-->
                    {!! Form::label('Cliente', 'Cliente:', ['class' => 'control-label']) !!}
                    {!! Form::select('cliente', $clientes, $id_cliente, ['class' => 'form-control']) !!}
                </th>
                <th>
                     <!--SELECCIÓN DE DESARROLLADOR, LOGUEADO POR DEFECTO-->
                    {!! Form::label('Responsable', 'Responsable:', ['class' => 'control-label']) !!}
                    {!! Form::select('responsable', $desarrolladores_sel, $id_desarrollador, ['class' => 'form-control']) !!}
                </th>
                <th>
                     <!--SELECCIÓN DE ESTADO-->
                    {!! Form::label('Estado', 'Estado:', ['class' => 'control-label']) !!}
                    {!! Form::select('estado', $estados, $id_estado, ['class' => 'form-control']) !!}
                </th>
                <th>
                    {!! Form::submit('Buscar', ['class' => 'btn btn-default'])  !!}
                    {!! Form::close() !!}
                </th>
            </thead>
        </table>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Fecha</th>                                
                    <th>Pedida Por</th>                                
                    <th>Cliente</th>
                    <th>Estado</th>
                    <!-- <th>&nbsp;</th>-->
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($trabajos as $trabajo)
                        <tr style="background-color:{{ ($trabajo->estado->codColor) }}">
                            <td class="table-text"><div>{{ (new \Carbon\Carbon($trabajo->fecha))->format('j F Y') }}</div></td>
                            <td class="table-text"><div>{{ $trabajo->PedidaPor }}</div></td>
                            <td class="table-text"><div>{{ $trabajo->cliente->NombreCliente }}</div></td>                              <td class="table-text">
                                <div>
                                    {{ $trabajo->estado->Estado }} 
                                    <span class="badge" style="background-color:{{ ($trabajo->estado->codColor) }}">   </span>
                                </div>
                            </td>
                            <td>
                                {!! Form::open([
                                    'method' => 'GET',
                                    'route' => ['trabajos.edit', $trabajo->idTrabajo]                                
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
                                    'route' => ['trabajos.destroy', $trabajo->idTrabajo],
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
            {!! $trabajos->render() !!}
            </div>
        </div>                
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">

    $(document).ready(function(){
        $("select[name='responsable']").focus();
    });

    </script>

    <script>
        $(function() {
            $( ".datepicker" ).datepicker({dateFormat: 'd-m-Y'}).val();
        });
    </script>
@endsection