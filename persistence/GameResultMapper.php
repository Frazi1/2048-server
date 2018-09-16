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

    public function addByPlayerId($score, $playerId) {
        $gameResult = new GameResult(null, $score, $playerId);
        $st = $this->db->prepare(
            "INSERT INTO game_results
             SET score=:score, player_id=:player_id"
        );
        $st->execute(array(
            ":score" => $score,
            ":player_id" => $playerId
        ));

        $gameResult = $this->db->lastInsertId();
        return $gameResult;
    }
}
