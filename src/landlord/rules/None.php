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
 * 空规则，出牌不正常时，可用
 * 所有规则中，放最后一个进行验证
 */
class None extends AbstractBaseRule
{
    protected string $label = 'no';

    public function is(): bool
    {
        return !$this->numbers || !$this->count;
    }

}