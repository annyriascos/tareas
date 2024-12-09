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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion_factura'])) {
    $accion = $_POST['accion_factura'];
    $id_cliente = $_POST['id_cliente'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $valor_total = $_POST['valor_total'];

    // Verificar que los IDs existen
    $cliente_existente = $conn->query("SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
    $producto_existente = $conn->query("SELECT * FROM productos WHERE id_producto='$id_producto'");

    if ($cliente_existente->num_rows > 0 && $producto_existente->num_rows > 0) {
        switch ($accion) {
            case 'create':
                // Registrar factura
                $sql = "INSERT INTO facturas (id_cliente, id_producto, cantidad, valor_total) 
                        VALUES ('$id_cliente', '$id_producto', '$cantidad', '$valor_total')";
                if ($conn->query($sql) === TRUE) {
                    echo "Factura registrada exitosamente.";
                } else {
                    echo "Error al registrar factura: " . $conn->error;
                }
                break;

            case 'read':
                // Buscar factura
                $sql = "SELECT * FROM facturas WHERE id_cliente = '$id_cliente' AND id_producto = '$id_producto'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "ID: " . $row["id_factura"] . " - Cliente: " . $row["id_cliente"] . " - Producto: " . $row["id_producto"] . " - Cantidad: " . $row["cantidad"] . " - Valor Total: " . $row["valor_total"] . "<br>";
                    }
                } else {
                    echo "No se encontraron facturas.";
                }
                break;

            case 'update':
                // Actualizar factura
                $sql = "UPDATE facturas SET cantidad='$cantidad', valor_total='$valor_total' WHERE id_cliente='$id_cliente' AND id_producto='$id_producto'";
                if ($conn->query($sql) === TRUE) {
                    echo "Factura actualizada exitosamente.";
                } else {
                    echo "Error al actualizar factura: " . $conn->error;
                }
                break;

            case 'delete':
                // Eliminar factura
                $sql = "DELETE FROM facturas WHERE id_cliente='$id_cliente' AND id_producto='$id_producto'";
                if ($conn->query($sql) === TRUE) {
                    echo "Factura eliminada exitosamente.";
                } else {
                    echo "Error al eliminar factura: " . $conn->error;
                }
                break;

            default:
                echo "Acción no reconocida.";
                break;
        }
    } else {
        echo "El ID del cliente o el ID del producto no existen.";
    }
}

$conn->close();
?>
