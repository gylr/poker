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
 * an extra card is added to each triplet.
 * For example 7-7-7-8-8-8-3-6.
 * The attached cards must be different from all the triplets and from each other.
 * Although triplets of twos cannot be included, a two or a joker or one of each can be attached, but not both jokers.
 * 三带一，飞机，不含双王，不含有炸，可含有2
 */
class SequenceTripletWithOne extends AbstractBaseRule
{
    use TraitSequence;

    protected string $label = 'sto';

    public function is(): bool
    {
        // 最少8张，且是4的倍数
        if ($this->count < 8 || $this->count % 4 !== 0){
            return false;
        }
        if ($this->isBothJokers()){
            return false;
        }
        // 含有炸弹
        if ($this->isContainBomb()) {
            return false;
        }
        // 三联的数字集合，并判断是否是顺子
        $class = self::create($this->prepareTripletNumbers());
        if (!$class->isSequenceTripletNumbers()){
            return false;
        }

        $this->generateAttachCount();
        // 层级差跟附加数量一致为合法，且反向count值保持一致为合法
        $diff_level = $class->getDiffLevel();
        return $diff_level === $this->attach_count && ($diff_level * 3 + $this->attach_count) === $this->count;
    }

}