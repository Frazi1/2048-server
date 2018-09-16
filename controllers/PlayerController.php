<?php
class PlayerController
{
    private $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    protected static function getQueryParam($name) {
        return $_GET[$name];
    }

    public function getAll()
    {
        return $this->playerService->getAll();
    }

    public function add()
    {
        $score = self::getQueryParam("score");
        $name = self::getQueryParam("name");
        $this->playerService->add($name, $score);
    }

    public function getById($id)
    {
        return $id;
    }
}
