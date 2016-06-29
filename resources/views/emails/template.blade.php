<!DOCTYPE html>
<html lang="es">
   <head>
		<meta charset="utf-8">
   </head>
   <body>
		<h1>Aviso de Llamado telef&oacute;nico</h1>
		<div>
			<h3>Llam&oacute; {!! $remitente !!} de {!! $cliente->NombreCliente !!}</h3>
			<h4>Pid&oacute; hablar con {!! $destinatario->NombreDesarrollador !!}</h4>
			<p>{!! $content !!}</p>
		</div>
   </body>
</html>