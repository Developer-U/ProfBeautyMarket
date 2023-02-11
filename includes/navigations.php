<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

register_nav_menus( array(
    'primary' => 'Основное',
    'primary-mobile' => 'Основное мобильное меню',
    'secondary' => 'Вторичное',
    'about' =>'О компании',
    'interest' =>'Интересное',

));

function estore_primary_menu() {
    wp_nav_menu( [
        'theme_location'  => 'primary',
        'container_class' => 'page-header__menu',
        'menu_class'      => 'page-header__menu-list',  
        'menu_id'         => 'primary-menu'   
    ] );
}

function estore_primary_mobile_menu() {
    wp_nav_menu( [
        'theme_location'  => 'primary-mobile',
        'container_class' => 'opened-menu__mobile',
        'menu_class'      => 'mobile-menu-list',  
        'menu_id'         => 'primary-mobile-menu'   
    ] );
}

function estore_secondary_menu() {
    wp_nav_menu( [
        'theme_location'  => 'secondary',
        'container_class' => 'sidebar-container',     
        'menu_class'      => 'hero-sidebar__list',  
        'menu_id'         => 'secondary-menu'   
    ] );
}

function estore_about_menu() {
    wp_nav_menu( [
        'theme_location'  => 'about',           
        'menu_class'      => 'footer-menu__list',  
        'menu_id'         => 'about-menu'   
    ] );
}

function estore_interest_menu() {
    wp_nav_menu( [
        'theme_location'  => 'interest',           
        'menu_class'      => 'footer-menu__list',  
        'menu_id'         => 'interest-menu'   
    ] );
}

