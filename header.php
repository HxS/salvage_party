<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php
      echo get_template_directory_uri() . '/build.css';
    ?>">
    <link rel="stylesheet" href="<?php
      echo get_template_directory_uri() . '/style.css';
    ?>">
    <link rel="stylesheet" href="<?php
      echo get_template_directory_uri() . '/animate.css';
    ?>">
    <title>Salvage Party</title>
    <?php
      do_action( 'wp_head' );
    ?>
  </head>

  <body>
    <header class="pageHeader wow slideInDown">
      <h1 class="pageHeader__logo">
        <a href="<?php echo esc_url( get_home_url() ); ?>"><img src="<?php
          echo get_template_directory_uri() . '/images/header_logo.png';
        ?>" alt="Salvage Party" /></a>
      </h1>

      <nav class="pageHeader__navigation">
        <ul>
          <li><a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'about' ) ) );
          ?>">ABOUT</a></li>
          <li><a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'action' ) ) );
          ?>">ACTION</a></li>
          <li><a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'schedule' ) ) );
          ?>">SCHEDULE</a></li>
          <li><a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
          ?>">TOPIC</a></li>
          <li><a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'report' ) ) );
          ?>">REPORT</a></li>
          <li><a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'feature' ) ) );
          ?>">FEATURE</a></li>
        </ul>
      </nav>

      <ul class="pageHeader__contactList">
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) );
        ?>"><img src="<?php
          echo get_template_directory_uri() . '/images/contact_mail.png';
        ?>" alt="mail" class="sns-icon" /></a></li>
        <li><a href="https://twitter.com/salvageparty" target="_blank"><img src="<?php
          echo get_template_directory_uri() . '/images/contact_twitter.png';
        ?>" alt="twitter" class="sns-icon" /></a></li>
        <li><a href="https://www.facebook.com/salvage.party/" target="_blank"><img src="<?php
          echo get_template_directory_uri() . '/images/contact_facebook.png';
        ?>" alt="facebook" class="sns-icon" /></a></li>
      </ul>
    </header>
