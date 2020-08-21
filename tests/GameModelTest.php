<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Models\GameModel;

class GameModelTest extends TestCase {

    public function testHeroAttackFirstBySpeed()
    {
        $model = new GameModel();

        $hero = array(
            'health'    => 100,
            'strength'  => 50,
            'defense'   => 30,
            'speed'     => 70,
            'luck'      => 20
        );

        $beast = array(
            'health'    => 100,
            'strength'  => 50,
            'defense'   => 30,
            'speed'     => 40,
            'luck'      => 20
        );

        $this->assertTrue($model->checkFirstAttack($hero, $beast));
    }

    public function testBestAttackFirstBySpeed()
    {
        $model = new GameModel();

        $hero = array(
            'health'    => 100,
            'strength'  => 50,
            'defense'   => 30,
            'speed'     => 70,
            'luck'      => 20
        );

        $beast = array(
            'health'    => 100,
            'strength'  => 50,
            'defense'   => 30,
            'speed'     => 90,
            'luck'      => 20
        );

        $this->assertFalse($model->checkFirstAttack($hero, $beast));
    }

    public function testHeroAttackByEqualSpeedAndGreatherLuck()
    {
        $model = new GameModel();

        $hero = array(
            'health'    => 100,
            'strength'  => 50,
            'defense'   => 30,
            'speed'     => 50,
            'luck'      => 30
        );

        $beast = array(
            'health'    => 100,
            'strength'  => 50,
            'defense'   => 30,
            'speed'     => 50,
            'luck'      => 20
        );

        $this->assertTrue($model->checkFirstAttack($hero, $beast));
    }
}