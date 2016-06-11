<?php
use \Org\Decatime\Entity\Topic as Topic;

//cleanup
cleanUp('\Org\Decatime\Entity\Topic', $ema);

$ema->persist(new Topic(1, 'JavaScript'));
$ema->persist(new Topic(2, 'HTML5'));
$ema->persist(new Topic(3, 'CSS'));
$ema->persist(new Topic(4, 'PHP'));
$ema->persist(new Topic(5, 'Database'));
$ema->persist(new Topic(6, 'SQL'));
$ema->persist(new Topic(7, 'NoSQL'));
$ema->persist(new Topic(8, 'Linux'));
$ema->persist(new Topic(9, 'Ubuntu'));
$ema->persist(new Topic(10, 'Debian'));
$ema->persist(new Topic(11, 'Bash'));
$ema->persist(new Topic(12, 'Shell'));

$ema->flush();
