# TaskFlow

Aplicación web para la gestión de tareas y proyectos, desarrollada con Laravel 12 y Tailwind CSS.

## Características

- **Dashboard** con estadísticas en tiempo real (tareas pendientes, en progreso, completadas)
- **Gestión de Tareas** con CRUD completo, cambio de estado inline y papelera
- **Gestión de Categorías** para organizar las tareas
- **Sistema de Autenticación** con registro, login y logout
- **Búsqueda y Filtros** por título, descripción, estado y categoría
- **Paginación** automática en todas las listas
- **Soft Deletes** con papelera y restauración de tareas
- **Diseño Responsivo** con interfaz moderna y profesional

## Requisitos

- PHP 8.3+ con las extensiones `pdo_pgsql`, `mbstring`, `openssl`, `xml`, `ctype`, `json`, `fileinfo`, `tokenizer` y `session`
- PostgreSQL 16+
- Composer 2
- Node.js 20.19+ o 22.12+ (Vite 8)
- Opcional: Docker / Docker Compose

## Instalación

```bash
# Clonar el repositorio
git clone <url-del-repositorio>
cd taskflow

# Instalar dependencias PHP
composer install

# Instalar dependencias JS
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Configurar la base de datos en .env
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=taskflow
# DB_USERNAME=taskflow
# DB_PASSWORD=secret

# Crear la base de datos (con psql o pgAdmin)
# CREATE DATABASE taskflow OWNER taskflow;

# Ejecutar migraciones
php artisan migrate

# Sembrar datos de prueba (opcional)
php artisan db:seed

# Compilar assets
npm install
npm run dev

# Iniciar servidor
php artisan serve
```

### Entorno local sin Docker

En esta máquina el proyecto usa una instancia portable de PostgreSQL en el
puerto `5433` y una extensión `pdo_pgsql` instalada en el perfil del usuario.
El script `scripts/dev` encapsula ambas cosas:

```bash
scripts/dev db:start     # inicia PostgreSQL local
scripts/dev fresh        # migra desde cero y siembra datos
scripts/dev serve        # http://127.0.0.1:8000
scripts/dev test         # suite de tests (SQLite en memoria)
scripts/dev artisan ...  # cualquier comando artisan
```

Si prefieres usar PostgreSQL del sistema, instala `postgresql-server` y
`php-pgsql`, ajusta `.env` y usa `php artisan` directamente. El script
detecta la extensión y los binarios, y permite sobrescribir las rutas con
`PHP_PGSQL_HOME`, `PG_HOME`, `PG_DATA` y `PG_PORT`.

## Estructura del Proyecto

```
app/
├── Http/Controllers/
│   ├── AuthController.php        # Autenticación
│   ├── CategoriaController.php   # CRUD Categorías
│   ├── DashboardController.php   # Dashboard con estadísticas
│   └── TareasController.php      # CRUD Tareas + Papelera
├── Models/
│   ├── Categoria.php
│   ├── Tarea.php
│   └── User.php
resources/views/
├── auth/                         # Login y Registro
├── categorias/                   # CRUD Categorías
├── tareas/                       # CRUD Tareas + Papelera
├── layouts/                      # Layouts base
├── partials/                     # Sidebar y Navbar
└── dashboard.blade.php           # Dashboard principal
routes/
└── web.php                       # Rutas de la aplicación
```

## Usuario por Defecto

| Campo | Valor |
|-------|-------|
| Usuario | `admin` |
| Contraseña | `password` |

## Tecnologías

- **Backend:** Laravel 12, PHP 8.3+
- **Frontend:** Tailwind CSS 3, Vite 8, Material Symbols
- **Base de Datos:** PostgreSQL 16 (tests con SQLite en memoria)
- **Build Tool:** Vite 8

## Licencia

Proyecto de aprendizaje - Laravel
