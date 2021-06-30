<?php


namespace IikoServer\Api\Methods;


use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\PersonObject;
use SimpleXMLElement;

trait Persons
{

    use IikoRequests;

    protected $persons = [];

    /**
     * Return array of persons organization
     * @param array $params
     */
    public function getPersons() : array {

        $request = $this->request($this->persons_endpoint, $this->key, 'GET');
        $persons = new SimpleXMLElement($request);
        foreach ($persons->employee as $person){
            $this->persons[] = new PersonObject(
                $person->id,
                $person->code,
                $person->name,
                $person->login,
                $person->mainRoleId,
                $person->mainRoleCode,
                $person->cardNumber,
                $person->snils,
                $person->deleted,
            );
        }

        return $this->persons;

    }
}