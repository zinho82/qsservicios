$(document).ready(function () { 
    /***************************************
     * Deshabilita campos del formulario
     * 
     ****************************************/
     $("#EncxMall").DataTable({
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
    $("#Sponsor").change(function(){
        var Id=$("#Sponsor").val();
         $.ajax({
                type: "post",
                datatype: "json",
                data:'id='+ Id,
                url: "genera_select.php",
                success: function (Id) {
                    $("#Campana").attr("disabled", false); 
                    $("#Campana").html(Id);

                },
                error: function () {
                    alert(" Error no se puede obtener informacion");
                }
            });
    });
});
