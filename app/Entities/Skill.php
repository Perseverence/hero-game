<?php

namespace App\Entities;

class Skill {

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $value;

    /**
     * @var int
     */
    private $chanceToProc;

    public function __construct(array $array)
    {
        $this->setName($array['name'])
            ->setType($array['type'])
            ->setValue($array['value'])
            ->setChanceToProc($array['probability_to_proc']);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Skill
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Skill
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Skill
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChanceToProc()
    {
        return $this->chanceToProc;
    }

    /**
     * @param mixed $chanceToProc
     * @return Skill
     */
    public function setChanceToProc($chanceToProc)
    {
        $this->chanceToProc = $chanceToProc;
        return $this;
    }
}