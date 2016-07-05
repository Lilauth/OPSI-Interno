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
                    {!! Form::button('Agregar Entrada <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success', 'id' => 'btn-new-entrada', 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#createModal-Entrada']) !!}
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
                                <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-primary editModal', 'data-id' => $entrada->idEntradaSalida, 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}
                            </td>
                            <!-- Task Delete Button -->
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['entradasalida.destroy', $entrada->idEntradaSalida],
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Caja Chica - Salidas
                <div class="pull-right">
                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                    {!! Form::button('Agregar Salida <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success', 'id' => 'btn-new-salida', 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#createModal-Entrada']) !!}
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
                                <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-primary editModal', 'data-id' => $salida->idEntradaSalida, 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}
                            </td>
                            <!-- Task Delete Button -->
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['entradasalida.destroy', $salida->idEntradaSalida],
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

@include('informes.entradasalida.create')
@include('informes.entradasalida.edit')

@endsection

@section('scripts')
    {!!Html::script('js/funciones/validateMoney.js')!!}
    {!!Html::script('js/cajachica/radioModals.js')!!}
@endsection