function buscarTrabajos(){
	var id = $("#cliente").val();

    $.ajax({
		url:   'dropdown',
        type:  'GET',
        data: 'id='+id,

		beforeSend: function () {
			$("#resultado").html("Procesando, espere por favor...");
		},

		success:  function (data)
		{
			$.each(data, function(key,value) {
				$("#resultado").append("<h4>"+value.DescCorta+"</h4>");
			});
		}
	});
}