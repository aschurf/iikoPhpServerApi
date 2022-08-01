<?php

namespace IikoServer\Api;

use IikoServer\Api\Requests\IikoTransportRequest;

class IikoTransport
{

    use IikoTransportRequest;

    private $token;

    private $apiLogin;

    private $host = 'https://api-ru.iiko.services/api/1/';

    private $hostDelivery = 'https://api-ru.iiko.services/api/2/';

    private $headers = [
        'Content-Type: application/json'
    ];


    /**
     * @param $token
     * @param $apiLogin
     */
    public function __construct(string $apiLogin)
    {
        $this->apiLogin = $apiLogin;

        $this->auth();
    }


    /**
     * @throws \Exception
     */
    private function auth()
    {

        $data = [
            'apiLogin' => $this->apiLogin
        ];


        $authResult = json_decode($this->transportRequest($this->host, 'access_token', $data, $this->headers));


        if (!empty($authResult->errorDescription)) {
            throw new \Exception($authResult->errorDescription);
        }

        if (!empty($authResult->token)) {
            $this->token = $authResult->token;
            $this->headers = ['Authorization: Bearer ' . $authResult->token, 'Content-Type: application/json'];
        } else {
            throw new \Exception('Error in auth');
        }
    }


    /**
     * Return organizations list
     * @param bool $returnAdditionalInfo
     * @param bool $includeDisabled
     * @return object
     */
    public function getOrganizations(bool $returnAdditionalInfo, bool $includeDisabled): object
    {

        $data = [
            "returnAdditionalInfo" => $returnAdditionalInfo,
            "includeDisabled" => $returnAdditionalInfo
        ];

        $organizations = json_decode($this->transportRequest($this->host, 'organizations', $data, $this->headers));

        return $organizations->organizations;
    }


    /**
     * Return customer ID
     * @param array $customerInfo
     * @return string
     * @throws \Exception
     */
    public function createCustomerorUpdate(array $customerInfo): string
    {
        $customer = json_decode($this->transportRequest($this->host, 'loyalty/iiko/customer/create_or_update', $customerInfo, $this->headers));

        if (!empty($customer->id)) {
            return $customer->id;
        } else {
            throw new \Exception($customer->errorDescription);
        }
    }


    /**
     * Return customer info
     * @param array $customerInfo
     * @return object
     * @throws \Exception
     */
    public function getCustomerInfo(array $customerInfo): object
    {
        $customer = json_decode($this->transportRequest($this->host, 'loyalty/iiko/customer/info', $customerInfo, $this->headers));

        if (!empty($customer->id)) {
            return $customer;
        } else {
            throw new \Exception($customer->errorDescription);
        }
    }


    /**
     * @param array $cardInfo
     * @return void
     * @throws \Exception
     */
    public function addCardToCustomer(array $cardInfo)
    {
        $card = json_decode($this->transportRequest($this->host, 'loyalty/iiko/customer/card/add', $cardInfo, $this->headers));

        if (!empty($card->errorDescription)) {
            throw new \Exception($card->errorDescription);
        }
    }


    /**
     * @param array $wallet
     * @return void
     * @throws \Exception
     */
    public function updateWalletMoney(array $wallet)
    {
        $card = json_decode($this->transportRequest($this->host, 'loyalty/iiko/customer/wallet/hold', $wallet, $this->headers));

        if (!empty($card->errorDescription)) {
            throw new \Exception($card->errorDescription);
        }
    }


    /**
     * @param array $organizations
     * @return mixed
     * @throws \Exception
     */
    public function getDiscounts(array $organizations)
    {

        $discounts = json_decode($this->transportRequest($this->host, 'discounts', $organizations, $this->headers));


        if (!empty($discounts->discounts)) {
            return $discounts->discounts;
        } else {
            throw new \Exception($discounts->errorDescription);
        }

    }



    /**
     * @return array
     * @throws \Exception
     */
    public function getMenues(): array
    {
        $menu = json_decode($this->transportRequest($this->hostDelivery, 'menu', [], $this->headers));


        if (!empty($menu->externalMenus)) {
            return $menu->externalMenus;
        } else {
            throw new \Exception($menu->errorDescription);
        }
    }

    /**
     * @param array $menuInfo
     * @return array
     * @throws \Exception
     */
    public function getDishesByMenuId(array $menuInfo) : array
    {
        $dishes = json_decode($this->transportRequest($this->hostDelivery, 'menu/by_id', $menuInfo, $this->headers));


        if (!empty($dishes->id)) {
            return $dishes->itemCategories;
        } else {
            throw new \Exception($dishes->errorDescription);
        }
    }
}