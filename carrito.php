<?php
session_start();

// Inicializa la sesión si no está configurada
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Agregar producto al carrito si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = $_POST['producto'];
    $cantidad = (int)$_POST['cantidad'];

    if ($cantidad > 0) {
        $_SESSION['carrito'][] = array('producto' => $producto, 'cantidad' => $cantidad);
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>

<body>
    <h1>Carrito de Compras</h1>
    <ul>
        <?php
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                echo "<p>{$item['producto']} - Cantidad: {$item['cantidad']}</p>";
            }
        } else {
            echo "<p>El carrito está vacío.</p>";
        }
        ?>
    </ul>
    <a href="inicio.php">Seguir comprando</a>
    <form action="pedidos.php" method="post">
        <input type="submit" value="Procesar pedido">
    </form>
</body>

</html>