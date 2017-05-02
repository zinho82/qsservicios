<?php require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="UTF-8"> 

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>..:AdminSystemQS:..</title>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script src="https://use.fontawesome.com/f228cd14da.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
        <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
        <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.0.4/js/bootstrap-transition.js"></script>
        <script src=" https://netdna.bootstrapcdn.com/twitter-bootstrap/2.0.4/js/bootstrap-collapse.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo __BASE_URL__ ?>css/estilos.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
        <link href="https://blackrockdigital.github.io/startbootstrap-simple-sidebar/css/simple-sidebar.css" rel="stylesheet">
        <style>
            body{
                background-color: #000;
                background-repeat: no-repeat;
                background-position-x: 150px;
                background-position-y: 200px;
                background-size: 1170px;
                min-width: 100%;
                background-image: url('<?php echo __BASE_URL__.__MODULO_IMAGENES__ ?>logoQs.jpg');
                
            }
        </style>
    </head>
    <body style="background-color: #000;" >
        <div id="wrapper">
        <?php
        $reque = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if (( $reque !== __BASE_URL__ . __MODULO_LOGIN__ . "view/login_index.php") and ( $_SESSION['usuario']['islog'] == 1)) {
            require_once __ROOT__ . __MODULO_MENU__ . 'view/menu_index.php';
        } else {
            if (($_SERVER['revision'] == 1 ) and ( $_SESSION['usuario']['id'] == false)) {
                header("Location: " . __BASE_URL__);
            } else {
                session_destroy();
                $_SESSION['revision'] = 1;
                $_SESSION['usuario']['islog'] = 1;
            }
        }
        ?>

