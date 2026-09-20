<?php
// Personalización DevLog LP — se ejecuta con: wp eval-file personalizar.php

function dl_pagina( $titulo, $slug, $contenido, $sin_barra = false ) {
	$existe = get_page_by_path( $slug );
	$datos  = array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => $titulo,
		'post_name'    => $slug,
		'post_content' => $contenido,
	);
	if ( $existe ) {
		$datos['ID'] = $existe->ID;
		$id          = wp_update_post( $datos );
	} else {
		$id = wp_insert_post( $datos );
	}
	if ( $sin_barra ) {
		update_post_meta( $id, 'site-sidebar-layout', 'no-sidebar' );
		update_post_meta( $id, 'site-post-title', 'disabled' );
		update_post_meta( $id, 'ast-site-content-layout', 'normal-width-container' );
		update_post_meta( $id, 'site-content-style', 'unboxed' );
	}
	echo "Página: $titulo (ID $id)\n";
	return $id;
}

// ---------- Portada ----------
$portada = <<<'HTML'
<!-- wp:group {"className":"dl-hero"} -->
<div class="wp-block-group dl-hero"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">💜 DevLog LP 💚</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Aprende lenguajes de programación, paradigmas y despliegue con Docker, explicado paso a paso.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/blog/">Leer el blog</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"dl-btn-borde"} -->
<div class="wp-block-button dl-btn-borde"><a class="wp-block-button__link wp-element-button" href="/recursos/">Ver recursos</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:heading {"className":"dl-seccion-titulo"} -->
<h2 class="wp-block-heading dl-seccion-titulo">¿Qué vas a <mark>encontrar</mark> aquí?</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"className":"dl-tarjeta"} -->
<div class="wp-block-column dl-tarjeta"><!-- wp:paragraph {"className":"dl-icono"} -->
<p class="dl-icono">🧠</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Paradigmas</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Imperativo, orientado a objetos y funcional, con ejemplos claros y comparaciones.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"dl-tarjeta"} -->
<div class="wp-block-column dl-tarjeta"><!-- wp:paragraph {"className":"dl-icono"} -->
<p class="dl-icono">💻</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Código real</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Python, Java y Haskell resolviendo el mismo problema, con resaltado de sintaxis.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"dl-tarjeta"} -->
<div class="wp-block-column dl-tarjeta"><!-- wp:paragraph {"className":"dl-icono"} -->
<p class="dl-icono">🐳</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Docker</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Contenedores, volúmenes y redes: cómo este mismo sitio corre con Docker Compose.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"className":"dl-cifras"} -->
<div class="wp-block-columns dl-cifras"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"dl-num"} -->
<p class="dl-num">5</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>contenedores Docker</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"dl-num"} -->
<p class="dl-num">3</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>paradigmas explicados</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"dl-num"} -->
<p class="dl-num">3</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>lenguajes comparados</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:heading {"className":"dl-seccion-titulo"} -->
<h2 class="wp-block-heading dl-seccion-titulo">Últimas <mark>publicaciones</mark></h2>
<!-- /wp:heading -->

<!-- wp:latest-posts {"postsToShow":3,"displayPostContent":true,"excerptLength":20,"displayPostDate":true,"postLayout":"grid","columns":3} /-->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p>“Los programas deben escribirse para que las personas los lean, y solo de forma incidental para que las máquinas los ejecuten.”</p>
<!-- /wp:paragraph --><cite>Harold Abelson</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:group {"className":"dl-cta"} -->
<div class="wp-block-group dl-cta"><!-- wp:heading -->
<h2 class="wp-block-heading">¿Listo para aprender? 🚀</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Explora los artículos o escríbenos si quieres proponer un tema.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contacto/">Contáctanos</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
HTML;

