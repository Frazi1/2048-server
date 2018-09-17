<?php
class PlayerController extends BaseController
{
    private $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function getAll()
    {
        return $this->playerService->getAll();
    }

    public function add()
    {
        $score = $this->getQueryParam("score");
        $name = $this->getQueryParam("name");
        $this->playerService->add($name, $score);
    }

    public function getById($id)
    {
        return $id;
    }
}
