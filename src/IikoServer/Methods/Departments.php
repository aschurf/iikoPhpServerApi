<?php


namespace IikoServer\Api\Methods;


use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\StoreObject;

trait Departments
{

    use IikoRequests;

    public function getDepartments(){
        $request = $this->request($this->stores_endpoint, $this->key, 'GET');
        $stores = new SimpleXMLElement($request);
        foreach ($stores->corporateItemDto as $store){
            $this->stores[] = new StoreObject($store->id, $store->code, $store->name, $store->type, $store->taxpayerIdNumber);
        }

        return $this->stores;
    }

}
