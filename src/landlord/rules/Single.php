<?php
declare (strict_types = 1);

namespace lai\poker\landlord\rules;


/**
 * Class Single
 * ranking from three (low) up to red joker (high) as explained above
 * 单张
 * @package lai\poker\landlord\rules
 */
class Single extends AbstractBaseRule
{
    protected string $label = 's';

    public function is(): bool
    {
        return $this->count === 1;
    }
}