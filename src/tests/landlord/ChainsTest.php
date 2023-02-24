<?php
declare(strict_types=1);
namespace lai\poker\tests\landlord;

use lai\poker\landlord\Chains;
use lai\poker\landlord\rules\Bomb;
use lai\poker\landlord\rules\None;
use lai\poker\landlord\rules\Pair;
use lai\poker\landlord\rules\Quadplex;
use lai\poker\landlord\rules\Rocket;
use lai\poker\landlord\rules\Sequence;
use lai\poker\landlord\rules\SequencePair;
use lai\poker\landlord\rules\SequenceTripletWithOne;
use lai\poker\landlord\rules\SequenceTripletWithPair;
use lai\poker\landlord\rules\Single;
use lai\poker\landlord\rules\Triplet;
use lai\poker\landlord\rules\TripletWithOne;
use lai\poker\landlord\rules\TripletWithPair;
use PHPUnit\Framework\TestCase;

class ChainsTest extends TestCase
{
    public function testSingle()
    {
        $numbers = [1];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Single::class, $class,'当为Single实例');

        $numbers = [54];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Single::class, $class,'当为Single实例');
    }

    public function testPair()
    {
        $numbers = [1,2];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Pair::class, $class,'当为Pair实例');

        $numbers = [1,5];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testBomb()
    {
        $numbers = [1,2,3,4];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Bomb::class, $class,'当为Bomb实例');

        $numbers = [45,46,47,48];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Bomb::class, $class,'当为Bomb实例');
    }

    public function testTriplet()
    {
        $numbers = [2,3,4];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Triplet::class, $class,'当为Triplet实例');

        $numbers = [52,53,54];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testRocket()
    {
        $numbers = [53,54];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Rocket::class, $class,'当为Rocket实例');

        $numbers = [52,54];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testSequence()
    {
        $numbers = [1,5,9,13,17,21];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Sequence::class, $class,'当为Sequence实例');

        $numbers = [2,5,9,13,17,22,29];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testSequencePair()
    {
        $numbers = [21,22,25,26,29,30];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(SequencePair::class, $class,'当为SequencePair实例');

        $numbers = [21,22,25,26,29,33];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testSequenceTripletWithOne()
    {
        $numbers = [1,2,3,51,5,6,7,54];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(SequenceTripletWithOne::class, $class,'当为SequenceTripletWithOne实例');

        $numbers = [1,2,3,53,5,6,7];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testSequenceTripletWithPair()
    {
        $numbers = [1,2,3,5,6,7,9,10,13,14];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(SequenceTripletWithPair::class, $class,'当为SequenceTripletWithPair实例');

        $numbers = [1,2,3,5,6,7,53,54,47,48];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testTripletWithOne()
    {
        $numbers = [1,2,3,5];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(TripletWithOne::class, $class,'当为TripletWithOne实例');

        $numbers = [1,2,53,54];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testTripletWithPair()
    {
        $numbers = [1,2,3,5,6];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(TripletWithPair::class, $class,'当为TripletWithPair实例');

        $numbers = [5,6,9,53,52];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testQuadplex()
    {
        $numbers = [1,2,3,4,9,13];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(Quadplex::class, $class,'当为Quadplex实例');

        $numbers = [1,2,3,4,51,52];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

    public function testNone()
    {
        $numbers = [];
        $class = Chains::create($numbers)->handle()->get();
        $this->assertInstanceOf(None::class, $class,'当为None实例');
    }

}