<?php

namespace App\Models;

use phpDocumentor\Reflection\Types\Integer;
use App\Entities\Hero;
use App\Entities\Beast;
use App\Libraries\SkillRandomizer;
use App\Entities\Skill;

class GameModel {

    public $hero = [
        'minHealth'     => 70,
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

    public $beast = [
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

    public $skills = [
        [
            'name' => 'Rapid Strike', // Rapid strike: Strike twice while it’s his turn to attack; there’s a 10% chance he’ll use this skill every time he attacks
            'type' => 0,
            'value' => 2,
            'probability_to_proc' => 10
        ],
        [
            'name' => 'Magic shield', //  Magic shield: Takes only half of the usual damage when an enemy attacks; there’s a 20% change he’ll use this skill every time he defends.
            'type' => 1,
            'value' => 50,
            'probability_to_proc' => 20
        ]
    ];

    /**
     * @var Hero
     */
    private $_heroInfo;

    /**
     * @var Beast
     */
    private $_beastInfo;

    /**
     * @var
     */
    private $_skillsInfo;

    /**
     * @var array
     */
    public $heroStats;

    /**
     * @var array
     */
    public $beastStats;


    public function __construct()
    {
        $this->_heroInfo  = Hero::fromArray($this->hero);
        $this->_beastInfo = Beast::fromArray($this->beast);

        $this->loadSkills();

        $this->heroStats  = $this->randomizeHeroStats();
        $this->beastStats = $this->randomizeHeroStats();
    }

    /**
     * Load Skills
     */
    public function loadSkills()
    {
        if(is_array($this->skills) && count($this->skills) > 0)
        {
            foreach ($this->skills as $skill)
            {
                $this->_skillsInfo[] = new Skill($skill);
            }
        }
    }

    /**
     * Randomize Hero Stats
     *
     * @return array
     */
    public function randomizeHeroStats()
    {
        $stats = array();

        $stats['health']   = $this->getRandomStats($this->_heroInfo->getMinHealth(), $this->_heroInfo->getMaxHealth());
        $stats['strength'] = $this->getRandomStats($this->_heroInfo->getMinStrength(), $this->_heroInfo->getMaxStrength());
        $stats['defense']  = $this->getRandomStats($this->_heroInfo->getMinDefense(), $this->_heroInfo->getMaxDefense());
        $stats['speed']    = $this->getRandomStats($this->_heroInfo->getMinSpeed(), $this->_heroInfo->getMaxSpeed());
        $stats['luck']     = $this->getRandomStats($this->_heroInfo->getMinLuck(), $this->_heroInfo->getMaxLuck());

        return $stats;
    }

    /**
     * @param $attackerStrength
     * @param $defenderDefense
     * @return mixed
     */
    public function calculateDamageDone($attackerStrength, $defenderDefense)
    {
        return $attackerStrength - $defenderDefense;
    }

    /**
     * Randomize Beast Stats
     *
     * @return array
     */
    public function randomizeBeastStats()
    {
        $stats = array();

        $stats['health']   = $this->getRandomStats($this->_beastInfo->getMinHealth(), $this->_beastInfo->getMaxHealth());
        $stats['strength'] = $this->getRandomStats($this->_beastInfo->getMinStrength(), $this->_beastInfo->getMaxStrength());
        $stats['defense']  = $this->getRandomStats($this->_beastInfo->getMinDefense(), $this->_beastInfo->getMaxDefense());
        $stats['speed']    = $this->getRandomStats($this->_beastInfo->getMinSpeed(), $this->_beastInfo->getMaxSpeed());
        $stats['luck']     = $this->getRandomStats($this->_beastInfo->getMinLuck(), $this->_beastInfo->getMaxLuck());

        return $stats;
    }

    /**
     * @param $hero
     * @param $beast
     * @return bool
     */
    public function checkFirstAttack($hero, $beast)
    {
        $first_attack = true; // true = hero attack first, false = beast attack first

        if($hero['speed'] > $beast['speed'])
        {
            $first_attack = true;
        }
        else if($beast['speed'] > $hero['speed'])
        {
            $first_attack = false;
        }
        else if ($beast['speed'] == $hero['speed'])
        {
            if ($hero['luck'] > $beast['luck'])
            {
                $first_attack = true;
            }
            else
            {
                $first_attack = false;
            }
        }

        return $first_attack;
    }

    /**
     * @param $min
     * @param $max
     * @return int
     */
    public function getRandomStats($min, $max)
    {
        return rand($min, $max);
    }

    /**
     * GET SKILL
     * @param $skills
     * @return mixed
     */
    public function getSkill()
    {
        $this->Randomizer = new SkillRandomizer();
        return $this->Randomizer->getPrize($this->_skillsInfo);
    }

    public function getHeroNewLuck()
    {
        return $this->getRandomStats($this->_heroInfo->getMinLuck(), $this->_heroInfo->getMaxLuck());
    }

    public function getBeastNewLuck()
    {
        return $this->getRandomStats($this->_beastInfo->getMinLuck(), $this->_beastInfo->getMaxLuck());
    }
}