# Contribuir

## Flujo

1. Crear una rama corta desde `main`.
2. Mantener cada cambio enfocado y con un mensaje de commit descriptivo.
3. No modificar rutas de cPanel ni workflows de producción sin revisar el despliegue completo.
4. Abrir un pull request y completar la lista de verificación.
5. Integrar solamente cuando las comprobaciones estén verdes.

## Convenciones

- PHP compatible con 8.0 y APIs de WordPress/WooCommerce.
- Sanitizar entradas, validar permisos y nonces, y escapar salidas según contexto.
- JavaScript sin dependencias nuevas salvo necesidad justificada.
- Imágenes en WebP cuando corresponda; evitar activos mayores a 12 MB.
- No versionar archivos generados, backups, bases de datos ni credenciales.

## Versionado

Si un cambio afecta los archivos servidos por el tema, actualizar juntos:

- `Version:` en `wordpress-theme/style.css`;
- `GRAVEDAD_VERSION` en `wordpress-theme/functions.php`.
