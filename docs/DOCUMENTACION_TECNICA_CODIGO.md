# Documentacion Tecnica del Codigo

## Proposito
Este documento explica el proyecto `practica2-appweb` a nivel de codigo fuente. No intenta describir cada linea literal del repositorio, sino los bloques de lineas que concentran la logica importante para que un estudiante pueda seguir el flujo completo del sistema.

## Como leer esta documentacion
La recomendacion es revisar el proyecto en este orden:

1. `routes/web.php`
2. controladores
3. modelos
4. requests de validacion
5. migraciones
6. seeders
7. vistas
8. pruebas

## 1. Flujo general de la aplicacion

### Archivo: `routes/web.php`

- Linea 9:
  Define la ruta publica principal del sistema. Cuando el usuario entra a `/`, Laravel muestra la vista `welcome`.

- Lineas 11-22:
  Agrupan todas las rutas privadas bajo el middleware `auth`. Esto significa que dashboard, categorias, productos y perfil solo se pueden usar con sesion iniciada.

- Linea 12:
  Conecta `/dashboard` con `DashboardController@index`.

- Lineas 13-15:
  Registran las rutas del modulo categorias, incluyendo PDF, Excel y CRUD resource.

- Lineas 16-18:
  Registran las rutas del modulo productos, incluyendo PDF, Excel y CRUD resource.

- Lineas 19-21:
  Mantienen el modulo de perfil del usuario autenticado.

- Linea 24:
  Importa las rutas de autenticacion generadas por Breeze.

## 2. Dashboard

### Archivo: `app/Http/Controllers/DashboardController.php`

- Lineas 11-31:
  Metodo `index()`. Es la entrada principal del dashboard.

- Linea 13:
  Cuenta el total de categorias con `Categoria::count()`.

- Linea 14:
  Cuenta el total de productos con `Producto::count()`.

- Lineas 15-17:
  Calculan la valuacion del inventario sumando `precio * stock` de todos los productos.

- Linea 18:
  Cuenta cuantos productos tienen stock menor o igual a 5.

- Lineas 19-22:
  Recuperan los ultimos 5 productos y cargan su categoria asociada.

- Lineas 24-30:
  Envia todas las metricas a la vista `dashboard`.

### Archivo: `resources/views/dashboard.blade.php`

- Lineas 3-15:
  Definen el titulo, subtitulo y botones de acceso rapido del dashboard.

- Lineas 18-47:
  Renderizan el bloque principal del panel con resumen visual de categorias y productos.

- Lineas 49-101:
  Muestran las tarjetas de metricas principales: categorias, productos, valuacion y stock bajo.

- Lineas 103-155:
  Construyen la tabla de ultimos productos agregados.

- Lineas 159-177:
  Presentan recomendaciones y accesos orientativos para el usuario.

## 3. Modulo de Categorias

### Archivo: `app/Http/Controllers/CategoriaController.php`

- Lineas 17-28:
  Metodo `index()`. Lee el parametro `buscar`, arma la consulta, cuenta productos por categoria, pagina a 7 registros y conserva filtros con `withQueryString()`.

- Lineas 30-33:
  Metodo `create()`. Solo devuelve el formulario de alta.

- Lineas 35-45:
  Metodo `store()`. Valida con `StoreCategoriaRequest`, crea la categoria y fija el estado inicial en `activo`.

- Lineas 47-50:
  Metodo `edit()`. Carga una categoria existente y la envia al formulario de edicion.

- Lineas 52-59:
  Metodo `update()`. Aplica los datos validados a la categoria seleccionada.

- Lineas 61-76:
  Metodo `destroy()`. Antes de borrar la categoria, carga sus productos y elimina las imagenes asociadas que existan en disco.

- Lineas 78-89:
  Metodo `reportePdf()`. Genera un PDF vertical con todas las categorias y la fecha de generacion.

- Lineas 91-105:
  Metodo `reporteExcel()`. Genera una descarga `.xls` compatible con Excel. Respeta el filtro `buscar`.

- Lineas 107-117:
  Metodo privado `categoriasQuery()`. Centraliza la logica del filtro por nombre, descripcion y estado. Esto evita duplicar consultas entre `index()` y `reporteExcel()`.

