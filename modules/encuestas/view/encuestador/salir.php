<?PHP
session_start();

session_unset();

session_destroy();

Header("Location: acceso.php");
?>
