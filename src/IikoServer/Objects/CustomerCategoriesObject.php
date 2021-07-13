<?php


namespace IikoServer\Api\Objects;


class CustomerCategoriesObject
{


    public $id;
    public $isActive;
    public $isDefaultForNewGuests;
    public $name;

    /**
     * CustomerCategoriesObject constructor.
     * @param $id
     * @param $isActive
     * @param $isDefaultForNewGuests
     * @param $name
     */
    public function __construct($id, $isActive, $isDefaultForNewGuests, $name)
    {
        $this->id = $id;
        $this->isActive = $isActive;
        $this->isDefaultForNewGuests = $isDefaultForNewGuests;
        $this->name = $name;
    }


}