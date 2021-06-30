<?php


namespace IikoServer\Api;

use IikoServer\Api\Exceptions\IikoApiException;
abstract class IikoServerApi
{

    protected $login;
    protected $password;
    protected $serverUrl;
    protected $key;


    protected $stores_endpoint = '/resto/api/corporation/stores';
    protected $suppliers_endpoint = '/resto/api/suppliers';
    protected $departments_endpoint = '/resto/api/corporation/departments';
    protected $products_endpoint = '/resto/api/v2/entities/products/list';
    protected $persons_endpoint = '/resto/api/employees';

    const VERSION = '1.0.0';

    const IIKO_LOGIN_ENV_NAME = 'IIKO_LOGIN';

    const IIKO_PASSWORD_ENV_NAME = 'IIKO_PASSWORD';

    const IIKO_SERVER_URL = 'IIKO_SERVER_URL';

    /**
     * IikoServerApi constructor.
     * @param string $login
     * @param string $password
     */
    public function __construct(string $login = null, string $password = null, string $serverUrl = null){

        $this->login = $login ?? getenv(self::IIKO_LOGIN_ENV_NAME);
        $this->validateLogin();

        $this->password = $password ?? getenv(self::IIKO_PASSWORD_ENV_NAME);
        $this->validatePassword();

        $this->serverUrl = $serverUrl ?? getenv(self::IIKO_SERVER_URL);
        $this->validateIikoHost();

        $this->authorize();
    }

    private function authorize()
    {
        $ch = curl_init($this->serverUrl."/resto/api/auth?login=".$this->login."&pass=".sha1($this->password)."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $key = curl_exec($ch);
        $this->checkAuth($key);
        curl_close($ch);
    }

    private function validateLogin(){
        if (!$this->login || ! is_string($this->login)){
            throw IikoApiException::loginNotProvided(self::IIKO_LOGIN_ENV_NAME);
        }
    }

    private function validatePassword(){
        if (!$this->password || ! is_string($this->password)){
            throw IikoApiException::passwordNotProvided(self::IIKO_PASSWORD_ENV_NAME);
        }
    }

    private function validateIikoHost(){
        if (!$this->serverUrl || ! is_string($this->serverUrl)){
            throw IikoApiException::IikoURLNotProvided(self::IIKO_SERVER_URL);
        }
    }

    private function checkAuth(string $key){
        if (strpos($key, 'Неверный пароль') !== false){
            throw IikoApiException::incorrectPassword($this->password);
        } elseif (strpos($key, 'не существует или удален') !== false){
            throw IikoApiException::incorrectLogin($this->login);
        } else {
            $this->key = $key;
        }
    }

}
