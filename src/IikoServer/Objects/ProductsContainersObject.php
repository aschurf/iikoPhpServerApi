<?php


namespace IikoServer\Api\Objects;


class ProductsContainersObject
{

    public $id;
    public $num;
    public $name;
    public $count;
    public $minContainerWeight;
    public $maxContainerWeight;
    public $containerWeight;
    public $fullContainerWeight;
    public $deleted;
    public $useInFront;

    /**
     * ProductsContainersObject constructor.
     * @param $id
     * @param $num
     * @param $name
     * @param $count
     * @param $minContainerWeight
     * @param $maxContainerWeight
     * @param $containerWeight
     * @param $fullContainerWeight
     * @param $deleted
     * @param $useInFront
     */
    public function __construct(string $id, string $num, string $name, float $count, float $minContainerWeight, float $maxContainerWeight, float $containerWeight, float $fullContainerWeight, bool $deleted, bool $useInFront)
    {
        $this->id = $id;
        $this->num = $num;
        $this->name = $name;
        $this->count = $count;
        $this->minContainerWeight = $minContainerWeight;
        $this->maxContainerWeight = $maxContainerWeight;
        $this->containerWeight = $containerWeight;
        $this->fullContainerWeight = $fullContainerWeight;
        $this->deleted = $deleted;
        $this->useInFront = $useInFront;
    }


}
