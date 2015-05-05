
¿Cómo cambiar el password de administración de prestashop? Sube este script y ¡listo!

Más información: <http://josepgarcia.com>

Instalación
------------

1 - Modificar los valores del archivo php:
```
$_TOKEN = '123'; // Password para ejecutar el script
$_id_employee = 1; // ID del empleado (1=admin), OBLIGATORIO
$_NEW_email = FALSE; // Nuevo correo electrónico para el usuario, OPCIONAL
$_NEW_passwd = '123456789'; // Nuevo password para el empleado, OBLIGATORIO
```
2 - Subir el archivo php al servidor (misma carpeta donde se encuentre la tienda).

3 - Abrir el archivo en el navegador, a través del dominio de la tienda:

http://mitienda.com/change_ps_pass.php
