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
            <div>
            {!! Form::open([
                'method' => 'GET',
                'route' => ['trabajos.create'],
                'class' => 'navbar-form navbar-left pull-left'
                ]) !!}

                {!! Form::submit('Nuevo trabajo', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}           
            </div>
            <div>                        
                 {!! Form::open([
                                'method' => 'GET',
                                'route' => ['trabajos.index'],
                                'class' => 'navbar-form navbar-left pull-right',
                                'role' => 'search'                                
                                 ]) !!}
                 <!--SELECCIÓN DE FECHA DESDE FILTRAR, UN MES ATRÁS POR DEFECTO-->
                 {!! Form::label('Desde', 'Desde:', ['class' => 'control-label']) !!}
                 {!! Form::text('desde', \Carbon\Carbon::now()->subMonth()->format('d-m-Y'), ['class' => 'datepicker form-control']) !!}

                 <!--SELECCIÓN DE FECHA HASTA PARA FILTRAR, FECHA ACTUAL POR DEFECTO-->
                 {!! Form::label('Hasta', 'Hasta:', ['class' => 'control-label']) !!}
                 {!! Form::text('hasta', \Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'datepicker form-control']) !!}

                <br><br>

                 <!--SELECCIÓN DE CLIENTE-->
                 {!! Form::label('Cliente', 'Cliente:', ['class' => 'control-label']) !!}
                 {!! Form::select('cliente', $clientes, $id_cliente, ['class' => 'form-control']) !!}

                 <!--SELECCIÓN DE DESARROLLADOR, LOGUEADO POR DEFECTO-->
                 {!! Form::label('Responsable', 'Responsable:', ['class' => 'control-label']) !!}
                 {!! Form::select('responsable', $desarrolladores_sel, $id_desarrollador, ['class' => 'form-control']) !!}

                 <!--SELECCIÓN DE ESTADO-->
                 {!! Form::label('Estado', 'Estado:', ['class' => 'control-label']) !!}
                 {!! Form::select('estado', $estados, $id_estado, ['class' => 'form-control']) !!}
                    <button type="submit" class="btn btn-default">Buscar</button>
                 {!! Form::close() !!} 
            </div>        
    @if (count($trabajos) > 0)
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
                            <tr>
                                <td class="table-text"><div>{{ (new \Carbon\Carbon($trabajo->fecha))->format('j F Y') }}</div></td>
                                <td class="table-text"><div>{{ $trabajo->PedidaPor }}</div></td>
                                <td class="table-text"><div>{{ $trabajo->cliente->NombreCliente }}</div></td>                              <td class="table-text"><div>{{ $trabajo->estado->Estado }}</div></td>
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
    @endif
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