<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Entities\Beast;


class BeastTestTest extends TestCase {

    public function testHeroValues()
    {
        $beast = [
            'minHealth'     => 60,
            'maxHealth'     => 90,
            'minStrength'   => 60,
            'maxStrength'   => 90,
            'minDefense'    => 40,
            'maxDefense'    => 60,
            'minSpeed'      => 40,
            'maxSpeed'      => 60,
            'minLuck'       => 25,
            'maxLuck'       => 40
        ];

        $beast = Beast::fromArray($beast);

        $this->assertEquals(60, $beast->getMinHealth());
    }
}

