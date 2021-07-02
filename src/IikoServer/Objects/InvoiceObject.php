<?php


namespace IikoServer\Api\Objects;


class InvoiceObject
{

    public $id;
    public $transportInvoiceNumber;
    public $incomingDate;
    public $supplier;
    public $defaultStore;
    public $dateIncoming;
    public $documentNumber;
    public $conception;
    public $status;
    public $distributionAlgorithm;

    /**
     * InvoiceObject constructor.
     * @param $id
     * @param $transportInvoiceNumber
     * @param $incomingDate
     * @param $supplier
     * @param $defaultStore
     * @param $dateIncoming
     * @param $documentNumber
     * @param $conception
     * @param $status
     * @param $distributionAlgorithm
     */
    public function __construct($id, $transportInvoiceNumber, $incomingDate, $supplier, $defaultStore, $dateIncoming, $documentNumber, $conception, $status, $distributionAlgorithm)
    {
        $this->id = $id;
        $this->transportInvoiceNumber = $transportInvoiceNumber;
        $this->incomingDate = $incomingDate;
        $this->supplier = $supplier;
        $this->defaultStore = $defaultStore;
        $this->dateIncoming = $dateIncoming;
        $this->documentNumber = $documentNumber;
        $this->conception = $conception;
        $this->status = $status;
        $this->distributionAlgorithm = $distributionAlgorithm;

    }


}