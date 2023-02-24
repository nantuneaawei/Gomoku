<?php

namespace App\Services\Lession;

use App\Repositories\MyDB\Backgammon as BackgammonRepositories;
use App\Services\Lession\Game;
use Mockery;
use PHPUnit\Framework\TestCase;


class GameTest extends TestCase
{
    private $oBackgammonRepositories;

    public function setUp(): void
    {
        $this->oBackgammonRepositories = Mockery::mock(BackgammonRepositories::class);
    }

    /**
     * testStartRound 初始盤面
     *
     * @return void
     */
    public function testStartRound()
    {
        $aBoard = [
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
        ];
        $iRoundID = 1;

        $this->oBackgammonRepositories->shouldReceive('insertBoard')
            ->once()
            ->andReturn($iRoundID);

        $aExpected = ['Board' => $aBoard, 'RoundID' => $iRoundID];

        $oServices = new Game($this->oBackgammonRepositories);
        $aActual = $oServices->startRound();
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * testStartRound1 測試黑子先下(0,0)
     *
     * @return void
     */
    public function testStartRound1()
    {
        $iRoundID = 1;
        $aBoard = [
            'round_id' => 1,
            'board'    => '[[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]',
        ];
        $this->oBackgammonRepositories->shouldReceive('getBoard')
            ->once()
            ->andReturn($aBoard);

        $aExpected = [
            'event' => true,
            'board' => [
            [1, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            ],
        ];
        $oServices = new Game($this->oBackgammonRepositories);
        $aActual   = $oServices->handleLocation(0, 0, $iRoundID);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * testStartRound2 測試黑子先下(1,1)
     *
     * @return void
     */
    public function testStartRound2()
    {
        $iRoundID = 1;
        $aBoard = [
            'round_id' => 1,
            'board'    => '[[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]',
        ];
        $this->oBackgammonRepositories->shouldReceive('getBoard')
            ->once()
            ->andReturn($aBoard);
        
        $aExpected = [
            'event' => true,
            'board' => [
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 1, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            ],
        ];
        $oServices = new Game($this->oBackgammonRepositories);
        $aActual   = $oServices->handleLocation(1, 1, $iRoundID);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * testRoundTwoCase1 測試白子第二回合下(0,2)
     *
     * @return void
     */
    public function testRoundTwoCase1()
    {
        $iRoundID = 2;
        $aBoard = [
            'round_id' => 2,
            'board'    => '[[1,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]',
        ];
        $this->oBackgammonRepositories->shouldReceive('getBoard')
            ->once()
            ->andReturn($aBoard);
        
        $aExpected = [
            'event' => true,
            'board' => [
            [1, 0, 2, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            ],
        ];
        $oServices = new Game($this->oBackgammonRepositories);
        $aActual   = $oServices->handleLocation(0, 2, $iRoundID);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * testRoundTwoCase2 第二回合白下(1,2)
     * 座標1, 2
     * 
     * @return void
     */
    public function testRoundTwoCase2()
    {
        $iRoundID = 2;
        $aBoard = [
            'round_id' => 2,
            'board'    => '[[1,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]',
        ];
        $this->oBackgammonRepositories->shouldReceive('getBoard')
            ->once()
            ->andReturn($aBoard);
        
        $aExpected = [
            'event' => true,
            'board' => [
            [1, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 2, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            ],
        ];
        $oServices = new Game($this->oBackgammonRepositories);
        $aActual   = $oServices->handleLocation(1, 2, $iRoundID);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * testRoundTwoCase3 第二回合白下，重複下
     * 座標2, 2
     *
     * @return void
     */
    public function testRoundTwoCase3()
    {
        $iRoundID = 2;
        $aBoard = [
            'round_id' => 2,
            'board'    => '[[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,1,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]',
        ];
        $this->oBackgammonRepositories->shouldReceive('getBoard')
            ->once()
            ->andReturn($aBoard);
        
        $aExpected = [
            'event' => false,
            'board' => [
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 1, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            ],
        ];
        $oServices = new Game($this->oBackgammonRepositories);
        $aActual   = $oServices->handleLocation(2, 2, $iRoundID);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * testRoundThreeCase1 第三回合黑下
     * 座標0, 3
     *
     * @return void
     */
    public function testRoundThreeCase1()
    {
        $iRoundID = 3;
        $aBoard = [
            'round_id' => 3,
            'board'    => '[[0,0,0,0,0,0,0,0,0,0,0],[0,0,2,0,0,0,0,0,0,0,0],[0,0,1,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]',
        ];
        $this->oBackgammonRepositories->shouldReceive('getBoard')
            ->once()
            ->andReturn($aBoard);
        
        $aExpected = [
            'event' => true,
            'board' => [
            [0, 0, 0, 1, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 2, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 1, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            ],
        ];
        $oServices = new Game($this->oBackgammonRepositories);
        $aActual   = $oServices->handleLocation(0, 3, $iRoundID);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * testCheckWinCase1 判斷輸贏,黑贏
     * 座標0, 0
     *
     * @return void
     */
    public function testCheckWinCase1()
    {
        $aBoard = [
            [1, 1, 1, 1, 1, 0, 0, 0 ,0 ,0 ,0],
            [0, 2, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 2, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 2, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 2, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
        ];

        $sExpected = ['Status' => 'Win', 'Player' => 'B'];
        $oServices = new Game($this->oBackgammonRepositories);
        $sActual   = $oServices->checkWhoWinLose(0, 0, $aBoard);
        $this->assertEquals($sExpected, $sActual);

    }

    /**
     * testCheckWinCase2 判斷輸贏,白贏
     * 座標0, 3
     *
     * @return void
     */
    public function testCheckWinCase2()
    {
        $aBoard = [
            [1, 1, 1, 2, 2, 2, 2, 2 ,0 ,0 ,0],
            [1, 2, 0, 0, 1, 0, 0, 0 ,0 ,0 ,0],
            [1, 0, 0, 2, 0, 2, 0, 0 ,0 ,0 ,0],
            [1, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 2, 0, 0, 0 ,0 ,0 ,0],
            [1, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
        ];

        $sExpected = ['Status' => 'Win', 'Player' => 'W'];
        $oServices = new Game($this->oBackgammonRepositories);
        $sActual   = $oServices->checkWhoWinLose(0, 3, $aBoard);
        $this->assertEquals($sExpected, $sActual);

    }

    /**
     * testCheckWinCase3 判斷輸贏,白贏
     * 座標1, 1
     *
     * @return void
     */
    public function testCheckWinCase3()
    {
        $aBoard = [
            [1, 1, 1, 2, 2, 2, 2, 0 ,0 ,0 ,0],
            [1, 2, 0, 0, 1, 0, 0, 0 ,0 ,0 ,0],
            [1, 0, 2, 2, 0, 2, 0, 0 ,0 ,0 ,0],
            [1, 0, 0, 2, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 1, 0, 1, 2, 0, 0, 0 ,0 ,0 ,0],
            [1, 0, 0, 0, 0, 2, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
            [0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0],
        ];

        $sExpected = ['Status' => 'Win', 'Player' => 'W'];
        $oServices = new Game($this->oBackgammonRepositories);
        $sActual   = $oServices->checkWhoWinLose(1, 1, $aBoard);
        $this->assertEquals($sExpected, $sActual);

    }

    /**
     * testCheckWinCase4 判斷輸贏,平手
     * 座標1, 1
     *
     * @return void
     */
    public function testCheckWinCase4()
    {
        $aBoard = [
            [2, 1, 1, 2, 2, 2, 2, 1 ,2 ,1 ,2],
            [1, 2, 2, 1, 1, 1, 2, 1 ,2 ,1 ,2],
            [2, 2, 1, 2, 1, 2, 1, 2 ,1 ,2 ,1],
            [1, 1, 2, 2, 1, 1, 2, 1 ,1 ,1 ,2],
            [2, 1, 1, 1, 2, 1, 2, 2 ,2 ,2 ,1],
            [1, 2, 1, 2, 2, 1, 1, 2 ,1 ,2 ,2],
            [2, 2, 1, 1, 2, 2, 1, 2 ,1 ,2 ,1],
            [1, 2, 1, 1, 1, 2, 1, 2 ,1 ,2 ,1],
            [2, 1, 2, 1, 1, 2, 2, 1 ,2 ,1 ,2],
            [1, 2, 1, 2, 1, 2, 1, 1 ,2 ,1 ,2],
            [2, 1, 2, 1, 2, 1, 2, 2 ,1 ,2 ,1],
        ];

        $sExpected = ['Status' => 'Tie', 'Player' => 'BW'];
        $oServices = new Game($this->oBackgammonRepositories);
        $sActual   = $oServices->checkWhoWinLose(1, 1, $aBoard);
        $this->assertEquals($sExpected, $sActual);

    }

    /**
     * testCheckWinCase5 判斷輸贏,未結束
     * 座標1, 1
     *
     * @return void
     */
    public function testCheckWinCase5()
    {
        $aBoard = [
            [0, 1, 1, 2, 2, 2, 2, 1 ,2 ,1 ,2],
            [1, 2, 2, 1, 1, 1, 2, 1 ,2 ,1 ,2],
            [2, 2, 1, 2, 1, 2, 1, 2 ,1 ,2 ,1],
            [1, 1, 2, 2, 1, 1, 2, 1 ,1 ,1 ,2],
            [2, 1, 1, 1, 2, 1, 2, 2 ,2 ,2 ,1],
            [1, 2, 1, 2, 2, 1, 1, 2 ,1 ,2 ,2],
            [2, 2, 1, 1, 2, 2, 1, 2 ,1 ,2 ,1],
            [1, 2, 1, 1, 1, 2, 1, 2 ,1 ,2 ,1],
            [2, 1, 2, 1, 1, 2, 2, 1 ,2 ,1 ,2],
            [1, 2, 1, 2, 1, 2, 1, 1 ,2 ,1 ,2],
            [2, 1, 2, 1, 2, 1, 2, 2 ,1 ,2 ,1],
        ];

        $sExpected = ['Status' => '-', 'Player' => '-'];
        $oServices = new Game($this->oBackgammonRepositories);
        $sActual   = $oServices->checkWhoWinLose(1, 1, $aBoard);
        $this->assertEquals($sExpected, $sActual);

    }
}