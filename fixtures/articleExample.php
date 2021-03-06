<?php
use \Org\Decatime\Entity\Article;
use \Org\Decatime\Entity\Content;
use \Org\Decatime\Entity\Paragraph;
use \Org\Decatime\Entity\Chapter;
use \Org\Decatime\Entity\Topic;
use \Org\Decatime\Entity\ArticleTopic;
use \Org\Decatime\Entity\ContentType;
use \Org\Decatime\Entity\Format;

//cleanup
cleanUp('\Org\Decatime\Entity\Article', $ema);

// add an article
$article1 = createArticle(
    $ema,
    "Installation de nodeJS",
    "Cet article décrit les étapes à suivres pour installer nodeJS sur une plateforme de développement.",
    [
        Topic::T_LINUX,
        Topic::T_UBUNTU,
        Topic::T_SHELL
    ]
);
$ema->flush();

// now that article is created we add some content
$chapter1 = addChapter($ema, $article1, "Introduction", 1, [
    [
        'title' => "Qu'est - ce que nodeJS",
        'keywords'=> "key1, key2, key3",
        'paragraphs' =>
        [
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => 'nodeJS est un serveur contenant le moteur V8 de google.',
            ],
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => 'Ceci est un <b>autre</b> bout de paragraphe sans intérêt...',
            ],
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => "Lorem ipsum dolor sit amet, <i>consectetur adipiscing elit</i>. Vestibulum porttitor ex enim, at mattis diam accumsan eget. Mauris at augue magna. Phasellus tempor, neque at imperdiet venenatis, ex elit scelerisque felis, non mattis orci metus ut dui. Vivamus dictum urna ut quam ornare, quis commodo mi interdum. Pellentesque cursus posuere tortor sed mollis. Integer placerat hendrerit tincidunt. Duis ultrices nisi nibh, sit amet commodo diam rhoncus ac. Donec et pellentesque ex. Integer commodo elementum dolor a vulputate. Fusce posuere, mauris quis sagittis ullamcorper, ex mi ullamcorper enim, sagittis fringilla felis dui non sem. Nulla sodales tincidunt quam ac aliquam. Donec ut augue est. Proin eu enim lectus."
            ],
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => 'Ceci est un autre bout de paragraphe sans intérêt 2...',
            ],
            [
                'type' => ContentType::T_IMAGE,
                'format' => Format::F_PNG,
                'rawData' => __DIR__ .'/../public/assets/images/logo_web.png'
            ]
        ]
    ],
    [
        'title' => "Qui utilise nodeJS",
        'keywords'=> "key4, key6, key12",
        'paragraphs' =>
        [
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => "Aenean eget scelerisque leo, vel efficitur nunc. Mauris eu felis nisi. In non lorem justo. Nulla congue eget nibh congue ornare. Vivamus et felis pellentesque, elementum eros ut, placerat lacus. Morbi tincidunt condimentum augue, eget viverra dolor sodales sit amet. Suspendisse aliquam interdum arcu et faucibus.",
            ],
            [
                'type' => ContentType::T_CODE,
                'format' => Format::F_PHP,
                'data' => file_get_contents(__DIR__.'/phpClass.php')
            ],
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor ex enim, at mattis diam accumsan eget. Mauris at augue magna. Phasellus tempor, neque at imperdiet venenatis, ex elit scelerisque felis, non mattis orci metus ut dui. Vivamus dictum urna ut quam ornare, quis commodo mi interdum. Pellentesque cursus posuere tortor sed mollis. Integer placerat hendrerit tincidunt. Duis ultrices nisi nibh, sit amet commodo diam rhoncus ac. Donec et pellentesque ex. Integer commodo elementum dolor a vulputate. Fusce posuere, mauris quis sagittis ullamcorper, ex mi ullamcorper enim, sagittis fringilla felis dui non sem. Nulla sodales tincidunt quam ac aliquam. Donec ut augue est. Proin eu enim lectus."
            ],
            [
                'type' => ContentType::T_CODE,
                'format' => Format::F_JAVASCRIPT,
                'data' => file_get_contents(__DIR__.'/jsExample.js')
            ]
        ]
    ]
]);
$ema->flush();

