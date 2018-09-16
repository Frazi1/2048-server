<?php
class PlayerMapper extends DataMapper
{
    public $gameResultMapper;

    public function __construct($db, $gameResultMapper) {
        parent::__construct($db);
        $this->gameResultMapper = $gameResultMapper;
    }

    public function mapToEntity($playerProps) {
        $playerId = $playerProps[0];
        $name = $playerProps["name"];
        return new Player($playerId, $name);
    }

    public function add(Player $player)
    {
        $st = $this->db->prepare(
            "INSERT INTO players
             SET name = :name"
        );
        $st->execute([
            ':name' => $player->name
        ]);

        $lastId = $this->db->lastInsertId();
        $player->id = $lastId;
        return $player;
    }

    public function getByName($name)
    {
        $st = $this->db->prepare(
            "SELECT * FROM players
             WHERE name=:name
             LIMIT 1"
        );
        $st->execute([
            ":name" => $name
        ]);
        $res = $st->fetch();
        if($res === false) return null;
        $mapped = $this->mapToEntity($res);
        return $mapped;
    }

    public function getAll() {
        $st = $this->db->prepare(
            "SELECT id, `name` FROM players p"
        );
        $st->execute();
        $players = $this->mapToEntities($st->fetchAll());
        foreach ($players as &$player) {
            //TODO: Fix n+1
            $player->gameResults = $this->gameResultMapper->getByPlayerId($player->id);
        }
        return $players;
    }
}
