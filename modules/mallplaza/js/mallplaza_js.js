$(document).ready(function () {
    /***************************************
     * Deshabilita campos del formulario
     * 
     ****************************************/
    $("#ano").attr("disabled", true);
    $("#archivo").attr("disabled", true);
    $("#Dim2").attr("disabled", true);
    $("#Dim3").attr("disabled", true);
    $("#Area2").attr("disabled", true);
    $("#Area3").attr("disabled", true);
    $("#Clasi2").attr("disabled", true);
    $("#Clasi3").attr("disabled", true);
    $("#Procesar").attr("disabled", true);

    /***************************************
     * MES
     * Activa la opcion del año al ser
     * selecionada una opc
     * 
     ****************************************/
    $("#mes").change(function () {
        $("#ano").attr("disabled", false);
    });
    /***************************************
     * Ano
     * muestra la lista de los archivos cargados segun
     * los parametros del formulario
     * 
     ****************************************/
    $("#ano").change(function () {
        var archi = $("#BuscarArchivo").serialize();

        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "genera-select.php",
            success: function (archi) {
                $("#archivo").attr("disabled", false);
                $("#archivo").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#archivo").change(function () {
         $("#Procesar").attr("disabled", false);
    });
    /***************************************
     * DIM(n)
     * Activa las opciones segun las causas 
     * (dimensiones), seleccionadas x el 
     * usuario
     * 
     ****************************************/
    $("#Dim1").change(function () {
        var archi = $("#FormCalificacion").serialize();

        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "genera-area.php",
            success: function (archi) {
                $("#Area1").html(archi);
                $("#Dim2").attr("disabled", false);
                $("#Area2").attr("disabled", false);
                $("#Clasi2").attr("disabled", false);
            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#Dim2").change(function () {
        var archi = $("#FormCalificacion").serialize();

        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "genera-area2.php",
            success: function (archi) {
                $("#Area2").html(archi);
                $("#Dim3").attr("disabled", false);
                $("#Area3").attr("disabled", false);
                $("#Clasi3").attr("disabled", false);
            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#Dim3").change(function () {
        var archi = $("#FormCalificacion").serialize();

        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "genera-area3.php",
            success: function (archi) {
                $("#Area3").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    /***************************************
     * CAMPOANA
     * carga la session para la campaña seleccioonada
     * 
     ****************************************/
    $("#campana").change(function () {
        var archi = $("#BuscarArchivo").serialize();

        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "genera-session.php",
            success: function (archi) {
                $("#archivo").attr("disabled", false);
                $("#archivo").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
     /***************************************
     * EXPORTAR
     * Abre la pagina con la tabla competa para ser exportada a diversos formatos
     * 
     ****************************************/
    $("#Exportar").click(function () {
        window.open("exportar.php","_self");
    });
    /***************************************
     * PROCESAR CARGA
     * Realiza la carga al temporal, historico y unico de los registros
     * para la comparacion de los envios anteriores
     * 
     ****************************************/
    $("#Procesar").click(function () {   
        var archi = $("#BuscarArchivo").serialize();

        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "proccarga.php",
            success: function (archi) {
                alert(archi); 
                 $("#Procesar").attr("disabled", true);
                location.reload();
                 

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    /***************************************
     * CALIFICACION
     * Carga la DataTable con botones de exportacion
     * para los registros seleccionados
     * 
     ****************************************/
    $('#calificacion').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':contains("Office")'
                }
            },
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]

    });
 /***************************************
     * Guarda la informacion de la calificacion
     * de la encuesta
     * 
     ****************************************/
    $("#Guardar").click(function () {
        var archi = $("#FormCalificacion").serialize();

        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "guardacarga.php",
            success: function (archi) {
                alert(archi);
                window.open('mallplaza_index.php','_self');

            },
            error: function () {
                alert(" error no se pudo guardar la informacion");
            }
        });
    });

});
