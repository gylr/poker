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

class Number
{
    //卡牌编号的开始值
    const BEGIN_NUMBER = 1;
    //卡牌编号的结束值
    const END_NUMBER = 54;
    // 对于顺子，最小的层级为1，对应的点数为3
    const MIN_SEQUENCE_LEVEL = 1;
    //对于顺子，最小的层级为12，对应的点数为A
    const MAX_SEQUENCE_LEVEL = 12;

    /**
     * @var array|string 为出的牌序号
     */
    protected array $data;

    public function __construct($numbers)
    {
        $this->parse($numbers);
    }

    public static function create($numbers): self
    {
        $self = new static($numbers);
        return \WeakReference::create($self)->get();
    }

    protected function parse($numbers): void
    {
        // 字符串可能是json
        if (is_string($numbers)) {
            $numbers = explode(',', $numbers);
        }
        $this->data = $numbers;
    }

    public function filter(): self
    {
        $this->data = array_filter($this->data, fn($number) => $number >= self::BEGIN_NUMBER && $number <= self::END_NUMBER);
        $this->data = array_flip(array_flip($this->data));
        return $this;
    }

    public function get(): array
    {
        return $this->data;
    }

    public function toString(): string
    {
        return implode(',', $this->data);
    }

    public function __toString()
    {
        return $this->toString();
    }
}