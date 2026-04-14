<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte Excel de categorias</title>
    </head>
    <body>
        {{-- Primera tabla: encabezado informativo del archivo exportado. --}}
        <table border="1">
            <tr>
                <td colspan="4"><strong>Reporte de categorias</strong></td>
            </tr>
            <tr>
                <td colspan="4">Fecha de generacion: {{ $fechaGeneracion->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td colspan="4">Filtro: {{ $buscar !== '' ? $buscar : 'Sin filtro' }}</td>
            </tr>
        </table>

        {{-- Segunda tabla: detalle de registros que Excel interpreta como hoja tabular. --}}
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion ?: 'Sin descripcion' }}</td>
                        <td>{{ ucfirst($categoria->estado) }}</td>
                        <td>{{ $categoria->productos_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
