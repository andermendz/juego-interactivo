# Trivia Aventura: Juego de Preguntas y Respuestas

Un emocionante juego de trivia interactivo desarrollado con Laravel y PostgreSQL.

## Requisitos del Sistema

- PHP 8.1 o superior
- Composer (Gestor de dependencias de PHP)
- PostgreSQL (Sistema de base de datos)
- Node.js y NPM (Para los assets del frontend)

## Guía de Instalación

1. Clonar el repositorio:
```bash
git clone <url-del-repositorio>
cd juego-interactivo
```

2. Instalar las dependencias de PHP:
```bash
composer install
```

3. Instalar las dependencias de Node.js:
```bash
npm install
```

4. Configurar el entorno:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en el archivo .env:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=trivia_game
DB_USERNAME=postgres
DB_PASSWORD=tu_contraseña
```

6. Crear la base de datos en PostgreSQL:
```sql
CREATE DATABASE trivia_game;
```

7. Ejecutar las migraciones y poblar la base de datos:
```bash
php artisan migrate:fresh --seed
```

8. Compilar los assets:
```bash
npm run dev
```

9. Iniciar el servidor de desarrollo:
```bash
php artisan serve
```

## Características del Juego

- **Inicio de Sesión**: Sistema simple con nombre de usuario
- **Preguntas**: 5 preguntas aleatorias por partida
- **Puntuación**: 10 puntos por cada respuesta correcta
- **Tiempo Limitado**: 30 segundos para responder cada pregunta
- **Ranking**: Tabla de mejores puntuaciones
- **Diseño**: Interfaz moderna y responsiva

## Estructura de la Base de Datos

### Tabla de Preguntas (questions)
- id (clave primaria)
- question (pregunta)
- option_a (opción A)
- option_b (opción B)
- option_c (opción C)
- option_d (opción D)
- correct_answer (respuesta correcta)
- timestamps (marcas de tiempo)

### Tabla de Puntuaciones (scores)
- id (clave primaria)
- player_name (nombre del jugador)
- score (puntuación)
- questions_answered (preguntas respondidas)
- correct_answers (respuestas correctas)
- timestamps (marcas de tiempo)

## Solución de Problemas Comunes

### Error de Conexión a PostgreSQL
1. Verificar que PostgreSQL esté instalado y en ejecución
2. Comprobar las credenciales en el archivo .env
3. Asegurarse de que la base de datos existe

### Error en la Instalación de Dependencias
1. Verificar la versión de PHP: `php -v`
2. Actualizar Composer: `composer self-update`
3. Limpiar caché: `composer clear-cache`

## Extensiones PHP Necesarias
- pdo_pgsql
- pgsql

### Instalación de Extensiones

#### Windows (XAMPP)
1. Activar `pdo_pgsql` y `pgsql` en php.ini

#### Linux (Ubuntu/Debian)
```bash
sudo apt-get install php-pgsql
```

#### macOS (Homebrew)
```bash
brew install php-pgsql
```

## Contribuir al Proyecto

1. Hacer fork del repositorio
2. Crear una rama para tu función: `git checkout -b nueva-funcion`
3. Commit de cambios: `git commit -m 'Añadir nueva función'`
4. Push a la rama: `git push origin nueva-funcion`
5. Crear Pull Request

## Soporte

Si encuentras algún problema o tienes sugerencias, por favor crea un issue en el repositorio.
