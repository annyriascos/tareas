<?php
// Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos los datos del formulario
    $nombre = $_POST['nombre'] ?? 'No proporcionado';
    $apellido = $_POST['apellido'] ?? 'No proporcionado';
    $documento = $_POST['documento'] ?? 'No seleccionado';
    $num_documento = $_POST['num_documento'] ?? 'No proporcionado';
    $texto_adicional = $_POST['texto_adicional'] ?? 'No proporcionado';
    $sentimiento = $_POST['sentimiento'] ?? 'No respondido';
} else {
    // Si no se ha enviado el formulario, redirigimos al formulario
    header('Location: formulario.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Procesados</title>
</head>
<body>

    <h2>Datos Procesados</h2>

    <p>Bienvenido, <?php echo htmlspecialchars($nombre) . " " . htmlspecialchars($apellido); ?>.</p>
    <p>Tipo de Documento: <?php echo htmlspecialchars($documento); ?></p>
    <p>Número de Documento: <?php echo htmlspecialchars($num_documento); ?></p>
    <p>Texto Adicional: <?php echo htmlspecialchars($texto_adicional); ?></p>
    <p>¿Cómo te sientes hoy?: <?php echo htmlspecialchars($sentimiento); ?></p>

</body>
</html>
