<?php
class PlayerService
{
    public function getAll()
    {
        return PlayerMapper::getAll();
    }

    public function add($name, $score)
    {
        $player = new Player;
        $player->name = $name;

        echo "PlayerService->add($name, $score)";
        PlayerMapper::add($player);
    }
}
