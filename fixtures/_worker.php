<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Config\App();
$ema = $app->getContainer()->get('ema');

require __DIR__.'/topics.php';
echo PHP_EOL.'topics done!'.PHP_EOL;

require __DIR__.'/formats.php';
echo PHP_EOL.'formats done!'.PHP_EOL;

require __DIR__.'/contentsType.php';
echo PHP_EOL.'contentsType done!'.PHP_EOL;

require __DIR__.'/articleExample.php';
echo PHP_EOL.'articleExample done!'.PHP_EOL;

function cleanUp($enQualifiedName, $ema)
{
    $entities = $ema->getRepository($enQualifiedName)->findAll();
    foreach ($entities as $entity) {
        $ema->remove($entity);
    }
    $ema->flush();
}
