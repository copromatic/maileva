<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 *
 * Bootstraper for PHPUnit tests.
 */
$loader = require_once __DIR__ . '/../vendor/autoload.php';
$loader->add('Maileva\\', __DIR__.'/Elements/');
$loader->add('Maileva\\', __DIR__.'/Ftp/');
