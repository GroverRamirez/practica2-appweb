<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte Excel de productos</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <td colspan="5"><strong>Reporte de productos</strong></td>
            </tr>
            <tr>
                <td colspan="5">Fecha de generacion: {{ $fechaGeneracion->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td colspan="5">Filtro: {{ $buscar !== '' ? $buscar : 'Sin filtro' }}</td>
            </tr>
        </table>

        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria?->nombre ?? 'Sin categoria' }}</td>
                        <td>{{ $producto->descripcion ?: 'Sin descripcion' }}</td>
                        <td>{{ number_format((float) $producto->precio, 2, '.', '') }}</td>
                        <td>{{ $producto->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
