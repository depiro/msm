# 🧩 Components – MSM Theme
Este directorio contiene componentes visuales reutilizables del tema WordPress, ubicados en:

```
templates/parts/
```

Cada componente está diseñado para ser independiente, dinámico y fácilmente invocable desde cualquier plantilla del sitio.

---

## 📁 Estructura

```text
parts/
├── banner-consultas.php           # Banner horizontal con imagen, título y CTA
├── banners-home.php               # Rejilla de banners editables (íconos, textos, enlaces)
├── info-institucional.php         # Sección institucional con datos personales y mapa
└── ...
```

---

## 🧩 Uso general

```php
set_query_var('nombre_variable', [
  // propiedades necesarias para el componente
]);
get_template_part('templates/parts/nombre-del-componente');
```

---

## 🧱 Componentes disponibles

### `banner-consultas.php`
Banner con título, botón y una imagen ilustrativa.

```php
set_query_var('banner_consultas', [
  'title' => 'Iniciá tus pedidos o consultas',
  'button_text' => 'Iniciar consultas',
  'button_url' => '/consultas',
  'image' => get_template_directory_uri() . '/assets/images/consultas-ilustracion.svg'
]);
```

### `banners-home.php`
Banners de la home personalizables mediante JSON o campos personalizados.

```php
set_query_var('banners_home', [
  [
    'url' => '/debito-automatico',
    'icon' => 'debito.svg',
    'title' => '¡Adherite al débito automático!',
    'text'  => 'y ganá tranquilidad todos los meses',
    'style' => 'bg-white shadow-sm'
  ],
  [...]
]);
```

### `info-institucional.php`
Sección final de página con contacto institucional y mapa.

```php
set_query_var('info_institucional', [
  'titulo' => 'Información institucional',
  'nombre' => 'Nombre Apellido',
  'cargo' => 'Puesto o Rol',
  'telefono' => '0000-000000',
  'email' => 'correo@ejemplo.com',
  'foto' => get_template_directory_uri() . '/assets/images/foto.jpg',
  'mapa_embed' => '<iframe src="..." ...></iframe>'
]);
```

---

## 🧼 Convenciones
- Todos los componentes deben ser **100% autocontenidos** y usar `get_query_var()`.
- Evitá lógica directa en el `get_template_part()`. Usá `set_query_var()` antes.
- Imágenes y SVGs deben estar en `assets/images/` o `assets/images/icons/`.

---

¿Agregar documentación para nuevos componentes? Simplemente copiá uno de los bloques y actualizá sus propiedades ✍️
