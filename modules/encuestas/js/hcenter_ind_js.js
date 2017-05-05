/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () { 
    alert("ENC IND");
    $("#Agenda").click(function(){
        window.open('Agenda.php'); 
    });
    $("#VerEncuesta").css("display", "none");
    $("#datetimepicker1").css("display", "none");
    /*******************************************
     * Preg_axxx
     * busca las causas y areas en los valores 
     * seleccionadpos
     * 
     *******************************************/
    $("#preg4_area1").change(function () {
        var id = $("#preg4_area1").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg4_causa1").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    }); 
    $("#preg4_area2").change(function () {
        var id = $("#preg4_area2").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg4_causa2").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#preg4_area3").change(function () {
        var id = $("#preg4_area3").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg4_causa3").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    
    $("#preg6_area1").change(function () {
        var id = $("#preg6_area1").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg6_causa1").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    }); 
    $("#preg6_area2").change(function () {
        var id = $("#preg6_area2").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg6_causa2").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#preg6_area3").change(function () {
        var id = $("#preg6_area3").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg6_causa3").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    
    
    /*******************************************
     * BOTON GUARDAR
     * funcion al apretar el boton
     * guardar, GUARDA ENCUESTA
     * 
     *******************************************/
    $("#Guardar").click(function () {
        var archi = $("#ingreso").serialize();
        $("#guardar").attr("disabled", true);
        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "GuardaEncInd.php",
            success: function (archi) {
               alert(archi);
window.open('hcenter_ind.php','_self');
            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#GuardarSinEncuesta").click(function () {
        var archi = $("#ingreso").serialize();
        $("#GuardarSinEncuesta").attr("disabled", true);
        $.ajax({
            type: "post",
            datatype: "json",
            data: archi,
            url: "GuardaEncInd.php",
            success: function (archi) {
              alert(archi);
              window.open('hcenter_index.php','_self');

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });

    /*******************************************
     * CALIFICAR ENCUSTAS
     * Cambia el valor del select 
     * segun la seleccion en la encuiesta
     * 
     *******************************************/
    $("#Arbol1").change(function () {
        var archi = $("#ingreso").serialize();
        var id = $("#Arbol1").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select.php",
            success: function (archi) {
                $("#Arbol2").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#ListaEncuestas").DataTable();
    $("#Arbol2").change(function () {
        var id = $("#Arbol2").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select.php",
            success: function (archi) {
                $("#Arbol3").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#Arbol3").change(function () {
        var id = $("#Arbol3").val();
        if (id == 7) {
            $("#VerEncuesta").css("display", "block");
            $("#GuardarSinEncuesta").attr("disabled", true);
        } else {
            $("#VerEncuesta").css("display", "none");
            $("#GuardarSinEncuesta").attr("disabled", false);
        }
        if (id == 14 || id == 18) {
            $("#datetimepicker1").css("display", "block");
        } else {
            $("#datetimepicker1").css("display", "none");
        }
    });
    $('#datetimepicker1').datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD H:m',
        inline: true,
        sideBySide: true
    });
});