<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Carrito de Compras</title>
</head>

<body>
    <h1>Seleccione los artículos y cantidades:</h1>
    <form action="carrito.php" method="post">
        <label for="producto">Producto:</label>
        <select name="producto">
            <option value="Camiseta negra manga corta">Camiseta negra manga corta</option>
            <option value="Vaquero azul oscuro">Vaquero azul oscuro</option>
            <option value="Zapatillas de piel color blanca">Zapatillas de piel color blanca</option>
        </select>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" min="1" value="1">
        <input type="submit" value="Agregar al carrito">
    </form>
</body>

</html>