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
 *  a triplet with any single card added, for example 6-6-6-8.
 * These rank according to the rank of the triplet - so for example 9-9-9-3 beats 8-8-8-A.
 * 三带一
 */
class TripletWithOne extends AbstractBaseRule
{
    protected string $label = 'to';

    public function is(): bool
    {
        if ($this->count !== 4){
            return false;
        }
        $count_values = $this->pointCountValues();
        // 只有两个不同的数字存在
        if (count($count_values) !== 2){
            return false;
        }
        list($first, $second) = $count_values;
        return $first === 1 && $second === 3;
    }

}