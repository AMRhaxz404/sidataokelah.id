<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_Admin_Notices { protected $_module_unique_affix; protected $_id; protected $_title; protected $_notices; protected $_network_notices; private $_blog_id = 0; private $_is_multisite; private static $_instances = array(); static function instance( $id, $title = '', $module_unique_affix = '', $is_network_and_blog_admins = false ) { if ( ! isset( self::$_instances[ $id ] ) ) { self::$_instances[ $id ] = new FS_Admin_Notices( $id, $title, $module_unique_affix, $is_network_and_blog_admins ); } return self::$_instances[ $id ]; } protected function __construct( $id, $title = '', $module_unique_affix = '', $is_network_and_blog_admins = false ) { $this->_id = $id; $this->_title = $title; $this->_module_unique_affix = $module_unique_affix; $this->_is_multisite = is_multisite(); if ( $this->_is_multisite ) { $this->_blog_id = get_current_blog_id(); $this->_network_notices = FS_Admin_Notice_Manager::instance( $id, $title, $module_unique_affix, $is_network_and_blog_admins, true ); } $this->_notices = FS_Admin_Notice_Manager::instance( $id, $title, $module_unique_affix, false, $this->_blog_id ); } function add( $message, $title = '', $type = 'success', $is_sticky = false, $id = '', $store_if_sticky = true, $network_level_or_blog_id = null, $is_dimissible = null ) { $notices = $this->get_site_or_network_notices( $id, $network_level_or_blog_id ); $notices->add( $message, $title, $type, $is_sticky, $id, $store_if_sticky, null, null, false, $is_dimissible ); } function remove_sticky( $ids, $network_level_or_blog_id = null, $store = true ) { if ( ! is_array( $ids ) ) { $ids = array( $ids ); } if ( $this->should_use_network_notices( $ids[0], $network_level_or_blog_id ) ) { $notices = $this->_network_notices; } else { $notices = $this->get_site_notices( $network_level_or_blog_id ); } return $notices->remove_sticky( $ids, $store ); } function has_sticky( $id, $network_level_or_blog_id = null ) { $notices = $this->get_site_or_network_notices( $id, $network_level_or_blog_id ); return $notices->has_sticky( $id ); } function add_sticky( $message, $id, $title = '', $type = 'success', $network_level_or_blog_id = null, $wp_user_id = null, $plugin_title = null, $is_network_and_blog_admins = false, $is_dismissible = true, $data = array() ) { $notices = $this->get_site_or_network_notices( $id, $network_level_or_blog_id ); $notices->add_sticky( $message, $id, $title, $type, $wp_user_id, $plugin_title, $is_network_and_blog_admins, $is_dismissible, $data ); } function get_sticky( $id, $network_level_or_blog_id ) { $notices = $this->get_site_or_network_notices( $id, $network_level_or_blog_id ); return $notices->get_sticky( $id ); } function clear_all_sticky( $network_level_or_blog_id = null, $is_temporary = false ) { if ( ! $this->_is_multisite || false === $network_level_or_blog_id || 0 == $network_level_or_blog_id || is_null( $network_level_or_blog_id ) ) { $notices = $this->get_site_notices( $network_level_or_blog_id ); $notices->clear_all_sticky( $is_temporary ); } if ( $this->_is_multisite && ( true === $network_level_or_blog_id || is_null( $network_level_or_blog_id ) ) ) { $this->_network_notices->clear_all_sticky( $is_temporary ); } } function add_all( $message, $title = '', $type = 'success', $is_sticky = false, $id = '' ) { $this->add( $message, $title, $type, $is_sticky, true, $id ); } private function get_site_notices( $blog_id = 0 ) { if ( 0 == $blog_id || $blog_id == $this->_blog_id ) { return $this->_notices; } return FS_Admin_Notice_Manager::instance( $this->_id, $this->_title, $this->_module_unique_affix, false, $blog_id ); } private function should_use_network_notices( $id = '', $network_level_or_blog_id = null ) { if ( ! $this->_is_multisite ) { return false; } if ( is_numeric( $network_level_or_blog_id ) ) { return false; } if ( is_bool( $network_level_or_blog_id ) ) { return $network_level_or_blog_id; } return fs_is_network_admin(); } private function get_site_or_network_notices( $id, $network_level_or_blog_id ) { return $this->should_use_network_notices( $id, $network_level_or_blog_id ) ? $this->_network_notices : $this->get_site_notices( $network_level_or_blog_id ); } }