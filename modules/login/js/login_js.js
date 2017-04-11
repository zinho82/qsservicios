$(document).ready(function () {
    /******************************
     * BtnIngresar
     * Llama al verificador de datos para
     * cargar el usuario y la session
     * 
     *******************************/

    $("#BtnIngresar").click(function () {
        var archi = $("#FormLogin").serialize();
      
            $.ajax({
                type: "post",
                datatype: "json",
                data: archi,
                url: "login.php",
                success: function (archi) {
               window.open('../../cargas/view/cargas_index.php','_self');
                },
                error: function (archi) {
                    alert ("Error: Revise Usuario y Contraseña o Contacte a su administrador");
                }
            });

    });
});

