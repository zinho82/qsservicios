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
                success: function (archi) {
                },
                error: function () {
                    alert(" error no se puedo obtener informacion");
                }
            });

    });
});

