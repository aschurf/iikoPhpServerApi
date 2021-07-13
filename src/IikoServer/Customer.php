<?php


namespace IikoServer\Api;


use IikoServer\Api\Exceptions\IikoApiException;
use ReflectionClass;
use ReflectionProperty;

class Customer
{

    use IikoRequests;

    protected $token;

    protected $serverUrl = 'https://iiko.biz:9900/api/0';

    private $phone;
    private $name;
    private $surName;
    private $middleName;
    private $sex;
    private $userData;
    private $email;
    private $birthday;
    private $magnetCardNumber;
    private $magnetCardTrack;

    protected $organiztionId;

    /**
     * Customer constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }


    public function phone(string $phone){
        $this->phone = $phone;
        return $this;
    }

    public function name(string $name){
        $this->name = $name;
        return $this;
    }

    public function surName(string $surName){
        $this->surName = $surName;
        return $this;
    }

    public function middleName(string $middleName){
        $this->middleName = $middleName;
        return $this;
    }

    public function sex(int $sex){
        $this->sex = $sex;
        return $this;
    }

    public function email(string $email){
        $this->email = $email;
        return $this;
    }

    public function birthday(string $birthday){
        $this->birthday = $birthday;
        return $this;
    }

    public function userData(string $userData){
        $this->userData = $userData;
        return $this;
    }

    public function magnetCardNumber(string $magnetCardNumber){
        $this->magnetCardNumber = $magnetCardNumber;
        return $this;
    }

    public function magnetCardTrack(string $magnetCardTrack){
        $this->magnetCardTrack = $magnetCardTrack;
        return $this;
    }

    public function organiztionId(string $organiztionId){
        $this->organiztionId = $organiztionId;
        return $this;
    }


    public function create(){
        if (!empty($this->phone) && !empty($this->magnetCardNumber) && !empty($this->organiztionId)){
            $reflect = new ReflectionClass($this);
            $props   = $reflect->getProperties(ReflectionProperty::IS_PRIVATE);

            $params = [];
            foreach ($props as $p){
                $propName = $p->getName();
                $params += array($propName => $this->$propName);
            }

            $customer = ['customer' => $params];
            $obj = json_encode ($customer, JSON_FORCE_OBJECT);

            $response = $this->cardRequest('/customers/create_or_update', $this->token, 'POST', $obj, '&organization='.$this->organiztionId);

            if ($response[0] != '{'){
                $response = str_replace('"', '', $response);
                return $response;
            } else {
                $jsonError = json_decode($response);
                throw IikoApiException::cardApiIncorrect($jsonError->message);
            }
        } else {
            throw IikoApiException::cardApiIncorrect('Phone, organiztionId and magnetCardNumber is required for create customer');
        }
    }


}