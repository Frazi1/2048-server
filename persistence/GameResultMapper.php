<?php
class GameResultMapper extends DataMapper {
    public function mapToEntity($entity)
    {
        $id = $entity[0];
        $score = $entity["score"];
        $playerId = $entity["player_id"];
        $gameResult = new GameResult($id, $score, $playerId);
        return $gameResult;
    }
    
    public function getByPlayerId($playerId)
    {
        $st = $this->db->prepare(
            "SELECT * FROM game_results
             WHERE player_id = :player_id"
        );
        $st->execute(array(":player_id" => $playerId));
        $results = $st->fetchAll();
        return $this->mapToEntities($results);
    }

    public function add(GameResult $gameResult) {
        $st = $this->db->prepare(
            "INSERT INTO game_results
             SET score=:score, player_id=:player_id"
        );
        $st->execute(array(
            ":score" => $gameResult->score,
            ":player_id" => $gameResult->playerId
        ));

        $gameResult = $this->db->lastInsertId();
        return $gameResult;
    }

    public function topWithPlayers($count)
    {
        $limitExpr = "";
        if($count) {
            $limitExpr = "LIMIT ".$count;
        }
        $st = $this->db->prepare(
            "SELECT gr.score as score, p.name as playerName FROM game_results gr
             LEFT JOIN players p ON p.id = gr.player_id 
             ORDER BY gr.score DESC
             ".$limitExpr
        );

        $st->execute();

        $currentIndex = 1;
        $objects = $st->fetchAll();
        $res = array_map(function($item) use($currentIndex) {
            $dto = new GameResultDto;
            $dto->position = $currentIndex++;
            $dto->score = $item["score"];
            $dto->playerName = $item["playerName"];
            return $dto;
        }, $objects);
        return $res;
    }
}
