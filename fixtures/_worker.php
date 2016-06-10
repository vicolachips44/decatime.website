<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Config\App();
$ema = $app->getContainer()->get('ema');

require __DIR__.'/topics.php';
echo PHP_EOL.'topics done!'.PHP_EOL;

function cleanUp($enQualifiedName, $ema)
{
    $entities = $ema->getRepository($enQualifiedName)->findAll();
    foreach ($entities as $entity) {
        $ema->remove($entity);
    }
    $ema->flush();
}
