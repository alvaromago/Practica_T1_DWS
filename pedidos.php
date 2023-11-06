<?php
session_start();

// Comprueba si se ha presionado el botón "Borrar historial"
if (isset($_POST['borrar_historial'])) {
    // Elimina las cookies relacionadas con el historial de pedidos, el número de pedidos y la fecha del último pedido
    setcookie('numero_pedidos', '', time() - 3600, '/');
    setcookie('fecha_ultimo_pedido', '', time() - 3600, '/');
    setcookie('historial_pedidos', '', time() - 3600, '/');
} else {
    // Procesa el pedido y actualiza el historial
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        // Obtén el número total de pedidos y la fecha del último pedido desde las cookies
        $numero_pedidos = isset($_COOKIE['numero_pedidos']) ? $_COOKIE['numero_pedidos'] : 0;
        $fecha_ultimo_pedido = isset($_COOKIE['fecha_ultimo_pedido']) ? $_COOKIE['fecha_ultimo_pedido'] : 'N/A';

        // Incrementa el número de pedidos
        $numero_pedidos++;

        // Obtiene la fecha y hora actual
        $fecha_actual = date('d-m-y H:i:s');

        // Actualiza la fecha del último pedido
        $fecha_ultimo_pedido = $fecha_actual;

        // Crea el historial de pedidos
        $historial_pedidos = [];
        if (isset($_COOKIE['historial_pedidos'])) {
            $historial_pedidos = unserialize($_COOKIE['historial_pedidos']);
        }

        // Agrega el pedido actual al historial
        $historial_pedidos[] = ['productos' => $_SESSION['carrito'], 'fecha' => $fecha_actual];

        // Almacena la información actualizada en las cookies
        setcookie('numero_pedidos', $numero_pedidos, time() + 1800, '/');
        setcookie('fecha_ultimo_pedido', $fecha_ultimo_pedido, time() + 1800, '/');
        setcookie('historial_pedidos', serialize($historial_pedidos), time() + 1800, '/');

        // Borra la sesión del carrito
        $_SESSION['carrito'] = array();
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>

<body>
    <h1>Historial de Pedidos</h1>
    <?php
    if (isset($numero_pedidos)) {
        echo 'Número total de pedidos: ' . $numero_pedidos;
        echo '<br>';
        echo 'Fecha del último pedido: ' . $fecha_ultimo_pedido;
    } ?>
    <ul>
        <?php
        if (!empty($historial_pedidos)) {
        } else {
            echo "<li>El historial está vacío.</li>";
        }
        ?>
    </ul>
    <a href="inicio.php">Volver al inicio</a>
    <form action="pedidos.php" method="post">
        <input type="submit" name="borrar_historial" value="Borrar historial">
    </form>
</body>

</html>