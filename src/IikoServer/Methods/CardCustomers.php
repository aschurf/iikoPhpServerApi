<?php


namespace IikoServer\Api\Methods;


use IikoServer\Api\Customer;
use IikoServer\Api\Exceptions\IikoApiException;
use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\CardCustomerObject;
use IikoServer\Api\Objects\CustomerCardObject;
use IikoServer\Api\Objects\CustomerCategoriesObject;
use IikoServer\Api\Objects\CustomerWalletBalanceObject;
use IikoServer\Api\Objects\CustomerWalletInfoObject;

trait CardCustomers
{

    use IikoRequests;


    /**
     * @param string $organization
     * @param string $customerId
     * @return CardCustomerObject
     * @throws IikoApiException
     */
    public function getCustomerById(string $organization, string $customerId) : CardCustomerObject {
        $response = $this->cardRequest('/customers/get_customer_by_id', $this->token, 'GET', '','&organization='.$organization.'&id='.$customerId);
        $response = json_decode($response);

        if (!empty($response->message)){
            throw IikoApiException::cardApiIncorrect($response->message);
        }

        $cards = [];
        if (count($response->cards) > 0){
            foreach ($response->cards as $card){
                $cards[] = new CustomerCardObject(
                    $card->Id,
                    $card->IsActivated,
                    $card->Number,
                    $card->OrganizationId,
                    $card->Track,
                    $card->ValidToDate
                );
            }
        }

        $categories = [];
        if (count($response->categories) > 0){
            foreach ($response->categories as $cat){
                $categories[] = new CustomerCategoriesObject(
                    $cat->id,
                    $cat->isActive,
                    $cat->isDefaultForNewGuests,
                    $cat->name
                );
            }
        }

        $walletBalances = [];
        if (count($response->walletBalances) > 0){
            foreach ($response->walletBalances as $wallet){

                $walletInfo = new CustomerWalletInfoObject(
                    $wallet->wallet->id,
                    $wallet->wallet->name,
                    $wallet->wallet->programType,
                    $wallet->wallet->type
                );

                $walletBalances[] = new CustomerWalletBalanceObject(
                    $wallet->balance,
                    $walletInfo
                );
            }
        }

        $customer = new CardCustomerObject(
            $response->id,
            $response->anonymized,
            $response->birthday,
            $response->comment,
            $response->consentStatus,
            $response->cultureName,
            $response->email,
            $response->iikoCardOrdersSum,
            $response->isBlocked,
            $response->isDeleted,
            $response->surname,
            $response->name,
            $response->middleName,
            $response->phone,
            $cards,
            $categories,
            $walletBalances
        );

        return $customer;
    }

    public function createCustomer(){
        return new Customer($this->token);
    }
}