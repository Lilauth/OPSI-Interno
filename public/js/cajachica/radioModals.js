$(document).ready(function() {
    $("#btn-new-entrada").on("click", function() {
        // allow numbers, a comma or a dot
		document.getElementById("radioS").removeAttribute("checked"); 
        $("#radioE").attr("checked", "checked");
    });
});

$(document).ready(function() {
    $("#btn-new-salida").on("click", function() {
        // allow numbers, a comma or a dot
		document.getElementById("radioE").removeAttribute("checked"); 
        $("#radioS").attr("checked", "checked");
    });
});

$(document).on("click", ".editModal", function() {
    //me guardo el idMovimiento, que manda el botón .editModal en la vista cajachica
    var idMovimiento = $(this).data('id');

    //movimientoId es un input de tipo hidden en informes/entradasalida/edit.blade.php
    $("#movimientoId").val(idMovimiento);

    //consulto para obtener los datos  del movimiento correspondiente en BD
    $.ajax({
        url:  'getMovement',
        type: 'GET',
        data: 'id=' + idMovimiento,

        success:  function (movimiento)
        {
            //movimiento es un arreglo con un sólo elemento (accedemos con [0])

            //seteamos los valores en los controles DOM
            $("#formEdit").attr("action", "entradasalida/"+idMovimiento);
            //tuvimos que armar la fecha, porque venía al revés (aaa-mm-dd)
            $("#Fecha_E").val(movimiento[0].Fecha.substring(8, 10)+movimiento[0].Fecha.substring(4, 8)+movimiento[0].Fecha.substring(0, 4));
            $("#Hora_E").val(movimiento[0].Hora);          
            $("#Concepto_E").val(movimiento[0].Concepto);

            //transformamos el string "monto" en float y luego formateamos a dos decimales 
            n = parseFloat(movimiento[0].Monto);
            n = n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            $("#Monto_E").val(n);

            $("#Responsable_E").val(movimiento[0].Responsable);

            //por último seteamos el valor del radioButton
            if(movimiento[0].Movimiento == 'E'){
                document.getElementById("radioS").removeAttribute("checked"); 
                $("#radioE_E").attr("checked", "checked");
            } else {
                document.getElementById("radioE").removeAttribute("checked"); 
                $("#radioS_E").attr("checked", "checked");
            }
        }
    });
});
