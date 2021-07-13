<?php


namespace IikoServer\Api\Objects;


class CustomerCardObject
{


    public $id;
    public $isActivated;
    public $number;
    public $organizationId;
    public $track;
    public $validToDate;

    /**
     * CustomerCardObject constructor.
     * @param $id
     * @param $isActivated
     * @param $number
     * @param $organizationId
     * @param $track
     * @param $validToDate
     */
    public function __construct($id, $isActivated, $number, $organizationId, $track, $validToDate)
    {
        $this->id = $id;
        $this->isActivated = $isActivated;
        $this->number = $number;
        $this->organizationId = $organizationId;
        $this->track = $track;
        $this->validToDate = $validToDate;
    }


}