<?php


namespace IikoServer\Api\Objects;


class DepartmentObject
{

    public $id;
    public $code;
    public $name;
    public $type;
    public $taxpayerIdNumber;

    /**
     * StoreObject constructor.
     * @param string $id
     * @param string $code
     * @param string $name
     * @param string $type
     * @param string|null $taxpayerIdNumber
     */
    public function __construct(string $id, string $code, string $name, string $type, string $taxpayerIdNumber = null){
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->type = $type;
        $this->taxpayerIdNumber = $taxpayerIdNumber;
    }

}
