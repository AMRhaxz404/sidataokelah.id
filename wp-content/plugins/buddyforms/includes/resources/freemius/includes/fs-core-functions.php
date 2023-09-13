<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( ! function_exists( 'fs_dummy' ) ) { function fs_dummy() { } } if ( ! function_exists( 'fs_get_url_daily_cache_killer' ) ) { function fs_get_url_daily_cache_killer() { return date( '\YY\Mm\Dd' ); } } if ( ! function_exists( 'fs_get_template_path' ) ) { function fs_get_template_path( $path ) { return WP_FS__DIR_TEMPLATES . '/' . trim( $path, '/' ); } function fs_include_template( $path, &$params = null ) { $VARS = &$params; include fs_get_template_path( $path ); } function fs_include_once_template( $path, &$params = null ) { $VARS = &$params; include_once fs_get_template_path( $path ); } function fs_require_template( $path, &$params = null ) { $VARS = &$params; require fs_get_template_path( $path ); } function fs_require_once_template( $path, &$params = null ) { $VARS = &$params; require_once fs_get_template_path( $path ); } function fs_get_template( $path, &$params = null ) { ob_start(); $VARS = &$params; require fs_get_template_path( $path ); return ob_get_clean(); } } if ( ! function_exists( 'fs_asset_url' ) ) { function fs_asset_url( $asset_abs_path ) { $wp_content_dir = fs_normalize_path( WP_CONTENT_DIR ); $asset_abs_path = fs_normalize_path( $asset_abs_path ); if ( 0 === strpos( $asset_abs_path, $wp_content_dir ) ) { $asset_rel_path = str_replace( $wp_content_dir, '', $asset_abs_path ); $asset_url = content_url( fs_normalize_path( $asset_rel_path ) ); } else { $wp_plugins_dir = fs_normalize_path( WP_PLUGIN_DIR ); if ( 0 === strpos( $asset_abs_path, $wp_plugins_dir ) ) { $asset_rel_path = str_replace( $wp_plugins_dir, '', $asset_abs_path ); $asset_url = plugins_url( fs_normalize_path( $asset_rel_path ) ); } else { $active_theme_stylesheet = get_stylesheet(); $wp_themes_dir = fs_normalize_path( trailingslashit( get_theme_root( $active_theme_stylesheet ) ) ); $asset_rel_path = str_replace( $wp_themes_dir, '', fs_normalize_path( $asset_abs_path ) ); $asset_url = trailingslashit( get_theme_root_uri( $active_theme_stylesheet ) ) . fs_normalize_path( $asset_rel_path ); } } return $asset_url; } } if ( ! function_exists( 'fs_enqueue_local_style' ) ) { function fs_enqueue_local_style( $handle, $path, $deps = array(), $ver = false, $media = 'all' ) { wp_enqueue_style( $handle, fs_asset_url( WP_FS__DIR_CSS . '/' . trim( $path, '/' ) ), $deps, $ver, $media ); } } if ( ! function_exists( 'fs_enqueue_local_script' ) ) { function fs_enqueue_local_script( $handle, $path, $deps = array(), $ver = false, $in_footer = 'all' ) { wp_enqueue_script( $handle, fs_asset_url( WP_FS__DIR_JS . '/' . trim( $path, '/' ) ), $deps, $ver, $in_footer ); } } if ( ! function_exists( 'fs_img_url' ) ) { function fs_img_url( $path, $img_dir = WP_FS__DIR_IMG ) { return ( fs_asset_url( $img_dir . '/' . trim( $path, '/' ) ) ); } } if ( ! function_exists( 'fs_request_get_raw' ) ) { function fs_request_get_raw( $key, $def = false, $type = false ) { if ( is_string( $type ) ) { $type = strtolower( $type ); } switch ( $type ) { case 'post': $value = isset( $_POST[ $key ] ) ? $_POST[ $key ] : $def; break; case 'get': $value = isset( $_GET[ $key ] ) ? $_GET[ $key ] : $def; break; default: $value = isset( $_REQUEST[ $key ] ) ? $_REQUEST[ $key ] : $def; break; } return empty( $value ) ? $value : wp_unslash( $value ); } } if ( ! function_exists( 'fs_sanitize_input' ) ) { function fs_sanitize_input( $input ) { if ( is_array( $input ) ) { foreach ( $input as $key => $value ) { $input[ $key ] = fs_sanitize_input( $value ); } } else { $input = empty( $input ) ? $input : sanitize_text_field( $input ); } return $input; } } if ( ! function_exists( 'fs_request_get' ) ) { function fs_request_get( $key, $def = false, $type = false ) { return fs_sanitize_input( fs_request_get_raw( $key, $def, $type ) ); } } if ( ! function_exists( 'fs_request_has' ) ) { function fs_request_has( $key ) { return isset( $_REQUEST[ $key ] ); } } if ( ! function_exists( 'fs_request_get_bool' ) ) { function fs_request_get_bool( $key, $def = false ) { $val = fs_request_get( $key, null ); if ( is_null( $val ) ) { return $def; } if ( is_bool( $val ) ) { return $val; } else if ( is_numeric( $val ) ) { if ( 1 == $val ) { return true; } else if ( 0 == $val ) { return false; } } else if ( is_string( $val ) ) { $val = strtolower( $val ); if ( 'true' === $val ) { return true; } else if ( 'false' === $val ) { return false; } } return $def; } } if ( ! function_exists( 'fs_request_is_post' ) ) { function fs_request_is_post() { return ( 'post' === strtolower( $_SERVER['REQUEST_METHOD'] ) ); } } if ( ! function_exists( 'fs_request_is_get' ) ) { function fs_request_is_get() { return ( 'get' === strtolower( $_SERVER['REQUEST_METHOD'] ) ); } } if ( ! function_exists( 'fs_get_action' ) ) { function fs_get_action( $action_key = 'action' ) { if ( ! empty( $_REQUEST[ $action_key ] ) && is_string( $_REQUEST[ $action_key ] ) ) { return strtolower( $_REQUEST[ $action_key ] ); } if ( 'action' == $action_key ) { $action_key = 'fs_action'; if ( ! empty( $_REQUEST[ $action_key ] ) && is_string( $_REQUEST[ $action_key ] ) ) { return strtolower( $_REQUEST[ $action_key ] ); } } return false; } } if ( ! function_exists( 'fs_request_is_action' ) ) { function fs_request_is_action( $action, $action_key = 'action' ) { return ( strtolower( $action ) === fs_get_action( $action_key ) ); } } if ( ! function_exists( 'fs_request_is_action_secure' ) ) { function fs_request_is_action_secure( $action, $action_key = 'action', $nonce_key = 'nonce' ) { if ( strtolower( $action ) !== fs_get_action( $action_key ) ) { return false; } $nonce = ! empty( $_REQUEST[ $nonce_key ] ) ? $_REQUEST[ $nonce_key ] : ''; if ( empty( $nonce ) || ( false === wp_verify_nonce( $nonce, $action ) ) ) { return false; } return true; } } if ( ! function_exists( 'fs_is_plugin_page' ) ) { function fs_is_plugin_page( $page_slug ) { return ( is_admin() && $page_slug === fs_request_get( 'page' ) ); } } if ( ! function_exists( 'fs_get_raw_referer' ) ) { function fs_get_raw_referer() { if ( function_exists( 'wp_get_raw_referer' ) ) { return wp_get_raw_referer(); } if ( ! empty( $_REQUEST['_wp_http_referer'] ) ) { return wp_unslash( $_REQUEST['_wp_http_referer'] ); } else if ( ! empty( $_SERVER['HTTP_REFERER'] ) ) { return wp_unslash( $_SERVER['HTTP_REFERER'] ); } return false; } } if ( ! function_exists( 'fs_ui_action_button' ) ) { function fs_ui_action_button( $module_id, $page, $action, $title, $button_class = '', $params = array(), $is_primary = true, $is_small = false, $icon_class = false, $confirmation = false, $method = 'GET' ) { echo fs_ui_get_action_button( $module_id, $page, $action, $title, $button_class, $params, $is_primary, $is_small, $icon_class, $confirmation, $method ); } } if ( ! function_exists( 'fs_ui_get_action_button' ) ) { function fs_ui_get_action_button( $module_id, $page, $action, $title, $button_class = '', $params = array(), $is_primary = true, $is_small = false, $icon_class = false, $confirmation = false, $method = 'GET' ) { $title = ( is_string( $icon_class ) ? '<i class="' . $icon_class . '"></i> ' : '' ) . $title; if ( is_string( $confirmation ) ) { return sprintf( '<form action="%s" method="%s"><input type="hidden" name="fs_action" value="%s">%s<a href="#" class="%s" onclick="if (confirm(\'%s\')) this.parentNode.submit(); return false;">%s</a></form>', freemius( $module_id )->_get_admin_page_url( $page, $params ), $method, $action, wp_nonce_field( $action, '_wpnonce', true, false ), 'button' . ( ! empty( $button_class ) ? ' ' . $button_class : '' ) . ( $is_primary ? ' button-primary' : '' ) . ( $is_small ? ' button-small' : '' ), $confirmation, $title ); } else if ( 'GET' !== strtoupper( $method ) ) { return sprintf( '<form action="%s" method="%s"><input type="hidden" name="fs_action" value="%s">%s<a href="#" class="%s" onclick="this.parentNode.submit(); return false;">%s</a></form>', freemius( $module_id )->_get_admin_page_url( $page, $params ), $method, $action, wp_nonce_field( $action, '_wpnonce', true, false ), 'button' . ( ! empty( $button_class ) ? ' ' . $button_class : '' ) . ( $is_primary ? ' button-primary' : '' ) . ( $is_small ? ' button-small' : '' ), $title ); } else { return sprintf( '<a href="%s" class="%s">%s</a></form>', wp_nonce_url( freemius( $module_id )->_get_admin_page_url( $page, array_merge( $params, array( 'fs_action' => $action ) ) ), $action ), 'button' . ( ! empty( $button_class ) ? ' ' . $button_class : '' ) . ( $is_primary ? ' button-primary' : '' ) . ( $is_small ? ' button-small' : '' ), $title ); } } function fs_ui_action_link( $module_id, $page, $action, $title, $params = array() ) { ?><a class=""
                 href="<?php echo wp_nonce_url( freemius( $module_id )->_get_admin_page_url( $page, array_merge( $params, array( 'fs_action' => $action ) ) ), $action ) ?>"><?php echo $title ?></a><?php
 } } if ( ! function_exists( 'fs_get_entity' ) ) { function fs_get_entity( $entity, $class ) { if ( ! is_object( $entity ) || $entity instanceof $class ) { return $entity; } return new $class( $entity ); } } if ( ! function_exists( 'fs_get_entities' ) ) { function fs_get_entities( $entities, $class_name ) { if ( ! is_array( $entities ) || empty( $entities ) ) { return $entities; } $first_array_element = reset( $entities ); if ( $first_array_element instanceof $class_name ) { return $entities; } if ( is_array( $first_array_element ) && ! empty( $first_array_element ) ) { $first_array_element = reset( $first_array_element ); if ( $first_array_element instanceof $class_name ) { return $entities; } } foreach ( $entities as $key => $entities_or_entity ) { if ( is_array( $entities_or_entity ) ) { $entities[ $key ] = fs_get_entities( $entities_or_entity, $class_name ); } else { $entities[ $key ] = fs_get_entity( $entities_or_entity, $class_name ); } } return $entities; } } if ( ! function_exists( 'fs_nonce_url' ) ) { function fs_nonce_url( $actionurl, $action = - 1, $name = '_wpnonce' ) { return add_query_arg( $name, wp_create_nonce( $action ), $actionurl ); } } if ( ! function_exists( 'fs_starts_with' ) ) { function fs_starts_with( $haystack, $needle ) { $length = strlen( $needle ); return ( substr( $haystack, 0, $length ) === $needle ); } } if ( ! function_exists( 'fs_ends_with' ) ) { function fs_ends_with( $haystack, $needle ) { $length = strlen( $needle ); $start = $length * - 1; return ( substr( $haystack, $start ) === $needle ); } } if ( ! function_exists( 'fs_strip_url_protocol' ) ) { function fs_strip_url_protocol( $url ) { if ( ! fs_starts_with( $url, 'http' ) ) { return $url; } $protocol_pos = strpos( $url, '://' ); if ( $protocol_pos > 5 ) { return $url; } return substr( $url, $protocol_pos + 3 ); } } if ( ! function_exists( 'fs_canonize_url' ) ) { function fs_canonize_url( $url, $omit_host = false, $ignore_params = array() ) { $parsed_url = parse_url( strtolower( $url ) ); $canonical = ( ( $omit_host || ! isset( $parsed_url['host'] ) ) ? '' : $parsed_url['host'] ) . $parsed_url['path']; if ( isset( $parsed_url['query'] ) ) { parse_str( $parsed_url['query'], $queryString ); $canonical .= '?' . fs_canonize_query_string( $queryString, $ignore_params ); } return $canonical; } } if ( ! function_exists( 'fs_canonize_query_string' ) ) { function fs_canonize_query_string( array $params, array &$ignore_params, $params_prefix = false ) { if ( ! is_array( $params ) || 0 === count( $params ) ) { return ''; } $keys = fs_urlencode_rfc3986( array_keys( $params ) ); $values = fs_urlencode_rfc3986( array_values( $params ) ); $params = array_combine( $keys, $values ); uksort( $params, 'strcmp' ); $pairs = array(); foreach ( $params as $parameter => $value ) { $lower_param = strtolower( $parameter ); if ( in_array( $lower_param, $ignore_params ) || ( false !== $params_prefix && fs_starts_with( $lower_param, $params_prefix ) ) ) { continue; } if ( is_array( $value ) ) { natsort( $value ); foreach ( $value as $duplicate_value ) { $pairs[] = $lower_param . '=' . $duplicate_value; } } else { $pairs[] = $lower_param . '=' . $value; } } if ( 0 === count( $pairs ) ) { return ''; } return implode( "&", $pairs ); } } if ( ! function_exists( 'fs_urlencode_rfc3986' ) ) { function fs_urlencode_rfc3986( $input ) { if ( is_array( $input ) ) { return array_map( 'fs_urlencode_rfc3986', $input ); } else if ( is_scalar( $input ) ) { return str_replace( '+', ' ', str_replace( '%7E', '~', rawurlencode( $input ) ) ); } return ''; } } if ( ! function_exists( 'fs_download_image' ) ) { function fs_download_image( $from, $to ) { $dir = dirname( $to ); if ( 'direct' !== get_filesystem_method( array(), $dir ) ) { return false; } if ( ! class_exists( 'WP_Filesystem_Direct' ) ) { require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php'; require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php'; } $fs = new WP_Filesystem_Direct( '' ); $tmpfile = download_url( $from ); if ( $tmpfile instanceof WP_Error ) { return false; } $fs->copy( $tmpfile, $to ); $fs->delete( $tmpfile ); return true; } } if ( ! function_exists( 'fs_sort_by_priority' ) ) { function fs_sort_by_priority( $a, $b ) { if ( ! isset( $a['priority'] ) && isset( $b['priority'] ) ) { return 1; } elseif ( isset( $a['priority'] ) && ! isset( $b['priority'] ) ) { return - 1; } elseif ( ( ! isset( $a['priority'] ) && ! isset( $b['priority'] ) ) || $a['priority'] === $b['priority'] ) { return 0; } return ( $a['priority'] < $b['priority'] ) ? - 1 : 1; } } global $fs_text_overrides; if ( ! isset( $fs_text_overrides ) ) { $fs_text_overrides = array(); } if ( ! function_exists( 'fs_text' ) ) { function fs_text( $key, $slug = 'freemius' ) { global $fs_text_overrides; if ( isset( $fs_text_overrides[ $slug ] ) ) { if ( isset( $fs_text_overrides[ $slug ][ $key ] ) ) { return $fs_text_overrides[ $slug ][ $key ]; } $lower_key = strtolower( $key ); if ( isset( $fs_text_overrides[ $slug ][ $lower_key ] ) ) { return $fs_text_overrides[ $slug ][ $lower_key ]; } } return $key; } function _fs_text_x_inline( $text, $context, $key = '', $slug = 'freemius' ) { list( $text, $text_domain ) = fs_text_and_domain( $text, $key, $slug ); $fn = 'translate_with_gettext_context'; return $fn( $text, $context, $text_domain ); } function fs_text_x_inline( $text, $context, $key = '', $slug = 'freemius' ) { return _fs_text_x_inline( $text, $context, $key, $slug ); } function fs_echo( $key, $slug = 'freemius' ) { echo fs_text( $key, $slug ); } function fs_echo_inline( $text, $key = '', $slug = 'freemius' ) { echo _fs_text_inline( $text, $key, $slug ); } function fs_echo_x_inline( $text, $context, $key = '', $slug = 'freemius' ) { echo _fs_text_x_inline( $text, $context, $key, $slug ); } } if ( ! function_exists( 'fs_text_override' ) ) { function fs_text_override( $text, $key, $slug ) { global $fs_text_overrides; if ( ! isset( $fs_text_overrides[ $slug ] ) ) { return false; } if ( empty( $key ) ) { $key = strtolower( str_replace( ' ', '-', $text ) ); } if ( isset( $fs_text_overrides[ $slug ][ $key ] ) ) { return $fs_text_overrides[ $slug ][ $key ]; } $lower_key = strtolower( $key ); if ( isset( $fs_text_overrides[ $slug ][ $lower_key ] ) ) { return $fs_text_overrides[ $slug ][ $lower_key ]; } return false; } } if ( ! function_exists( 'fs_text_and_domain' ) ) { function fs_text_and_domain( $text, $key, $slug ) { $override = fs_text_override( $text, $key, $slug ); if ( false === $override ) { $text_domain = 'freemius'; } else { $text = $override; $text_domain = $slug; } return array( $text, $text_domain ); } } if ( ! function_exists( '_fs_text_inline' ) ) { function _fs_text_inline( $text, $key = '', $slug = 'freemius' ) { list( $text, $text_domain ) = fs_text_and_domain( $text, $key, $slug ); $fn = 'translate'; return $fn( $text, $text_domain ); } } if ( ! function_exists( 'fs_text_inline' ) ) { function fs_text_inline( $text, $key = '', $slug = 'freemius' ) { return _fs_text_inline( $text, $key, $slug ); } } if ( ! function_exists( 'fs_esc_attr' ) ) { function fs_esc_attr( $key, $slug ) { return esc_attr( fs_text( $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_attr_inline' ) ) { function fs_esc_attr_inline( $text, $key = '', $slug = 'freemius' ) { return esc_attr( _fs_text_inline( $text, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_attr_x_inline' ) ) { function fs_esc_attr_x_inline( $text, $context, $key = '', $slug = 'freemius' ) { return esc_attr( _fs_text_x_inline( $text, $context, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_attr_echo' ) ) { function fs_esc_attr_echo( $key, $slug ) { echo esc_attr( fs_text( $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_attr_echo_inline' ) ) { function fs_esc_attr_echo_inline( $text, $key = '', $slug = 'freemius' ) { echo esc_attr( _fs_text_inline( $text, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_js' ) ) { function fs_esc_js( $key, $slug ) { return esc_js( fs_text( $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_js_inline' ) ) { function fs_esc_js_inline( $text, $key = '', $slug = 'freemius' ) { return esc_js( _fs_text_inline( $text, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_js_x_inline' ) ) { function fs_esc_js_x_inline( $text, $context, $key = '', $slug = 'freemius' ) { return esc_js( _fs_text_x_inline( $text, $context, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_js_echo_x_inline' ) ) { function fs_esc_js_echo_x_inline( $text, $context, $key = '', $slug = 'freemius' ) { echo esc_js( _fs_text_x_inline( $text, $context, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_js_echo' ) ) { function fs_esc_js_echo( $key, $slug ) { echo esc_js( fs_text( $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_js_echo_inline' ) ) { function fs_esc_js_echo_inline( $text, $key = '', $slug = 'freemius' ) { echo esc_js( _fs_text_inline( $text, $key, $slug ) ); } } if ( ! function_exists( 'fs_json_encode_echo' ) ) { function fs_json_encode_echo( $key, $slug ) { echo json_encode( fs_text( $key, $slug ) ); } } if ( ! function_exists( 'fs_json_encode_echo_inline' ) ) { function fs_json_encode_echo_inline( $text, $key = '', $slug = 'freemius' ) { echo json_encode( _fs_text_inline( $text, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_html' ) ) { function fs_esc_html( $key, $slug ) { return esc_html( fs_text( $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_html_inline' ) ) { function fs_esc_html_inline( $text, $key = '', $slug = 'freemius' ) { return esc_html( _fs_text_inline( $text, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_html_x_inline' ) ) { function fs_esc_html_x_inline( $text, $context, $key = '', $slug = 'freemius' ) { return esc_html( _fs_text_x_inline( $text, $context, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_html_echo_x_inline' ) ) { function fs_esc_html_echo_x_inline( $text, $context, $key = '', $slug = 'freemius' ) { echo esc_html( _fs_text_x_inline( $text, $context, $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_html_echo' ) ) { function fs_esc_html_echo( $key, $slug ) { echo esc_html( fs_text( $key, $slug ) ); } } if ( ! function_exists( 'fs_esc_html_echo_inline' ) ) { function fs_esc_html_echo_inline( $text, $key = '', $slug = 'freemius' ) { echo esc_html( _fs_text_inline( $text, $key, $slug ) ); } } if ( ! function_exists( 'fs_override_i18n' ) ) { function fs_override_i18n( array $key_value, $slug = 'freemius' ) { global $fs_text_overrides; if ( ! isset( $fs_text_overrides[ $slug ] ) ) { $fs_text_overrides[ $slug ] = array(); } foreach ( $key_value as $key => $value ) { $fs_text_overrides[ $slug ][ $key ] = $value; } } } if ( ! function_exists( 'fs_is_plugin_uninstall' ) ) { function fs_is_plugin_uninstall() { return ( defined( 'WP_UNINSTALL_PLUGIN' ) || ( 0 < did_action( 'pre_uninstall_plugin' ) ) ); } } if ( ! function_exists( 'fs_is_network_admin' ) ) { function fs_is_network_admin() { return ( WP_FS__IS_NETWORK_ADMIN || ( is_multisite() && fs_is_plugin_uninstall() ) ); } } if ( ! function_exists( 'fs_is_blog_admin' ) ) { function fs_is_blog_admin() { return ( WP_FS__IS_BLOG_ADMIN || ( ! is_multisite() && fs_is_plugin_uninstall() ) ); } } if ( ! function_exists( 'fs_apply_filter' ) ) { function fs_apply_filter( $module_unique_affix, $tag, $value ) { $args = func_get_args(); return call_user_func_array( 'apply_filters', array_merge( array( "fs_{$tag}_{$module_unique_affix}" ), array_slice( $args, 2 ) ) ); } }