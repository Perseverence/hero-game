<?php

namespace App\Entities;

use http\Exception\InvalidArgumentException;
use phpDocumentor\Reflection\Types\Integer;
use App\Entities\Creature as Creature;
use function PHPUnit\Framework\throwException;

class Hero extends Creature {
    public static function fromArray($array)
    {
        if(!is_array($array)) {
            throw new InvalidArgumentException;
        }

        $data = new self($array);

        return $data;
    }
}