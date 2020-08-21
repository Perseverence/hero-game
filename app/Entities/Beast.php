<?php
/**
 * Created by PhpStorm.
 * User: valentin.dobrica
 * Date: 20.08.2020
 * Time: 2:16 PM
 */

namespace App\Entities;

use App\Entities\Creature as Creature;

class Beast extends Creature {

    public static function fromArray(array $array)
    {
        $data = new self($array);

        return $data;
    }
}