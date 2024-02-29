<?php declare(strict_types=1);

if(empty($_POST) || (!isset($_POST["dinamica"]) && !isset($_POST["leyenda"]))){
    header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
}
session_start();

// Obtener datos de usuario
$queFallo = $_POST['queFallo'];
$argumento = $_POST['leyenda'];

// Validar usuario (ejemplo simplificado, usar una base de datos en la vida real)
if ($queFallo === 'usuario' && $argumento === 'argumento') {
  // Asignar variables de sesión
  $_SESSION['nombre'] = $queFallo;
  $_SESSION['rol'] = 'usuario';

  // Registrar datos de navegación
  $_SESSION['ultimaVisita'] = time();
  $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
  $_SESSION['navegador'] = $_SERVER['HTTP_USER_AGENT'];

  // Redirigir a la página principal
  header('Location: principal.php');
  exit;
} else {
  // Mostrar mensaje de error
  echo '<p>Usuario o contraseña incorrectos.</p>';
}


$_POST[]="";