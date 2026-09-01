# Gravedad Store

Tema premium de WordPress y WooCommerce para **Gravedad Store**, orientado a TCG, cartas sueltas, juegos de mesa, accesorios, preventas y eventos.

## Requisitos

- WordPress 6.4 o superior.
- PHP 8.0 o superior.
- WooCommerce activo.
- Rama de publicación: `main`.
- Versión actual del tema: consultar `wordpress-theme/style.css`.

## Funcionalidades

- Integración completa con WooCommerce.
- Catálogo, búsqueda y fichas de producto.
- Carrito, checkout, favoritos y cuenta.
- Páginas informativas de envíos, devoluciones, preguntas frecuentes y compra.
- Preventas, novedades, ofertas y eventos.
- Paneles de contenido y editor de menú.
- SEO y medidas de seguridad integradas.
- Galerías de producto, navegación mobile y diseño responsive.

## Estructura

```text
wordpress-theme/
├── style.css
├── functions.php
├── front-page.php
├── header.php
├── footer.php
├── archive-product.php
├── single.php
├── page-*.php
├── inc/
└── assets/
```

## Instalación manual

1. Comprimir el contenido de `wordpress-theme/` como una carpeta de tema.
2. En WordPress ir a **Apariencia → Temas → Añadir nuevo → Subir tema**.
3. Instalar, activar y comprobar que WooCommerce esté activo.
4. Configurar menús, logo, páginas y opciones del tema.

No se debe comprimir la raíz completa del repositorio: WordPress necesita encontrar `style.css` en la raíz del ZIP del tema.

## Desarrollo

Los estilos están en `assets/css/`, las interacciones en `assets/js/` y los paneles administrativos en `inc/`. Al cambiar la versión se deben mantener alineados `style.css` y `GRAVEDAD_VERSION` en `functions.php`.

## Publicación

El repositorio incluye `.cpanel.yml` y un workflow en `.github/workflows/deploy-wordpress-theme.yml`. Antes de desplegar se recomienda validar PHP, revisar el ZIP resultante y hacer una copia de seguridad del sitio.

## Seguridad

Los datos guardados se sanitizan con funciones de WordPress y las salidas deben escaparse según su contexto. No deben incluirse credenciales, claves ni copias de producción.

## Créditos

Tema diseñado y desarrollado por [Estudio Ideamos](https://ideamos.com.ar/). Licencia GPL-2.0-or-later.
