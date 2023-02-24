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

use lai\poker\landlord\rules\ChainRulesInterface;
use lai\poker\landlord\rules\RulesInterface;
use lai\poker\landlord\traits\TraitChains;

class Chains implements ChainRulesInterface
{
    use TraitChains;

    protected ?array $numbers = [];

    protected \SplDoublyLinkedList $linkedList;

    protected ?RulesInterface $rule = null;

    public function __construct($numbers = [])
    {
        $this->numbers = $numbers;
        $this->linkedList = new \SplDoublyLinkedList();
    }

    public static function create($numbers = []): self
    {
        return new self($numbers);
    }

    public function handle(): self
    {
        $this->prepareNextRules();
        $this->handleNext();
        return $this;
    }

    public function get(): ?RulesInterface
    {
        return $this->rule;
    }

    public function setNext($next)
    {
        $this->linkedList->push($next);
    }

    public function handleNext()
    {
        for ($this->linkedList->rewind(); $this->linkedList->valid(); $this->linkedList->next()) {
            $rule = $this->linkedList->current();
            if ($rule instanceof RulesInterface && $rule->is()) {
                $this->rule = $rule;
                break;
            }
        }
    }
}