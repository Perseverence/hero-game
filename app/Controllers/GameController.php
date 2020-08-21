<?php

namespace App\Controllers;
use App\Models\GameModel as GameModel;

class GameController {

    public $_model;

    public $nrOfRounds = 20;

    public $game_state = array();

    public function __construct()
    {
        $this->_model = new GameModel();
    }

    public function battle()
    {
        $hero = $this->_model->heroStats;
        $beast = $this->_model->beastStats;

        print_r($this->_model->heroStats);
        print_r($this->_model->beastStats);

        $attacker = $this->_model->checkFirstAttack($hero, $beast);  // true = hero attack first, false = beast attack first

        for($i = 1; $i <= $this->nrOfRounds; $i++)
        {
            if($hero['health'] <= 0 || $beast['health'] <= 0)
            {
                break;
            }

            // Orderus attack first
            if($attacker == true)
            {
                $attacker = false; // switch role to beast
                $damage = $this->_model->calculateDamageDone($hero['strength'], $beast['defense']);
                $skill = $this->_model->getSkill();

                if($hero['luck'] > $beast['luck'])
                {
                    if($damage > 0)
                    {
                        $this->game_state[$i]['attack_damage'] = "Damage {$damage}";

                        // check for Rapid Strike
                        if(isset($skill) && $skill->params->id !== -1 && $skill->params->getType() === 0)
                        {
                            $damage = ($damage * $skill->paramas->getValue());
                            $beast_health = $beast['health'] - $damage;

                            $this->game_state[$i]['attacker_skill_used'] = "Orderus has used the skill {$skill->params->getName()}";
                            $this->game_state[$i]['new_attack_damage'] = "New Damage {$damage} because Orderus used Rapid Strike Skill.";
                        }
                        else
                        {
                            $beast_health = $beast['health'] - $damage;
                            $this->game_state[$i]['no_skills_used'] = "No skills used";
                        }

                        $this->game_state[$i]['attacker'] = "Orderus has attacked the Wild Beast and did damage = {$damage}";
                        $this->game_state[$i]['defender']['health_before_attack'] = "Wild Beast health before attack = {$beast['health']}";
                        $this->game_state[$i]['defender']['health_after_attack']  = "Wild Beast health after attack = {$beast_health}";

                        $beast['health'] = $beast_health ;
                    }
                    else
                    {
                        $this->game_state[$i]['defender_won'] = "The defense of Wild Beast is greater than the Orderus attack";
                    }
                }
                else
                {
                    $this->game_state[$i]['attack_missed'] = "[Orderus has no luck against the Wild Beast and he missed the attack.]";
                }
            }
            else
            {
                $attacker = true; // switch role to hero back
                $damage = $this->_model->calculateDamageDone($beast['strength'], $hero['defense']);
                $skill = $this->_model->getSkill();

                if($beast['luck'] > $hero['luck'])
                {
                    if($damage > 0)
                    {
                        $this->game_state[$i]['attack_damage'] = "Damage {$damage}";

                        // check for Magic Shield for Orderus
                        if(isset($skill) && $skill->params->id !== -1 && $skill->params->getType() === 1)
                        {
                            $damage = ($skill->params->getValue() / 100) * $damage;
                            $hero_health = $hero['health'] - $damage;

                            $this->game_state[$i]['defender']['skills_used'] = "Orderus has used the skill {$skill->params->getName()}";
                            $this->game_state[$i]['new_attack_damage'] = "New Damage because Orderus has used Magic Shield {$damage}";
                        }
                        else
                        {
                            $hero_health = $hero['health'] - $damage;

                            $this->game_state[$i]['defender']['skills_used'] = "No skill used.";
                        }

                        $this->game_state[$i]['attacker'] = "Wild Beast has attacked Orderus and did damage = {$damage}";
                        $this->game_state[$i]['defender']['health_before_attack'] = "Orderus health before attack = {$hero['health']}";
                        $this->game_state[$i]['defender']['health_after_attack'] = "Orderus health after attack = {$hero_health}";

                        $hero['health'] = $hero_health ;
                    }
                    else
                    {
                        $this->game_state[$i]['defender_won'] = "The defense of Orderus is greater than the Wild Beast attack";
                    }
                }
                else
                {
                    $this->game_state[$i]['attack_missed'] = "[Wild Beast has no luck against the Orderus and missed the attack.]";
                }
            }

            // RANDOMIZE AGAIN THE LUCK AFTER TURN
            $hero['luck']  = $this->_model->getHeroNewLuck();
            $beast['luck'] = $this->_model->getBeastNewLuck();

            $this->game_state[$i]['new_luck_hero']  = "New Hero Luck = " . $hero['luck'];
            $this->game_state[$i]['new_luck_beast'] = "New Beast Luck = " . $beast['luck'];
        }

        if($hero['health'] > $beast['health'])
        {
            $this->game_state['win'] = "Orderus has win!";
            $this->game_state['lost'] = "Beast has lost!";
        }
        else
        {
            $this->game_state['win'] = "Beast has win!";
            $this->game_state['lost'] = "Orderus has lost!";
        }

        print_r($this->game_state);
    }
}