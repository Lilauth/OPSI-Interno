@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Nuevo Sistema de Cliente</h1>                       
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
                {!! Form::open(['url' => 'sistemas']) !!}

                <div class="form-group">
                    {!! Form::label('Descripcion', 'Descripci&oacute;n:', ['class' => 'control-label']) !!}
                    {!! Form::text('Descripcion', null, ['class' => 'form-control enfocar']) !!}
                </div>                   

                {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

                <div class="pull-right">
                    <a href="{{ route('sistemas.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!}
            </div>    
        </div>    
    </div>    
@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
@endsection