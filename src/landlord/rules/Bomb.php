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

class Bomb extends AbstractBaseRule
{
    protected string $label = 'b';

    public function is(): bool
    {
        if ($this->count !== 4){
            return false;
        }
        $points = array_count_values(array_column($this->data, 'point'));
        sort($points);
        list($first) = $points;
        return 4 === $first;
    }

}