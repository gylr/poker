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
 * three cards of the same rank
 * 三张完全一样， 不含有飞机或三带
 */
class Triplet extends AbstractBaseRule
{
    protected string $label = 't';

    public function is(): bool
    {
        if ($this->count !== 3){
            return false;
        }

        list($first, $second, $third) = array_column($this->data, 'point');
        return $first === $second && $second === $third;
    }

}