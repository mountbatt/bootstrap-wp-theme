<!DOCTYPE html>
<!--
Development: BÜRO BATTENBERG www.buerobattenberg.de 
-->
<html <?php language_attributes(); ?>>
  <head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <?php if(class_exists('ACF')): ?>
    <?php if(get_field( 'publisher', 'options' )): ?>
  <meta name="publisher" content="<?php the_field( 'publisher', 'options' ); ?>"/>
  <meta name="copyright" content="<?php the_field( 'publisher', 'options' ); ?>"/>
    <?php endif; ?>
  <?php endif; ?>

  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
  
  <?php wp_head(); ?>
  </head>
 
  <body <?php $class=""; body_class($class); ?>>
    
    <?php /* loading spinner 
    <div id="loader-wrapper">
      <div class="icon center-div">
        <i class="fa fa-circle-notch fa-spin fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    */ ?>
    
    <div id="main-wrap">
      
      
      <div id="header">
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" title="<?php echo get_bloginfo('site_title'); ?>" href="<?php echo get_home_url(); ?>">
                  <i class="bi bi-bootstrap-fill me-2" style="font-size: 2rem;"></i> <?php echo get_bloginfo('site-title'); ?>
                </a>
                
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="icon-bar top-bar"></span>
                  <span class="icon-bar middle-bar"></span>
                  <span class="icon-bar bottom-bar"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="main-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav ms-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 2,
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    ));
                    ?>
                </div>
            </div>
        </nav>
      </div>

    <div id="main-container" class="container">
    
    
      
      
