$(".checkVisto").on('change', function setVisto(){
	var id = this.value;
	var checked = document.getElementById(id).checked;

    $.ajax({
		url:  'setVisto/'+id+'&'+checked,
        type: 'GET',

		success:  function (data)
		{
			$('#Searching_Modal').modal('show');
			doSpin();
			$("#filtrar").click();
		}
	});
});