### Archivo: `app/Models/Categoria.php`

- Linea 13:
  `fillable` define los campos permitidos para asignacion masiva.

- Lineas 15-18:
  Relacion `productos()`. Indica que una categoria tiene muchos productos.

### Archivo: `app/Http/Requests/StoreCategoriaRequest.php`

- Lineas 9-12:
  Autorizan la solicitud.

- Lineas 14-19:
  Reglas para crear categoria: nombre obligatorio y descripcion obligatoria.

### Archivo: `app/Http/Requests/UpdateCategoriaRequest.php`

- Lineas 14-20:
  Reglas para actualizar categoria. Ademas del nombre y descripcion, valida que el estado solo sea `activo` o `inactivo`.

### Archivo: `resources/views/categorias/index.blade.php`

- Lineas 6-18:
  Botones superiores del modulo: exportar Excel, exportar PDF y crear nueva categoria.

- Linea 23:
  Inserta el componente reutilizable de busqueda.

- Lineas 25-29:
  Muestran el filtro activo si el usuario esta buscando.

- Lineas 31-35:
  Estado vacio cuando no hay registros.

- Lineas 37-72:
  Tabla principal del modulo.

- Lineas 49-69:
  Recorren cada categoria y muestran nombre, descripcion, estado, cantidad de productos y acciones.

- Lineas 60-66:
  Formulario de eliminacion protegido con `POST + DELETE`.

- Lineas 75-76:
  Renderizan la paginacion.

### Archivo: `resources/views/categorias/_form.blade.php`

- Lineas 1-5:
  Preparan el token CSRF y el metodo `PUT` cuando el formulario esta en modo edicion.

- Lineas 8-14:
  Campo `nombre`.

- Lineas 16-30:
  Campo `estado`. En creacion se muestra como fijo en `Activo`; en edicion se habilita el selector.

- Lineas 32-38:
  Campo `descripcion`.

- Lineas 40-45:
  Botones de guardar y cancelar.

## 4. Modulo de Productos

### Archivo: `app/Http/Controllers/ProductoController.php`

- Lineas 18-28:
  Metodo `index()`. Filtra por nombre, descripcion o categoria, pagina resultados y conserva la query string.

- Lineas 30-35:
  Metodo `create()`. Carga las categorias para el selector del formulario.

- Lineas 37-50:
  Metodo `store()`. Valida, guarda imagen en `storage/app/public/productos` si existe y luego crea el producto.

- Lineas 52-57:
  Metodo `edit()`. Carga el producto y todas las categorias para editar.

- Lineas 59-76:
  Metodo `update()`. Si llega una nueva imagen, elimina la anterior y guarda la nueva antes de actualizar el registro.

- Lineas 78-89:
  Metodo `destroy()`. Elimina la imagen del disco y luego el producto en base de datos.

- Lineas 91-102:
  Metodo `reportePdf()`. Exporta productos en PDF horizontal.

- Lineas 104-117:
  Metodo `reporteExcel()`. Exporta productos en `.xls`, tambien respetando el filtro actual.

- Lineas 119-132:
  Metodo privado `productosQuery()`. Reutiliza la logica de busqueda entre `index()` y `reporteExcel()`.

### Archivo: `app/Models/Producto.php`

- Lineas 13-20:
  Campos que pueden ser asignados masivamente.

- Lineas 22-27:
  `casts()` formatea `precio` como decimal de dos cifras.

- Lineas 29-32:
  Relacion `categoria()`. Todo producto pertenece a una categoria.

- Lineas 34-43:
  Accesor `getImagenUrlAttribute()`. Si existe imagen local, devuelve la URL de `storage`. Si no existe, devuelve una imagen generada por `ui-avatars`.

### Archivo: `app/Http/Requests/StoreProductoRequest.php`

- Lineas 14-23:
  Reglas de creacion de productos: nombre, precio, stock, categoria obligatoria e imagen opcional con validacion de tipo y tamano.

### Archivo: `app/Http/Requests/UpdateProductoRequest.php`

- Lineas 14-23:
  Usa practicamente las mismas reglas que la creacion, pero orientadas a actualizacion.

