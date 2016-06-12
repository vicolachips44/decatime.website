<?php
use \Org\Decatime\Entity\Format as Format;

//cleanup
cleanUp('\Org\Decatime\Entity\Format', $ema);

$ema->persist(new Format(1, 'text'));
$ema->persist(new Format(2, 'rst'));
$ema->persist(new Format(3, 'html'));
$ema->persist(new Format(4, 'php'));
$ema->persist(new Format(5, 'javascript'));
$ema->persist(new Format(6, 'bash'));
$ema->persist(new Format(7, 'png'));

$ema->flush();
