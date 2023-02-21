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

use lai\poker\landlord\traits\TraitSequence;

/**
 * at least three pairs of consecutive ranks, from 3 up to ace.
 * Twos and jokers cannot be used. For example 10-10-J-J-Q-Q-K-K.
 * 双连顺，最少单元素3个，牌最少6张
 */
class SequencePair extends AbstractBaseRule
{
    use TraitSequence;

    protected string $label = 'sp';

    public function is(): bool
    {
        // 最少6张，并且是偶数张
        if ($this->count < 6 || $this->count & 1){
            return false;
        }
        if ($this->isContainTrumps()){
            return false;
        }
        if (!$this->isSequence()){
            return false;
        }
        $count_values = array_count_values($this->levels);
        if (count($count_values) < 3) {
            return false;
        }
        $this->unit = 2;
        return $this->isLevelsSumEqual();
    }

}