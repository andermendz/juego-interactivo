# Trivia

[Demostración](https://laravel-production-45d7.up.railway.app/)

¡Bienvenido a Trivia! Un emocionante juego de cultura general desarrollado con Laravel y PostgreSQL, diseñado para poner a prueba tus conocimientos en diversas áreas del saber de manera divertida e interactiva.

## Características Principales

- **Sistema de Usuarios**: Inicio de sesión personalizado para guardar tu progreso
- **Preguntas Dinámicas**: 5 preguntas aleatorias en cada partida
- **Sistema de Puntuación**: 
  - 10 puntos por respuesta correcta
  - Seguimiento de respuestas acertadas
  - Tabla de clasificación global
- **Tiempo Limitado**: 30 segundos por pregunta para mantener la emoción
- **Interfaz Moderna**: 
  - Diseño responsive para todos los dispositivos
  - Modo claro/oscuro
  - Animaciones fluidas
- **Seguridad**: Protección CSRF y validación de datos

## Requisitos Técnicos

- PHP 8.1 o superior
- Composer (Gestor de dependencias de PHP)
- PostgreSQL 13 o superior
- Node.js 16+ y NPM
- Navegador web moderno

## Guía de Instalación

### 1. Preparación del Entorno
```bash
# Clonar el repositorio
git clone <url-del-repositorio>
cd juego-interactivo

# Instalar dependencias
composer install
npm install
```

### 2. Configuración del Entorno
```bash
# Crear y configurar archivo de entorno
cp .env.example .env
php artisan key:generate

# Configurar la base de datos en .env:
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=trivia_game
DB_USERNAME=postgres
DB_PASSWORD=tu_contraseña
```

### 3. Preparación de la Base de Datos
```bash
# Crear la base de datos
psql -U postgres
CREATE DATABASE trivia_game;
\q

# Ejecutar migraciones y seeders
php artisan migrate:fresh --seed
```

### 4. Compilación y Ejecución
```bash
# Compilar assets
npm run dev

# Iniciar servidor de desarrollo
php artisan serve
```

## Cómo Jugar

1. **Inicio**: Ingresa tu nombre de usuario para comenzar
2. **Partida**: 
   - Responde 5 preguntas aleatorias
   - Tienes 30 segundos por pregunta
   - Recibe retroalimentación instantánea
3. **Puntuación**: 
   - +10 puntos por respuesta correcta
   - Ver tu posición en la tabla de clasificación
4. **Finalización**: 
   - Revisa tu puntuación final
   - Opción para reiniciar el juego

## Estructura de la Base de Datos

### Tabla de Preguntas (questions)
| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | Identificador único |
| question | text | Texto de la pregunta |
| option_a | varchar | Primera opción |
| option_b | varchar | Segunda opción |
| option_c | varchar | Tercera opción |
| option_d | varchar | Cuarta opción |
| correct_answer | char | Respuesta correcta (A,B,C,D) |

### Tabla de Puntuaciones (scores)
| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | Identificador único |
| player_name | varchar | Nombre del jugador |
| score | integer | Puntuación total |
| questions_answered | integer | Preguntas respondidas |
| correct_answers | integer | Respuestas correctas |

## Solución de Problemas Comunes

### Error de Conexión a Base de Datos
1. Verificar que PostgreSQL esté en ejecución:
   ```bash
   sudo service postgresql status
   ```
2. Comprobar credenciales en `.env`
3. Verificar permisos de usuario de PostgreSQL

### Errores de Compilación
1. Limpiar caché:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   npm cache clean --force
   ```
2. Reinstalar dependencias:
   ```bash
   rm -rf node_modules
   npm install
   ```

## Contribuciones

¡Las contribuciones son bienvenidas! Si deseas mejorar el juego:

1. Haz fork del repositorio
2. Crea una rama para tu función: `git checkout -b nueva-funcion`
3. Realiza tus cambios y haz commit: `git commit -m 'Agrega nueva función'`
4. Envía un pull request

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## Contacto

Para preguntas o sugerencias, por favor abre un issue en el repositorio.
