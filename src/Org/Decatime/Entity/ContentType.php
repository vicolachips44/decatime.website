<?php

namespace Org\Decatime\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class ContentType implements \JsonSerializable
{
    const T_TEXT = 1;
    const T_IMAGE = 2;
    const T_FILE = 3;
    const T_CODE = 4;
    const T_COMMENT = 5;

    use EnumTrait;
}
