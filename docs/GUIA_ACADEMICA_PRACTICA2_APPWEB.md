# Guia Academica de Desarrollo

## Proyecto
`practica2-appweb` - AppWeb de gestion de categorias y productos con Laravel.

## 1. Presentacion
Esta guia academica fue preparada para apoyar a estudiantes en el desarrollo progresivo de una aplicacion web real con Laravel. El proyecto permite practicar autenticacion, panel privado, CRUD, relaciones entre tablas, carga de imagenes, reportes PDF, reportes Excel y pruebas funcionales.

La intencion de esta guia no es solo mostrar comandos. Tambien busca ordenar el trabajo por fases, explicar que se desarrolla en cada etapa, que se debe verificar y que evidencias conviene presentar en laboratorio o evaluacion.

## 2. Enfoque pedagogico
La prioridad del proyecto es la funcionalidad.

Esto significa:

- primero se debe lograr que el sistema funcione correctamente
- las vistas pueden mantenerse simples mientras la logica este bien resuelta
- no es obligatorio rehacer toda la interfaz para considerar la practica terminada
- el diseno visual puede mejorarse despues, cuando CRUD, relaciones, reportes y pruebas ya esten estables

## 3. Objetivos de aprendizaje
- crear y configurar un proyecto Laravel desde cero
- trabajar con rutas, controladores, modelos, migraciones y validaciones
- implementar autenticacion con Breeze y proteger modulos privados
- desarrollar CRUD de categorias y productos
- aplicar relaciones Eloquent entre tablas
- gestionar imagenes con almacenamiento publico
- agregar busqueda, paginacion y exportacion de reportes
- poblar la base de datos con seeders y factories
- verificar el sistema mediante pruebas feature

## 4. Resultado esperado
Al finalizar, el estudiante debe obtener una aplicacion que incluya:

- landing publica en `/`
- registro, login, recuperacion de contrasena y perfil
- dashboard privado con metricas
- CRUD de categorias
- CRUD de productos
- relacion categoria -> productos
- subida y visualizacion de imagenes
- busqueda y paginacion en ambos modulos
- reportes PDF
- reportes Excel
- datos demo
- pruebas automatizadas

## 5. Estado funcional del proyecto actual
El proyecto `practica2-appweb` ya cuenta con los siguientes modulos implementados:

- autenticacion con Breeze
- dashboard con metricas de categorias, productos, valuacion y stock bajo
- CRUD de categorias
- CRUD de productos
- reporte PDF de categorias y productos
- reporte Excel de categorias y productos
- seeders y factories
- localizacion basica en espanol
- pruebas feature

## 6. Base tecnologica del proyecto
- PHP 8.3+
- Laravel 13
- Blade
- Eloquent ORM
- Vite
- Sass
- Bootstrap 5
- SweetAlert2
- DomPDF
- PHPUnit

## 7. Requisitos previos
Antes de trabajar en el proyecto, el estudiante debe verificar:

- PHP instalado y visible en terminal
- Composer instalado
- Node.js y npm instalados
- MySQL o SQLite disponibles
- entorno local como Laragon
- editor como VS Code

Comandos sugeridos de comprobacion:

```powershell
php -v
composer -V
node -v
npm -v
```

## 8. Estructura academica recomendada
Las carpetas mas importantes del proyecto son:

- `app/Http/Controllers`
- `app/Http/Requests`
- `app/Models`
- `database/migrations`
- `database/factories`
- `database/seeders`
- `resources/views`
- `resources/js`
- `resources/scss`
- `routes`
- `tests/Feature`
- `docs`

## 9. Modulos principales

### 9.1 Dashboard
Responsable de mostrar el resumen del sistema.

Muestra:

- total de categorias
- total de productos
- valuacion del inventario
- productos con stock bajo
- ultimos productos agregados

Archivo principal:

- `app/Http/Controllers/DashboardController.php`

### 9.2 Categorias
Permite:

