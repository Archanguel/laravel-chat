# 💬 Proyecto Chat App (Laravel + Livewire + Pusher)

Aplicación de chat en tiempo real desarrollada con **Laravel**, **Livewire** y **Pusher**, pensada para demostrar manejo de backend, frontend y comunicación en tiempo real dentro del ecosistema Laravel.

---

## 🚀 Tecnologías principales

- **Laravel 11** — Framework backend principal.
- **Livewire** — Renderizado reactivo sin necesidad de JavaScript adicional.
- **Pusher** — Comunicación en tiempo real para el envío y recepción instantánea de mensajes.
- **Blade** — Motor de plantillas utilizado para la vista principal del chat.
- **SQLite / MySQL** — Base de datos (configurable).
- **Tailwind CSS** — Estilos visuales limpios y modernos.

---

## 🧠 Funcionalidades principales

✅ **Sistema de usuarios**
- Registro y login (autenticación nativa de Laravel).  
- Cada usuario tiene su nombre, email y contraseña encriptada.

✅ **Salas de chat**
- Lista de salas con color identificador.  
- Cambio dinámico de sala sin recargar la página.

✅ **Mensajería en tiempo real**
- Envío de mensajes instantáneo gracias a **Pusher**.  
- Visualización inmediata para todos los usuarios conectados.  
- Contador de caracteres con límite configurable.

✅ **Edición y eliminación de mensajes**
- Solo el autor del mensaje puede editarlo o eliminarlo.  
- Los mensajes editados muestran el texto *“editado”* al estilo WhatsApp.

✅ **Interfaz dinámica**
- Actualización automática de mensajes y usuarios con Livewire.  
- Scroll automático hacia el último mensaje.  
- Diseño responsivo y simple.

---

## ⚙️ Instalación y ejecución

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/Archanguel/laravel-chat.git
   cd laravel-chat

2. Instalar dependencias:
    composer install
    npm install && npm run dev

3. Configurar entorno:
    cp .env.example .env
    php artisan key:generate
    Luego editar el .env con los datos de tu base de datos y tus claves de Pusher.

4. Ejecutar migraciones y seeders:
    php artisan migrate:fresh --seed

5. Iniciar el servidor:
    php artisan serve

6. Acceder a la aplicación en:
    http://localhost:8000

---

## 🧩 Próximas mejoras
Mostrar usuarios conectados en tiempo real dentro de cada sala.
Autenticación visual combinada (Login/Register en una sola vista).
Mejoras de diseño visual con Tailwind.
Deploy en servidor remoto (Render / Railway / Laravel Forge).

---

## 👨‍💻 Autor
Alberto Bossio
Desarrollador web con experiencia en React.js, Redux, JavaScript, TypeScript, HTML5 / CSS3, Hooks, Custom Hooks, Context API, APIs REST / JSON, Uso de Vite / Webpack, Git.
Sin experiencia previa en las tecnologías utilizadas para este proyecto y con solo 1 semana de desarrollo para el mismo.
