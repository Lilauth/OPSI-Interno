$("#clientesE").on('change', function buscarTrabajos(){
	var id = $("#clientesE").val();

    $.ajax({
		url:  'trabajosCliente',
        type: 'GET',
        data: 'id=' + id,

		success:  function (data)
		{
			var opciones = "";
			$.each(data, function(key,value) {
				opciones = opciones + ("<option value="+value.idTrabajo+">"+value.DescCorta+"</option>");
			});

			$("#trabajosE").html(opciones);
			setearTrabajo($("#trabajoId_E").val());
		}
	});
});

$(document).on("click", ".btn-edit-tarea", function () {
	//me guardo el idTarea (que manda el button en el atributo "data-id")
    var idTarea = $(this).data('id');   

    //#tareaId es un input de tipo hidden en el edit.blade.php de tareasDet
	$("#tareaId").val( idTarea );

	//consulto para obtener los datos  de la tarea correspondiente en BD
    $.ajax({
		url:  'getTarea',
        type: 'GET',
        data: 'id=' + idTarea,

		success:  function (tarea)
		{
			//tarea es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "tareasdet/"+idTarea);
			$("#asistenciaId_E").val(tarea[0].idAsistencia);
			$("#trabajoId_E").val(tarea[0].idTrabajo);			
			$("#tareaDescripcionE").val(tarea[0].Descripcion);
			$("#cantHorasE").attr("value", tarea[0].cantHoras.substring(11, 16));
			$("#clientesE").val(tarea[0].idCliente).change();
		}
	});
});

function setearTrabajo(idTrabajo){
	$("#trabajosE").val(idTrabajo);
}