<?php
if (!defined('ABSPATH')) { exit; }

define('GRAVEDAD_VERSION', '5.36.1');

function gravedad_icon($name) {
    $icons = array(
        'search' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        'user' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
        'cart' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>',
        'truck' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="6" width="14" height="12"></rect><path d="M15 10h4l3 3v5h-7z"></path><circle cx="6" cy="20" r="2"></circle><circle cx="17.5" cy="20" r="2"></circle></svg>',
        'shield' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 4 5v6c0 5 3.4 8.7 8 10 4.6-1.3 8-5 8-10V5z"></path><path d="m9 12 2 2 4-4"></path></svg>',
        'refresh' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 15.4-6.4L21 8"></path><path d="M21 3v5h-5"></path><path d="M21 12a9 9 0 0 1-15.4 6.4L3 16"></path><path d="M3 21v-5h5"></path></svg>',
        'store' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9.5 4.5 4h15L21 9.5"></path><path d="M4 9.5V20h16V9.5"></path><path d="M9.5 20v-6h5v6"></path><path d="M3 9.5a2.2 2.2 0 0 0 4.4 0 2.2 2.2 0 0 0 4.4 0 2.2 2.2 0 0 0 4.4 0 2.2 2.2 0 0 0 4.4 0"></path></svg>',
        'headset' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14v-2.5a8 8 0 0 1 16 0V14"></path><rect x="2" y="14" width="5" height="7" rx="1.6"></rect><rect x="17" y="14" width="5" height="7" rx="1.6"></rect><path d="M20 21a4 4 0 0 1-4 3h-2"></path></svg>',
        'sparkle' => '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M12 2c.7 4.4 2.6 6.3 7 7-4.4.7-6.3 2.6-7 7-.7-4.4-2.6-6.3-7-7 4.4-.7 6.3-2.6 7-7z"></path></svg>',
        'box' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m21 7.5-9-4.5-9 4.5 9 4.5 9-4.5z"></path><path d="M3 7.5v9l9 4.5 9-4.5v-9"></path><path d="M12 12v9"></path></svg>',
        'hexagon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 3 7.5v9L12 22l9-5.5v-9z"></path><path d="M12 8v8"></path><path d="m8.5 10 7 4"></path><path d="m15.5 10-7 4"></path></svg>',
        'tarot' => '<svg viewBox="0 0 499.054 499.054" fill="currentColor"><g><g><path d="m418.518 213.011-14.096-5.13 5.129-14.096 14.096 5.13zm-28.19-10.26-14.096-5.13 5.129-14.096 14.096 5.13zm-28.193-10.261-14.095-5.13 5.131-14.096 14.095 5.13z"/></g><g><path d="m380.882 215.691-.328 15.217c-.096 4.444-.914 8.813-2.433 12.983-3.699 10.166-11.137 18.282-20.941 22.854-9.803 4.571-20.804 5.053-30.968 1.353-4.171-1.518-8.043-3.699-11.509-6.482l-11.866-9.53-.328 15.217c-.513 23.772 14.157 45.21 36.503 53.343 6.195 2.255 12.614 3.377 19.016 3.377 7.994 0 15.961-1.751 23.422-5.229 13.436-6.266 23.627-17.388 28.698-31.318 8.133-22.345 1.141-47.362-17.399-62.252zm15.17 66.652c-3.7 10.166-11.138 18.282-20.941 22.854-9.805 4.572-20.804 5.053-30.968 1.352-11.725-4.267-20.553-13.553-24.45-24.882.461.182.923.356 1.389.526 28.757 10.465 60.669-4.414 71.136-33.171.169-.466.332-.934.489-1.402 6.173 10.267 7.612 23 3.345 34.723z"/><path d="m483.697 215.09 15.357-42.193-189.497-68.972-2.07 5.687h-158.524v6.051l-36.548 13.302 5.13 14.096 31.418-11.435v86.222l-3.248 1.983-27.296-20.128-7.971 32.965-33.535 5.068 17.673 28.946-20.129 27.296 32.965 7.972 5.068 33.535 28.947-17.674 7.526 5.55v60.456h21.115l-20.836 7.584c-11.956-23.004-38.109-35.2-63.416-29.572l-49.675-136.482c11.202-5.802 20.14-15.068 25.56-26.69 5.419-11.622 6.772-24.424 4.016-36.735l36.756-13.378-5.13-14.096-97.353 35.434 93.784 257.668 120.163-43.732h62.882l128.441 46.749 55.093-151.364-14.096-5.131-33.037 90.768c-12.31-2.755-25.113-1.404-36.735 4.016-11.623 5.419-20.888 14.357-26.691 25.56l-68.311-24.863c5.628-25.307-6.568-51.461-29.571-63.417l49.671-136.469c4.126.924 8.308 1.386 12.482 1.386 8.28 0 16.53-1.813 24.258-5.416 11.623-5.419 20.888-14.357 26.691-25.559l68.311 24.863c-5.628 25.307 6.568 51.46 29.571 63.417l-11.491 31.571 14.096 5.131 11.318-31.096zm-348.698 181.495-32.25 11.738-11.738-32.25c17.436-3.032 35.1 5.203 43.988 20.512zm-86.883-204.267c-3.722 7.981-9.682 14.467-17.149 18.785l-11.741-32.257 32.257-11.74c1.491 8.497.354 17.231-3.367 25.212zm115.847-67.706h34.32c-3.116 17.428-16.893 31.204-34.32 34.32zm0 209.885c17.427 3.116 31.205 16.893 34.32 34.32h-34.32zm49.479 34.32c-3.367-25.706-23.772-46.111-49.478-49.478v-27.203h-15v12.588l-6.738-4.969-18.278 11.16-3.2-21.176-20.815-5.032 12.71-17.235-11.16-18.278 21.175-3.201 5.034-20.814 17.236 12.71 4.036-2.464v41.712h15v-103.047c25.706-3.367 46.111-23.772 49.478-49.478h88.586l-14.697 40.378h.001l-14.328 39.367c-5.269-2.284-10.519-3.804-15.71-4.555v-23.049h-15v23.052c-6.886.996-13.411 3.281-19.431 6.294l-12.155-22.23-13.161 7.197 12.524 22.904c-15.622 11.416-25.703 25.465-26.401 26.453l-3.06 4.329 3.06 4.329c1.102 1.56 25.554 35.629 58.29 40.57l-26.185 71.942 19.844 7.223h-22.177zm42.322-117.095-8.528 23.432c-21.521-1.501-40.441-21.435-47.917-30.409 2.825-3.398 7.297-8.368 12.987-13.347 8.939-7.821 22.699-17.145 37.488-17.145 5.793 0 11.849 1.435 18.064 4.243l-11.064 30.399v-12.173h-15v15zm127.069 130.727c7.982-3.722 16.718-4.855 25.212-3.366l-11.741 32.257-32.257-11.74c4.32-7.468 10.805-13.428 18.786-17.151zm-115.583-18.082-32.25-11.737 11.738-32.251c15.307 8.89 23.544 26.548 20.512 43.988zm64.744-212.324c-7.982 3.722-16.718 4.856-25.212 3.366l11.74-32.257 32.257 11.74c-4.319 7.468-10.804 13.428-18.785 17.151zm115.584 18.082 20.683 7.527 11.567 4.21-11.738 32.25c-15.31-8.888-23.545-26.546-20.512-43.987z"/><path d="m242.026 27.308h15v44.875h-15z"/><path d="m270.718 49.935h44.875v15h-44.875z" transform="matrix(.342 -.94 .94 .342 138.912 313.263)"/><path d="m198.397 35.006h15v44.874h-15z" transform="matrix(.94 -.342 .342 .94 -7.23 73.887)"/><path d="m242.026 426.871h15v44.875h-15z"/><path d="m285.656 419.183h15v44.875h-15z" transform="matrix(.94 -.342 .342 .94 -133.36 126.893)"/><path d="m183.46 434.111h44.875v15h-44.875z" transform="matrix(.342 -.94 .94 .342 -279.504 484.039)"/></g></g></svg>',
        'dice' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="4"></rect><circle cx="8" cy="8" r="1.3" fill="currentColor" stroke="none"></circle><circle cx="16" cy="8" r="1.3" fill="currentColor" stroke="none"></circle><circle cx="12" cy="12" r="1.3" fill="currentColor" stroke="none"></circle><circle cx="8" cy="16" r="1.3" fill="currentColor" stroke="none"></circle><circle cx="16" cy="16" r="1.3" fill="currentColor" stroke="none"></circle></svg>',
        'pin' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.4 7-12.5A7 7 0 0 0 5 9.5C5 14.6 12 22 12 22z"></path><circle cx="12" cy="9.5" r="2.5"></circle></svg>',
        'clock' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3.5 2"></path></svg>',
        'hourglass' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2h12"></path><path d="M6 22h12"></path><path d="M6 2c0 5 4 6.5 6 8 2-1.5 6-3 6-8"></path><path d="M6 22c0-5 4-6.5 6-8 2 1.5 6 3 6 8"></path></svg>',
        'tag' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41 12 22l-10-10V3h9l9.59 9.59a2 2 0 0 1 0 2.82z"></path><circle cx="7.5" cy="7.5" r="1.5" fill="currentColor" stroke="none"></circle></svg>',
        'game-magic' => '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M12 1.5l2.7 7.2 7.3.3-5.8 4.6 2.1 7.1L12 16.6l-6.3 4.1 2.1-7.1L2 8.9l7.3-.2z"></path></svg>',
        'game-pokemon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9.5"></circle><path d="M2.5 12h6.2a3.3 3.3 0 0 0 6.6 0h6.2" stroke-width="1.8"></path><circle cx="12" cy="12" r="2.6" fill="currentColor" stroke-width="1.4"></circle></svg>',
        'game-onepiece' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><circle cx="12" cy="12" r="9"></circle><circle cx="12" cy="12" r="2.6" fill="currentColor" stroke="none"></circle><path d="M12 3v3.4M12 17.6V21M21 12h-3.4M6.4 12H3M18.4 5.6l-2.4 2.4M8 13.6l-2.4 2.4M18.4 18.4l-2.4-2.4M8 10.4 5.6 8"></path></svg>',
        'game-digimon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"><path d="M12 2 3 7.5v9L12 22l9-5.5v-9z"></path><path d="M12 8l2.8 2.8L12 13.6 9.2 10.8z" fill="currentColor" stroke="none"></path></svg>',
        'game-dragonball' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9.5" fill="none"></circle><circle cx="12" cy="7.2" r="1.15" fill="currentColor" stroke="none"></circle><circle cx="8.2" cy="9.6" r="1.15" fill="currentColor" stroke="none"></circle><circle cx="9.6" cy="14" r="1.15" fill="currentColor" stroke="none"></circle><circle cx="14.4" cy="14" r="1.15" fill="currentColor" stroke="none"></circle><circle cx="15.8" cy="9.6" r="1.15" fill="currentColor" stroke="none"></circle></svg>',
        'heart' => '<svg viewBox="0 0 511.992 511.992" fill="currentColor" stroke="none"><path d="m510.616 196.061c-3.944-12.14-15.729-20.486-32.329-22.898l-131.649-19.131-58.876-119.293c-7.424-15.044-19.003-23.671-31.767-23.671s-24.342 8.628-31.766 23.671l-58.873 119.292-131.65 19.132c-16.602 2.412-28.385 10.757-32.33 22.897-3.944 12.14.683 25.818 12.695 37.526l95.262 92.857-22.489 131.12c-2.957 17.247 2.066 27.561 6.8 33.176 5.538 6.568 13.617 10.186 22.749 10.186 6.905 0 14.257-2.025 21.85-6.019l117.753-61.906 117.752 61.905c7.595 3.994 14.946 6.019 21.853 6.019h.001c9.133 0 17.212-3.618 22.75-10.186 4.734-5.615 9.757-15.929 6.799-33.177l-22.493-131.118 95.263-92.856c12.011-11.709 16.639-25.386 12.695-37.526zm-33.636 16.043-100.91 98.361c-3.536 3.446-5.149 8.411-4.314 13.277l23.826 138.89c.767 4.473.378 7.155.016 8.291-.905-.001-3.479-.254-7.888-2.572l-124.733-65.575c-2.186-1.149-4.583-1.723-6.98-1.723s-4.795.574-6.98 1.723l-124.734 65.576c-4.404 2.316-6.977 2.57-7.883 2.571-.363-1.136-.752-3.818.015-8.291l23.822-138.891c.834-4.866-.779-9.831-4.314-13.277l-100.91-98.362c-3.254-3.172-4.515-5.572-4.887-6.702.965-.695 3.396-1.896 7.895-2.55l139.456-20.266c4.886-.71 9.109-3.779 11.294-8.206l62.364-126.365c2.01-4.074 3.903-6.015 4.863-6.719.96.704 2.854 2.645 4.864 6.72l62.365 126.364c2.186 4.427 6.408 7.496 11.294 8.206l139.454 20.266c4.498.653 6.929 1.854 7.894 2.55-.374 1.131-1.635 3.532-4.889 6.704z"></path></svg>',
        'heart-filled' => '<svg viewBox="0 0 511.992 511.992" fill="currentColor" stroke="none"><path d="M256,21 L308.9,183.2 L479.5,183.4 L341.6,283.8 L394.1,446.1 L256,346 L117.9,446.1 L170.4,283.8 L32.5,183.4 L203.1,183.2 Z"></path></svg>',
        'whatsapp' => '<svg viewBox="-23 -21 682 682.66669" fill="currentColor" fill-rule="evenodd"><path d="m544.386719 93.007812c-59.875-59.945312-139.503907-92.9726558-224.335938-93.007812-174.804687 0-317.070312 142.261719-317.140625 317.113281-.023437 55.894531 14.578125 110.457031 42.332032 158.550781l-44.992188 164.335938 168.121094-44.101562c46.324218 25.269531 98.476562 38.585937 151.550781 38.601562h.132813c174.785156 0 317.066406-142.273438 317.132812-317.132812.035156-84.742188-32.921875-164.417969-92.800781-224.359376zm-224.335938 487.933594h-.109375c-47.296875-.019531-93.683594-12.730468-134.160156-36.742187l-9.621094-5.714844-99.765625 26.171875 26.628907-97.269531-6.269532-9.972657c-26.386718-41.96875-40.320312-90.476562-40.296875-140.28125.054688-145.332031 118.304688-263.570312 263.699219-263.570312 70.40625.023438 136.589844 27.476562 186.355469 77.300781s77.15625 116.050781 77.132812 186.484375c-.0625 145.34375-118.304687 263.59375-263.59375 263.59375zm144.585938-197.417968c-7.921875-3.96875-46.882813-23.132813-54.148438-25.78125-7.257812-2.644532-12.546875-3.960938-17.824219 3.96875-5.285156 7.929687-20.46875 25.78125-25.09375 31.066406-4.625 5.289062-9.242187 5.953125-17.167968 1.984375-7.925782-3.964844-33.457032-12.335938-63.726563-39.332031-23.554687-21.011719-39.457031-46.960938-44.082031-54.890626-4.617188-7.9375-.039062-11.8125 3.476562-16.171874 8.578126-10.652344 17.167969-21.820313 19.808594-27.105469 2.644532-5.289063 1.320313-9.917969-.664062-13.882813-1.976563-3.964844-17.824219-42.96875-24.425782-58.839844-6.4375-15.445312-12.964843-13.359374-17.832031-13.601562-4.617187-.230469-9.902343-.277344-15.1875-.277344-5.28125 0-13.867187 1.980469-21.132812 9.917969-7.261719 7.933594-27.730469 27.101563-27.730469 66.105469s28.394531 76.683594 32.355469 81.972656c3.960937 5.289062 55.878906 85.328125 135.367187 119.648438 18.90625 8.171874 33.664063 13.042968 45.175782 16.695312 18.984374 6.03125 36.253906 5.179688 49.910156 3.140625 15.226562-2.277344 46.878906-19.171875 53.488281-37.679687 6.601563-18.511719 6.601563-34.375 4.617187-37.683594-1.976562-3.304688-7.261718-5.285156-15.183593-9.253906zm0 0"/></svg>',
    );
    return isset($icons[$name]) ? $icons[$name] : '';
}

