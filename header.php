<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php
      echo get_template_directory_uri() . '/style.css';
    ?>
    ">
    <title>Salvage Party</title>
  </head>

  <body>
    <header class="pageHeader">
      <h1>
        <a href="#"><img src="<?php
          echo get_template_directory_uri() . '/images/header_logo.png';
        ?>" alt="Salvage Party" /></a>
      </h1>

      <nav class="pageHeader__navigation">
        <ul>
          <li><a href="#">ABOUT</a></li>
          <li><a href="#">ACTION</a></li>
          <li><a href="#">SCHEDULE</a></li>
          <li><a href="#">TOPIC</a></li>
          <li><a href="#">REPORT</a></li>
          <li><a href="#">FEATURE</a></li>
        </ul>
      </nav>

      <ul class="pageHeader__contactList">
        <li><a href="#"><img src="<?php
          echo get_template_directory_uri() . '/images/contact_mail.png';
        ?>" alt="Salvage Party" /></a></li>
        <li><a href="#"><img src="<?php
          echo get_template_directory_uri() . '/images/contact_twitter.png';
        ?>" alt="Salvage Party" /></a></li>
        <li><a href="#"><img src="<?php
          echo get_template_directory_uri() . '/images/contact_facebook.png';
        ?>" alt="Salvage Party" /></a></li>
      </ul>
    </header>
