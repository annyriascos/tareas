<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drogueria"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar solicitud según la acción seleccionada
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion_producto'])) {
    $accion = $_POST['accion_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $lote_producto = $_POST['lote_producto'];
    $valor = $_POST['valor'];

    switch ($accion) {
        case 'create':
            // Registrar producto
            $sql = "INSERT INTO productos (nombre_producto, lote_producto, valor) VALUES ('$nombre_producto', '$lote_producto', '$valor')";
            if ($conn->query($sql) === TRUE) {
                echo "Producto registrado exitosamente.";
            } else {
                echo "Error al registrar producto: " . $conn->error;
            }
            break;

        case 'read':
            // Buscar producto
            $sql = "SELECT * FROM productos WHERE nombre_producto = '$nombre_producto'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "ID: " . $row["id"] . " - Nombre: " . $row["nombre_producto"] . " - Lote: " . $row["lote_producto"] . " - Valor: " . $row["valor"] . "<br>";
                }
            } else {
                echo "No se encontraron productos.";
            }
            break;

        case 'update':
            // Actualizar producto
            $sql = "UPDATE productos SET lote_producto='$lote_producto', valor='$valor' WHERE nombre_producto='$nombre_producto'";
            if ($conn->query($sql) === TRUE) {
                echo "Producto actualizado exitosamente.";
            } else {
                echo "Error al actualizar producto: " . $conn->error;
            }
            break;

        case 'delete':
            // Eliminar producto
            $sql = "DELETE FROM productos WHERE nombre_producto='$nombre_producto'";
            if ($conn->query($sql) === TRUE) {
                echo "Producto eliminado exitosamente.";
            } else {
                echo "Error al eliminar producto: " . $conn->error;
            }
            break;

        default:
            echo "Acción no reconocida.";
            break;
    }
}

$conn->close();
?>
