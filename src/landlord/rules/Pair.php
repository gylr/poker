<?php
declare (strict_types = 1);

namespace lai\poker\landlord\rules;

class Pair extends AbstractBaseRule
{
    protected string $label = 'p';

    public function is(): bool
    {
        if ($this->count !== 2){
            return false;
        }

        list($first, $second) = array_column($this->data, 'point');
        return strcmp($first, $second) === 0;
    }

}