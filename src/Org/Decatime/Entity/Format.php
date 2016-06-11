<?php

namespace Org\Decatime\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Format
{
    const F_TEXT = 1;
    const F_RST = 2;
    const F_HTML = 3;
    const F_PHP = 4;
    const F_JAVASCRIPT = 5;
    const F_BASH = 6;

    use EnumTrait;
}
