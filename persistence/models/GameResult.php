<?php
class GameResult  {
    public $id;
    public $score;
    public $playerId;

    public function __construct($id, $score, $playerId)
    {
        $this->id = $id;
        $this->score = $score;
        $this->playerId = $playerId;
    }
}