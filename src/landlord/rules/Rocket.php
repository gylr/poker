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
 * a pair of jokers. It is the highest combination and beats everything else, including bombs.
 * 双王火箭，比任何牌都大
 */
class Rocket extends AbstractBaseRule
{
    protected string $label = 'r';

    public function is(): bool
    {
        if ($this->count !== 2){
            return false;
        }
        return $this->isBothJokers();
    }

}