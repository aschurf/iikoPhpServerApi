<?php


namespace IikoServer\Api\Objects;


class ProductObject
{

    public $id;
    public $deleted;
    public $name;
    public $description;
    public $num;
    public $code;
    public $taxCategory;
    public $category;
    public $accountingCategory;
    public $mainUnit;
    public $type;
    public $unitWeight;
    public $unitCapacity;

    /**
     * ProductObject constructor.
     * @param $id
     * @param $deleted
     * @param $name
     * @param $description
     * @param $num
     * @param $code
     * @param $taxCategory
     * @param $category
     * @param $accountingCategory
     * @param $mainUnit
     * @param $type
     * @param $unitWeight
     * @param $unitCapacity
     */
    public function __construct($id, $deleted, $name, $description, $num, $code, $taxCategory, $category, $accountingCategory, $mainUnit, $type, $unitWeight, $unitCapacity)
    {
        $this->id = $id;
        $this->deleted = $deleted;
        $this->name = $name;
        $this->description = $description;
        $this->num = $num;
        $this->code = $code;
        $this->taxCategory = $taxCategory;
        $this->category = $category;
        $this->accountingCategory = $accountingCategory;
        $this->mainUnit = $mainUnit;
        $this->type = $type;
        $this->unitWeight = $unitWeight;
        $this->unitCapacity = $unitCapacity;
    }


}
