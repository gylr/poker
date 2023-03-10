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
 * two cards of the same rank, from three (low) up to two (high)
 * 对子
 */
class Pair extends AbstractBaseRule
{
    protected string $label = 'p';

    public function is(): bool
    {
        if ($this->count !== 2){
            return false;
        }

        list($first, $second) = array_column($this->data, Card::POINT);
        return strcmp($first, $second) === 0;
    }

}