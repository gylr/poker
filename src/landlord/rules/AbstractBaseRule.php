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

    public static function create($numbers = []): static
    {
        $self = new static($numbers);
        return \WeakReference::create($self)->get();
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
        $decors = array_column($this->data, Card::DECOR);
        return 2 === count(array_filter($decors, fn($decor)=> $decor === Decor::JOKER));
    }

    public function isContainBomb(): bool
    {
        $points = array_column($this->data, Card::POINT, Card::NUMBER);
        $count_values = array_count_values($points);
        return count(array_filter($count_values, fn($count) => $count === 4)) > 0;
    }

    public function pointCountValues(): array
    {
        $points = array_column($this->data, Card::POINT);
        $count_values = array_count_values($points);
        sort($count_values);
        return $count_values;
    }
}