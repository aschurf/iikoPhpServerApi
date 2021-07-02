<?php


namespace IikoServer\Api\Objects;


class InvoiceItemObject
{


    public $product;
    public $productArticle;
    public $supplierProduct;
    public $supplierProductArticle;
    public $amount;
    public $amountUnit;
    public $actualAmount;
    public $store;
    public $code;
    public $price;
    public $priceWithoutVat;
    public $sum;
    public $vatPercent;
    public $vatSum;
    public $discountSum;
    public $num;

    /**
     * InvoiceItemObject constructor.
     * @param $product
     * @param $productArticle
     * @param $supplierProduct
     * @param $supplierProductArticle
     * @param $amount
     * @param $amountUnit
     * @param $actualAmount
     * @param $store
     * @param $code
     * @param $price
     * @param $priceWithoutVat
     * @param $sum
     * @param $vatPercent
     * @param $vatSum
     * @param $discountSum
     * @param $num
     */
    public function __construct($product, $productArticle, $supplierProduct, $supplierProductArticle, $amount, $amountUnit, $actualAmount, $store, $code, $price, $priceWithoutVat, $sum, $vatPercent, $vatSum, $discountSum, $num)
    {
        $this->product = $product;
        $this->productArticle = $productArticle;
        $this->supplierProduct = $supplierProduct;
        $this->supplierProductArticle = $supplierProductArticle;
        $this->amount = $amount;
        $this->amountUnit = $amountUnit;
        $this->actualAmount = $actualAmount;
        $this->store = $store;
        $this->code = $code;
        $this->price = $price;
        $this->priceWithoutVat = $priceWithoutVat;
        $this->sum = $sum;
        $this->vatPercent = $vatPercent;
        $this->vatSum = $vatSum;
        $this->discountSum = $discountSum;
        $this->num = $num;
    }


}