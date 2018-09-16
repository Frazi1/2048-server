<?php
class PlayerMapper extends DataMapper
{
    private static function mapToPlayer($playerProps) {
        $id = $playerProps["id"];
        $name = $playerProps["name"];
        return new Player($id, $name);
    }

    public static function add(Player $player)
    {
        $st = self::$db->prepare(
            "INSERT INTO players
             SET name = :name"
        );
        $st->execute([
            ':name' => $player->name
        ]);
    }

    public static function getAll() {
        $st = self::$db->prepare(
            "SELECT * FROM players p
             LEFT JOIN game_results r ON p.id=r.player_id"
        );
        $st->execute();
        $res = $st->fetchAll();
        $mapped = array_map(array('PlayerMapper', 'mapToPlayer'), $res);
        // var_dump($res);
        return $mapped;
    }
}
