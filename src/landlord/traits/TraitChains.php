<?php
// +----------------------------------------------------------------------
// | poker
// +----------------------------------------------------------------------
// | Copyright (c) 2023 All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: gylr0505 <gylr0505@163.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace lai\poker\landlord\traits;

use lai\poker\landlord\rules\Bomb;
use lai\poker\landlord\rules\None;
use lai\poker\landlord\rules\Pair;
use lai\poker\landlord\rules\Quadplex;
use lai\poker\landlord\rules\Rocket;
use lai\poker\landlord\rules\Sequence;
use lai\poker\landlord\rules\SequencePair;
use lai\poker\landlord\rules\SequenceTriplet;
use lai\poker\landlord\rules\SequenceTripletWithOne;
use lai\poker\landlord\rules\SequenceTripletWithPair;
use lai\poker\landlord\rules\Single;
use lai\poker\landlord\rules\Triplet;
use lai\poker\landlord\rules\TripletWithOne;
use lai\poker\landlord\rules\TripletWithPair;

trait TraitChains
{
    protected ?array $chains = [];

    protected function prepareNextRules()
    {
        if (!$this->chains) {
            $this->prepareRules();
        }
        foreach ($this->chains as $key => $rule) {
            $this->setNext($rule);
        }
    }

    protected function prepareRules()
    {
        $this->chains = [
            Single::create($this->numbers),
            Pair::create($this->numbers),
            Bomb::create($this->numbers),
            Triplet::create($this->numbers),
            Rocket::create($this->numbers),
            Sequence::create($this->numbers),
            SequencePair::create($this->numbers),
            SequenceTriplet::create($this->numbers),
            SequenceTripletWithOne::create($this->numbers),
            SequenceTripletWithPair::create($this->numbers),
            TripletWithOne::create($this->numbers),
            TripletWithPair::create($this->numbers),
            Quadplex::create($this->numbers),
            None::create([])  // 关系链的原因，该规则放最后一个
        ];
    }
}