<?php


namespace IikoServer\Api\Methods;


use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\CardOrganizationObject;

trait CardOrganizations
{
    use IikoRequests;

    /**
     * @return array
     * @throws \IikoServer\Api\Exceptions\IikoApiException
     */
    public function getOrganizations() : array {
        $organizations = $this->cardRequest('/organization/list', $this->token, 'GET');
        $jsonParse = json_decode($organizations);

        $listOfOrganizations = [];
        foreach ($jsonParse as $j){
            $listOfOrganizations[] = new CardOrganizationObject(
              $j->address,
              $j->description,
              $j->fullName,
              $j->id,
              $j->name,
              $j->networkId,
              $j->phone,
              $j->organizationType,
            );
        }

        return $listOfOrganizations;
    }
}