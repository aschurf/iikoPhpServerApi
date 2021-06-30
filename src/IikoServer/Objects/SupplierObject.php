<?php


namespace IikoServer\Api\Objects;


class SupplierObject
{

    public $id;
    public $code;
    public $name;
    public $login;
    public $cardNumber;
    public $taxpayerIdNumber;
    public $snils;
    public $deleted;
    public $supplier;
    public $employee;
    public $client;

    public function __construct(string $id, string $code, string $name, string $login, string $cardNumber, string $taxpayerIdNumber, string $snils, bool $deleted, bool $supplier, bool $employee, bool $client){
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->login = $login;
        $this->cardNumber = $cardNumber;
        $this->taxpayerIdNumber = $taxpayerIdNumber;
        $this->snils = $snils;
        $this->deleted = $deleted;
        $this->supplier = $supplier;
        $this->employee = $employee;
        $this->client = $client;
    }
}
