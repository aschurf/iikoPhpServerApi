<?php

namespace IikoServer\Api\Methods;

use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\StoreObject;
use SimpleXMLElement;

trait Stores
{

    use IikoRequests;

    protected $stores = [];

    /**
     * Return all departments of organizations
     * @param int $deleted
     * @return array
     * @throws \IikoServer\Api\Exceptions\IikoApiException
     */
    public function getStores(int $deleted = 0){
        $request = $this->request($this->stores_endpoint, $this->key, 'GET');
        $stores = new SimpleXMLElement($request);
        foreach ($stores->corporateItemDto as $store){
            $this->stores[] = new StoreObject($store->id, $store->code, $store->name, $store->type);
        }

        return $this->stores;
    }

}