// ---------- Recursos ----------
$recursos = <<<'HTML'
<!-- wp:paragraph -->
<p>Una selección de herramientas y documentación oficial para seguir aprendiendo.</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Lenguaje / herramienta</th><th>Paradigma principal</th><th>Documentación oficial</th></tr></thead><tbody><tr><td>🐍 Python</td><td>Multiparadigma</td><td><a href="https://docs.python.org/es/3/">docs.python.org</a></td></tr><tr><td>☕ Java</td><td>Orientado a objetos</td><td><a href="https://dev.java/learn/">dev.java</a></td></tr><tr><td>λ Haskell</td><td>Funcional</td><td><a href="https://www.haskell.org/documentation/">haskell.org</a></td></tr><tr><td>🟨 JavaScript</td><td>Multiparadigma</td><td><a href="https://developer.mozilla.org/es/docs/Web/JavaScript">MDN Web Docs</a></td></tr><tr><td>🐳 Docker</td><td>Contenedores</td><td><a href="https://docs.docker.com/">docs.docker.com</a></td></tr><tr><td>📝 WordPress</td><td>CMS en PHP</td><td><a href="https://developer.wordpress.org/">developer.wordpress.org</a></td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Servicios de este proyecto</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><strong>WordPress</strong>: el sitio web, en el puerto 8080</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>MySQL 8</strong>: la base de datos, solo en la red interna</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>phpMyAdmin</strong>: administrador de la base de datos, en el puerto 8081</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Adminer</strong>: administrador ligero de la base de datos, en el puerto 8082</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Dozzle</strong>: logs de los contenedores en vivo, en el puerto 8888</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
HTML;

// ---------- Contacto ----------
$contacto = <<<'HTML'
<!-- wp:paragraph -->
<p>¿Tienes una duda, una corrección o quieres proponer un tema para el blog? ¡Escríbenos!</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"className":"dl-tarjeta"} -->
<div class="wp-block-column dl-tarjeta"><!-- wp:paragraph {"className":"dl-icono"} -->
<p class="dl-icono">📧</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Correo</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>contacto@devlog-lp.local</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"dl-tarjeta"} -->
<div class="wp-block-column dl-tarjeta"><!-- wp:paragraph {"className":"dl-icono"} -->
<p class="dl-icono">🎓</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Universidad</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>UJAP — Lenguajes de Programación (LPR07304)</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"dl-tarjeta"} -->
<div class="wp-block-column dl-tarjeta"><!-- wp:paragraph {"className":"dl-icono"} -->
<p class="dl-icono">💬</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Comentarios</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>También puedes dejar un comentario en cualquier artículo.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
HTML;

$id_inicio   = dl_pagina( 'Inicio', 'inicio', $portada, true );
$id_blog     = dl_pagina( 'Blog', 'blog', '' );
$id_recursos = dl_pagina( 'Recursos', 'recursos', $recursos );
$id_contacto = dl_pagina( 'Contacto', 'contacto', $contacto );

// Portada estática + página de entradas
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $id_inicio );
update_option( 'page_for_posts', $id_blog );
echo "Portada = Inicio, entradas = Blog\n";

// ---------- Menú ----------
$menu_id = 4;
foreach ( wp_get_nav_menu_items( $menu_id ) as $item ) {
	wp_delete_post( $item->ID, true );
}
$orden = 1;
$add   = function ( $args ) use ( $menu_id, &$orden ) {
	$args['menu-item-status']   = 'publish';
	$args['menu-item-position'] = $orden++;
	return wp_update_nav_menu_item( $menu_id, 0, $args );
};
$add( array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $id_inicio, 'menu-item-title' => 'Inicio' ) );
$padre = $add( array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $id_blog, 'menu-item-title' => 'Blog' ) );
$add( array( 'menu-item-type' => 'taxonomy', 'menu-item-object' => 'category', 'menu-item-object-id' => 2, 'menu-item-parent-id' => $padre ) );
$add( array( 'menu-item-type' => 'taxonomy', 'menu-item-object' => 'category', 'menu-item-object-id' => 3, 'menu-item-parent-id' => $padre ) );
$add( array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $id_recursos ) );
$add( array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => 6 ) );
$add( array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $id_contacto ) );
echo "Menú actualizado (Blog con submenú de categorías)\n";

