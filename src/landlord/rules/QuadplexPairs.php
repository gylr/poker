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

/**
 * there are two types: a quad with two single cards of different ranks attached,
 * such as 6-6-6-6-8-9, or a quad with two pairs of different ranks attached, such as J-J-J-J-9-9-Q-Q.
 * Twos and jokers can be attached, but you cannot use both jokers in one quadplex set.
 * Quadplex sets are ranked according to the rank of the quad.
 * Note that a quadplex set can only beat a lower quadplex set of the same type, and cannot beat any other type of combination.
 * Also a quadplex set can be beaten by a bomb made of lower ranked cards.
 * 四带二或四带二对，不允许出现双王
 */
class QuadplexPairs extends AbstractBaseRule
{
    protected string $label = 'qp';

    public function is(): bool
    {
        // 最少6张
        if ($this->count < 6){
            return false;
        }
        if ($this->isBothJokers()){
            return false;
        }
        $count_values = $this->pointCountValues();
        // 有且只能为三个元素，其他情况均非法
        if (count($count_values) !== 3){
            return false;
        }
        list($first, $second, $third) = $count_values;
        // 四带二对
        if ($this->count === 8){
            return $first === 2 && $second === 2 && $third === 4;
        }
        return false;
    }

}