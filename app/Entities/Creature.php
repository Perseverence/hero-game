<?php

namespace App\Entities;

use phpDocumentor\Reflection\Types\Integer;

class Creature {

    /**
     * @var int
     */
    private $minHealth;

    /**
     * @var int
     */
    private $maxHealth;

    /**
     * @var int
     */
    private $minStrength;

    /**
     * @var int
     */
    private $maxStrength;

    /**
     * @var int
     */
    private $minDefense;

    /**
     * @var int
     */
    private $maxDefense;

    /**
     * @var int
     */
    private $minSpeed;

    /**
     * @var int
     */
    private $maxSpeed;

    /**
     * @var int
     */
    private $minLuck;

    /**
     * @var int
     */
    private $maxLuck;

    /**
     * @var boolean
     */
    private $haveSkills = false;

    /**
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->setMinHealth($array['minHealth'])
            ->setMaxHealth($array['maxHealth'])
            ->setMinStrength($array['minStrength'])
            ->setMaxStrength($array['maxStrength'])
            ->setMinDefense($array['minDefense'])
            ->setMaxDefense($array['maxDefense'])
            ->setMinSpeed($array['minSpeed'])
            ->setMaxSpeed($array['maxSpeed'])
            ->setMinLuck($array['minLuck'])
            ->setMaxLuck($array['maxLuck']);

        if(isset($array['haveSkills']) && $array['haveSkills'] === true)
        {
            $this->setHaveSkills(true);
        }
    }

    /**
     * @return int
     */
    public function getMinHealth()
    {
        return $this->minHealth;
    }

    /**
     * @param int $minHealth
     * @return Creature
     */
    public function setMinHealth($minHealth): Creature
    {
        $this->minHealth = $minHealth;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxHealth()
    {
        return $this->maxHealth;
    }

    /**
     * @param int $maxHealth
     * @return Creature
     */
    public function setMaxHealth($maxHealth): Creature
    {
        $this->maxHealth = $maxHealth;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinStrength()
    {
        return $this->minStrength;
    }

    /**
     * @param int $minStrength
     * @return Creature
     */
    public function setMinStrength($minStrength): Creature
    {
        $this->minStrength = $minStrength;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxStrength()
    {
        return $this->maxStrength;
    }

    /**
     * @param int $maxStrength
     * @return Creature
     */
    public function setMaxStrength($maxStrength): Creature
    {
        $this->maxStrength = $maxStrength;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinDefense()
    {
        return $this->minDefense;
    }

    /**
     * @param int $minDefense
     * @return Creature
     */
    public function setMinDefense($minDefense): Creature
    {
        $this->minDefense = $minDefense;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxDefense()
    {
        return $this->maxDefense;
    }

    /**
     * @param int $maxDefense
     * @return Creature
     */
    public function setMaxDefense($maxDefense): Creature
    {
        $this->maxDefense = $maxDefense;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinSpeed()
    {
        return $this->minSpeed;
    }

    /**
     * @param int $minSpeed
     * @return Creature
     */
    public function setMinSpeed($minSpeed): Creature
    {
        $this->minSpeed = $minSpeed;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    /**
     * @param int $maxSpeed
     * @return Creature
     */
    public function setMaxSpeed($maxSpeed): Creature
    {
        $this->maxSpeed = $maxSpeed;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinLuck()
    {
        return $this->minLuck;
    }

    /**
     * @param int $minLuck
     * @return Creature
     */
    public function setMinLuck($minLuck): Creature
    {
        $this->minLuck = $minLuck;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLuck()
    {
        return $this->maxLuck;
    }

    /**
     * @param int $maxLuck
     * @return Creature
     */
    public function setMaxLuck($maxLuck): Creature
    {
        $this->maxLuck = $maxLuck;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHaveSkills()
    {
        return $this->haveSkills;
    }

    /**
     * @param bool $haveSkills
     * @return Creature
     */
    public function setHaveSkills($haveSkills): Creature
    {
        $this->haveSkills = $haveSkills;
        return $this;
    }
}