// ---------- Colores: llegan del docker-compose.yml (variables DL_COLOR_*) ----------
// Si la variable no está definida en el compose, se usa el valor de respaldo.
function dl_color( $variable, $respaldo ) {
	$valor = getenv( $variable );
	// Solo se acepta un color hexadecimal válido (#abc o #aabbcc).
	return ( $valor && preg_match( '/^#[0-9a-fA-F]{3,8}$/', trim( $valor ) ) ) ? trim( $valor ) : $respaldo;
}

$colores = array(
	'lila'         => dl_color( 'DL_COLOR_LILA', '#9B59D0' ),
	'lila-oscuro'  => dl_color( 'DL_COLOR_LILA_OSCURO', '#6A2C91' ),
	'lila-claro'   => dl_color( 'DL_COLOR_LILA_CLARO', '#F3E8FC' ),
	'verde'        => dl_color( 'DL_COLOR_VERDE', '#8DC63F' ),
	'verde-oscuro' => dl_color( 'DL_COLOR_VERDE_OSCURO', '#5E8C1F' ),
	'texto'        => dl_color( 'DL_COLOR_TEXTO', '#2D1B3D' ),
	'fondo'        => dl_color( 'DL_COLOR_FONDO', '#FBF7FE' ),
);
echo "Colores desde el compose:\n";
foreach ( $colores as $nombre => $valor ) {
	echo "  --$nombre: $valor\n";
}

// ---------- Astra: paleta, barra lateral, pie ----------
$s = get_option( 'astra-settings', array() );
$s['global-color-palette'] = array(
	'palette' => array(
		$colores['lila'],
		$colores['verde'],
		$colores['lila-oscuro'],
		$colores['texto'],
		$colores['fondo'],
		'#FFFFFF',
		$colores['lila-claro'],
		'#1F1530',
		$colores['verde-oscuro'],
	),
);
$s['site-sidebar-layout']     = 'right-sidebar';
$s['footer-copyright-editor'] = '<p>© [current_year] <strong>DevLog LP</strong> 💜💚 Hecho con WordPress + Docker · UJAP · Lenguajes de Programación</p>';
update_option( 'astra-settings', $s );
echo "Astra: paleta lila/verde, barra lateral derecha, pie de página\n";

// ---------- CSS adicional ----------
// El bloque :root se genera con los colores del compose y se antepone al CSS.
$root = ":root{\n";
foreach ( $colores as $nombre => $valor ) {
	$root .= "  --$nombre:$valor;\n";
}
$root .= "}\n";
$css = $root . file_get_contents( '/personalizacion/estilo.css' );
$r   = wp_update_custom_css_post( $css, array( 'stylesheet' => get_stylesheet() ) );
echo is_wp_error( $r ) ? 'Error CSS: ' . $r->get_error_message() . "\n" : "CSS adicional aplicado\n";

// ---------- Widget de bienvenida en la barra lateral ----------
$bloques = get_option( 'widget_block', array() );
$bloques[99] = array( 'content' => '<!-- wp:group {"className":"dl-bienvenida"} --><div class="wp-block-group dl-bienvenida"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">👋 ¡Bienvenido!</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Blog de la materia <strong>Lenguajes de Programación</strong> de la UJAP, desplegado con Docker.</p><!-- /wp:paragraph --></div><!-- /wp:group -->' );
update_option( 'widget_block', $bloques );
$sidebars = get_option( 'sidebars_widgets', array() );
if ( ! in_array( 'block-99', $sidebars['sidebar-1'] ?? array(), true ) ) {
	array_unshift( $sidebars['sidebar-1'], 'block-99' );
	update_option( 'sidebars_widgets', $sidebars );
}
echo "Widget de bienvenida agregado\n";

flush_rewrite_rules();
echo "Listo\n";
