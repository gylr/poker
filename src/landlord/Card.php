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
 * 根据$number创建纸牌信息，含有点数point，花色decor，层级level
 */
class Card
{
    //level 对应牌point，对于斗地主，顺序从小到大，不可修改
    const LEVEL_MAPS = [
        1 => '3','4','5','6','7','8','9','10','J','Q','K','A','2','BJ','RJ'
    ];

    // 花色序列，最最小1
    const DECOR_BEGIN_NUMBER = 1;
    // 花色序列，最大为52，即到LEVEL_CARD_MAPS的2；大小王特殊处理
    const DECOR_END_NUMBER = 52;

    // 小王的number
    const BLACK_JOKER_NUMBER = 53;
    // 大王的number
    const RED_JOKER_NUMBER = 54;
    // 牌层级标记，不可修改
    const LEVEL = 'level';
    // 牌点数标记，不可修改
    const POINT = 'point';
    // 牌花色标记，不可修改
    const DECOR = 'decor';
    // 号码标记，不可修改
    const NUMBER = 'number';

    /**
     * @var int 此卡的编号，按规则是固定的；
     */
    private int $number;

    /**
     * @var int 此卡片的层级大小
     */
    private int $level;

    /**
     * @var string 纸牌点数
     */
    private string $point;

    /**
     * @var string 纸牌花色
     */
    private string $decor;

    public function __construct($number)
    {
        $this->number = $number;
        $this->parse();
    }

    public static function create($number): self
    {
        $self = new static($number);
        return \WeakReference::create($self)->get();
    }

    protected function parse()
    {
        $this->parseLevel();
        $this->parsePoint();
        $this->parseDecor();
    }

    private function parseLevel()
    {
        // BJ独占14；其他序列正常占位即可；
        $this->level = (int)ceil($this->number / 4);
        // 有且只为大王(RJ)的情况，独占15，正序加1即可；
        if ($this->number == self::RED_JOKER_NUMBER){
            $this->level += 1;
        }
    }

    protected function parsePoint(): void
    {
        $this->point = self::LEVEL_MAPS[$this->level] ?? 0;
    }

    protected function parseDecor(): void
    {
        $this->decor = Decor::JOKER;
        if ($this->number >= self::DECOR_BEGIN_NUMBER && $this->number <= self::DECOR_END_NUMBER){
            $this->decor = Decor::generateOne($this->number);
        }
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getPoint(): string
    {
        return $this->point;
    }

    public function getDecor(): string
    {
        return $this->decor;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

}