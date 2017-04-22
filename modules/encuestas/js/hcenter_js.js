/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $("#ListaEncuestas").DataTable();
    $("#preg2_a1").change(function () {
        var archi = $("#ingreso").serialize();
        var id=$("#preg2_a1").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data:'id='+id,
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
        var id=$("#preg2_a2").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data:'id='+id,
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
        var id=$("#preg2_a3").val();

        $.ajax({
            type: "post",
            datatype: "json",
            data:'id='+id,
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
    $("#Guardar").click(function(){
             var archi = $("#ingreso").serialize();

        $.ajax({
            type: "post",
            datatype: "json",
             data:archi,
            url: "GuardaEnc.php", 
            success: function (archi) {
                $("#preg2_c3").html(archi);

            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    
});