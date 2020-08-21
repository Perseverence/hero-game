<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Entities\Hero as Hero;
use http\Exception\InvalidArgumentException;

class HeroTest extends TestCase {

    public function testHeroValues()
    {
        $hero = [
            'minHealth'     => -30,
            'maxHealth'     => 100,
            'minStrength'   => 70,
            'maxStrength'   => 80,
            'minDefense'    => 45,
            'maxDefense'    => 55,
            'minSpeed'      => 40,
            'maxSpeed'      => 50,
            'minLuck'       => 10,
            'maxLuck'       => 30,
            'haveSkills'    => true
        ];

        $hero = Hero::fromArray($hero);

        $this->assertEquals(-30, $hero->getMinHealth());
        $this->assertEquals(100, $hero->getMaxHealth());
        $this->assertEquals(70, $hero->getMinStrength());
        $this->assertEquals(80, $hero->getMaxStrength());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCheckIfNotArrayIsPassed()
    {
        Hero::fromArray(123);
    }
}

