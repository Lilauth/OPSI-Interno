$(".clientes").on('change', function buscarTrabajos(){
	var id = $(".clientes").val();

    $.ajax({
		url:   'dropdown',
        type:  'GET',
        data: 'id='+id,

		success:  function (data)
		{
			var opciones = "";
			$.each(data, function(key,value) {
				opciones = opciones + ("<option>"+value.DescCorta+"</option>");
			});

			$(".trabajos").html(opciones);
		}
	});
});