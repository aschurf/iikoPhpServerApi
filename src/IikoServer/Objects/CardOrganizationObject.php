<?php


namespace IikoServer\Api\Objects;


class CardOrganizationObject
{

    public $address;
    public $description;
    public $fullName;
    public $id;
    public $name;
    public $networkId;
    public $phone;
    public $organizationType;

    /**
     * CardOrganizationObject constructor.
     * @param $address
     * @param $description
     * @param $fullName
     * @param $id
     * @param $name
     * @param $networkId
     * @param $phone
     * @param $organizationType
     */
    public function __construct($address, $description, $fullName, $id, $name, $networkId, $phone, $organizationType)
    {
        $this->address = $address;
        $this->description = $description;
        $this->fullName = $fullName;
        $this->id = $id;
        $this->name = $name;
        $this->networkId = $networkId;
        $this->phone = $phone;
        $this->organizationType = $organizationType;
    }


}