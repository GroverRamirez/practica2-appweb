# practica2-appweb

Proyecto academico de Laravel para la gestion de categorias y productos.

## Alcance actual
- autenticacion con Breeze
- dashboard privado
- CRUD de categorias
- CRUD de productos
- imagenes en almacenamiento publico
- busqueda y paginacion
- reportes PDF
- reportes Excel
- seeders y factories
- pruebas feature

## Comandos principales

```powershell
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
composer dev
```

Pruebas:

```powershell
php artisan test
```

Build:

```powershell
npm run build
```

## Usuario demo
- correo: `grover.ramirez@gmail.com`
- clave: `12345678`

## Documentacion academica
La guia principal para estudiantes y docentes se encuentra en:

- [docs/GUIA_ACADEMICA_PRACTICA2_APPWEB.md](docs/GUIA_ACADEMICA_PRACTICA2_APPWEB.md)
- [docs/DOCUMENTACION_TECNICA_CODIGO.md](docs/DOCUMENTACION_TECNICA_CODIGO.md)

## Nota sobre Excel
El proyecto actual exporta reportes Excel en formato compatible `.xls` para evitar dependencia obligatoria de `ext-zip` en todos los entornos de laboratorio.
