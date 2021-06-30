<?php

namespace IikoServer\Api\Objects;

/**
 * Class StoreObject
 * @package IikoServer\Api\Objects
 * @property string             $id                     Unique identifier for this chat, not exceeding 1e13 by absolute value.
 * @property string             $code
 * @property string             $name
 * @property string             $type
 */
class StoreObject
{

    public $id;
    public $code;
    public $name;
    public $type;

    /**
     * StoreObject constructor.
     * @param string $id
     * @param string $code
     * @param string $name
     * @param string $type
     */
    public function __construct(string $id, string $code, string $name, string $type){
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->type = $type;
    }

}
