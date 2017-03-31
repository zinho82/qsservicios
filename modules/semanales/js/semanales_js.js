$(document).ready(function(){
    //alert("semanales");
    /*************************************
     * DATATABLES
     * -ResumenSemanal
     * -Example (Duplicados)
     * 
     *************************************/
    $("#example").DataTable({
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
    $("#ResumenSemanal").DataTable();
        /*************************************
     * Bloqueos
     * Bloqueo o eliminacion de la vista
     * de controles de formulario
     * 
     *************************************/
    $("#archivo").attr("disabled", true);
    $("#TipoCarga").attr("disabled", true);
    $("#Procesar").attr("disabled", true);
    /*************************************
     * AÑO
     * carga las opciones de carga FDB o por
     * facturar
     * 
     ************************************/
     $("#ano").change(function(){
        var archi=$("#BuscarArchivo").serialize();
        
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
        });
     /*************************************
     * TIPOCARGA
     * carga los archivos asociados a la 
     * carga de AÑO
     * 
     ************************************/
        $("#TipoCarga").change(function(){
        var archi=$("#BuscarArchivo").serialize();
        
            $.ajax({
                type: "post",
                datatype: "json",
                data: archi,
                url: "genera-select.php",
                success: function (archi) {
                    $("#archivo").attr("disabled", false);
                    $("#archivo").html(archi);
                    $("#Procesar").attr("disabled",false);

                },
                error: function () {
                    alert(" error no se puedo obtener informacion");
                }
            });
        });
        /*************************************
     * PROCESAR
     * Se procesa la carga del archivo 
     * seleccionado
     * 
     ************************************/
    $("#Procesar").click(function(){
        var archi=$("#BuscarArchivo").serialize();
        
            $.ajax({
                type: "post",
                datatype: "json",
                data: archi,
                url: "proccarga.php",
                success: function (archi) {
                   
$("#msg").html(archi);
                },
                error: function () {
                    alert(" error no se puedo obtener informacion");
                }
            });
        });
});
