<?php


namespace IikoServer\Api;


use Dotenv\Dotenv;
use IikoServer\Api\Exceptions\IikoApiException;

abstract class IikoCardApi
{

    protected $login;
    protected $password;

    protected $serverUrl = 'https://iiko.biz:9900/api/0';

    protected $token;

    const VERSION = '1.0.0';

    const IIKO_CARD_LOGIN_ENV_NAME = 'IIKO_CARD_LOGIN';

    const IIKO_CARD_PASSWORD_ENV_NAME = 'IIKO_CARD_PASSWORD';

    /**
     * IikoCardApi constructor.
     * @param $login
     * @param $password
     * @param $serverUrl
     * @param $key
     */
    protected function __construct(string $login = null, string $password = null)
    {
        $dotenv = Dotenv::createImmutable('../../', '.env');
        $dotenv->load();

        $this->login = $login ?? $_ENV[self::IIKO_CARD_LOGIN_ENV_NAME];
        $this->validateLogin();

        $this->password = $password ?? $_ENV[self::IIKO_CARD_PASSWORD_ENV_NAME];
        $this->validatePassword();

        $this->getToken();
    }


    /**
     * @throws IikoApiException
     */
    private function validateLogin(){
        if (!$this->login || ! is_string($this->login)){
            throw IikoApiException::loginNotProvided(self::IIKO_CARD_LOGIN_ENV_NAME);
        }
    }


    /**
     * @throws IikoApiException
     */
    private function validatePassword(){
        if (!$this->password || ! is_string($this->password)){
            throw IikoApiException::passwordNotProvided(self::IIKO_CARD_PASSWORD_ENV_NAME);
        }
    }

    /**
     * @throws IikoApiException
     */
    private function getToken() {
        $ch = curl_init($this->serverUrl."/auth/access_token?user_id=".$this->login."&user_secret=".$this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        if ($response[0] != '{'){
            $this->token = str_replace('"', '', $response);
        } else {
            $jsonError = json_decode($response);
            throw IikoApiException::cardApiIncorrect($jsonError->message);
        }
    }



}