<?php

namespace Tests\Unit\Repositories\MyDB;

use App\Models\MyDB\Game as GameModel;
use App\Repositories\MyDB\Backgammon as BackgammonRepositories;
use Mockery;
use PHPUnit\Framework\TestCase;

class BackgammonTest extends TestCase
{
    /**
     * testInsertInitBoard 寫入初始盤面，回傳局號
     *
     * @return int 局號
     */
    public function testInsertInitBoard()
    {
        $sBoard    = '[[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]';
        $iRoundId  = 1;
        $oGameModel = Mockery::mock(GameModel::class);
        $oGameModel->shouldReceive('insertGetId')
            ->andReturn($iRoundId);

        $aExpected   = 1;
        $oBackgammon = new BackgammonRepositories($oGameModel);
        $aActual     = $oBackgammon->insertBoard($sBoard);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * testGetBoard 取得該局盤面
     *
     * @return void
     */
    public function testGetBoard()
    {
        $iRoundId   = 1;
        $aBoard     = [
            'round_id' => 1,
            'board'    => '[[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]',
        ];
        $oGameModel = Mockery::mock(GameModel::class);
        $oGameModel->shouldReceive('where')
            ->andReturn(Mockery::self())
            ->shouldReceive('get')
            ->andReturn(Mockery::self())
            ->shouldReceive('first')
            ->andReturn(Mockery::self())
            ->shouldReceive('toArray')
            ->andReturn($aBoard);

        $aExpected  = [
            'round_id' => 1,
            'board'    => '[[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0]]',
        ];

        $oBackgammon = new BackgammonRepositories($oGameModel);
        $aActual     = $oBackgammon->getBoard($iRoundId);
        $this->assertEquals($aExpected, $aActual);
    }


}
