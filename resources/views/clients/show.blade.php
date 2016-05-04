@extends('layouts.app')

@section('content')
<div class="container">    

	<h1>{{ $client->name }}</h1>
	
    @include('partials.alerts.js_confirm')

	<a href="{{ route('client.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i>Clients List</a>
	<a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i>Edit</a>    

 		{!! Form::open([
            'method' => 'DELETE',
            'route' => ['client.destroy', $client->id],
            'onsubmit' => 'return ConfirmDelete()'                  
        ]) !!}
        <div class="pull-right">
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        </div>  
       <!-- <button class='btn btn-xs btn-danger' type='submit' data-toggle="modal" data-target="#confirmDelete" 
                data-title="Delete Client" data-message='Are you sure you want to delete this client ?'>-->  
       
        {!! Form::close() !!}       
</div>

@endsection