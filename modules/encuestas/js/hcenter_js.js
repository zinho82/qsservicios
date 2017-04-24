/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $("#VerEncuesta").css("display", "none");
    $("#datetimepicker1").css("display", "none");
    $("#ListaEncuestas").DataTable();
    /*******************************************
     * Preg_axxx
     * busca las causas y areas en los valores 
     * seleccionadpos
     * 
     *******************************************/
    $("#preg2_a1").change(function () {
        var archi = $("#ingreso").serialize();
        var id = $("#preg2_a1").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg2_c1").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#preg2_a2").change(function () {
        var archi = $("#ingreso").serialize();
        var id = $("#preg2_a2").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg2_c2").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#preg2_a3").change(function () {
        var archi = $("#ingreso").serialize();
        var id = $("#preg2_a3").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select_enchcemp.php",
            success: function (archi) {
                $("#preg2_c3").html(archi);

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
            url: "GuardaEnc.php",
            success: function (archi) {
               alert(archi);

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
            url: "GuardaEnc.php",
            success: function (archi) {
              alert(archi);

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
    $("#Arbol2").change(function () {
        var archi = $("#ingreso").serialize();
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