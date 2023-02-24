<?php

namespace App\Services\Lession;

use App\Repositories\MyDB\Backgammon as BackgammonRepositories;

class Game
{
    private $oBackgammonRepositories;

    public function __construct(BackgammonRepositories $_oBackgammonRepositories)
    {
        $this->oBackgammonRepositories = $_oBackgammonRepositories;
    }

    /**
     * startRound 初始盤面
     * 0 空格
     *
     *
     * @return array 初始盤面
     */
    public function startRound()
    {
        $aBoard = [
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        ];

        $iRoundID = $this->oBackgammonRepositories->insertBoard(json_encode($aBoard));
        return ['Board' => $aBoard, 'RoundID' => $iRoundID];

    }

    /**
     * handleLocation 處理位置
     *
     * @param  int $_iX X軸
     * @param  int $_iY Y軸
     * @param  int $_iRoundID 局號
     * @return array    新盤面
     */
    public function handleLocation($_iX, $_iY, $_iRoundID)
    {
        $aBoardData = $this->oBackgammonRepositories->getBoard($_iRoundID);
        $aBoard = json_decode($aBoardData['board'], true);
        $bStatus = $this->checkBoard($aBoard, $_iX, $_iY);
        if (!$bStatus) {
            return ['event' => $bStatus, 'board' => $aBoard];
        }
        $aBoard[$_iX][$_iY] = $this->isBW($aBoard);
        return ['event' => $bStatus, 'board' => $aBoard];
    }

    /**
     * isBW 判斷是要黑還是白
     *
     * @param  array $_aBoard 盤面
     * @return int            1(B)/2(W)
     */
    private function isBW($_aBoard)
    {
        $iB = 0;
        $iW = 0;
        foreach ($_aBoard as $aXValue) {
            foreach ($aXValue as $iBW) {
                if ($iBW === 1) {
                    $iB++;
                }
                if ($iBW === 2) {
                    $iW++;
                }
            }
        }
        if ($iW === 0 && $iB === 0) {
            return 1;
        }

        if (($iB - $iW) == 1) {
            return 2;
        }
        return 1;
    }

    /**
     * checkBoard 檢查盤面是否已下過
     *
     * @param  array $_aBoard  盤面
     * @param  int   $_iX      X軸
     * @param  int   $_iY      Y軸
     * @return bool            true(可下) / false(不可下)
     */
    private function checkBoard($_aBoard, $_iX, $_iY)
    {
        if ($_aBoard[$_iX][$_iY] !== 0) {
            return false;
        }
        return true;
    }

    /**
     * checkWhoWinLose 判斷輸贏
     *
     * @param  int $_iX X軸
     * @param  int $_iY Y軸
     * @param  array $_aBoard 盤面
     * @return array 輸贏結果
     */
    public function checkWhoWinLose($_iX, $_iY, $_aBoard)
    {
        $iWin = 0;
        $iTie = 0;
        $iPoint = $_aBoard[$_iX][$_iY];

        $bCheck = function ($_iX, $_iY, $_aBoard, $_iPoint) {
            $iMax = 0;
            $iX = $_iX;
            $iY = $_iY;
            $aDir = [
                [
                    [-1, 0],
                    [1, 0],
                ],
                [
                    [0, -1],
                    [0, 1],
                ],
                [
                    [-1, -1],
                    [1, 1],
                ],
                [
                    [1, -1],
                    [-1, 1],
                ],
            ];
            for ($i = 0; $i < 4; $i++) {
                $iCount = 1;
                for ($j = 0; $j < 2; $j++) {
                    $bFlag = true;
                    while ($bFlag) {
                        $iX = $iX + $aDir[$i][$j][0];
                        $iY = $iY + $aDir[$i][$j][1];

                        if ($iX >= 0 && $iX <= 10 && $iY >= 0 && $iY <= 10) {
                            if ($_aBoard[$iX][$iY] == $_iPoint) {
                                $iCount++;
                            } else {
                                $bFlag = false;
                            }

                        } else {
                            $bFlag = false;
                        }

                    }
                    $iX = $_iX;
                    $iY = $_iY;
                }

                if ($iCount >= 5) {
                    $iMax = 1;
                    break;
                } else {
                    $iMax = 0;
                }

            }
            if ($iMax == 1) {
                return true;
            } else {
                return false;
            }

        };

        if ($bCheck($_iX, $_iY, $_aBoard, $iPoint)) {
            $iWin = $iPoint;
        }

        foreach ($_aBoard as $aXArr)
        {
            foreach ($aXArr as $iAll)
            {
                if ($iAll == 0)
                {
                    $iTie++;
                }
            }
        }

        if ($iWin == 0 && $iTie != 0)
        {
            $iWin = 3;
        }

        switch ($iWin) {
            case 0:
                return ['Status' => 'Tie', 'Player' => 'BW'];
                break;
            case 1:
                return ['Status' => 'Win', 'Player' => 'B'];
                break;
            case 2:
                return ['Status' => 'Win', 'Player' => 'W'];
                break;
            case 3:
                return ['Status' => '-', 'Player' => '-'];
                break;
        }

    }
}