- listar categorias
- buscar por nombre, descripcion o estado
- crear categorias
- editar categorias
- eliminar categorias
- exportar PDF
- exportar Excel

Archivos clave:

- `app/Http/Controllers/CategoriaController.php`
- `app/Models/Categoria.php`
- `app/Http/Requests/StoreCategoriaRequest.php`
- `app/Http/Requests/UpdateCategoriaRequest.php`
- `resources/views/categorias/*`

### 9.3 Productos
Permite:

- listar productos
- buscar por nombre, descripcion o categoria
- crear productos
- editar productos
- eliminar productos
- subir imagenes
- reemplazar imagenes
- exportar PDF
- exportar Excel

Archivos clave:

- `app/Http/Controllers/ProductoController.php`
- `app/Models/Producto.php`
- `app/Http/Requests/StoreProductoRequest.php`
- `app/Http/Requests/UpdateProductoRequest.php`
- `resources/views/productos/*`

## 10. Fases sugeridas para el estudiante

### Fase 1. Preparacion del entorno
Objetivo: dejar operativo el proyecto Laravel.

Actividades:

- clonar el proyecto
- instalar dependencias PHP
- instalar dependencias frontend
- crear y ajustar `.env`
- configurar base de datos

Comandos:

```powershell
composer install
copy .env.example .env
php artisan key:generate
npm install
```

Verificacion:

- el proyecto arranca
- la clave de aplicacion existe
- la base de datos esta configurada

### Fase 2. Base de datos y datos demo
Objetivo: crear las tablas y poblar informacion inicial.

Comandos:

```powershell
php artisan migrate:fresh --seed
php artisan storage:link
```

Verificacion:

- se crean tablas de usuarios, categorias y productos
- existe enlace simbolico `public/storage`
- el usuario demo se crea correctamente

Usuario demo actual:

- correo: `grover.ramirez@gmail.com`
- clave: `12345678`

### Fase 3. Autenticacion
Objetivo: trabajar con acceso publico y privado.

Verificacion:

- `/` funciona como landing publica
- `/register` registra un usuario
- `/login` autentica correctamente
- `/dashboard` requiere sesion

### Fase 4. CRUD de categorias
Objetivo: desarrollar un modulo CRUD completo.

Competencias:

- rutas resource
- validaciones con FormRequest
- mensajes flash
- paginacion
- filtros por query string

Verificacion:

- se crea una categoria
- se edita correctamente
- se elimina
- la busqueda funciona
- el filtro se conserva entre paginas

### Fase 5. CRUD de productos
Objetivo: trabajar relaciones y archivos.

Competencias:

- `belongsTo` y `hasMany`
- `foreignId`
- validacion de imagen
- almacenamiento en disco publico
- reemplazo y borrado de imagen

Verificacion:

- el producto se registra con categoria
- la imagen se visualiza
- al actualizar imagen se reemplaza la anterior
- al eliminar producto se borra el archivo asociado

### Fase 6. Dashboard y reportes
Objetivo: ampliar valor funcional del sistema.

Competencias:

- consultas agregadas
- suma de inventario
- filtros reutilizables
- reportes PDF
- reportes Excel

Verificacion:

- el dashboard muestra datos reales
- PDF de categorias funciona
- PDF de productos funciona
- Excel de categorias funciona
- Excel de productos funciona

### Fase 7. Pruebas
Objetivo: validar el sistema.

Comando:

```powershell
php artisan test
```

Las pruebas actuales cubren:

- autenticacion
- perfil
- busqueda de categorias
- paginacion de categorias
- PDF de categorias
- Excel de categorias
- busqueda de productos
- paginacion de productos
- PDF de productos
- Excel de productos

## 11. Comandos utiles del proyecto

Instalacion:

```powershell
composer install
npm install
```

Configuracion inicial:

```powershell
copy .env.example .env
php artisan key:generate
```

Migraciones y seed:

```powershell
php artisan migrate:fresh --seed
```

Enlace de almacenamiento:

```powershell
php artisan storage:link
```

