<?php


namespace IikoServer\Api\Objects;


class CustomerWalletBalanceObject
{

    public $balance;
    public $wallet;

    /**
     * CustomerWalletBalanceObject constructor.
     * @param $balance
     * @param array $wallet
     */
    public function __construct($balance, CustomerWalletInfoObject $wallet)
    {
        $this->balance = $balance;
        $this->wallet = $wallet;
    }


}