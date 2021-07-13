<?php


namespace IikoServer\Api\Objects;


class CustomerWalletInfoObject
{

    public $id;
    public $name;
    public $programType;
    public $type;

    /**
     * CustomerWalletInfoObject constructor.
     * @param $id
     * @param $name
     * @param $programType
     * @param $type
     */
    public function __construct($id, $name, $programType, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->programType = $programType;
        $this->type = $type;
    }


}