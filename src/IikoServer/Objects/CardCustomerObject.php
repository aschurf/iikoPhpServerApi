<?php


namespace IikoServer\Api\Objects;


class CardCustomerObject
{


    public $id;
    public $anonymized;
    public $birthday;
    public $comment;
    public $consentStatus;
    public $cultureName;
    public $email;
    public $iikoCardOrdersSum;
    public $isBlocked;
    public $isDeleted;
    public $surname;
    public $name;
    public $middleName;
    public $phone;
    public $cards = [];
    public $categories = [];
    public $walletBalances = [];

    /**
     * CardCustomerObject constructor.
     * @param $id
     * @param $anonymized
     * @param $birthday
     * @param $comment
     * @param $consentStatus
     * @param $cultureName
     * @param $email
     * @param $iikoCardOrdersSum
     * @param $isBlocked
     * @param $isDeleted
     * @param $surname
     * @param $name
     * @param $middleName
     * @param $phone
     * @param array $cards
     * @param array $categories
     * @param array $walletBalances
     */
    public function __construct($id, $anonymized, $birthday, $comment, $consentStatus, $cultureName, $email, $iikoCardOrdersSum, $isBlocked, $isDeleted, $surname, $name, $middleName, $phone, array $cards, array $categories, array $walletBalances)
    {
        $this->id = $id;
        $this->anonymized = $anonymized;
        $this->birthday = $birthday;
        $this->comment = $comment;
        $this->consentStatus = $consentStatus;
        $this->cultureName = $cultureName;
        $this->email = $email;
        $this->iikoCardOrdersSum = $iikoCardOrdersSum;
        $this->isBlocked = $isBlocked;
        $this->isDeleted = $isDeleted;
        $this->surname = $surname;
        $this->name = $name;
        $this->middleName = $middleName;
        $this->phone = $phone;
        $this->cards = $cards;
        $this->categories = $categories;
        $this->walletBalances = $walletBalances;
    }


}