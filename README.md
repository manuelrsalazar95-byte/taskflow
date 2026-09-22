# TaskFlow

Aplicación web para la gestión de tareas y proyectos, desarrollada con Laravel 10 y Tailwind CSS.

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

- PHP 8.1+
- PostgreSQL
- Composer
- Node.js (para assets con Vite)

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

# Configurar base de datos en .env
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=wa_laravel
# DB_USERNAME=postgres
# DB_PASSWORD=root

# Ejecutar migraciones
php artisan migrate

# Sembrar datos de prueba (opcional)
php artisan db:seed

# Compilar assets
npm run dev

# Iniciar servidor
php artisan serve
```

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

- **Backend:** Laravel 10, PHP 8.1
- **Frontend:** Tailwind CSS, Material Symbols
- **Base de Datos:** PostgreSQL
- **Build Tool:** Vite

## Licencia

Proyecto de aprendizaje - Laravel
