# Laboratorio de Gestión de Sesiones en PHP

Este proyecto de laboratorio proporciona ejemplos y prácticas relacionadas con la gestión de sesiones en PHP, incluyendo la implementación de un manejador de sesiones personalizado que almacena datos en una base de datos MySQL.

## Contenido del Proyecto

- **`db.php`**: Clase PHP para la conexión a la base de datos MySQL.
- **`user.php`**: Clase PHP que maneja operaciones relacionadas con usuarios.
- **`user_session.php`**: Clase PHP que maneja la sesión del usuario.
- **`vistas/`**: Carpeta que contiene las vistas HTML para la interfaz de usuario.
- **`includes/`**: Carpeta que contiene scripts adicionales, como el manejador de sesiones de base de datos.

## Configuración
1. **Creacion de base de datos**: Asegúrate de tener una base de datos MySQL disponible para ejecutar los scripts del archivo `querys.sql`

2. **Configuración de la conexion de Base de Datos**: actualiza los detalles de conexión en el archivo `db.php`.

4. **Configuración de Rutas de Sesión**: En el archivo `user_session.php`, ajusta la configuración de la ruta de sesión según tus necesidades.

5. **Uso de Sesiones Personalizadas**: Observa cómo se utiliza la clase `DatabaseSessionHandler` para personalizar el manejo de sesiones en el archivo `user_session.php`.

## Ejecución del Proyecto

1. Clona el repositorio:

   ```bash
   git clone https://github.com/DaniDuran/Laboratorio-Session-PHP.git