### Archivo: `resources/views/productos/index.blade.php`

- Lineas 6-18:
  Botones de exportacion y alta de producto.

- Linea 23:
  Inserta el componente de busqueda del modulo.

- Lineas 31-35:
  Estado vacio del listado.

- Lineas 37-86:
  Tabla de productos.

- Lineas 49-83:
  Recorrido de productos mostrando imagen, nombre, categoria, precio, stock y acciones.

- Lineas 63-67:
  Si el stock es menor o igual a 5, se marca como `Bajo`.

- Lineas 74-80:
  Formulario de eliminacion del producto.

- Lineas 89-90:
  Paginacion del listado.

### Archivo: `resources/views/productos/_form.blade.php`

- Lineas 8-14:
  Campo `nombre`.

- Lineas 16-29:
  Selector `categoria_id`.

- Lineas 31-45:
  Campos numericos `precio` y `stock`.

- Lineas 47-53:
  Campo `descripcion`.

- Lineas 55-62:
  Campo `imagen` con formatos permitidos.

- Lineas 64-74:
  Vista previa de imagen cuando el formulario esta en modo edicion.

- Lineas 76-81:
  Botones de guardar y cancelar.

## 5. Migraciones

### Archivo: `database/migrations/2026_04_14_105552_create_categorias_table.php`

- Lineas 14-20:
  Crean la tabla `categorias` con `nombre`, `descripcion`, `estado` y timestamps.

### Archivo: `database/migrations/2026_04_14_120000_create_productos_table.php`

- Lineas 11-19:
  Crean la tabla `productos` con nombre, descripcion, precio, stock y `categoria_id` con borrado en cascada.

### Archivo: `database/migrations/2026_04_14_120100_alter_categorias_and_productos_tables.php`

- Lineas 11-18:
  Ajustan el esquema para permitir descripcion nullable y precio decimal `10,2`.

- Lineas 21-30:
  Definen como revertir esos cambios.

### Archivo: `database/migrations/2026_04_14_120200_add_imagen_to_productos_table.php`

- Lineas 11-13:
  Agregan la columna `imagen` a la tabla `productos`.

## 6. Seeder de datos demo

### Archivo: `database/seeders/DatabaseSeeder.php`

- Lineas 14-19:
  Crean o actualizan el usuario demo del sistema.

- Lineas 21-67:
  Definen un dataset manual de categorias y productos para laboratorio.

- Lineas 69-84:
  Recorren el dataset, crean o actualizan categorias y luego crean o actualizan productos asociados.

Este archivo es importante porque permite poblar rapidamente el sistema para pruebas, exposiciones y evaluacion.

## 7. Pruebas

### Archivo: `tests/Feature/CategoriaModuleTest.php`

- Lineas 14-38:
  Verifican busqueda de categorias.

- Lineas 40-60:
  Verifican paginacion.

- Lineas 62-78:
  Verifican reporte PDF.

- Lineas 80-96:
  Verifican reporte Excel.

### Archivo: `tests/Feature/ProductoModuleTest.php`

- Lineas 15-39:
  Verifican busqueda de productos.

- Lineas 41-63:
  Verifican paginacion.

- Lineas 65-82:
  Verifican reporte PDF.

- Lineas 84-101:
  Verifican reporte Excel.

## 8. Ideas clave para explicar en clase

- Las rutas conectan URL con controladores.
- Los controladores contienen la logica del caso de uso.
- Los modelos representan tablas y relaciones.
- Los requests separan las validaciones del controlador.
- Las migraciones construyen y evolucionan el esquema.
- Las vistas renderizan la salida final al usuario.
- Las pruebas validan que el sistema siga funcionando despues de cambios.

## 9. Recomendacion para documentar mas a futuro
Si deseas ampliar esta documentacion, lo mejor es seguir el mismo patron:

1. identificar archivo
2. dividirlo en bloques de lineas
3. explicar el objetivo de cada bloque
4. relacionarlo con el flujo MVC
5. anotar que valida, que guarda, que renderiza o que exporta

Esto ayuda mas al estudiante que llenar el codigo fuente de comentarios triviales.
