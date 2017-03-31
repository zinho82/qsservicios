$(document).ready(function() {
       /***************************************
     * Deshabilita campos del formulario
     * 
     ****************************************/
    $("#ano").attr("disabled",true);
    $("#archivo").attr("disabled",true);
    $("#mes").change(function(){
        $("#ano").attr("disabled",false);
    });
       /***************************************
     * Ano
     * muestra la lista de los archivos cargados segun
     * los parametros del formulario
     * 
     ****************************************/
    $("#ano").change(function(){
        var archi=$("#BuscarArchivo").serialize();
        
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
    /***************************************
     * PROCESAR CARGA
     * Realiza la carga al temporal, historico y unico de los registros
     * para la comparacion de los envios anteriores
     * 
     ****************************************/
    $("#Procesar").click(function(){
         var archi=$("#BuscarArchivo").serialize();
        
            $.ajax({
                type: "post",
                datatype: "json",
                data: archi,
                url: "proccarga.php",
                success: function (archi) {
                    location.reload();

                },
                error: function () {
                    alert(" error no se puedo obtener informacion");
                }
            });
    });
       /***************************************
     * EXAMPLE
     * Carga la DataTable con botones de exportacion
     * para los registros seleccionados
     * 
     ****************************************/
    $('#example').DataTable({
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
    
    
} );
