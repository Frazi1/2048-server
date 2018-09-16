<?php
abstract class DataMapper {
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    protected abstract function mapToEntity($entity);

    protected final function mapToEntities($objects) 
    {
        $mapped = null;
        if(is_array($objects) && is_array(reset($objects))) {
            $mapped = array_map(function($item) {
                return $this->mapToEntity($item);
            }, $objects);
        }
        else {
            $mapped = $this->mapToEntity($objects);
        }
        return $mapped;
    }
}