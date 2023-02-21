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
 * at least two triplets of consecutive ranks from three up to ace. For example 4-4-4-5-5-5.
 * 三联体
 */
class SequenceTriplet extends AbstractBaseRule
{
    use TraitSequence;

    protected string $label = 'st';

    public function is(): bool
    {
        return $this->isSequenceTripletNumbers();
    }

}