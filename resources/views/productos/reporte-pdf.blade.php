<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte de productos</title>
        <style>
            body { font-family: DejaVu Sans, sans-serif; color: #1f2937; font-size: 11px; }
            h1 { margin-bottom: 4px; font-size: 20px; }
            p { margin: 0 0 8px; }
            table { width: 100%; border-collapse: collapse; margin-top: 18px; }
            th, td { border: 1px solid #cbd5e1; padding: 7px; text-align: left; }
            th { background: #e2e8f0; text-transform: uppercase; font-size: 10px; }
        </style>
    </head>
    <body>
        <h1>Reporte de productos</h1>
        <p>Fecha de generacion: {{ $fechaGeneracion->format('d/m/Y H:i') }}</p>

        <table>
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
                        <td>${{ number_format((float) $producto->precio, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
