<?php

namespace App\Libraries;

class SkillRandomizer
{
    private $items;
    public $pool;

    public function __construct()
    {
        $this->items = array();
    }

    public function getPrize($rewards_list)
    {
        // generating pool
        $this->fillItems($rewards_list);
        // get random
        $result = $this->getRandomItem();
        return $result;
    }

    public function fillItems($rewards_list)
    {
        $chance_to_win = 0;

        // go over each reward
        if(count($rewards_list) > 0)
        {
            foreach($rewards_list as $reward)
            {
                // if it has a chance to be found, add it to the pool
                if($reward->getChanceToProc() > 0)
                {
                    $chance_to_win += $reward->getChanceToProc();
                    $this->addItem( (object)array("probability" => $reward->getChanceToProc(), "params" => (object)$reward));
                }
            }
        }

        // if chance to win is 0 then add lose with probability 100%
        if($chance_to_win == 0)
        {
            $this->addItem( (object)array("probability" => 100, "params" => (object)array("id" => -1)));
        }
        else
        {
            // calculate chance to lose
            $chance_to_lose = 100 - $chance_to_win;
            // if there is a chance to lose, add lose to the pool
            if($chance_to_lose > 0)
            {
                $this->addItem( (object)array("probability" => $chance_to_lose, "params" => (object)array("id" => -1)));
            }
        }
    }

    public function addItem($itm)
    {
        /*
        {
        probability:
        userFunction:
        params:
        }
        */
        //mendatory params into item
        if (!isset($itm->probability))
            die('probability is mandatory');

        if (!isset($itm->params))
            $itm->params = new stdClass;
        if (!isset($itm->uid))
            $itm->uid = base_convert(rand(), 10, 36);

        $this->items[] = $itm;
    }

    public function getRandomItem()
    {
        $this->generatePool();
        $r = rand(0, count($this->pool) - 1);
        $k = $this->pool[$r];
        return $this->items[$k];
    }

    public function getItemByUid($uid)
    {
        foreach ($this->items as $k => $v) {
            if ($v->uid == $uid)
                return $this->items[$k];
        } //$this->items as $k => $v
        return null;
    }

    private function generatePool()
    {
        // find min probability into table pMin
        // then calculate K in this way  pMin*K = 1
        // e.g. at least one item for probability<1
        $pMin = 1;
        foreach ($this->items as $k => $v) {
            if ($v->probability < $pMin)
                $pMin = $v->probability;
        } //$this->items as $k => $v
        $kOne = ($pMin < 1 ? $kOne = 1 / $pMin : 1);

        $this->pool = array();
        foreach ($this->items as $k => $v) {
            for ($p = 0; $p < $v->probability * $kOne; $p++) {
                $this->pool[] = $k;
            } //$p = 0; $p < $v->probability * 10; $p++
        } //$this->items as $k => $v
        $this->shufflePool();

    }

    private function shufflePool()
    {
        // shuffle using Fisher-Yates
        $i = count($this->pool);

        while (--$i) {
            $j = mt_rand(0, $i);
            if ($i != $j) {
                // swap items
                $tmp = $this->pool[$j];
                $this->pool[$j] = $this->pool[$i];
                $this->pool[$i] = $tmp;
            } //$i != $j
        } //--$i
    }
}
