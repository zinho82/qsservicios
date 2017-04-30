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
//    $("#Mall").change(function(){
//        alert("cambio mall");
//                var FormMall=$("#FormMall").serialize();
//                FormMall.submit();
//                
//    });
});
