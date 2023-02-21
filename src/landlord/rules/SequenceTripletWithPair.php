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
use lai\poker\landlord\traits\TraitSequence;

/**
 * an extra pair is attached to each triplet.
 * Only the triplets have to be in sequence - for example 8-8-8-9-9-9-4-4-J-J.
 * The pairs must be different in rank from each other and from all the triplets.
 * Although triplets of twos cannot be included, twos can be attached.
 * Note that attached single cards and attached pairs cannot be mixed - for example 3-3-3-4-4-4-6-7-7 is not valid.
 * 三带一对，不含双王，不含有炸
 */
class SequenceTripletWithPair extends AbstractBaseRule
{
    use TraitSequence;

    protected string $label = 'stp';

    public function is(): bool
    {
        // 最少10张，且是5的倍数
        if ($this->count < 10 || $this->count % 5 !== 0){
            return false;
        }
        if ($this->isBothJokers()){
            return false;
        }
        // 找到三带二顺中的三顺，进行后续的判断
        $levels = array_column($this->data, Card::LEVEL);
        $levels_counts = array_count_values(array_count_values($levels));
        sort($levels_counts);
        list($first, $second) = $levels_counts;
        //表示个数不匹配
        if ($first !== $second || count($levels_counts) !== 2){
            return false;
        }

        $class = new self($this->prepareTripletNumbers());
        if (!$class->isSequenceTripletNumbers()){
            return false;
        }
        $this->generateAttachCount();
        // 层级差跟附加数量一致为合法，且反向count值保持一致为合法
        $diff_level = $class->getDiffLevel();
        return ($diff_level * 2) === $this->attach_count && ($diff_level * 3 + $this->attach_count) === $this->count;
    }

}