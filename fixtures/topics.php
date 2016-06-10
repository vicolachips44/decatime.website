<?php

//cleanup
cleanUp('\Org\Decatime\Entity\Topic', $ema);

$ema->persist(createTopic('JavaScript'));
$ema->persist(createTopic('HTML5'));
$ema->persist(createTopic('css'));
$ema->persist(createTopic('PHP'));
$ema->persist(createTopic('Database'));
$ema->persist(createTopic('SQL'));
$ema->persist(createTopic('NoSQL'));
$ema->persist(createTopic('Linux'));
$ema->persist(createTopic('Ubuntu'));
$ema->persist(createTopic('Debian'));
$ema->persist(createTopic('Bash'));
$ema->persist(createTopic('Shell'));

$ema->flush();

function createTopic($name)
{
    $topic = new \Org\Decatime\Entity\Topic();
    $topic->setName($name);
    return $topic;
}
