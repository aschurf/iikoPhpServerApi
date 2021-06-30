<?php

declare(strict_types=1);

namespace IikoServer\Api\Methods;


use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\SupplierObject;
use SimpleXMLElement;
use function Aws\boolean_value;


trait Suppliers
{
    use IikoRequests;

    protected $suppliers = [];


    /**
     * Return all suppliers of organization
     * You can pass parameters DELETED (default false), SUPPLIER (default true), EMPLOYEE (default false) and CLIENT (default false)
     * <code>
     *  getSupliers(false, true, false, false)
     * </code>
     * @param bool $deleted
     * @param bool $supplier
     * @param bool $employee
     * @param bool $client
     * @return array
     * @throws \IikoServer\Api\Exceptions\IikoApiException
     */
    public function getSupliers(bool $deleted = false, bool $supplierBool = true, bool $employee = false, bool $client = false) {
        $request = $this->request($this->suppliers_endpoint, $this->key, 'GET');

        $suppliers = new SimpleXMLElement($request);

        foreach ($suppliers->employee as $supplier){
            $supDeleted = $supplier->deleted == 'false' ? false : true;
            $isSupplier = $supplier->supplier == 'false' ? false : true;
            $isEmployee = $supplier->employee == 'false' ? false : true;
            $isClient = $supplier->client == 'false' ? false : true;

            if ($supDeleted == $deleted && $isSupplier == $supplierBool && $isEmployee == $employee && $isClient == $client){
                $this->suppliers[] = new SupplierObject(strval($supplier->id), strval($supplier->code), strval($supplier->name),
                    strval($supplier->login), strval($supplier->cardNumber), strval($supplier->taxpayerIdNumber), strval($supplier->snils),
                    $supDeleted,  $isSupplier, $isEmployee, $isClient);
            }
        }

        return $this->suppliers;
    }
}
