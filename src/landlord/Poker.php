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
namespace lai\poker\landlord;

class Poker
{
    protected array $data = [];
    protected array $numbers = [];

    public function __construct($numbers)
    {
        $this->numbers = Number::create($numbers)->filter()->get();
        $this->data = [];
    }

    public static function create($numbers = []): self
    {
        $self = new static($numbers);
        return \WeakReference::create($self)->get();
    }

    public function handle(): self
    {
        $this->parseNumbersToCard();
        return $this;
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function getData(): array
    {
        return $this->data;
    }

    protected function parseNumbersToCard(): void
    {
        array_walk($this->numbers, fn($number, $key) => $this->data[$key] = Card::create((int)$number)->toArray());
    }
}