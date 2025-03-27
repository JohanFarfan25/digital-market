# 🚀 Digital Market - con Laravel

Plataforma de comercio electrónico desarrollada con Laravel para gestión de productos, usuarios y pagos.

---

## 📸 Capturas de Pantalla



---

## 📥 Instalación

### 1️⃣ Clonar el repositorio

- Crea una carpeta donde alojarás el repositorio y clónalo:

```bash
git clone https://github.com/JohanFarfan25/digital-market.git
cd digital-market
```

### 2️⃣ Instalar dependencias

Ejecuta el siguiente comando en la raíz del proyecto para instalar las dependencias de Composer:

```bash
composer install
```

### 3️⃣ Configurar la base de datos ⚙️

- Crea una copia del archivo `.env_example` y renómbralo a `.env`:

```bash
cp .env_example .env
```

- Crea una base de datos en MySQL.
- Configura las credenciales en el archivo `.env`:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_la_base_de_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

### 4️⃣ Generar la clave de la aplicación

Ejecuta el siguiente comando en la terminal desde la raíz del proyecto:

```bash
php artisan key:generate
```

Esto generará una clave segura y la agregará automáticamente al archivo `.env`.

---

## ☁️ Configuración de Servicios Externos

### 🔹 **Cloudinary** (Para almacenamiento de imágenes)

Debes crear una cuenta en **Cloudinary** y agregar las credenciales en el archivo `.env`:

```ini
CLOUDINARY_CLOUD_NAME=
CLOUDINARY_API_KEY=
CLOUDINARY_API_SECRET=
CLOUDINARY_URL=
```

---

## 👤 Creación de Usuario SuperAdmin 👑

Configura el usuario administrador en el archivo `.env`:

```ini
ADMIN_DEFAULT="Nombre del Admin"
EMAIL_ADMIN_DEFAULT="admin@example.com"
PASSWORD_ADMIN_DEFAULT="contraseña-segura"
PHONE_ADMIN_DEFAULT="1234567890"
LOCATION_ADMIN_DEFAULT="Oficina Principal"
ABOUT_ME_ADMIN_DEFAULT="Información sobre el administrador"
ROLE_SUPER_ADMIN="Super Admin"
PHONE_CORPORATE="Número Corporativo para comunicación por WhatsApp"
```

---

## ⚡ Ejecución del Proyecto 

### 1️⃣ Ejecutar las migraciones 

```bash
php artisan migrate
```

### 2️⃣ Iniciar el servidor

```bash
php artisan serve
```

El proyecto estará disponible en `http://127.0.0.1:8000`.

---

## 🔧 Requisitos del Sistema

- **Composer** `^2.6.5`
- **PHP** `^8.3.16`

---


## ✉️ Contacto
- **Autor:** Johan Alexander Farfán 
- **Email:** johanfarfan25@gmail.com

## 📂 Estructura

```
.
├── app
│   ├── Console
│   ├── Exceptions
│   ├── Http
│   │   ├── Controllers
│   │   └── Middleware
│   ├── Models
│   ├── Providers
│   └── Traits
├── config
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
├── public
│   └── assets
│       ├── css
│       ├── img
│       └── js
├── resources
│   ├── css
│   ├── js
│   └── views
│       ├── box
│       ├── layouts
│       ├── permissions
│       ├── products
│       ├── roles
│       ├── session
│       ├── transactions
│       └── users
├── routes
└── tests
    ├── Feature
    └── Unit
```
