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

class Sequence extends AbstractBaseRule
{
    use TraitSequence;

    protected string $label = 'ss';

    public function is(): bool
    {
        // 最少5张，最多12张
        if ($this->count < 5 || $this->count > 12){
            return false;
        }
        if ($this->isContainTrumps()) {
            return false;
        }
        if (!$this->isSequence()){
            return false;
        }
        $this->unit = 1;
        return $this->isLevelsSumEqual();
    }

}