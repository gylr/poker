<?php
declare (strict_types = 1);

namespace lai\poker\landlord\rules;

interface RulesInterface
{
    public function is(): bool;

    public function get(): array;

    public function getData(): array;

    public function getCount(): int;
}