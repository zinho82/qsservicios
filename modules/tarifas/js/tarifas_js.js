$(document).ready(function(){
    $("#TablaTarifa").DataTable({
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
});