$chapter2 = addChapter($ema, $article1, "Le dessous des cartes", 2, [
    [
        'title' => "Quoi qui a sous le capot ?",
        'keywords'=> "key4, key5, key12",
        'paragraphs' =>
        [
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => 'En fait nodejs en a pas mal sous le capot. Un V8 ça dépote!',
            ],
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => 'Ceci est un <b>autre</b> bout de paragraphe sans intérêt...',
            ],
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => "Lorem ipsum dolor sit amet, <i>consectetur adipiscing elit</i>. Vestibulum porttitor ex enim, at mattis diam accumsan eget. Mauris at augue magna. Phasellus tempor, neque at imperdiet venenatis, ex elit scelerisque felis, non mattis orci metus ut dui. Vivamus dictum urna ut quam ornare, quis commodo mi interdum. Pellentesque cursus posuere tortor sed mollis. Integer placerat hendrerit tincidunt. Duis ultrices nisi nibh, sit amet commodo diam rhoncus ac. Donec et pellentesque ex. Integer commodo elementum dolor a vulputate. Fusce posuere, mauris quis sagittis ullamcorper, ex mi ullamcorper enim, sagittis fringilla felis dui non sem. Nulla sodales tincidunt quam ac aliquam. Donec ut augue est. Proin eu enim lectus."
            ],
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => 'Ceci est un autre bout de paragraphe sans intérêt 4...',
            ]
        ]
    ],
    [
        'title' => "Ou est - ce qu'on peut ce procurer nodeJS",
        'keywords'=> "key18, key21, key16",
        'paragraphs' =>
        [
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => "Aenean eget scelerisque leo, vel efficitur nunc. Mauris eu felis nisi. In non lorem justo. Nulla congue eget nibh congue ornare. Vivamus et felis pellentesque, elementum eros ut, placerat lacus. Morbi tincidunt condimentum augue, eget viverra dolor sodales sit amet. Suspendisse aliquam interdum arcu et faucibus.",
            ],
            [
                'type' => ContentType::T_CODE,
                'format' => Format::F_JAVASCRIPT,
                'data' => file_get_contents(__DIR__.'/jsExample.js')
            ],
            [
                'type' => ContentType::T_TEXT,
                'format' => Format::F_TEXT,
                'data' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor ex enim, at mattis diam accumsan eget. Mauris at augue magna. Phasellus tempor, neque at imperdiet venenatis, ex elit scelerisque felis, non mattis orci metus ut dui. Vivamus dictum urna ut quam ornare, quis commodo mi interdum. Pellentesque cursus posuere tortor sed mollis. Integer placerat hendrerit tincidunt. Duis ultrices nisi nibh, sit amet commodo diam rhoncus ac. Donec et pellentesque ex. Integer commodo elementum dolor a vulputate. Fusce posuere, mauris quis sagittis ullamcorper, ex mi ullamcorper enim, sagittis fringilla felis dui non sem. Nulla sodales tincidunt quam ac aliquam. Donec ut augue est. Proin eu enim lectus."
            ]
        ]
    ]
]);
$ema->flush();

function createArticle($ema, $title, $shortDesc, array $topics)
{
    $article = new Article();
    $article->setTitle($title);
    $article->setCreatedAt(new \DateTime());
    $article->setPublishedAt(new \DateTime());
    $article->setShortDescription($shortDesc);
    foreach ($topics as $topic) {
        $articleTopic = new ArticleTopic();
        $articleTopic->setArticle($article);
        $articleTopic->setTopic($ema->getRepository('\Org\Decatime\Entity\Topic')->findOneById($topic));
        $ema->persist($articleTopic);
    }
    $ema->persist($article);
    return $article;
}

function addChapter($ema, $parent, $title, $position, array $datas)
{
    $chapter = new Chapter();
    $chapter->setTitle($title);
    $chapter->setPosition($position);
    if ($parent instanceof Article) {
        $chapter->setArticle($parent);
    } else {
        $chapter->setParent($parent);
    }
    $ema->persist($chapter);
    $conpos = 1;
    foreach ($datas as $content) {
        $c = new Content();
        $c->setTitle($content['title']);
        $c->setKeywords($content['keywords']);
        $c->setPosition($conpos);
        $c->setChapter($chapter);
        $parapos = 1;
        foreach ($content['paragraphs'] as $paragraph) {
            $p = new Paragraph();
            $p->setType($ema->getRepository('\Org\Decatime\Entity\ContentType')->findOneById($paragraph['type']));
            $p->setFormat($ema->getRepository('\Org\Decatime\Entity\Format')->findOneById($paragraph['format']));
            if (isset($paragraph['data'])) {
                $p->setData($paragraph['data']);
            } elseif (isset($paragraph['rawData'])) {
                $handle = fopen($paragraph['rawData'], "r");
                $bytes = fread($handle, filesize($paragraph['rawData']));
                $p->setRawData($bytes);
                fclose($handle);
            }
            $p->setContent($c);
            $p->setPosition($parapos);

            $parapos++;
            $ema->persist($p);
        }
        $conpos++;
        $ema->persist($c);
    }
    return $chapter;
}