function gravedad_setup() {
    load_theme_textdomain('gravedad-store', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array('height' => 120, 'width' => 420, 'flex-height' => true, 'flex-width' => true));
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    register_nav_menus(array('primary' => __('Menú principal', 'gravedad-store'), 'footer' => __('Menú del pie', 'gravedad-store')));
}
add_action('after_setup_theme', 'gravedad_setup');

function gravedad_force_search_template($template) {
    if (is_search()) {
        $custom = get_template_directory() . '/archive-product.php';
        if (file_exists($custom)) { return $custom; }
    }
    return $template;
}
add_filter('template_include', 'gravedad_force_search_template', 99);

function gravedad_assets() {
    wp_enqueue_style('gravedad-fonts', 'https://fonts.googleapis.com/css2?family=Racing+Sans+One&family=Manrope:wght@400;500;600;700;800&display=swap', array(), null);
    wp_enqueue_style('gravedad-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-commerce', get_template_directory_uri() . '/assets/css/commerce.css', array('gravedad-theme'), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-singles', get_template_directory_uri() . '/assets/css/singles.css', array('gravedad-commerce'), GRAVEDAD_VERSION);
    wp_enqueue_script('gravedad-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), GRAVEDAD_VERSION, true);
    wp_localize_script('gravedad-theme', 'gravedadAjax', array('url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'gravedad_assets');

function gravedad_uncropped_thumbnails($size) {
    $size['width'] = max((int) $size['width'], 640);
    $size['height'] = max((int) $size['height'], 640);
    $size['crop'] = 0;
    return $size;
}
add_filter('woocommerce_get_image_size_thumbnail', 'gravedad_uncropped_thumbnails');
add_filter('woocommerce_get_image_size_gallery_thumbnail', 'gravedad_uncropped_thumbnails');

function gravedad_favicon() {
    if (has_site_icon()) { return; }
    $uri = get_template_directory_uri();
    echo '<link rel="icon" href="' . esc_url($uri . '/assets/img/favicon.ico') . '" sizes="any">';
    echo '<link rel="icon" type="image/png" href="' . esc_url($uri . '/assets/img/favicon-32.png') . '" sizes="32x32">';
    echo '<link rel="icon" type="image/png" href="' . esc_url($uri . '/assets/img/favicon-192.png') . '" sizes="192x192">';
    echo '<link rel="apple-touch-icon" href="' . esc_url($uri . '/assets/img/apple-touch-icon.png') . '">';
}
add_action('wp_head', 'gravedad_favicon', 1);

function gravedad_customize($wp_customize) {
    $wp_customize->add_section('gravedad_store', array('title' => __('Gravedad Store', 'gravedad-store'), 'priority' => 30));
    $fields = array(
        'gravedad_announcement' => array('Aviso superior', 'ENVÍOS A TODO EL PAÍS'),
        'gravedad_promo' => array('Promoción superior', '3 CUOTAS SIN INTERÉS EN PRODUCTOS SELECCIONADOS'),
        'gravedad_whatsapp' => array('WhatsApp', '541136403287'),
        'gravedad_instagram' => array('Instagram', 'https://www.instagram.com/gravedadstore'),
        'gravedad_event_date' => array('Fecha del próximo evento', '24 AGO'),
        'gravedad_event_location' => array('Lugar del próximo evento', 'José C. Paz, Buenos Aires'),
    );
    foreach ($fields as $id => $field) {
        $wp_customize->add_setting($id, array('default' => $field[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($id, array('label' => __($field[0], 'gravedad-store'), 'section' => 'gravedad_store', 'type' => 'text'));
    }
    $wp_customize->add_setting('gravedad_usd_rate_manual', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('gravedad_usd_rate_manual', array(
        'label' => __('Cotización manual del dólar (opcional)', 'gravedad-store'),
        'description' => __('Dejar vacío para usar la cotización oficial automática. Si cargás un valor acá, se usa ese en vez del automático.', 'gravedad-store'),
        'section' => 'gravedad_store', 'type' => 'number',
    ));
}
add_action('customize_register', 'gravedad_customize');
add_action('customize_save_after', function () { gravedad_recalculate_usd_prices(); });

function gravedad_option($key, $default = '') { return get_theme_mod($key, $default); }

/* ---- Cotización del dólar y precios en USD ---- */

function gravedad_fetch_official_usd_rate() {
    $response = wp_remote_get('https://dolarapi.com/v1/dolares/oficial', array('timeout' => 12));
    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) { return false; }
    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (!is_array($body) || empty($body['venta'])) { return false; }
    return (float) $body['venta'];
}

add_action('gravedad_fetch_usd_rate_event', 'gravedad_update_usd_rate');
function gravedad_update_usd_rate() {
    $rate = gravedad_fetch_official_usd_rate();
    if (!$rate) { return; }
    $previous = (float) get_option('gravedad_usd_rate_auto', 0);
    update_option('gravedad_usd_rate_auto', $rate);
    update_option('gravedad_usd_rate_auto_updated', current_time('mysql'));
    if (abs($previous - $rate) > 0.009) { gravedad_recalculate_usd_prices(); }
}

add_action('after_setup_theme', function () {
    if (!wp_next_scheduled('gravedad_fetch_usd_rate_event')) {
        wp_schedule_event(time(), 'hourly', 'gravedad_fetch_usd_rate_event');
    }
});

function gravedad_get_usd_rate() {
    $manual = get_theme_mod('gravedad_usd_rate_manual', '');
    if ($manual !== '' && is_numeric($manual) && (float) $manual > 0) { return (float) $manual; }
    $auto = (float) get_option('gravedad_usd_rate_auto', 0);
    if ($auto > 0) { return $auto; }
    $fetched = gravedad_fetch_official_usd_rate();
    if ($fetched) {
        update_option('gravedad_usd_rate_auto', $fetched);
        update_option('gravedad_usd_rate_auto_updated', current_time('mysql'));
        return $fetched;
    }
    return 1000; // resguardo si todavía no hay cotización disponible
}

function gravedad_recalculate_usd_prices() {
    if (!class_exists('WooCommerce')) { return; }
    $rate = gravedad_get_usd_rate();
    $ids = get_posts(array('post_type' => 'product', 'posts_per_page' => -1, 'fields' => 'ids', 'meta_key' => '_price_usd', 'post_status' => 'any'));
    foreach ($ids as $id) {
        $usd_regular = get_post_meta($id, '_price_usd', true);
        $usd_sale = get_post_meta($id, '_sale_price_usd', true);
        if ($usd_regular === '' || !is_numeric($usd_regular)) { continue; }
        $ars_regular = round($usd_regular * $rate, 2);
        update_post_meta($id, '_regular_price', $ars_regular);
        if ($usd_sale !== '' && is_numeric($usd_sale) && (float) $usd_sale > 0) {
            $ars_sale = round($usd_sale * $rate, 2);
            update_post_meta($id, '_sale_price', $ars_sale);
            update_post_meta($id, '_price', $ars_sale);
        } else {
            update_post_meta($id, '_price', $ars_regular);
        }
        wc_delete_product_transients($id);
    }
}

add_action('woocommerce_product_options_pricing', function () {
    global $post;
    woocommerce_wp_text_input(array('id' => '_price_usd', 'label' => __('Precio en USD (opcional)', 'gravedad-store'), 'description' => __('Si cargás un valor acá, el precio en pesos se calcula solo con la cotización del dólar y pisa el precio regular.', 'gravedad-store'), 'desc_tip' => true, 'data_type' => 'price'));
    woocommerce_wp_text_input(array('id' => '_sale_price_usd', 'label' => __('Precio de oferta en USD (opcional)', 'gravedad-store'), 'data_type' => 'price'));
});

add_action('woocommerce_process_product_meta', function ($post_id) {
    $usd_regular = isset($_POST['_price_usd']) ? wc_format_decimal(wp_unslash($_POST['_price_usd'])) : '';
    $usd_sale = isset($_POST['_sale_price_usd']) ? wc_format_decimal(wp_unslash($_POST['_sale_price_usd'])) : '';
    update_post_meta($post_id, '_price_usd', $usd_regular);
    update_post_meta($post_id, '_sale_price_usd', $usd_sale);
    if ($usd_regular !== '' && is_numeric($usd_regular)) {
        $rate = gravedad_get_usd_rate();
        $ars_regular = round($usd_regular * $rate, 2);
        update_post_meta($post_id, '_regular_price', $ars_regular);
        if ($usd_sale !== '' && is_numeric($usd_sale) && (float) $usd_sale > 0) {
            $ars_sale = round($usd_sale * $rate, 2);
            update_post_meta($post_id, '_sale_price', $ars_sale);
            update_post_meta($post_id, '_price', $ars_sale);
        } else {
            update_post_meta($post_id, '_price', $ars_regular);
        }
    }
});

function gravedad_usd_reference_note() {
    global $product;
    if (!$product) { return; }
    $usd = get_post_meta($product->get_id(), '_price_usd', true);
    if ($usd === '' || !is_numeric($usd)) { return; }
    echo '<small class="usd-reference">≈ USD ' . esc_html(number_format((float) $usd, 2)) . ' · cotización $' . esc_html(number_format(gravedad_get_usd_rate(), 0, ',', '.')) . '</small>';
}
add_action('woocommerce_single_product_summary', 'gravedad_usd_reference_note', 11);

function gravedad_shop_url($slug = '') {
    if (in_array($slug, array('novedades', 'ofertas'), true)) {
        $page = get_page_by_path($slug);
        if ($page) { return get_permalink($page); }
    }
    if (function_exists('wc_get_page_id')) {
        if ($slug) {
            $term = get_term_by('slug', $slug, 'product_cat');
            if ($term && !is_wp_error($term)) { return get_term_link($term); }
        }
        $shop = wc_get_page_permalink('shop');
        if ($shop) { return $shop; }
    }
    return home_url('/tienda/');
}

function gravedad_fav_button($product_id) {
    return '<button type="button" class="fav-toggle" data-product-id="' . esc_attr($product_id) . '" aria-label="Agregar a favoritos"><span class="fav-icon-off">' . gravedad_icon('heart') . '</span><span class="fav-icon-on">' . gravedad_icon('heart-filled') . '</span></button>';
}

function gravedad_render_gravity_product($product, $filter_dims = array()) {
    $permalink = get_permalink($product->get_id());
    $data_attrs = '';
    foreach ($filter_dims as $param => $data) {
        $taxonomy = $data[1];
        $terms = get_the_terms($product->get_id(), $taxonomy);
        $slugs = ($terms && !is_wp_error($terms)) ? wp_list_pluck($terms, 'slug') : array();
        $data_attrs .= ' data-' . esc_attr($param) . '="' . esc_attr(implode(' ', $slugs)) . '"';
    }
    echo '<article class="gravity-product"' . $data_attrs . '><a class="product-image" href="' . esc_url($permalink) . '">';
    echo $product->is_on_sale() ? '<span>OFERTA</span>' : '<span class="is-new">NUEVO</span>';
    echo $product->get_image('woocommerce_thumbnail');
    echo '</a>' . gravedad_fav_button($product->get_id()) . '<div><small>' . wp_kses_post(wc_get_product_category_list($product->get_id(), ', ')) . '</small><h3><a href="' . esc_url($permalink) . '">' . esc_html($product->get_name()) . '</a></h3><div class="product-price">' . wp_kses_post($product->get_price_html()) . '<a class="plus" href="' . esc_url($product->add_to_cart_url()) . '" data-product_id="' . esc_attr($product->get_id()) . '">+</a></div></div></article>';
}

function gravedad_home_quick_filters($dims) {
    $groups = array();
    foreach ($dims as $param => $data) {
        list($label, $taxonomy) = $data;
        $terms = gravedad_filter_terms($taxonomy);
        if ($terms) { $groups[] = array($param, $label, array_slice($terms, 0, 8)); }
    }
    if (!$groups) { return; }
    echo '<div class="home-quick-filters" data-carousel-filters>';
    foreach ($groups as $g) {
        list($param, $label, $terms) = $g;
        echo '<select data-filter-key="' . esc_attr($param) . '"><option value="">' . esc_html($label) . ': todos</option>';
        foreach ($terms as $t) { echo '<option value="' . esc_attr($t->slug) . '">' . esc_html($t->name) . '</option>'; }
        echo '</select>';
    }
    echo '</div>';
}

function gravedad_home_carousel($kicker, $title_html, $desc, $query_args, $view_all_url, $section_id = '', $quick_filter_dims = array()) {
    if (!class_exists('WooCommerce')) { return; }
    $defaults = array('post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => 12, 'orderby' => 'date', 'order' => 'DESC');
    $query = new WP_Query(array_merge($defaults, $query_args));
    if (!$query->have_posts()) { wp_reset_postdata(); return; }
    echo '<section class="featured-products"' . ($section_id ? ' id="' . esc_attr($section_id) . '"' : '') . '><div class="section-head"><div><p class="section-label">' . esc_html($kicker) . '</p><h2>' . $title_html . '</h2>' . ($desc ? '<p class="section-desc">' . esc_html($desc) . '</p>' : '') . '</div><a href="' . esc_url($view_all_url) . '">VER TODO →</a></div>';
    if ($quick_filter_dims) { gravedad_home_quick_filters($quick_filter_dims); }
    echo '<div class="product-cards" data-filterable-cards><p class="qf-no-results" hidden>No hay productos que coincidan con esos filtros.</p>';
    while ($query->have_posts()) { $query->the_post(); gravedad_render_gravity_product(wc_get_product(get_the_ID()), $quick_filter_dims); }
    echo '</div></section>';
    wp_reset_postdata();
}

function gravedad_marquee($items = array()) {
    if (!$items) {
        $items = array('ENVÍOS A TODO EL PAÍS', 'COMPRA PROTEGIDA', 'RETIRÁ EN TIENDA SIN CARGO', 'ATENCIÓN PERSONALIZADA', 'NUEVOS INGRESOS TODAS LAS SEMANAS');
    }
    echo '<div class="section-marquee"><div class="section-marquee-track">';
    for ($i = 0; $i < 2; $i++) {
        foreach ($items as $item) { echo '<span>' . esc_html($item) . '</span><i>◆</i>'; }
    }
    echo '</div></div>';
}

function gravedad_filter_link($section_slug, $args = array()) {
    $url = gravedad_shop_url($section_slug);
    return $args ? add_query_arg($args, $url) : $url;
}

function gravedad_mega_promo($kicker, $title, $cta, $url, $image) {
    $img_url = get_template_directory_uri() . '/assets/img/' . $image;
    echo '<a class="mega-promo" href="' . esc_url($url) . '" style="--mega-img:url(\'' . esc_url($img_url) . '\')"><span class="mega-promo-kicker">' . esc_html($kicker) . '</span><strong>' . esc_html($title) . '</strong><span class="button primary">' . esc_html($cta) . '</span></a>';
}

function gravedad_megamenu($key) {
    ob_start();
    if ($key === 'tcg') {
        $games = array(
            array('Magic: The Gathering', 'magic', 'game-magic'),
            array('Pokémon', 'pokemon', 'game-pokemon'),
            array('One Piece', 'one-piece', 'game-onepiece'),
            array('Digimon', 'digimon', 'game-digimon'),
            array('Dragon Ball', 'dragon-ball', 'game-dragonball'),
        );
        $tipos = array('Sobres', 'Booster Box', 'Collector Booster', 'Productos especiales');
        echo '<div class="mega-menu"><div class="mega-columns mega-columns-5">';
        foreach ($games as $g) {
            list($label, $slug, $icon) = $g;
            echo '<div class="mega-col"><h4>' . gravedad_icon($icon) . esc_html($label) . '</h4>';
            echo '<a href="' . esc_url(gravedad_filter_link('cartas-sueltas', array('f_juego' => $slug))) . '">Cartas sueltas</a>';
            foreach ($tipos as $t) { echo '<a href="' . esc_url(gravedad_filter_link('tcg', array('f_juego' => $slug, 'f_tipo_producto' => sanitize_title($t)))) . '">' . esc_html($t) . '</a>'; }
            echo '<a class="mega-view-all" href="' . esc_url(gravedad_filter_link('tcg', array('f_juego' => $slug))) . '">Ver todo →</a></div>';
        }
        echo '</div>';
        gravedad_mega_promo('TRADING CARD GAMES', 'Sellado y singles', 'Ver todo TCG →', gravedad_shop_url('tcg'), 'hero-tcg.jpg');
        echo '</div>';
    } elseif ($key === 'cartas-sueltas') {
        $games = array('Magic: The Gathering' => 'magic', 'Pokémon' => 'pokemon', 'One Piece' => 'one-piece', 'Digimon' => 'digimon', 'Dragon Ball' => 'dragon-ball', 'Otros' => 'otros');
        $rarezas = array('Común', 'Infrecuente', 'Rara', 'Mítica', 'Promo', 'Especial');
        $idiomas = array('Español', 'Inglés', 'Japonés', 'Portugués');
        echo '<div class="mega-menu"><div class="mega-columns mega-columns-3">';
        echo '<div class="mega-col"><h4>Elegir juego</h4>';
        foreach ($games as $label => $slug) { echo '<a href="' . esc_url(gravedad_filter_link('cartas-sueltas', array('f_juego' => $slug))) . '">' . esc_html($label) . '</a>'; }
        echo '</div><div class="mega-col"><h4>Por rareza</h4>';
        foreach ($rarezas as $r) { echo '<a href="' . esc_url(gravedad_filter_link('cartas-sueltas', array('f_rareza' => sanitize_title($r)))) . '">' . esc_html($r) . '</a>'; }
        echo '</div><div class="mega-col"><h4>Por idioma</h4>';
        foreach ($idiomas as $i) { echo '<a href="' . esc_url(gravedad_filter_link('cartas-sueltas', array('f_idioma' => sanitize_title($i)))) . '">' . esc_html($i) . '</a>'; }
        echo '<a class="mega-view-all" href="' . esc_url(gravedad_shop_url('cartas-sueltas')) . '">Ver todas →</a></div>';
        echo '</div>';
        gravedad_mega_promo('ENCONTRÁ ESA CARTA', 'Cartas sueltas', 'Explorar →', gravedad_shop_url('cartas-sueltas'), 'hero-cartas-sueltas.jpg');
        echo '</div>';
    } elseif ($key === 'juegos-de-mesa') {
        $editoriales = array('Devir' => 'devir', 'Buró' => 'buro', 'Popullar' => 'popullar', 'Otras editoriales' => 'otras-editoriales');
        $tipos = array('Familiares', 'Party Games', 'Estrategia', 'Cooperativos', 'Para 2 jugadores', 'Infantiles', 'Juegos de cartas', 'Rol / Aventura');
        echo '<div class="mega-menu"><div class="mega-columns mega-columns-3">';
        echo '<div class="mega-col"><h4>Por editorial</h4>';
        foreach ($editoriales as $label => $slug) { echo '<a href="' . esc_url(gravedad_filter_link('juegos-de-mesa', array('f_editorial' => $slug))) . '">' . esc_html($label) . '</a>'; }
        echo '<a class="mega-view-all" href="' . esc_url(gravedad_shop_url('juegos-de-mesa')) . '">Ver todos →</a></div>';
        echo '<div class="mega-col mega-col-wide"><h4>Por tipo de juego</h4><div class="mega-col-grid">';
        foreach ($tipos as $t) { echo '<a href="' . esc_url(gravedad_filter_link('juegos-de-mesa', array('f_tipo_juego' => sanitize_title($t)))) . '">' . esc_html($t) . '</a>'; }
        echo '</div></div>';
        echo '</div>';
        gravedad_mega_promo('PARA COMPARTIR LA MESA', 'Juegos de mesa', 'Explorar →', gravedad_shop_url('juegos-de-mesa'), 'hero-juegos-de-mesa.jpg');
        echo '</div>';
    } elseif ($key === 'accesorios') {
        $tipos = array('Folios / Sleeves' => 'folios-sleeves', 'Deck Boxes' => 'deck-boxes', 'Carpetas' => 'carpetas', 'Playmats' => 'playmats', 'Dados y Contadores' => 'dados-y-contadores', 'Almacenamiento' => 'almacenamiento');
        $marcas = array('Dragon Shield', 'Ultra Pro', 'Ultimate Guard', 'KMC');
        echo '<div class="mega-menu"><div class="mega-columns mega-columns-2">';
        echo '<div class="mega-col"><h4>Por tipo</h4>';
        foreach ($tipos as $label => $slug) { echo '<a href="' . esc_url(gravedad_filter_link('accesorios', array('f_tipo_accesorio' => $slug))) . '">' . esc_html($label) . '</a>'; }
        echo '<a class="mega-view-all" href="' . esc_url(gravedad_shop_url('accesorios')) . '">Ver todos →</a></div>';
        echo '<div class="mega-col"><h4>Por marca</h4>';
        foreach ($marcas as $m) { echo '<a href="' . esc_url(gravedad_filter_link('accesorios', array('f_marca' => sanitize_title($m)))) . '">' . esc_html($m) . '</a>'; }
        echo '</div>';
        echo '</div>';
        gravedad_mega_promo('CUIDÁ TU COLECCIÓN', 'Accesorios', 'Explorar →', gravedad_shop_url('accesorios'), 'hero-accesorios.jpg');
        echo '</div>';
    }
    return ob_get_clean();
}

function gravedad_default_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Inicio</a></li>';
    echo '<li class="has-mega"><a href="' . esc_url(gravedad_shop_url('tcg')) . '">TCG</a>' . gravedad_megamenu('tcg') . '</li>';
    echo '<li class="has-mega"><a href="' . esc_url(gravedad_shop_url('cartas-sueltas')) . '">Cartas sueltas</a>' . gravedad_megamenu('cartas-sueltas') . '</li>';
    echo '<li class="has-mega"><a href="' . esc_url(gravedad_shop_url('juegos-de-mesa')) . '">Juegos de mesa</a>' . gravedad_megamenu('juegos-de-mesa') . '</li>';
    echo '<li class="has-mega"><a href="' . esc_url(gravedad_shop_url('accesorios')) . '">Accesorios</a>' . gravedad_megamenu('accesorios') . '</li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('preventas')) . '">Preventas</a></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('novedades')) . '">Novedades</a></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('ofertas')) . '">Ofertas</a></li>';
    echo '<li><a href="' . esc_url(home_url('/eventos/')) . '">Eventos</a></li>';
    echo '</ul>';
}

function gravedad_cart_count_fragment($fragments) {
    ob_start(); ?>
    <span class="cart-count"><?php echo function_exists('WC') && WC()->cart ? esc_html(WC()->cart->get_cart_contents_count()) : '0'; ?></span>
    <?php $fragments['.cart-count'] = ob_get_clean(); return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'gravedad_cart_count_fragment');

function gravedad_widgets() {
    register_sidebar(array('name' => __('Filtros de tienda', 'gravedad-store'), 'id' => 'shop-filters', 'before_widget' => '<section class="shop-widget">', 'after_widget' => '</section>', 'before_title' => '<h3>', 'after_title' => '</h3>'));
}
add_action('widgets_init', 'gravedad_widgets');

function gravedad_ensure_woocommerce_pages() {
    if (!class_exists('WooCommerce')) { return; }
    $pages = array(
        'woocommerce_cart_page_id' => array('Carrito', 'carrito', '[woocommerce_cart]'),
        'woocommerce_checkout_page_id' => array('Finalizar compra', 'finalizar-compra', '[woocommerce_checkout]'),
        'woocommerce_myaccount_page_id' => array('Mi cuenta', 'mi-cuenta', '[woocommerce_my_account]'),
    );
    foreach ($pages as $option => $data) {
        $current = absint(get_option($option));
        if ($current && get_post_status($current)) { continue; }
        $existing = get_page_by_path($data[1]);
        $page_id = $existing ? $existing->ID : wp_insert_post(array(
            'post_title' => $data[0],
            'post_name' => $data[1],
            'post_content' => $data[2],
            'post_status' => 'publish',
            'post_type' => 'page',
        ));
        if ($page_id && !is_wp_error($page_id)) { update_option($option, $page_id); }
    }
}
add_action('after_switch_theme', 'gravedad_ensure_woocommerce_pages');

function gravedad_ensure_catalog_structure() {
    if (!class_exists('WooCommerce')) { return; }
    $categories = array(
        'cartas-sueltas' => array('Cartas sueltas', 0, 'Cartas individuales de TCG, filtrables por juego, colección, rareza, idioma, condición y acabado.'),
        'tcg' => array('TCG', 0, 'Sobres, booster boxes, bundles, mazos y ediciones especiales de tus juegos favoritos.'),
        'magic' => array('Magic: The Gathering', 'tcg', ''),
        'pokemon' => array('Pokémon', 'tcg', ''),
        'one-piece' => array('One Piece', 'tcg', ''),
        'digimon' => array('Digimon', 'tcg', ''),
        'dragon-ball' => array('Dragon Ball', 'tcg', ''),
        'otros-tcg' => array('Otros TCG', 'tcg', 'Espacio para nuevos juegos y líneas de TCG.'),
        'juegos-de-mesa' => array('Juegos de mesa', 0, 'Estrategia, party games, cooperativos, familiares y mucho más.'),
        'devir' => array('Devir', 'juegos-de-mesa', ''),
        'buro' => array('Buró', 'juegos-de-mesa', ''),
        'popullar' => array('Popullar', 'juegos-de-mesa', ''),
        'otras-editoriales' => array('Otras editoriales', 'juegos-de-mesa', ''),
        'accesorios' => array('Accesorios', 0, 'Sleeves, deck boxes, carpetas, playmats y todo lo necesario para jugar y proteger tus cartas.'),
        'folios-sleeves' => array('Folios / Sleeves', 'accesorios', ''),
        'deck-boxes' => array('Deck Boxes', 'accesorios', ''),
        'carpetas' => array('Carpetas', 'accesorios', ''),
        'playmats' => array('Playmats', 'accesorios', ''),
        'dados-y-contadores' => array('Dados y Contadores', 'accesorios', ''),
        'almacenamiento' => array('Almacenamiento', 'accesorios', ''),
        'otros-accesorios' => array('Otros accesorios', 'accesorios', ''),
        'preventas' => array('Preventas', 0, 'Próximos lanzamientos disponibles para reservar antes que se agoten.'),
    );
    foreach ($categories as $slug => $data) {
        if (term_exists($slug, 'product_cat')) { continue; }
        list($name, $parent_slug, $description) = $data;
        $parent_id = 0;
        if ($parent_slug) {
            $parent = get_term_by('slug', $parent_slug, 'product_cat');
            $parent_id = $parent && !is_wp_error($parent) ? $parent->term_id : 0;
        }
        wp_insert_term($name, 'product_cat', array('slug' => $slug, 'description' => $description, 'parent' => $parent_id));
    }
    foreach ($categories as $slug => $data) {
        $parent_slug = $data[1];
        if (!$parent_slug) { continue; }
        $term = get_term_by('slug', $slug, 'product_cat');
        $parent = get_term_by('slug', $parent_slug, 'product_cat');
        if ($term && $parent && !is_wp_error($term) && !is_wp_error($parent) && (int) $term->parent !== (int) $parent->term_id) {
            wp_update_term($term->term_id, 'product_cat', array('parent' => $parent->term_id));
        }
    }
    if (function_exists('wc_create_attribute') && function_exists('wc_attribute_taxonomy_id_by_name')) {
        $attributes = array(
            'juego' => 'Juego', 'coleccion' => 'Colección / Set', 'rareza' => 'Rareza',
            'color' => 'Color', 'tipo-carta' => 'Tipo', 'idioma' => 'Idioma',
            'condicion' => 'Condición', 'acabado' => 'Foil / Acabado',
            'tipo-producto' => 'Tipo de producto', 'editorial' => 'Editorial',
            'tipo-juego' => 'Tipo de juego', 'jugadores' => 'Cantidad de jugadores',
            'edad' => 'Edad recomendada', 'duracion' => 'Duración de partida',
            'dificultad' => 'Dificultad', 'tipo-accesorio' => 'Tipo de accesorio', 'marca' => 'Marca',
        );
        foreach ($attributes as $slug => $label) {
            if (!wc_attribute_taxonomy_id_by_name($slug)) {
                wc_create_attribute(array('name'=>$label,'slug'=>$slug,'type'=>'select','order_by'=>'name','has_archives'=>true));
            }
        }
    }
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'gravedad_ensure_catalog_structure');

add_action('woocommerce_before_shop_loop_item_title', function () {
    global $product;
    if ($product) { echo gravedad_fav_button($product->get_id()); }
}, 15);

add_action('woocommerce_single_product_summary', function () {
    global $product;
    if ($product) { echo gravedad_fav_button($product->get_id()); }
}, 31);

add_action('wp_ajax_gravedad_get_favorites', 'gravedad_ajax_get_favorites');
add_action('wp_ajax_nopriv_gravedad_get_favorites', 'gravedad_ajax_get_favorites');
function gravedad_ajax_get_favorites() {
    $ids = isset($_POST['ids']) ? array_map('absint', (array) $_POST['ids']) : array();
    if (!$ids) { wp_send_json_success(array('html' => '', 'count' => 0)); }
    $query = new WP_Query(array('post_type' => 'product', 'post_status' => 'publish', 'post__in' => $ids, 'orderby' => 'post__in', 'posts_per_page' => 100));
    $count = $query->post_count;
    ob_start();
    gravedad_render_product_grid($query);
    $html = ob_get_clean();
    wp_send_json_success(array('html' => $html, 'count' => $count));
}

function gravedad_ensure_catalog_pages() {
    $defs = array(
        'novedades' => array('Novedades', 'page-novedades.php'),
        'ofertas' => array('Ofertas', 'page-ofertas.php'),
        'favoritos' => array('Favoritos', 'page-favoritos.php'),
    );
    foreach ($defs as $slug => $data) {
        list($title, $template) = $data;
        $existing = get_page_by_path($slug);
        $page_id = $existing ? $existing->ID : wp_insert_post(array(
            'post_title' => $title, 'post_name' => $slug, 'post_status' => 'publish', 'post_type' => 'page',
        ));
        if ($page_id && !is_wp_error($page_id)) { update_post_meta($page_id, '_wp_page_template', $template); }
    }
}
add_action('after_switch_theme', 'gravedad_ensure_catalog_pages');

function gravedad_run_theme_upgrades() {
    $installed = get_option('gravedad_theme_version', '0');
    if (version_compare($installed, GRAVEDAD_VERSION, '>=')) { return; }
    gravedad_ensure_woocommerce_pages();
    gravedad_ensure_catalog_structure();
    gravedad_ensure_catalog_pages();
    update_option('gravedad_theme_version', GRAVEDAD_VERSION);
}
add_action('admin_init', 'gravedad_run_theme_upgrades');

function gravedad_seed_filter_terms() {
    $groups = array(
        'pa_juego' => array('Magic: The Gathering','Pokémon','One Piece','Digimon','Dragon Ball','Otros'),
        'pa_rareza' => array('Común','Infrecuente','Rara','Mítica','Promo','Especial'),
        'pa_idioma' => array('Español','Inglés','Japonés','Portugués'),
        'pa_condicion' => array('Nueva','Near Mint','Excellent','Good','Played'),
        'pa_acabado' => array('Foil','No Foil','Reverse Holo','Holo'),
        'pa_tipo-producto' => array('Sobres','Booster Box','Bundles','Collector Booster','Mazos / Commander','Kits y colecciones','Starter Decks','Double Packs','Productos especiales'),
        'pa_editorial' => array('Devir','Buró','Popullar','Otras editoriales'),
        'pa_tipo-juego' => array('Familiares','Party Games','Estrategia','Cooperativos','Para 2 jugadores','Infantiles','Juegos de cartas','Rol / Aventura'),
        'pa_jugadores' => array('1 jugador','2 jugadores','3-4 jugadores','5 o más'),
        'pa_edad' => array('+3','+6','+8','+12','+14','+18'),
        'pa_duracion' => array('-30 min','30-60 min','60-90 min','+90 min'),
        'pa_dificultad' => array('Fácil','Media','Difícil'),
        'pa_tipo-accesorio' => array('Folios / Sleeves','Deck Boxes','Carpetas','Playmats','Dados y Contadores','Almacenamiento','Otros'),
        'pa_marca' => array('Dragon Shield','Ultra Pro','Ultimate Guard','KMC','Otras marcas'),
    );
    foreach ($groups as $taxonomy => $terms) {
        if (!taxonomy_exists($taxonomy)) { continue; }
        foreach ($terms as $term) { if (!term_exists($term, $taxonomy)) { wp_insert_term($term, $taxonomy); } }
    }
}
add_action('init', 'gravedad_seed_filter_terms', 30);

function gravedad_section_filters() {
    return array(
        'cartas-sueltas' => array(
            'f_juego' => array('Juego','pa_juego'), 'f_coleccion' => array('Colección / Set','pa_coleccion'),
            'f_rareza' => array('Rareza','pa_rareza'), 'f_color' => array('Color','pa_color'),
            'f_tipo_carta' => array('Tipo de carta','pa_tipo-carta'), 'f_idioma' => array('Idioma','pa_idioma'),
            'f_condicion' => array('Condición','pa_condicion'), 'f_acabado' => array('Foil / Acabado','pa_acabado'),
        ),
        'tcg' => array(
            'f_juego' => array('Juego','pa_juego'), 'f_tipo_producto' => array('Tipo de producto','pa_tipo-producto'),
            'f_coleccion' => array('Colección / Set','pa_coleccion'), 'f_idioma' => array('Idioma','pa_idioma'),
        ),
        'juegos-de-mesa' => array(
            'f_editorial' => array('Editorial','pa_editorial'), 'f_tipo_juego' => array('Tipo de juego','pa_tipo-juego'),
            'f_jugadores' => array('Cantidad de jugadores','pa_jugadores'), 'f_edad' => array('Edad recomendada','pa_edad'),
            'f_duracion' => array('Duración de partida','pa_duracion'), 'f_dificultad' => array('Dificultad','pa_dificultad'),
        ),
        'accesorios' => array(
            'f_tipo_accesorio' => array('Tipo de accesorio','pa_tipo-accesorio'), 'f_marca' => array('Marca','pa_marca'),
        ),
        'preventas' => array(
            'f_juego' => array('Juego','pa_juego'), 'f_editorial' => array('Editorial','pa_editorial'),
            'f_tipo_producto' => array('Tipo de producto','pa_tipo-producto'),
        ),
    );
}

function gravedad_section_for_term($term) {
    if (!$term) { return ''; }
    $known = array('cartas-sueltas', 'tcg', 'juegos-de-mesa', 'accesorios', 'preventas');
    if (in_array($term->slug, $known, true)) { return $term->slug; }
    foreach (get_ancestors($term->term_id, 'product_cat') as $ancestor_id) {
        $ancestor = get_term($ancestor_id, 'product_cat');
        if ($ancestor && !is_wp_error($ancestor) && in_array($ancestor->slug, $known, true)) { return $ancestor->slug; }
    }
    return '';
}

function gravedad_section_copy() {
    return array(
        'cartas-sueltas' => array('ENCONTRÁ ESA CARTA', 'Cartas sueltas.', 'Buscá entre todas las cartas disponibles y afiná los resultados hasta encontrar exactamente la que necesitás.', 'Nombre de la carta', 'Ej: Black Lotus'),
        'tcg' => array('TRADING CARD GAMES', 'Sellado y singles.', 'Sobres, booster boxes, bundles, mazos y ediciones especiales de tus juegos favoritos.', 'Buscar producto', 'Ej: Booster Box'),
        'juegos-de-mesa' => array('PARA COMPARTIR LA MESA', 'Juegos de mesa.', 'Estrategia, party games, cooperativos y familiares de las mejores editoriales.', 'Buscar juego', 'Ej: Catan'),
        'accesorios' => array('CUIDÁ TU COLECCIÓN', 'Accesorios.', 'Sleeves, deck boxes, carpetas, playmats y todo lo necesario para jugar y proteger tus cartas.', 'Buscar accesorio', 'Ej: Dragon Shield'),
        'preventas' => array('RESERVÁ EL TUYO', 'Preventas.', 'Próximos lanzamientos disponibles para reservar antes que se agoten.', 'Buscar preventa', 'Ej: nombre del producto'),
    );
}

function gravedad_section_hero_image($section) {
    $images = array(
        'cartas-sueltas' => 'hero-cartas-sueltas.jpg',
        'tcg' => 'hero-tcg.jpg',
        'juegos-de-mesa' => 'hero-juegos-de-mesa.jpg',
        'accesorios' => 'hero-accesorios.jpg',
        'preventas' => 'hero-preventas.jpg',
    );
    return isset($images[$section]) ? get_template_directory_uri() . '/assets/img/' . $images[$section] : '';
}

function gravedad_filter_taxonomy_map() {
    $map = array();
    foreach (gravedad_section_filters() as $filters) {
        foreach ($filters as $param => $data) { $map[$param] = $data[1]; }
    }
    return $map;
}

function gravedad_catalog_tax_query_from_get() {
    $tax_query = array();
    foreach (gravedad_filter_taxonomy_map() as $param => $taxonomy) {
        if (!empty($_GET[$param]) && taxonomy_exists($taxonomy)) {
            $tax_query[] = array('taxonomy' => $taxonomy, 'field' => 'slug', 'terms' => sanitize_title(wp_unslash($_GET[$param])));
        }
    }
    if (count($tax_query) > 1) { $tax_query['relation'] = 'AND'; }
    return $tax_query;
}

function gravedad_catalog_meta_query_from_get() {
    $meta_query = array();
    $min = isset($_GET['precio_min']) ? floatval(wp_unslash($_GET['precio_min'])) : 0;
    $max = isset($_GET['precio_max']) ? floatval(wp_unslash($_GET['precio_max'])) : 0;
    if ($min && $max) { $meta_query[] = array('key' => '_price', 'value' => array($min, $max), 'compare' => 'BETWEEN', 'type' => 'NUMERIC'); }
    elseif ($min) { $meta_query[] = array('key' => '_price', 'value' => $min, 'compare' => '>=', 'type' => 'NUMERIC'); }
    elseif ($max) { $meta_query[] = array('key' => '_price', 'value' => $max, 'compare' => '<=', 'type' => 'NUMERIC'); }
    if (!empty($_GET['f_stock']) && in_array($_GET['f_stock'], array('instock', 'outofstock'), true)) {
        $meta_query[] = array('key' => '_stock_status', 'value' => sanitize_key($_GET['f_stock']));
    }
    return $meta_query;
}

function gravedad_active_filter_chips($filters_map) {
    $chips = array();
    foreach ($filters_map as $param => $data) {
        if (empty($_GET[$param])) { continue; }
        $slug = sanitize_title(wp_unslash($_GET[$param]));
        $term = get_term_by('slug', $slug, $data[1]);
        if ($term && !is_wp_error($term)) {
            $chips[] = array($param, $data[0] . ': ' . $term->name);
        }
    }
    if (!empty($_GET['precio_min']) || !empty($_GET['precio_max'])) {
        $min = !empty($_GET['precio_min']) ? '$' . number_format((float) wp_unslash($_GET['precio_min']), 0, ',', '.') : '';
        $max = !empty($_GET['precio_max']) ? '$' . number_format((float) wp_unslash($_GET['precio_max']), 0, ',', '.') : '';
        $label = 'Precio: ' . ($min && $max ? $min . ' - ' . $max : ($min ? 'desde ' . $min : 'hasta ' . $max));
        $chips[] = array('precio', $label);
    }
    if (!empty($_GET['f_stock'])) {
        $chips[] = array('f_stock', 'Disponibilidad: ' . ($_GET['f_stock'] === 'instock' ? 'En stock' : 'Sin stock'));
    }
    if (!empty($_GET['s'])) {
        $chips[] = array('s', 'Búsqueda: "' . sanitize_text_field(wp_unslash($_GET['s'])) . '"');
    }
    if (!$chips) { return; }
    echo '<div class="active-filters">';
    foreach ($chips as $chip) {
        list($param, $label) = $chip;
        $remove_args = $param === 'precio' ? array('precio_min', 'precio_max') : array($param);
        echo '<span class="filter-chip">' . esc_html($label) . '<a href="' . esc_url(remove_query_arg($remove_args)) . '" aria-label="Quitar filtro">×</a></span>';
    }
    $clear_args = array_merge(array_keys($filters_map), array('precio_min', 'precio_max', 'f_stock', 's'));
    echo '<a class="filter-chip-clear" href="' . esc_url(remove_query_arg($clear_args)) . '">Limpiar todo</a>';
    echo '</div>';
}

function gravedad_apply_catalog_filters($query) {
    if (is_admin() || !$query->is_main_query() || !function_exists('is_product_taxonomy') || !is_product_taxonomy()) { return; }
    $tax_query = array_merge((array) $query->get('tax_query'), gravedad_catalog_tax_query_from_get());
    if (count($tax_query) > 1 && !isset($tax_query['relation'])) { $tax_query['relation'] = 'AND'; }
    if ($tax_query) { $query->set('tax_query', $tax_query); }
    $meta_query = array_merge((array) $query->get('meta_query'), gravedad_catalog_meta_query_from_get());
    if ($meta_query) { $query->set('meta_query', $meta_query); }
}
add_action('pre_get_posts', 'gravedad_apply_catalog_filters');

function gravedad_filter_terms($taxonomy) {
    if (!taxonomy_exists($taxonomy)) { return array(); }
    $terms = get_terms(array('taxonomy' => $taxonomy, 'hide_empty' => true, 'orderby' => 'name'));
    return is_wp_error($terms) ? array() : $terms;
}

function gravedad_loop_game_label() {
    global $product;
    if (!$product) { return; }
    $terms = get_the_terms($product->get_id(), 'pa_juego');
    if ($terms && !is_wp_error($terms)) {
        echo '<span class="loop-game-label">' . esc_html($terms[0]->name) . '</span>';
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'gravedad_loop_game_label', 5);

function gravedad_render_product_grid($query) {
    echo '<div class="woocommerce">';
    if ($query->have_posts()) {
        echo '<ul class="products columns-4">';
        while ($query->have_posts()) { $query->the_post(); wc_get_template_part('content', 'product'); }
        echo '</ul>';
        wp_reset_postdata();
    } else {
        do_action('woocommerce_no_products_found');
    }
    echo '</div>';
}

function gravedad_single_product_badge() {
    global $product;
    if (!$product) { return; }
    if ($product->is_on_sale()) { echo '<span class="single-badge single-badge-sale">OFERTA</span>'; }
    elseif ((time() - strtotime(get_the_date('c'))) < 30 * DAY_IN_SECONDS) { echo '<span class="single-badge">NUEVO</span>'; }
}
add_action('woocommerce_before_single_product_summary', 'gravedad_single_product_badge', 5);

function gravedad_single_product_trust_badges() {
    echo '<ul class="trust-badges">';
    echo '<li>' . gravedad_icon('truck') . '<span><strong>Envío a todo el país</strong><small>Correo Argentino</small></span></li>';
    echo '<li>' . gravedad_icon('shield') . '<span><strong>Pago protegido</strong><small>Mercado Pago y tarjetas</small></span></li>';
    echo '<li>' . gravedad_icon('refresh') . '<span><strong>Cambios sin drama</strong><small>Hasta 10 días</small></span></li>';
    echo '</ul>';
}
add_action('woocommerce_single_product_summary', 'gravedad_single_product_trust_badges', 31);

add_filter('woocommerce_output_related_products_args', function ($args) {
    $args['posts_per_page'] = 10;
    return $args;
});

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/* ---- Eventos (CPT) ---- */

function gravedad_register_evento_cpt() {
    register_post_type('evento', array(
        'labels' => array(
            'name' => 'Eventos',
            'singular_name' => 'Evento',
            'add_new' => 'Añadir evento',
            'add_new_item' => 'Añadir nuevo evento',
            'edit_item' => 'Editar evento',
            'new_item' => 'Nuevo evento',
            'view_item' => 'Ver evento',
            'search_items' => 'Buscar eventos',
            'not_found' => 'No se encontraron eventos',
            'not_found_in_trash' => 'No hay eventos en la papelera',
            'all_items' => 'Todos los eventos',
            'menu_name' => 'Eventos',
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'evento'),
        'menu_icon' => 'dashicons-calendar-alt',
        'menu_position' => 26,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'gravedad_register_evento_cpt');

function gravedad_register_evento_meta() {
    foreach (array('fecha', 'hora', 'ubicacion', 'enlace') as $f) {
        register_post_meta('evento', '_evento_' . $f, array('type' => 'string', 'single' => true, 'show_in_rest' => true));
    }
}
add_action('init', 'gravedad_register_evento_meta');

function gravedad_evento_meta_box() {
    add_meta_box('gravedad_evento_datos', 'Datos del evento', 'gravedad_evento_meta_box_html', 'evento', 'side', 'high');
}
add_action('add_meta_boxes', 'gravedad_evento_meta_box');

function gravedad_evento_meta_box_html($post) {
    wp_nonce_field('gravedad_evento_save', 'gravedad_evento_nonce');
    $fecha = get_post_meta($post->ID, '_evento_fecha', true);
    $hora = get_post_meta($post->ID, '_evento_hora', true);
    if (!$hora) { $hora = '14:00 hs'; }
    $ubicacion = get_post_meta($post->ID, '_evento_ubicacion', true);
    if (!$ubicacion) { $ubicacion = gravedad_option('gravedad_event_location', 'José C. Paz, Buenos Aires'); }
    $enlace = get_post_meta($post->ID, '_evento_enlace', true);
    ?>
    <p><label for="gravedad_evento_fecha"><strong>Fecha</strong></label><br>
    <input type="date" id="gravedad_evento_fecha" name="gravedad_evento_fecha" value="<?php echo esc_attr($fecha); ?>" style="width:100%"></p>
    <p><label for="gravedad_evento_hora"><strong>Hora</strong></label><br>
    <input type="text" id="gravedad_evento_hora" name="gravedad_evento_hora" value="<?php echo esc_attr($hora); ?>" style="width:100%" placeholder="14:00 hs"></p>
    <p><label for="gravedad_evento_ubicacion"><strong>Ubicación</strong></label><br>
    <input type="text" id="gravedad_evento_ubicacion" name="gravedad_evento_ubicacion" value="<?php echo esc_attr($ubicacion); ?>" style="width:100%"></p>
    <p><label for="gravedad_evento_enlace"><strong>Enlace de inscripción</strong></label><br>
    <input type="url" id="gravedad_evento_enlace" name="gravedad_evento_enlace" value="<?php echo esc_attr($enlace); ?>" style="width:100%" placeholder="https://wa.me/... (opcional)"></p>
    <p style="color:#787c82;font-size:12px;margin-top:14px">📌 Subí el flyer del evento como <strong>Imagen destacada</strong>, en el panel de la derecha. Usá la <strong>Descripción</strong> (arriba) para los detalles del evento.</p>
    <?php
}

function gravedad_evento_save($post_id) {
    if (!isset($_POST['gravedad_evento_nonce']) || !wp_verify_nonce($_POST['gravedad_evento_nonce'], 'gravedad_evento_save')) { return; }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
    if (!current_user_can('edit_post', $post_id)) { return; }
    $fields = array('fecha', 'hora', 'ubicacion', 'enlace');
    foreach ($fields as $f) {
        $key = 'gravedad_evento_' . $f;
        if (isset($_POST[$key])) {
            $value = $f === 'enlace' ? esc_url_raw(wp_unslash($_POST[$key])) : sanitize_text_field(wp_unslash($_POST[$key]));
            update_post_meta($post_id, '_evento_' . $f, $value);
        }
    }
}
add_action('save_post_evento', 'gravedad_evento_save');

add_filter('manage_evento_posts_columns', function ($columns) {
    $new = array();
    foreach ($columns as $key => $label) {
        $new[$key] = $label;
        if ($key === 'title') { $new['evento_fecha'] = 'Fecha'; $new['evento_estado'] = 'Estado'; }
    }
    return $new;
});
add_action('manage_evento_posts_custom_column', function ($column, $post_id) {
    if ($column === 'evento_fecha') {
        $fecha = get_post_meta($post_id, '_evento_fecha', true);
        echo $fecha ? esc_html(date_i18n('d/m/Y', strtotime($fecha))) : '—';
    }
    if ($column === 'evento_estado') {
        $fecha = get_post_meta($post_id, '_evento_fecha', true);
        if (!$fecha) { echo '—'; return; }
        echo strtotime($fecha) >= strtotime('today') ? '<span style="color:#1a8a3c;font-weight:600">Próximo</span>' : '<span style="color:#9a9ba2">Pasado</span>';
    }
}, 10, 2);
add_filter('manage_edit-evento_sortable_columns', function ($columns) {
    $columns['evento_fecha'] = 'evento_fecha';
    return $columns;
});
add_action('pre_get_posts', function ($query) {
    if (!is_admin() || !$query->is_main_query()) { return; }
    if ($query->get('post_type') !== 'evento') { return; }
    if ($query->get('orderby') === 'evento_fecha') {
        $query->set('meta_query', array('relation' => 'OR', array('key' => '_evento_fecha', 'compare' => 'EXISTS'), array('key' => '_evento_fecha', 'compare' => 'NOT EXISTS')));
        $query->set('meta_key', '_evento_fecha');
        $query->set('orderby', 'meta_value');
    }
});

function gravedad_evento_meta($id, $key, $default = '') {
    $v = get_post_meta($id, '_evento_' . $key, true);
    return $v !== '' ? $v : $default;
}
