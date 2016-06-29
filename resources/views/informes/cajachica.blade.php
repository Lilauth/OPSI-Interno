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
            <h1>Caja Chica - Entradas
                <div class="pull-right">
                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                    <button type="button" id="btn-new-entrada" class="btn btn-success" data-toggle="modal" data-target="#createModal-Entrada">
                    <i class="fa fa-bolt"></i> Agregar Entrada
                    </button>
                </div>
            </h1>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Concepto</th>
                    <th>Responsable</th>
                    <th>Monto</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($entradas as $entrada)
                        <tr>
                            <td class="table-text"><div>{{ (new \Carbon\Carbon($entrada->Fecha))->format('j F Y') }}</div></td>
                            <td class="table-text"><div>{{ $entrada->Hora }}</div></td>
                            <td class="table-text"><div>{{ $entrada->Concepto }}</div></td>
                            <td class="table-text"><div>{{ $entrada->Responsable }}</div></td>
                            <td class="table-text"><div>{{ number_format($entrada->Monto, 2) }}</div></td>
                            <td>
                                <button type="button" data-id="{{$entrada->idEntradaSalida}}" class="btn btn-success editModal" data-toggle="modal" data-target="#editModal">
                                <i class="fa fa-Pencil"></i> Edit
                                </button>                                           
                            </td>
                            <!-- Task Delete Button -->
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['entradasalida.destroy', $entrada->idEntradaSalida],
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
        </div>                
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Caja Chica - Salidas
                <div class="pull-right">
                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                    <button type="button" id="btn-new-salida" class="btn btn-success" data-toggle="modal" data-target="#createModal-Entrada">
                    <i class="fa fa-bolt"></i> Agregar Salida
                    </button>
                </div>
            </h1>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Concepto</th>
                    <th>Responsable</th>
                    <th>Monto</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($salidas as $salida)
                        <tr>
                            <td class="table-text"><div>{{ (new \Carbon\Carbon($salida->Fecha))->format('j F Y') }}</div></td>
                            <td class="table-text"><div>{{ $salida->Hora }}</div></td>
                            <td class="table-text"><div>{{ $salida->Concepto }}</div></td>
                            <td class="table-text"><div>{{ $salida->Responsable }}</div></td>
                            <td class="table-text"><div>{{ number_format($salida->Monto, 2) }}</div></td>
                            <td>
                                <button type="button" data-id="{{$salida->idEntradaSalida}}" class="btn btn-success editModal" data-toggle="modal" data-target="#editModal">
                                <i class="fa fa-Pencil"></i> Edit
                                </button>                                           
                            </td>
                            <!-- Task Delete Button -->
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['entradasalida.destroy', $salida->idEntradaSalida],
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
        </div>                
    </div>
</div>

@include('informes.entradasalida.create')
@include('informes.entradasalida.edit')

@endsection

@section('scripts')
    <script type="text/javascript">

    $(document).ready(function(){
        $("input[name='Buscar']").focus();
    });

    </script>

    <script>
        $(function() {
            $( ".datepicker" ).datepicker({dateFormat: 'd-m-Y'}).val();
        });
    </script>

    <!--INICIALIZACIÓN DE TIMEPICKER DESDE Y HASTA (SON DE LA MISMA CLASE)-->
    <script>
        $(function() {
            $('.Hora').timepicker({'timeFormat': 'H:i', 'step': 10, 'showDuration': true, 'scrollDefault': 'now'});
        });
    </script>

    {!!Html::script('js/funciones/validateMoney.js')!!}
    {!!Html::script('js/cajachica/radioModals.js')!!}
@endsection