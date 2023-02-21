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

        // 三联的数字集合
        $class = new self($this->prepareTripletNumbers());
        if (!$class->isSequenceTripletNumbers()){
            return false;
        }
        $this->generateAttachCount();
        // 层级差跟附加数量一致为合法，且反向count值保持一致为合法
        $diff_level = $class->getDiffLevel();

        return $diff_level === $this->attach_count && ($diff_level * 3 + $this->attach_count) === $this->count;
    }

}