Desarrollo:

```powershell
composer dev
```

Build:

```powershell
npm run build
```

Pruebas:

```powershell
php artisan test
```

## 12. Rutas funcionales importantes

Publicas:

- `/`
- `/register`
- `/login`
- `/forgot-password`

Privadas:

- `/dashboard`
- `/categorias`
- `/productos`
- `/profile`

Reportes:

- `/categorias/reporte/pdf`
- `/categorias/reporte/excel`
- `/productos/reporte/pdf`
- `/productos/reporte/excel`

## 13. Nota academica sobre reportes Excel
El proyecto actual exporta Excel mediante una respuesta compatible con `.xls`, suficiente para uso academico y apertura en Microsoft Excel o LibreOffice.

Esto es importante porque:

- evita bloquear la practica si el entorno no tiene la extension `ext-zip`
- mantiene el foco en funcionalidad
- permite una mejora futura a `.xlsx` si el entorno esta listo

Si el docente o el estudiante desean migrar a `.xlsx` con `maatwebsite/excel`, primero deben verificar:

- que PHP tenga activa la extension `zip`
- que Composer pueda instalar el paquete sin conflicto

## 14. Criterios de evaluacion sugeridos
Se recomienda evaluar por bloques:

- instalacion y configuracion
- comprension del flujo MVC
- calidad de migraciones y modelos
- uso correcto de validaciones
- funcionamiento del CRUD de categorias
- funcionamiento del CRUD de productos
- manejo correcto de imagenes
- uso de filtros y paginacion
- generacion de reportes
- pruebas y depuracion

## 15. Evidencias sugeridas para laboratorio
- captura del `.env` configurado
- captura del login
- captura del dashboard
- captura del listado de categorias
- captura del listado de productos
- captura de una imagen subida
- captura de un PDF generado
- captura de un Excel abierto
- captura de pruebas en verde

## 16. Errores frecuentes

### Problemas de entorno
- PHP incorrecto en terminal por conflicto entre Laragon y otro entorno
- Composer no reconocido
- Node.js no instalado

### Problemas de base de datos
- credenciales incorrectas en `.env`
- no ejecutar migraciones despues de cambios de esquema

### Problemas de imagenes
- olvidar `php artisan storage:link`
- guardar archivos sin usar disco `public`

### Problemas de filtros
- no conservar `withQueryString()`
- duplicar logica de busqueda en varios metodos

### Problemas de reportes
- no proteger rutas con `auth`
- exportar datos sin respetar el filtro actual

## 17. Recomendaciones para el estudiante
- trabajar fase por fase
- no saltar directamente al frontend
- probar cada modulo antes de avanzar
- hacer commits por etapa
- leer rutas, controlador, modelo y vista como un mismo flujo
- usar las pruebas para detectar regresiones

## 18. Recomendaciones para el docente
- pedir defensa del flujo MVC, no solo mostrar pantallas
- solicitar evidencia por fase
- evaluar funcionalidad antes que apariencia
- revisar si el estudiante entiende por que usa migraciones, requests, relaciones y pruebas

## 19. Checklist final
- la landing publica funciona
- el registro y login funcionan
- el dashboard muestra informacion real
- el CRUD de categorias funciona
- el CRUD de productos funciona
- la imagen del producto se visualiza
- la busqueda funciona en categorias y productos
- la paginacion conserva filtros
- los reportes PDF funcionan
- los reportes Excel funcionan
- los seeders cargan datos demo
- las pruebas pasan en verde

## 20. Conclusiones
`practica2-appweb` es un proyecto academico adecuado para ensenar Laravel de manera aplicada porque obliga a integrar autenticacion, CRUD, relaciones, archivos, reportes y verificacion automatizada en una misma aplicacion.

La recomendacion central de esta guia es simple: primero hacer que el sistema funcione, luego mejorar su presentacion. Si el estudiante domina esa secuencia, no solo termina la practica, sino que aprende una forma mas profesional de desarrollar aplicaciones web.
