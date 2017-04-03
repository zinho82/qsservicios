$(document).ready(function () {
alert("login");
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
                success: function (msg) {
                if(msg==false){
                    alert ("Error: Revise Usuario y Contraseña o Contacte a su adeministrador");
                }
                },
                error: function (msg) {
                  //  alert ("Error: Revise Usuario y Contraseña o Contacte a su adeministrador");
                }
            });

    });
});

