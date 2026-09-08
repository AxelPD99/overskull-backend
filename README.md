# Overskull Backend

API REST desarrollada con Laravel para la gestión de productos y categorías.

## Tecnologías

- Laravel 13
- PHP 8.4
- MySQL 8.4
- Laravel Telescope
- L5 Swagger / OpenAPI
- Nginx
- Docker
- Docker Compose
- Composer

## Requisitos

Para ejecutar el proyecto localmente:

- PHP 8.4+
- Composer
- MySQL 8+

Para ejecutar con Docker:

- Docker
- Docker Compose

## Instalación local

Clonar el repositorio:

```bash
git clone <URL_DEL_REPOSITORIO>
cd overskull-backend
```

Instalar las dependencias:

```bash
composer install
```

Crear el archivo `.env`:

```bash
cp .env.example .env
```

En Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generar la clave de aplicación:

```bash
php artisan key:generate
```

Configurar la conexión a MySQL en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=overskull_db
DB_USERNAME=root
DB_PASSWORD=admin
```

Ejecutar las migraciones y seeders:

```bash
php artisan migrate --seed
```

Iniciar el servidor:

```bash
php artisan serve
```

La API estará disponible en:

```text
http://127.0.0.1:8000/api
```

## Ejecución con Docker

El proyecto incluye Docker para ejecutar Laravel, PHP-FPM, MySQL y Nginx.

Construir las imágenes:

```bash
docker compose build
```

Levantar los servicios:

```bash
docker compose up -d
```

Ejecutar las migraciones:

```bash
docker compose exec app php artisan migrate
```

Ejecutar los seeders:

```bash
docker compose exec app php artisan db:seed
```

La API estará disponible en:

```text
http://localhost:8000/api
```

### Servicios Docker

| Servicio | Descripción | Puerto |
|---|---|---|
| app | Laravel + PHP-FPM | 9000 interno |
| nginx | Servidor web para Laravel | 8000 |
| mysql | Base de datos MySQL | 3307 |

Dentro de Docker, Laravel se conecta a MySQL mediante:

```env
DB_HOST=mysql
DB_PORT=3306
```

El puerto `3307` corresponde al acceso a MySQL desde el equipo host.

## Documentación Swagger

La documentación de la API está disponible mediante Swagger UI:

```text
http://localhost:8000/api/docs
```

## Laravel Telescope

Laravel Telescope está instalado para inspección y monitoreo de la aplicación.

Con el proyecto ejecutándose, se puede acceder a:

```text
http://localhost:8000/telescope
```

## API

Todas las respuestas de la API utilizan una estructura JSON estandarizada.

### Respuesta exitosa

```json
{
    "success": true,
    "message": "Productos obtenidos correctamente.",
    "data": []
}
```

### Respuesta con error

```json
{
    "success": false,
    "message": "Los datos enviados no son válidos.",
    "errors": {
        "name": [
            "El nombre es obligatorio."
        ]
    }
}
```

## Endpoints

### Categorías

| Método | Endpoint | Descripción |
|---|---|---|
| GET | `/api/categories` | Listar categorías |
| POST | `/api/categories` | Crear categoría |
| GET | `/api/categories/{id}` | Obtener categoría |
| PUT/PATCH | `/api/categories/{id}` | Actualizar categoría |
| DELETE | `/api/categories/{id}` | Eliminar categoría |

### Productos

| Método | Endpoint | Descripción |
|---|---|---|
| GET | `/api/products` | Listar productos |
| POST | `/api/products` | Crear producto |
| GET | `/api/products/{id}` | Obtener producto |
| PUT/PATCH | `/api/products/{id}` | Actualizar producto |
| DELETE | `/api/products/{id}` | Eliminar producto |

## Campos de producto

Los productos utilizan los siguientes campos:

- `name`
- `description`
- `price`
- `stock`
- `category_id`

Ejemplo de creación:

```json
{
    "name": "Hoodie Overskull",
    "description": "Hoodie negro de edición limitada",
    "price": 129.90,
    "stock": 25,
    "category_id": 1
}
```

## Validaciones

La API valida los datos recibidos antes de realizar operaciones de creación o actualización.

Principales validaciones:

- Nombre obligatorio.
- Longitud máxima del nombre.
- Precio numérico y mayor a cero.
- Stock entero y mayor o igual a cero.
- Categoría existente.
- Nombre de categoría único.

Los errores de validación utilizan el código HTTP `422`.

## Manejo de errores

La API utiliza respuestas JSON estandarizadas para los errores:

- `404` - Recurso no encontrado.
- `422` - Error de validación.
- `500` - Error interno del servidor.

## Auditoría

El proyecto implementa un sistema de auditoría para registrar las operaciones realizadas sobre productos y categorías.

Se registran las siguientes operaciones:

- Creación.
- Actualización.
- Eliminación.

Los registros almacenan:

- Acción realizada.
- Modelo afectado.
- ID del modelo.
- Valores anteriores cuando corresponde.
- Nuevos valores cuando corresponde.
- Fecha y hora de la operación.

Los registros se almacenan en la tabla:

```text
activity_logs
```

La lógica de auditoría se implementa mediante un trait reutilizable.

## Base de datos

Las principales tablas utilizadas son:

```text
categories
products
activity_logs
```

Relación:

```text
Category 1 ──────── N Product
```

Cada producto pertenece a una categoría mediante `category_id`.

La eliminación de una categoría elimina sus productos relacionados mediante `cascadeOnDelete`.

## Estructura principal

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   └── Requests/
├── Models/
├── Resources/
└── Traits/

database/
├── migrations/
└── seeders/

docker/
└── nginx/

routes/
└── api.php

storage/
└── api-docs/
```

## Arquitectura

El proyecto separa responsabilidades mediante:

- **Controllers:** manejo de peticiones HTTP.
- **Form Requests:** validación de datos.
- **API Resources:** transformación de respuestas.
- **Models:** acceso y relaciones con la base de datos.
- **Traits:** lógica reutilizable de auditoría.
- **Migrations:** estructura de base de datos.
- **Seeders:** datos iniciales.

La separación de responsabilidades facilita el mantenimiento y la escalabilidad del proyecto.