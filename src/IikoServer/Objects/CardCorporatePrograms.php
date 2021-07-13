<?php


namespace IikoServer\Api\Objects;


class CardCorporatePrograms
{

    public $id;
    public $description;
    public $name;
    public $serviceFrom;
    public $serviceTo;
    public $wallets = [];

    /**
     * CardCorporatePrograms constructor.
     * @param $id
     * @param $description
     * @param $name
     * @param $serviceFrom
     * @param $serviceTo
     */
    public function __construct($id, $description, $name, $serviceFrom, $serviceTo, $wallets)
    {
        $this->id = $id;
        $this->description = $description;
        $this->name = $name;
        $this->serviceFrom = $serviceFrom;
        $this->serviceTo = $serviceTo;
        $this->wallets = $wallets;
    }


}