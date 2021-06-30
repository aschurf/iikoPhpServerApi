<?php


namespace IikoServer\Api\Objects;


class PersonObject
{

    public $id;
    public $code;
    public $name;
    public $login;
    public $mainRoleId;
    public $mainRoleCode;
    public $cardNumber;
    public $snils;
    public $deleted;

    /**
     * PersonObject constructor.
     * @param $id
     * @param $code
     * @param $name
     * @param $login
     * @param $mainRoleId
     * @param $mainRoleCode
     * @param $cardNumber
     * @param $snils
     * @param $deleted
     */
    public function __construct($id, $code, $name, $login, $mainRoleId, $mainRoleCode, $cardNumber, $snils, $deleted)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->login = $login;
        $this->mainRoleId = $mainRoleId;
        $this->mainRoleCode = $mainRoleCode;
        $this->cardNumber = $cardNumber;
        $this->snils = $snils;
        $this->deleted = $deleted;
    }


}