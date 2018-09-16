<?php
class PlayerService
{
    public $playerMapper;

    public function __construct(PlayerMapper $playerMapper)
    {
        $this->playerMapper = $playerMapper;
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


    }
}
