$(document).ready(
        function () {
            //alert("CARGA");
            /******************************
             * BLOQUEO DE VISTAS
             * 
             *******************************/
            $("#msg").css("display", "none");
            $("#TipoCarga").attr("disabled",true);
            $("#cargar").click(function () {
                var formData = new FormData($("#CargaArch")[0]);
                $.ajax({
                    url: 'carga.php',
                    type: 'POST',
                    // Form data
                    //datos del formulario
                    data: formData,
                    //necesario para subir archivos via ajax
                    cache: false,
                    contentType: false,
                    processData: false,
                    //mientras enviamos el archivo
                    beforeSend: function () {
                        $("#msg").css("display", "block");
                        $("#msg").attr("class", "alert alert-info");
                        $("#msg").html("Comenzando la carga");
                    },
                    //una vez finalizado correctamente
                    success: function (formData) {

                        $("#msg").css("display", "block");
                        $("#msg").attr("class", "alert alert-info");
                        $("#msg").html(formData);
                    },
                    //si ha ocurrido un error
                    error: function () {
                        $("#msg").html("Error al Cargar Archivo");
                        $("#msg").css("display", "block");
                        $("#msg").attr("class", "alert alert-info");
                    }
                });

            });
            /******************************
             * TIPOARCHIVO
             * Trae los registros asociados a 
             * la opcion de archivo seleccionado
             * FDB o por facturar en la opcion 
             * tipoArhcivo=semanal
             * 
             *******************************/

            $("#TipoArchivo").change(function () {
                var archi = $("#CargaArch").serialize();
                var TipoCarga =$("#TipoArchivo").val();
                if (TipoCarga==4){
                    $.ajax({
                        type: "post",
                        datatype: "json",
                        data: archi,
                        url: "genera-select2.php",
                        success: function (archi) {
                            $("#TipoCarga").attr("disabled", false);
                            $("#TipoCarga").html(archi);

                        },
                        error: function () {
                            alert(" error no se puedo obtener informacion");
                        }
                    });
                }else{
                    $("#TipoCarga").val(7);
                }
                    
            });
        }
);

