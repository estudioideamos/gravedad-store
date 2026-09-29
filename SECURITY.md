# Seguridad de Gravedad Store

Este repositorio aplica controles inspirados en OWASP Top 10:2025 y en las
recomendaciones oficiales de endurecimiento de WordPress. OWASP es un marco de
riesgos, no un plugin ni una certificación automática.

## Controles versionados

- validación de permisos y nonces en operaciones administrativas;
- sanitización de entradas y escape contextual de salidas;
- XML-RPC, enumeración pública de usuarios y contraseñas de aplicación cerrados;
- límite de intentos de acceso, antispam y límites para endpoints públicos;
- editor de archivos de WordPress deshabilitado;
- cabeceras HSTS, CSP, anti-framing, nosniff, referrer y permissions policy;
- secretos de producción almacenados en GitHub Actions y permisos mínimos;
- acciones externas fijadas por SHA;
- análisis de sintaxis, archivos sensibles y primitivas PHP peligrosas en cada
  cambio y una vez por semana;
- despliegue únicamente después de superar las validaciones.

## Controles operativos obligatorios

Estos puntos viven en WordPress o en el hosting y deben revisarse periódicamente:

1. WordPress, WooCommerce, plugins y PHP en versiones compatibles y soportadas.
2. Dos factores para todas las cuentas administradoras y usuarios individuales;
   no compartir una misma cuenta.
3. Backups automáticos de archivos y base de datos, con una restauración de
   prueba documentada.
4. Certificado TLS vigente, redirección HTTPS y `FORCE_SSL_ADMIN` en `wp-config.php`.
5. Plugins y temas inactivos eliminados; instalar únicamente fuentes confiables.
6. Caché de página y, si el hosting lo soporta, caché persistente de objetos.
7. Revisión de Salud del sitio, logs, pedidos anómalos y cuentas administradoras.
8. Token de cPanel limitado, rotado periódicamente y revocado al dejar de usarse.

## Reporte responsable

La rama `main` es la única versión con soporte activo.

Reportar vulnerabilidades por un canal privado de Estudio Ideamos en
`ideamos.com.ar`, incluyendo descripción, pasos de reproducción, impacto,
versión afectada y evidencia suficiente para validarlas.

No publicar credenciales, datos personales, rutas internas ni pasos explotables
en Issues. Si una credencial quedó expuesta, debe revocarse y reemplazarse de
inmediato: borrarla de un archivo no la elimina del historial de Git.
