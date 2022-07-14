<?php


namespace IikoServer\Api\Methods;


use DOMDocument;
use IikoServer\Api\Exceptions\PersonException;
use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\PersonObject;
use SimpleXMLElement;
use function Webmozart\Assert\Tests\StaticAnalysis\string;

trait Persons
{

    use IikoRequests;

    protected $persons = [];

    private $personInfo = [
        "firstname" => null,
        "lastName" => null,
        "code" => null,
        "mainRoleCode" => null,
        "cardNumber" => null
    ];
    /**
     * Return array of persons organization
     * @param array $params
     */
    public function getPersons() : array {

        $request = $this->request($this->persons_endpoint, $this->key, 'GET');
        $persons = new SimpleXMLElement($request);
        foreach ($persons->employee as $person){
            $this->persons[] = new PersonObject(
                strval($person->id),
                strval($person->code),
                strval($person->name),
                strval($person->login),
                strval($person->mainRoleId),
                strval($person->mainRoleCode),
                strval($person->cardNumber),
                strval($person->snils),
                strval($person->deleted)
            );
        }

        return $this->persons;

    }

    /**
     * @param array $params
     * @return PersonObject
     * @throws PersonException
     */
    private function addPerson(array $params) {
        $this->validateFirstName($params);
        $dom = new DomDocument('1.0');
        $newPerson = $dom->appendChild($dom->createElement('employee'));

        foreach ($this->personInfo as $key => $info){
            $code = $newPerson->appendChild($dom->createElement($key));
            $code->appendChild($dom->createTextNode($this->personInfo[$key]));
        }

        $dom->formatOutput = true;
        $result = $dom->saveXML();

        var_dump($result);
    }

    /**
     * @param array $params
     * @throws PersonException
     */
    public function validateFirstName(array $params){
        foreach ($this->personInfo as $key => $info){
            if (array_key_exists($key, $params) && is_string($params[$key])){
                $this->personInfo[$key] = $params[$key];
            } else {
                throw PersonException::requiredValueNotFound('Required "'.$key.'" not supplied in parameters');
            }
        }
    }
}