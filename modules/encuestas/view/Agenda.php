<?php
require_once '../../config/superior.php';
$encuestas=new encuestas_class();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Mi Agenda</div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <th>Campaña</th>
                <th>Nombre</th>
                <th>Fono1</th>
                <th>Fecha y Hora Llamar</th>
                <th></th>
                </thead>
                <tbody>
<?php echo $encuestas->BuscarAgenda($_SESSION['usuario']['id']);
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require_once '../../config/footer.php';
