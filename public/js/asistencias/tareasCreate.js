$("#clientesC").on('change', function buscarTrabajos(){
	var id = $("#clientesC").val();

    $.ajax({
		url:  'trabajosCliente',
        type: 'GET',
        data: 'id=' + id,

		success:  function (data)
		{
			var opciones = "";
			opciones = opciones + ("<option value=-1> --Ninguno-- </option>");
			$.each(data, function(key,value) {
				opciones = opciones + ("<option value="+value.idTrabajo+">"+value.DescCorta+"</option>");
			});

			$("#trabajosC").html(opciones);
		}
	});
});

$(document).on("click", ".btn-create-tarea", function () {
     var idAsistencia = $(this).data('id');

     $("#asistenciaId_C").val( idAsistencia );
});