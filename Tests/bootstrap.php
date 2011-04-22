<?php

require_once $_SERVER['SYMFONY'] . '/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Orchestra\\S3StreamBundle' => '../../',
    'Symfony' => $_SERVER['SYMFONY'],
));
$loader->registerPrefixFallback(array(
    $_SERVER['PEAR'],
));
$loader->register();
