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
/**
 * 生成一副牌，或已生成的牌，然后做牌的分发；
 * 对于已打乱的牌，可能是历史记录，按场景自行决定是否要洗牌（打乱）
 */
class PokerNumbers
{
    // 牌编号，默认值，1-54，表示新牌
    protected array $numbers = [];
    // 位序0的牌
    protected array $first = [];
    // 位序1的牌
    protected array $second = [];
    // 位序2的牌
    protected array $third = [];
    // 底牌三张
    protected array $hand = [];
    // 以位序为key的数组集合
    protected array $order = [];

    public function __construct($numbers = [])
    {
        $numbers = $numbers ?: range(Number::BEGIN_NUMBER, Number::END_NUMBER);
        $this->numbers = Number::create($numbers)->filter()->get();
    }

    public static function create($numbers = []): self
    {
        $self = new static($numbers);
        return \WeakReference::create($self)->get();
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function toString(): string
    {
        return implode(',', $this->numbers);
    }

    /**
     * 打乱牌序，可多次调用
     * @return $this
     */
    public function shuffle(): self
    {
        shuffle($this->numbers);
        // numbers被打乱后，按key换序，进行序列重组
        $this->numbers = $this->shuffleStepNumbers();
        return $this;
    }

    public function handOut(): self
    {
        if (!$this->order) {
            list($this->first, $this->second, $this->third, $this->hand) = array_chunk($this->numbers, 17);
            $this->order = [$this->first, $this->second, $this->third, $this->hand];
        }
        return $this;
    }

    public function getFirst(): array
    {
        $this->handOut();
        return $this->first;
    }

    public function getSecond(): array
    {
        $this->handOut();
        return $this->second;
    }

    public function getThird(): array
    {
        $this->handOut();
        return $this->third;
    }

    public function getHand(): array
    {
        $this->handOut();
        return $this->hand;
    }

    /**
     * @param int $key 玩家位序索引
     * @return array|mixed
     */
    public function getByKey(int $key = 0)
    {
        $this->handOut();
        return $this->order[$key] ?? [];
    }

    /**
     * 获取地主牌，含有底牌 $this->hand 三张
     * @param int $key 地主本身所在位序
     * @return array
     */
    public function getTrumps(int $key = 0): array
    {
        return array_merge($this->getByKey($key), $this->getHand());
    }

    protected function shuffleStepNumbers(): array
    {
        $steps = [0,1,2,3,4,5];
        shuffle($steps);
        list($one, $two, $three, $four, $five, $six) = $steps;
        return [
            ...$this->filterStep($one), ...$this->filterStep($two), ...$this->filterStep($three),
            ...$this->filterStep($four), ...$this->filterStep($five), ...$this->filterStep($six)
        ];
    }

    protected function filterStep($step = 0): array
    {
        return array_filter($this->numbers, fn($key) => ($key % 6) === $step, ARRAY_FILTER_USE_KEY);
    }
}