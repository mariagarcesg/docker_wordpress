# WordPress + MySQL + phpMyAdmin con Docker
## Práctica alternativa — LPR07304 Lenguajes de Programación


## ¿Qué vas a levantar?

| Servicio     | ¿Qué es?                              | URL de acceso              |
|--------------|---------------------------------------|----------------------------|
| WordPress    | El sitio web completo                 | http://localhost:8080       |
| phpMyAdmin   | Administrador visual de la base datos | http://localhost:8081       |
| MySQL        | La base de datos (sin interfaz propia)| (interna, puerto 3306)      |

---

## Paso 1 — Levantar el base (igual que todos)

Crea una carpeta, coloca el docker-compose.yml dentro y ejecuta:

```bash
docker compose up -d
```

Verifica que los 3 contenedores estén corriendo:
```bash
docker ps
```

Abre http://localhost:8080 y completa la instalación de WordPress.
Abre http://localhost:8081 y explora la base de datos.

---

## Paso 2 — Tu personalización (OBLIGATORIO)

El docker-compose.yml base es el punto de partida. Debes modificarlo y extenderlo.
No se acepta entregar el archivo sin cambios.

### 2.1 Cambia las credenciales
Reemplaza todas las contraseñas y nombres de base de datos por valores propios.
Nada de wp_password123 — usa algo con sentido para tu proyecto.

### 2.2 Agrega al menos UNA variable de entorno extra a WordPress
Ejemplos:
- `WORDPRESS_DEBUG: 1` → activa el modo debug
- `WORDPRESS_CONFIG_EXTRA: "define('WP_DEFAULT_THEME', 'twentytwentyfour');"` → tema por defecto
- Busca en la documentación oficial de la imagen wordpress en Docker Hub qué otras variables acepta

### 2.3 Agrega un CUARTO servicio (elige uno)

**Opción A — Redis (caché)**
```yaml
  redis:
    image: redis:alpine
    container_name: wordpress-redis
    restart: unless-stopped
    networks:
      - wp-network
```
Luego instala el plugin "W3 Total Cache" en WordPress y configúralo para usar Redis.

**Opción B — Adminer (alternativa a phpMyAdmin)**
```yaml
  adminer:
    image: adminer:latest
    container_name: wordpress-adminer
    restart: unless-stopped
    ports:
      - "8082:8080"
    depends_on:
      - db
    networks:
      - wp-network
```
Accede en http://localhost:8082

**Opción C — Nginx como proxy reverso**
Investiga cómo poner Nginx delante de WordPress para que el acceso sea por el puerto 80 estándar.

### 2.4 Personaliza WordPress
- Cambia el tema (no dejes el default Twenty Twenty-Four sin tocar)
- Crea al menos 2 posts con contenido real relacionado a tu área de interés
- Crea al menos 1 categoría y 1 menú de navegación

---

## Lo que debes mostrar en clase

1. `docker ps` — los 4 contenedores corriendo (incluyendo el que agregaste)
2. WordPress en el navegador con tu personalización visible
3. phpMyAdmin o Adminer mostrando las tablas de la BD
4. El docker-compose.yml modificado — explicar cada cambio que hiciste
5. Responder las preguntas de la profesora

---

## Preguntas que te puede hacer la profesora

- ¿Por qué WordPress usa `db` como host y no `localhost`?
- ¿Qué pasaría si eliminas el contenedor de MySQL sin el volumen?
- ¿Para qué sirve `depends_on`?
- ¿Cuántos volúmenes tiene tu proyecto y por qué?
- ¿Qué es la red wp-network y por qué la necesitamos?
- ¿Qué hace el cuarto servicio que agregaste y por qué lo elegiste?
- ¿Qué variable de entorno extra agregaste y qué efecto tiene?