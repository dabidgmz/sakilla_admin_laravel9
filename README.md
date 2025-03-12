# CRUD Completo con Laravel 9, MySQL Workbench y AdminLTE v3.2.0

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

## Descripción del Proyecto

En esta práctica, desarrollamos un CRUD completo utilizando **Laravel 9** como framework backend, **MySQL Workbench** para la gestión de la base de datos Sakila, y **AdminLTE v3.2.0** para la interfaz de usuario.

<p align="center">
  <img src="https://user-images.githubusercontent.com/your-image.png" width="700" alt="Vista previa del proyecto">
</p>

## Tecnologías Utilizadas

- 🛠 **Laravel 9** - Framework PHP para desarrollo web.
- 🗄 **MySQL Workbench** - Herramienta de administración de bases de datos.
- 🎨 **AdminLTE v3.2.0** - Plantilla de administración basada en Bootstrap.

## Características Implementadas ✅

- **Autenticación de Usuarios** con el sistema de autenticación de Laravel.
- **CRUD Completo** para la base de datos Sakila:
  - Creación, lectura, actualización y eliminación de registros.
- **Validaciones de Datos** con reglas de validación de Laravel.
- **Relaciones entre Modelos** utilizando Eloquent ORM.
- **Vistas Dinámicas** con Blade y AdminLTE.
- **Migraciones y Seeders** para la creación y poblamiento de la base de datos.

## Instalación y Configuración 🚀

### Requisitos Previos 📋

- PHP 8.0+
- Composer
- MySQL
- Node.js y NPM (para compilar assets con Vite)

### Pasos de Instalación 🛠

1. **Clonar el repositorio:**
   ```sh
   git clone https://github.com/tu_usuario/tu_repositorio.git
   cd tu_repositorio
   ```
2. **Instalar dependencias de Laravel:**
   ```sh
   composer install
   ```
3. **Configurar el archivo `.env`**
   ```sh
   cp .env.example .env
   ```
   - Configurar la conexión a la base de datos en el archivo `.env`.
4. **Generar la clave de la aplicación:**
   ```sh
   php artisan key:generate
   ```
5. **Ejecutar migraciones y seeders:**
   ```sh
   php artisan migrate --seed
   ```
6. **Instalar dependencias de frontend:**
   ```sh
   npm install && npm run dev
   ```
7. **Iniciar el servidor:**
   ```sh
   php artisan serve
   ```


## Contribuyentes 👥

Agradecemos a los siguientes desarrolladores por su participación en este proyecto:

- **[@dabidgmz](https://github.com/dabidgmz) - David Herrera** 🏗
- **[@JVRC22](https://github.com/JVRC22) - Javier Resendiz** 🔧
- **[@JoseLCS2003](https://github.com/JoseLCS2003) - Jose 2003** 📌
- **[@JulieValdes](https://github.com/JulieValdes) - Julie Valdes** 🎨

## Licencia 📄

Este proyecto está bajo la licencia [MIT](https://opensource.org/licenses/MIT).
