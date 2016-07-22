$(document).on("click", ".btn-show-client", function () {
	//me guardo el idCliente (que manda el button en el atributo "data-id")
    var idCliente = $(this).data('id');   

    //#clienteId es un input de tipo hidden en el edit.blade.php de tareasDet
	$("#clienteId").val( idCliente );

	//consulto para obtener los datos  de la cliente correspondiente en BD
    $.ajax({
		url:  'getCliente',
        type: 'GET',
        data: 'id=' + idCliente,

		success:  function (cliente)
		{
			//cliente es un arreglo con un sólo elemento (accedemos con [0])
			$("#codigo").html(cliente[0].CodigoCliente);
			$("#nombre").html(cliente[0].NombreCliente);
			$("#telefono").html(cliente[0].Telefono);
			$("#observaciones").html(cliente[0].Observaciones);
			$("#otrosnombres").html(cliente[0].OtrosNombres);
		}
	});
});