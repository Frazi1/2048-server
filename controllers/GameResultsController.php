<?php
class GameResultsController extends BaseController
{
    private $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }
    public function topWithPlayers()
    {
        $top=$this->getQueryParam("top");
        return $this->playerService->topGamesWithPlayers($top);
    }
}
