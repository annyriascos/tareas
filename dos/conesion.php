<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_contacto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$tipo_documento = $_POST['tipo_documento'];
$numero_documento = $_POST['numero_documento'];
$correo = $_POST['correo'];
$mensaje = $_POST['mensaje'];

// Insertar datos en la base de datos
$sql = "INSERT INTO contactos (nombre, apellido, tipo_documento, numero_documento, correo, mensaje)
VALUES ('$nombre', '$apellido', '$tipo_documento', '$numero_documento', '$correo', '$mensaje')";

if ($conn->query($sql) === TRUE) {
  echo "Datos guardados correctamente";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
