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
declare(strict_types=1);
namespace lai\poker\landlord\rules;

use app\engine\Suits;
use lai\poker\landlord\Card;
use lai\poker\landlord\Decor;
use lai\poker\landlord\Number;
use lai\poker\landlord\Poker;

abstract class AbstractBaseRule implements RulesInterface
{
    protected int $count = 0;

    protected string $label = '';

    protected array $numbers = [];

    protected array $data = [];

    public function __construct($numbers = [])
    {
        $this->numbers = Number::create($numbers)->filter()->get();
        $this->count = count($this->numbers);
        $this->data  = Poker::create($this->numbers)->handle()->getData();
    }

    public function get(): array
    {
        return $this->numbers;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    abstract public function is(): bool;

    /**
     * 是否同时含有双王
     * @return bool
     */
    public function isBothJokers(): bool
    {
        $suits = array_column($this->data, 'suit');
        return 2 === count(array_filter($suits, fn($suit)=> $suit === Decor::JOKER));
    }
}