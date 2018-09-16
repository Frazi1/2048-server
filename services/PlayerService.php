<?php
class PlayerService
{
    public $playerMapper;
    public $gameResultMapper;
    
    public function __construct(PlayerMapper $playerMapper, GameResultMapper $gameResultMapper)
    {
        $this->playerMapper = $playerMapper;
        $this->gameResultMapper = $gameResultMapper;
    }
    public function getAll()
    {
        return $this->playerMapper->getAll();
    }

    public function add($name, $score)
    {
        // $player = new Player;
        // $player->name = $name;

        $player = $this->playerMapper->getByName($name);

        echo "PlayerService->add($name, $score)";
        if($player == null) {
            $player = new Player(null, $name);
            $this->playerMapper->add($player);
        }
        $this->gameResultMapper->addByPlayerId($score, $player->id);
    }
}
