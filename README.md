# Gravedad Store

Tema a medida de WordPress + WooCommerce para [Gravedad Store](https://gravedad.com.ar/), orientado a TCG, cartas sueltas, juegos de mesa, accesorios, preventas y eventos.

[![Calidad](https://github.com/estudioideamos/gravedad-store/actions/workflows/quality.yml/badge.svg)](https://github.com/estudioideamos/gravedad-store/actions/workflows/quality.yml)
[![Producción](https://github.com/estudioideamos/gravedad-store/actions/workflows/deploy-wordpress-theme.yml/badge.svg)](https://github.com/estudioideamos/gravedad-store/actions/workflows/deploy-wordpress-theme.yml)

## Requisitos

- WordPress 6.4 o superior.
- PHP 8.0 o superior.
- WooCommerce activo.
- Rama de producción: `main`.
- Versión actual: declarada en `wordpress-theme/style.css` y `GRAVEDAD_VERSION`.

## Contenido

```text
wordpress-theme/                  Tema activo de la tienda
├── assets/                       CSS, JavaScript e imágenes propias
├── inc/                          Paneles, SEO, seguridad y automatizaciones
├── page-*.php                    Plantillas de páginas
├── functions.php                Integraciones y comportamiento del tema
└── style.css                     Metadatos y versión
plugins/gravedad-menu-lock/       Plugin auxiliar para ordenar el admin
.github/workflows/                Validación y despliegue
.cpanel.yml                       Destino de producción en cPanel
```

Las imágenes cargadas desde WordPress pertenecen a la Biblioteca de medios y no se guardan en este repositorio.

## Desarrollo seguro

1. Crear una rama desde `main`.
2. Hacer cambios dentro de `wordpress-theme/` o `plugins/`.
3. Mantener alineada la versión de `style.css` con `GRAVEDAD_VERSION`.
4. Abrir un pull request y esperar que pase **Calidad del tema**.
5. Integrar a `main` únicamente cambios revisados.

La validación automática comprueba sintaxis PHP y JavaScript, consistencia de versión, archivos obligatorios, credenciales accidentales y tamaño de activos.

## Publicación

Un cambio en `wordpress-theme/` sobre `main` ejecuta este circuito:

```text
GitHub Actions → validación → API HTTPS de cPanel → actualización Git → .cpanel.yml → tema activo
```

El secreto `CPANEL_TOKEN` se guarda exclusivamente en GitHub Actions. No debe copiarse al código, a issues ni a archivos del repositorio.

Para una publicación manual: **Actions → Publicar tema en WordPress → Run workflow**.

## Rollback

1. Identificar el último commit estable en GitHub.
2. Crear un revert del commit defectuoso; no reescribir el historial de `main`.
3. Al llegar el revert a `main`, el workflow valida y vuelve a desplegar automáticamente.

## Instalación manual

Comprimir el contenido de `wordpress-theme/` dejando `style.css` en la raíz del ZIP. En WordPress ir a **Apariencia → Temas → Añadir nuevo → Subir tema**.

## Seguridad

No se versionan credenciales, bases de datos ni copias de producción. Para reportar un problema sensible, seguir [SECURITY.md](SECURITY.md) y no abrir un issue público.

## Licencia y créditos

Código bajo GPL-2.0-or-later. Diseño y desarrollo por [Estudio Ideamos](https://ideamos.com.ar/).
