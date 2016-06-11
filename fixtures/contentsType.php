<?php
use \Org\Decatime\Entity\ContentType as ContentType;

//cleanup
cleanUp('\Org\Decatime\Entity\ContentType', $ema);

$ema->persist(new ContentType(1, 'text'));
$ema->persist(new ContentType(2, 'image'));
$ema->persist(new ContentType(3, 'file'));
$ema->persist(new ContentType(4, 'code'));
$ema->persist(new ContentType(5, 'comment'));

$ema->flush();
