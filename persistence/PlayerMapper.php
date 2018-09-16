<?php
class PlayerMapper extends DataMapper
{
    public function __construct($db) {
        parent::__construct($db);
    }

    public function mapToEntity($playerProps) {
        $id = $playerProps[0];
        $name = $playerProps["name"];
        return new Player($id, $name);
    }

    private function mapToEntitiesInternal($objects) {
        return $this->mapToEntities(array('PlayerMapper', 'mapToPlayer'), $objects);
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
        $mapped = $this->mapToEntitiesInternal($res);
        return $mapped;
    }

    public function getAll() {
        $st = $this->db->prepare(
            "SELECT * FROM players p
             LEFT JOIN game_results r ON p.id=r.player_id
             "
        );
        $st->execute();
        $res = $st->fetchAll();
        $mapped = $this->mapToEntitiesInternal($res);
        // var_dump($res);
        return $mapped;
    }
}
