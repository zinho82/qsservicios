/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $("#Campana").attr("disabled", true);
    $("#BuscarEncAsignada").attr("disabled", true);
    $("#Asignados").DataTable();
    $("#Sponsor").change(function () {
        var id = $("#Sponsor").val();
        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select.php",
            success: function (id) {
                $("#Campana").attr("disabled", false);
                $("#Campana").html(id);
            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
    $("#Ejecutivo").change(function(){
        $("CargarUsusario").attr("disabled",false);
    });
     $("#SponsorA").change(function () {
        var id = $("#SponsorA").val();
        $.ajax({
            type: "post",
            datatype: "json",
            data: 'id=' + id,
            url: "genera_select.php",
            success: function (id) {
                $("#CampanaA").attr("disabled", false);
                $("#CampanaA").html(id);
            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
      $("#CampanaA").change(function () {
     var id = $("#CampanaA").val();
     $.ajax({
     type: "post",
     datatype: "json",
     data: 'id=' + id,
     url: "Genera_Codcarga.php",
     success: function (id) {
     $("#CodCarga").attr("disabled", false);
     $("#CodCarga").html(id);
     },
     error: function () {
     alert(" error no se puedo obtener informacion");
     }
     });
     });
    $("#Campana").change(function () {
        $("#BuscarEncAsignada").attr("disabled", false);
    });
    $("#AsignarReg").click(function () {
        var datos=$("#FormAsignar").serialize();
        var vuelta=$("#Vuelta").val();
        $.ajax({
            type: "post",
            datatype: "json",
            data: datos,
            url: "AsignarRegistros.php",
            success: function (id) {
               // $("#Campana").attr("disabled", false);
               // $("#Campana").html(id);
               alert(id);
               window.open(vuelta,"_self");
            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
      $("#CargarUsusario").click(function () {
        var datos=$("#FromCampanasEje").serialize();
        $.ajax({
            type: "post",
            datatype: "json",
            data: datos,
            url: "GuardaEJCa.php",
            success: function (id) {
               // $("#Campana").attr("disabled", false);
               // $("#Campana").html(id);
               alert(id);
               location.reload();
            },
            error: function () {
                alert(" error no se puedo obtener informacion");
            }
        });
    });
   $("#Nuevo").click(function(){
       $("#TituloModal").html("Agregar Campaña a Ejecutivo");
   });
});
function add(valor) {
        var dato = valor.split("|");
        alert(dato);
       /* $("#TituloVentana").html("Asignar Registros");
        $("#EjQuita").val(dato[0]);
        $("#codCamReg").val(dato[1]);
        $("#AccionReg").val("Asignar");*/
        
        
    };

 