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

use lai\poker\landlord\Card;
use lai\poker\landlord\Decor;
use lai\poker\landlord\Number;

trait TraitSequence
{
    protected int $unit = 1;

    protected array $levels = [];

    public function isSequence(): bool
    {
        $this->filterTwoJokersLevel();
        // 没有多余的牌，有且只会返回1
        return 1 === count(array_flip(array_count_values($this->levels)));
    }

    public function filterTwoJokersLevel(): array
    {
        $levels = array_column($this->data, Card::LEVEL);
        //过滤掉2和双王
        return $this->levels = array_filter($levels,
            fn($level) => $level >= Number::MIN_SEQUENCE_LEVEL && $level <= Number::MAX_SEQUENCE_LEVEL
        );
    }

    public function isLevelsSumEqual(): bool
    {
        //用一个从小到大的值，组成一个新数组，再求和。跟原数组求和的值对比。相等则说明序列一样
        return (array_sum(range(min($this->levels), max($this->levels))) * $this->unit) === array_sum($this->levels);
    }

    /**
     * 是否含有王
     * @return bool
     */
    public function isContainJoker(): bool
    {
        $decors = array_column($this->data, Card::DECOR);
        return in_array(Decor::JOKER, $decors);
    }

    /**
     * 是否包含2
     * @return bool
     */
    public function isContainTwoPoint(): bool
    {
        $points = array_column($this->data, Card::POINT);
        return in_array('2', $points);
    }

    /**
     * 是否含有主牌，2或者王
     * @return bool
     */
    public function isContainTrumps(): bool
    {
        return $this->isContainTwoPoint() || $this->isContainJoker();
    }

    /**
     * 对三联做独特的验证，其中不能含有主牌
     * @return bool
     */
    public function isSequenceTripletNumbers(): bool
    {
        if ($this->count < 6 || $this->count % 3 !== 0){
            return false;
        }
        if ($this->isContainTrumps()){
            return false;
        }
        if (!$this->isSequence()){
            return false;
        }
//        if (count($this->levels) < 1) {
//            return false;
//        }
        $this->unit = 3;
        return $this->isLevelsSumEqual();
    }
}