<?php


namespace IikoServer\Api\Methods;


use DateTime;
use Exception;
use IikoServer\Api\Exceptions\InvoicesException;
use IikoServer\Api\IikoInvoice;
use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\InvoiceItemObject;
use IikoServer\Api\Objects\InvoiceObject;
use SimpleXMLElement;

trait Invoices
{
    use IikoRequests;

    private $invoices = [];

    private $getInvoicesParams = [
        'from' => null,
        'to' => null,
        'supplierId' => [],
    ];

    /**
     * Gets array of invoices according to the specified conditions
     *
     * <code>
     * $params = [
     *   'from'                        => string,
     *   'to'                          => string,
     *   'supplierId'                  => [],
     * ];
     * </code>
     * @param array $params
     * @return array
     * @throws InvoicesException
     * @throws \IikoServer\Api\Exceptions\IikoApiException
     */
    public function getInvoices(array $params) : array {

        $query = $this->validateGetInvoices($params);

        if (array_key_exists('supplierId', $params) && count($params['supplierId']) > 0){
            foreach ($params['supplierId'] as $supplier){
                $query .= "&supplierId=".$supplier;
            }
        }

        $invoices = $this->request('/resto/api/documents/export/incomingInvoice', $this->key, 'GET', [], $query);

        $invoiceList = new SimpleXMLElement($invoices);
        $i = 0;
        foreach ($invoiceList->document as $inv){
            $this->invoices[] = new InvoiceObject(
                strval($inv->id),
                strval($inv->transportInvoiceNumber),
                strval($inv->incomingDate),
                strval($inv->supplier),
                strval($inv->defaultStore),
                strval($inv->dateIncoming),
                strval($inv->documentNumber),
                strval($inv->conception),
                strval($inv->status),
                strval($inv->distributionAlgorithm)
            );

            foreach ($inv->items->item as $item) {
                $this->invoices[$i]->items[] = new InvoiceItemObject(
                    strval($item->product),
                    strval($item->productArticle),
                    strval($item->supplierProduct),
                    strval($item->supplierProductArticle),
                    floatval($item->amount),
                    strval($item->amountUnit),
                    floatval($item->actualAmount),
                    strval($item->store),
                    strval($item->code),
                    floatval($item->price),
                    floatval($item->priceWithoutVat),
                    floatval($item->sum),
                    floatval($item->vatPercent),
                    floatval($item->vatSum),
                    floatval($item->discountSum),
                    strval($item->num)
                );
            }


            $i++;
        }

        return $this->invoices;

    }

    /**
     * @param array $params
     * @return string
     * @throws InvoicesException
     */
    public function validateGetInvoices(array $params) : string {
        $query = "";
        foreach ($params as $p => $v){
            if (array_key_exists($p, $this->getInvoicesParams) && $v !== null && $p !== 'supplierId'){
                try {
                    $Date = new DateTime($v);
                    $sDate = $Date->format('Y-m-d');
                } catch (Exception $e){
                    $Date = new DateTime($v);
                    $sDate = $Date->modify('-1 day')->format('Y-m-d');
                }
                $this->getInvoicesParams[$p] = $sDate;
                $query .= "&".$p."=".$sDate;
            } elseif ($p === 'supplierId' && is_array($v)) {
                continue;
            } else {
                throw new InvoicesException('Required parameter FROM or TO for method getInvoices is not defined. Or you supplierId is not array');
            }
        }
        return $query;

    }


    public function createOutgoingInvoice(){
        return new IikoInvoice($this->serverUrl, $this->key);
    }
}