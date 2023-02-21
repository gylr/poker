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

namespace lai\poker\landlord\rules;

use lai\poker\landlord\Card;

/**
 * a triplet with a pair added, like a full house in poker,
 * the ranking being determined by the rank of the triplet - for example Q-Q-Q-6-6 beats 10-10-10-K-K.
 * 三带二
 */
class TripletWithPair extends AbstractBaseRule
{
    protected string $label = 'tp';

    public function is(): bool
    {
        if ($this->count !== 5){
            return false;
        }
        $points = array_column($this->data, Card::POINT);
        $count_values = array_count_values($points);
        // 只有两个不同的数字存在
        if (count($count_values) !== 2){
            return false;
        }
        sort($count_values);
        list($first, $second) = $count_values;
        return $first === 2 && $second === 3;
    }

}