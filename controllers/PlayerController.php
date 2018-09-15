<?php
class PlayerController
{
    public function getAll()
    {
        return ["valera", "tomato"];
    }

    public function getById($id)
    {
        return $id;
    }
}
