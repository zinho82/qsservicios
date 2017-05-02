$(document).ready(
        function(){
             /***************************************
     * CALIFICACION
     * Carga la DataTable con botones de exportacion
     * para los registros seleccionados
     * 
     ****************************************/
    $('#calificacion').DataTable({
        dom: 'lBfrtip',
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
        });
