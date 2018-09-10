<?php
class GetPlayersHandler extends RequestHandler
{
    public function handleReq(HttpRequest $req) {
        return ["valera", "petro"];
    }
}
