<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( ! function_exists( 'fs_html_get_allowed_kses_list' ) ) { function fs_html_get_allowed_kses_list() { $common_attributes = array( 'class' => true, 'style' => true, 'data-*' => true, ); return array( 'a' => array_merge( $common_attributes, array( 'href' => true, 'title' => true, 'target' => true, 'rel' => true, ) ), 'img' => array_merge( $common_attributes, array( 'src' => true, 'alt' => true, 'title' => true, 'width' => true, 'height' => true, ) ), 'br' => $common_attributes, 'em' => $common_attributes, 'small' => $common_attributes, 'strong' => $common_attributes, 'u' => $common_attributes, 'b' => $common_attributes, 'hr' => $common_attributes, 'span' => $common_attributes, 'p' => $common_attributes, 'div' => $common_attributes, 'ul' => $common_attributes, 'li' => $common_attributes, 'ol' => $common_attributes, 'h1' => $common_attributes, 'h2' => $common_attributes, 'h3' => $common_attributes, 'h4' => $common_attributes, 'h5' => $common_attributes, 'h6' => $common_attributes, 'button' => $common_attributes, 'sup' => $common_attributes, 'sub' => $common_attributes, 'nobr' => $common_attributes, ); } } if ( ! function_exists( 'fs_html_get_classname' ) ) { function fs_html_get_classname( $classes ) { if ( is_array( $classes ) ) { $classes = implode( ' ', $classes ); } return esc_attr( $classes ); } } if ( ! function_exists( 'fs_html_get_attributes' ) ) { function fs_html_get_attributes( $attributes ) { $attribute_string = ''; foreach ( $attributes as $key => $value ) { $attribute_string .= sprintf( ' %1$s="%2$s"', esc_attr( $key ), esc_attr( $value ) ); } return $attribute_string; } } if ( ! function_exists( 'fs_html_get_sanitized_html' ) ) { function fs_html_get_sanitized_html( $raw_html ) { return wp_kses( $raw_html, fs_html_get_allowed_kses_list() ); } } 