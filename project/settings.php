<?php

define('DISPLAY_ERRORS', 1);

define('INCLUDE_PATH', './scripts' . PATH_SEPARATOR . './modules');

$conf = array(
  'sitename' => 'Web-project',
  'theme' => './theme',
  'charset' => 'UTF-8',
  'clean_urls' => TRUE,
  'display_errors' => 1,
  'date_format' => 'Y.m.d',
  'date_format_2' => 'Y.m.d H:i',
  'date_format_3' => 'd.m.Y',
  'basedir' => '/web-lessons-back.github.io/project/',
  'login' => 'admin',
  'password' => '123',
);

$urlconf = array(
  '/^project$/' => array('module' => 'project'),
  '' => array('module' => 'front','method' => ['get', 'post']),
  '/^login$/' => array('module' => 'login'),
  '/^admin$/' => array('module' => 'admin'),
  '/^logout$/' => array('module' => 'logout')
);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Content-Type: text/html; charset=' . $conf['charset']);