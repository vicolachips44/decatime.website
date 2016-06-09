<?php

require_once __DIR__.'/autoload.php';

$app = new \Config\App();
$container = $app->getContainer();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($container->get('ema'));
