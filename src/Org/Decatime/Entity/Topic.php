<?php

namespace Org\Decatime\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Topic implements \JsonSerializable
{
    const T_JAVASCRIPT = 1;
    const T_HTML5 = 2;
    const T_CSS = 3;
    const T_PHP = 4;
    const T_DATABASE = 5;
    const T_SQL = 6;
    const T_NOSQL = 7;
    const T_LINUX = 8;
    const T_UBUNTU = 9;
    const T_DEBIAN = 10;
    const T_BASH = 11;
    const T_SHELL = 12;

    use EnumTrait;
}
