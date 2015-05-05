<?php

/* V 0.85 */

$_TOKEN = '123'; // Password para ejecutar el script

$_id_employee = 1; // ID del empleado (1=admin), OBLIGATORIO
$_NEW_email = ''; // Nuevo correo electrónico para el usuario, OPCIONAL
$_NEW_passwd = ''; // Nuevo password para el empleado, OBLIGATORIO

/*
 * 
 */
$_id_employee = (int) $_id_employee;
if ($_id_employee < 1) {
    echo 'ID del empleado tiene que ser mayor que 0';
    exit();
}
if (!$_NEW_passwd) {
    echo 'Password del empleado requerido';
    exit();
}
if (strlen($_NEW_passwd) < 8) {
    echo 'El password tiene que ser de 8 carácteres como mínimo';
    exit();
}

if (!is_file('config/settings.inc.php')) {
    echo 'Tienes que poner el fichero en el directorio principal de la tienda';
    exit();
}

if ((!$g_token = filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING))
        OR ( $g_token != $_TOKEN)) {
    if ($g_token)
        echo '<p>Error en el token de acceso</p>';
    echo '<form action="" method="GET">';
    echo '<p>Token: <input type="text" name="t" value="" /></p>';
    echo '</form>';
    exit();
}


/*
 * ***************
 */

require_once('config/settings.inc.php');

$conn = new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);

try {
    $conn = new PDO('mysql:host=' . _DB_SERVER_ . ';dbname=' . _DB_NAME_, _DB_USER_, _DB_PASSWD_);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE `' . _DB_PREFIX_ . 'employee` ';
    $sql .= 'SET `passwd` = MD5("' . _COOKIE_KEY_ . $_NEW_passwd . '") ';

    if (filter_var($_NEW_email, FILTER_VALIDATE_EMAIL))
        $sql .=', `email`= "' . $_NEW_email . '" ';

    $sql .= 'WHERE `id_employee`=' . $_id_employee;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo $stmt->rowCount() . " registros actualizados";
    echo '<br /><br />';
    $stmt->debugDumpParams();
} catch (PDOException $e) {
    echo $sql . "<br />" . $e->getMessage();
}

$conn = null;

