@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Nuevo Mensaje Telef&oacute;nico</h1>                       
            </div>

            <div class="panel-body">                
                @include('partials.alerts.errors')
                <!-- success messages -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                         {{ Session::get('flash_message') }}
                    </div>
                @endif
                <!-- -->
                {!! Form::open(['url' => 'mensajes']) !!}

                
                <div class="form-group">
                    {!! Form::label('Fecha', 'Fecha:', ['class' => 'control-label']) !!}
                    {!! Form::text('Fecha', \Carbon\Carbon::now()->format('d-m-Y'), ['id' => 'datepicker', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Cliente', 'Cliente:', ['class' => 'control-label']) !!}
                    {!! Form::text('Cliente', null, ['class' => 'form-control']) !!}
                </div> 

                <div class="form-group">
                    {!! Form::label('idCliente', 'Empresa:', ['class' => 'control-label']) !!}
                    {!! Form::select('idCliente', $clientes_sel, '0', ['class' => 'form-control']) !!}
                </div>                

                <div class="form-group">
                     {!! Form::label('Para', 'Para:', ['class' => 'control-label']) !!}                    
                     {!! Form::select('Para', $desarrolladores_sel, 9, ['class' => 'form-control']) !!}
                 </div> 

                 <div class="form-group">
                    {!! Form::label('Mensaje', 'Mensaje:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('Mensaje', null, ['class' => 'form-control']) !!}
                </div>

                <!--  <div class="form-group">
                    {!! Form::label('Visto', 'Visto', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('Visto', '1', false) !!}
                  </div>  -->                            

                {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

                <div class="pull-right">
                    <a href="{{ route('mensajes.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!}
            </div>    
        </div>    
    </div>    
@endsection

@section('scripts')
    <script type="text/javascript">

    $(document).ready(function(){
        $("input[name='Fecha']").focus();
    });

    </script>

    <script>
        $(function() {
            $( "#datepicker" ).datepicker({dateFormat: 'd-m-Y'}).val();
        });
    </script>
@endsection