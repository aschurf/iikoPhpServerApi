<?php


namespace IikoServer\Api;


use IikoServer\Api\Methods\CardCustomers;
use IikoServer\Api\Methods\NutritionPrograms;
use IikoServer\Api\Methods\CardOrganizations;

class IikoCard extends IikoCardApi
{


    use CardOrganizations;
    use CardCustomers;
    use NutritionPrograms {
        CardOrganizations::request insteadof NutritionPrograms;
        CardOrganizations::cardRequest insteadof NutritionPrograms;
        CardCustomers::request insteadof CardOrganizations;
        CardCustomers::cardRequest insteadof CardOrganizations;
    }
    /**
     * IikoCard constructor.
     * @param string $userId
     * @param string $userPassword
     */
    public function __construct(string $userId = null, string $userPassword = null)
    {
        parent::__construct($userId, $userPassword);
    }




}