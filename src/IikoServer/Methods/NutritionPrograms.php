<?php


namespace IikoServer\Api\Methods;


use IikoServer\Api\Exceptions\IikoApiException;
use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\CardCorporatePrograms;
use IikoServer\Api\Objects\CardCorporateProgramWallets;

trait NutritionPrograms
{

    use IikoRequests {
        IikoRequests::cardRequest as cRequest;
    }

    /**
     * Return array of corporate catering programs by organization ID
     * @param string $organizationId
     * @return array
     * @throws \IikoServer\Api\Exceptions\IikoApiException
     */
    public function getCorporateNutritionPrograms(string $organizationId) : array {
        $response = $this->cRequest('/organization/'.$organizationId.'/corporate_nutritions', $this->token, 'GET');
        $response = json_decode($response);

        $listOfPrograms = [];

        foreach ($response as $r){
            $wallets = [];
            foreach ($r->wallets as $w){
                $wallets[] = new CardCorporateProgramWallets($w->id, $w->name, $w->programType, $w->type);
            }
            $listOfPrograms[] = new CardCorporatePrograms($r->id, $r->description, $r->name, $r->serviceFrom, $r->serviceTo, $wallets);
        }

        return $listOfPrograms;
    }


    /**
     * @param string $customerId
     * @param string $organizationId
     * @param string $corporateNutritionId
     * @throws \IikoServer\Api\Exceptions\IikoApiException
     */
    public function includePersonToNutritionProgram(string $customerId, string $organizationId, string $corporateNutritionId) : string {

        $response = $this->cRequest('/customers/'.$customerId.'/add_to_nutrition_organization', $this->token,
                                        'POST', [], '&organization='.$organizationId.'&corporate_nutrition_id='.$corporateNutritionId);

        if ($response[0] != '{'){
            $response = str_replace('"', '', $response);
            return $response;
        } else {
            $jsonError = json_decode($response);
            throw IikoApiException::cardApiIncorrect($jsonError->message);
        }

    }



    public function excludePersonToNutritionProgram(string $customerId, string $organizationId, string $corporateNutritionId) : string {

        $response = $this->cRequest('/customers/'.$customerId.'/remove_from_nutrition_organization', $this->token,
            'POST', [], '&organization='.$organizationId.'&corporate_nutrition_id='.$corporateNutritionId);

        if ($response[0] != '{'){
            return 'Customer was deleted from Nutrition Program';
        } else {
            $jsonError = json_decode($response);
            throw IikoApiException::cardApiIncorrect($jsonError->message);
        }

    }

}