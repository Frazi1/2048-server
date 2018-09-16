<?php
class Player 
{
    public $id;
    public $name;
    public $gameResults;

    public function __construct($id, $name, $gameResults = null)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
