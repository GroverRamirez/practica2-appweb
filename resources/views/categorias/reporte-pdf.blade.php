<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte de categorias</title>
        <style>
            body { font-family: DejaVu Sans, sans-serif; color: #1f2937; font-size: 12px; }
            h1 { margin-bottom: 4px; font-size: 22px; }
            p { margin: 0 0 8px; }
            table { width: 100%; border-collapse: collapse; margin-top: 18px; }
            th, td { border: 1px solid #cbd5e1; padding: 8px; text-align: left; }
            th { background: #e2e8f0; text-transform: uppercase; font-size: 11px; }
        </style>
    </head>
    <body>
        {{-- Plantilla simple pensada para renderizarse con DomPDF sin depender del layout web. --}}
        <h1>Reporte de categorias</h1>
        <p>Fecha de generacion: {{ $fechaGeneracion->format('d/m/Y H:i') }}</p>

        <table>
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
