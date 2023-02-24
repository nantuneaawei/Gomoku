<?php

namespace App\Repositories\MyDB;

use App\Models\MyDB\Game as GameModel;

class Backgammon
{
    private $oGameModel;

    public function __construct(GameModel $_oGameModel)
    {
        $this->oGameModel = $_oGameModel;
    }

    public function insertBoard($_sBoard)
    {
       return $this->oGameModel->insertGetId(['board' => $_sBoard]);
    }

    /**
     * getBoard 用局號取盤面
     *
     * @param  int    $_iRound 局號
     * @return array           盤面
     */
    public function getBoard($_iRound)
    {
        return $this->oGameModel->where(['round_id' => $_iRound])
            ->get()
            ->first()
            ->toArray();
    }

    /**
     * updateBoard 更新盤面
     *
     * @param  int    $_iRound 局號
     * @return array           盤面
     */
    public function updateBoard($_iRound, $_sBoard)
    {
        return $this->oGameModel->where(['round_id' => $_iRound])
            ->update(['board' => $_sBoard]);
    }

}
