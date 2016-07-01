$(".checkVisto").on('change', function setVisto(){
	var id = this.value;
	var checked = document.getElementById(id).checked;

    $.ajax({
		url:  'setVisto/'+id+'&'+checked,
        type: 'GET',

        beforeSend: doSpin(),

		success:  function (data)
		{
			$("#filtrar").click();
		}
	});
});
