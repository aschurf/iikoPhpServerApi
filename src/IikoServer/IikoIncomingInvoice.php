<?php


namespace IikoServer\Api;

use DateTime;
use DOMDocument;
use IikoServer\Api\Exceptions\InvoicesException;
use ReflectionClass;
use ReflectionProperty;
use SimpleXMLElement;

class IikoIncomingInvoice
{

    use IikoRequests;

    private $key;
    private $iiko_server_url;

    protected $documentNumber;
    protected $dateIncoming;
    protected $defaultStoreId;
    protected $status;
    protected $counteragentId;
    protected $items = [];
    private $itemsData = [
        'productId', 'price', 'amount', 'sum', 'discountSum'
    ];


    public function __construct($iiko_server_url, $key){
        $this->iiko_server_url = $iiko_server_url;
        $this->key = $key;
    }
    /**
     * @param mixed $documentNumber
     */
    public function documentNumber(string $documentNumber)
    {
        $this->documentNumber = $documentNumber;
        return $this;
    }

    /**
     * @param mixed $dateIncoming
     * @throws \Exception
     */
    public function dateIncoming(string $dateIncoming)
    {
        $date = new DateTime($dateIncoming);
        $sDate = $date->format('Y-m-d');
        $sTime = $date->format('H:i');
        $this->dateIncoming = $sDate.'T'.$sTime;
        return $this;
    }

    /**
     * @param mixed $defaultStoreId
     */
    public function defaultStoreId(string $defaultStoreId)
    {
        $this->defaultStoreId = $defaultStoreId;
        return $this;
    }

    /**
     * @param mixed $status
     */
    public function status(string $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param mixed $counteragentId
     */
    public function counteragentId(string $counteragentId)
    {
        $this->counteragentId = $counteragentId;
        return $this;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function items(array $items){
        if (is_array($items)){
            $this->items = $items;
            return $this;
        }
    }

    /**
     * @throws InvoicesException
     */
    public function create(){
        $this->validate();

        $dom = new DomDocument('1.0');
        $document = $dom->appendChild($dom->createElement('document'));
        $documentNumber = $document->appendChild($dom->createElement('documentNumber'));
        $documentNumber->appendChild($dom->createTextNode($this->documentNumber));

        $dateIncoming = $document->appendChild($dom->createElement('dateIncoming'));
        $dateIncoming->appendChild($dom->createTextNode($this->dateIncoming));

        $useDefaultDocumentTime = $document->appendChild($dom->createElement('useDefaultDocumentTime'));
        $useDefaultDocumentTime->appendChild($dom->createTextNode('true'));

        $defaultStoreId = $document->appendChild($dom->createElement('defaultStoreId'));
        $defaultStoreId->appendChild($dom->createTextNode($this->defaultStoreId));

        $documentStatus = $document->appendChild($dom->createElement('status'));
        $documentStatus->appendChild($dom->createTextNode($this->status));

        $counteragentId = $document->appendChild($dom->createElement('counteragentId'));
        $counteragentId->appendChild($dom->createTextNode($this->counteragentId));

        $items = $document->appendChild($dom->createElement('items'));

        foreach ($this->items as $i){
            $item = $items->appendChild($dom->createElement('item'));
            $productId = $item->appendChild($dom->createElement('productId'));
            $productId->appendChild($dom->createTextNode(strval($i['productId'])));

            $price = $item->appendChild($dom->createElement('price'));
            $price->appendChild($dom->createTextNode($i['price']));

            $amount = $item->appendChild($dom->createElement('amount'));
            $amount->appendChild($dom->createTextNode($i['amount']));

            $sum = $item->appendChild($dom->createElement('sum'));
            $sum->appendChild($dom->createTextNode($i['sum']));

            $discountSum = $item->appendChild($dom->createElement('discountSum'));
            $discountSum->appendChild($dom->createTextNode($i['discountSum']));
        }

        $dom->formatOutput = true;
        $result = $dom->saveXML();

        $reqData1 = curl_init($this->iiko_server_url.'/resto/api/documents/import/incomingInvoice?key='.$this->key);
        curl_setopt($reqData1, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($reqData1, CURLOPT_POSTFIELDS, $result);
        curl_setopt($reqData1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($reqData1, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/xml')
        );

        $resultIIKO = curl_exec($reqData1);

        try {
            $response = new SimpleXMLElement($resultIIKO);
            return ['valid' => strval($response->valid), 'warning' => strval($response->warning), 'errorMessage' => strval($response->errorMessage)];
        } catch (\Exception $e) {

            throw new InvoicesException($resultIIKO);

        }
    }


    /**
     * @throws InvoicesException
     */
    private function validate(){
        $ref = new ReflectionClass($this);
        $props   = $ref->getProperties(ReflectionProperty::IS_PROTECTED);

        foreach ($props as $prop) {
            if ($this->{$prop->getName()} == null){
                throw new InvoicesException('Required parameter '.$prop->getName().' is undefined');
            }

            foreach ($this->items as $item ){
                foreach ($this->itemsData as $iData){
                    if (!array_key_exists($iData, $item)){
                        throw new InvoicesException('Required parameter '.$iData.' is undefined');
                    }
                }
            }
        }
    }

}