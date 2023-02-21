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

class Decor
{
    // 黑桃
    const SPADE = 'S';
    // 红桃
    const HEART = 'H';
    // 方块
    const DIAMOND = 'D';
    // 梅花
    const CLUB = 'C';
    // 鬼牌
    const JOKER = 'JOKER';

    /**
     * 获取花色集合
     * @return string[]
     */
    public static function getAll(): array
    {
        return [1=>self::SPADE, self::HEART, self::DIAMOND, self::CLUB];
    }

    /**
     * 根据$number取得对应的花色，用在2-A，不含大小王
     * @param $number
     * @return string
     */
    public static function generateOne($number): string
    {
        $fn = fn($fours, $remainder) => $fours[$remainder != 0 ? $remainder : 4];
        return $fn(self::getAll(), $number % 4);
    }
}