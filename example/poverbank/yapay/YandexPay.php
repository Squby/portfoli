<?php

use YandexMoney\ExternalPayment;

/**
 * Created by PhpStorm.
 * User: bro
 * Date: 19.01.2017
 * Time: 21:24
 * Класс для оплаты банковской карты без авторизации
 */
class YandexPay
{
    private $client_id;
    private $redirect_uri;
    private $scope;
    private $ext_auth_success_uri;
    private $ext_auth_fail_uri;
    private $test_wallet = '410012240012205';
    private $wallet_to = '41001442573405';
    private $amount;
    private $message;

    #Переменные для внутренних задач
    private $external_payment;
    private $requestId;



    public function __construct($client_id, $redirect_uri, /*$scope*/ $ext_auth_success_uri, $ext_auth_fail_uri, $wallet_to, $amount, $message){
        /*$this->requireYandexApi($libPath);*/
        $this->client_id = $client_id;
        $this->redirect_uri = $redirect_uri;
        /*$this->scope = $scope;*/
        $this->ext_auth_success_uri = $ext_auth_success_uri;
        $this->ext_auth_fail_uri = $ext_auth_fail_uri;
        $this->wallet_to = $wallet_to;
        $this->amount = $amount;
        $this->message = $message;
    }

   /* public function payBankCard(){
        $this->externalPayment();
    }*/

   /* public function startPay($libPath){

    }*/


    /**
     *@param string $libPath путь к папке библиотеки яндекс денег без слэша на конце
     *
     */

    /*private function requireYandexApi($libPath){
        require_once($libPath.'/api.php');
        require_once($libPath.'/external_payment.php');
    }*/

    /**
     * Проверка оплаты пользователя
     */
    public function checkPay(){
        do{
            $result = $this->processExternalPayment($this->requestId);
            sleep(3);
        }while ($result->status == 'in_progress');

        if ($result->status == 'success'){
            header( 'Location: '. $this->redirect_uri, true, 302);

            //print_r('Спасибо, платеж совершен успешно');
        }else {
            //print_r($result);
            $errMess = "Извините, произошла ошибка платежа. Для прояснения
            ситуации свяжитесь с администратором. \n Статус платежа: $result->status. Код ошибки: $result->error
            ";

            throw new Exception($errMess);
        }

        die;

    }

    /**
     * Сохранение объекта оплаты в сессии
     */

    private function saveObject(){
        $_SESSION['yandexPayObject'] = $this;
    }

    public function getObject() {
        return $_SESSION['yandexPayObject'];
    }

    /**
     * Оплата банковской картой неавторизованным пользователем
     */

    public function externalPayment(){

        #Получение instance_id
        $response = ExternalPayment::getInstanceId($this->client_id);
        if($response->status == "success") {
            $instance_id = $response->instance_id;
        }
        else {
            throw new Exception($response->error);
        }

        #Получение request_id
        $this->requestId = $this->makeRequestPayment($instance_id);

        #Проводим платеж
        $result = $this->processExternalPayment($this->requestId);

        $this->saveObject();

        $this->redirectToPay($result);


    }

    /**
     * Создание и отправка запроса Яндексу
     *
     * @param $instance_id
     *
     * @return int
     * @throws Exception
     */

    private function makeRequestPayment($instance_id){

        # 2. Make request payment
        $this->external_payment = new ExternalPayment($instance_id);

        $payment_options = array(
            "pattern_id" => "p2p",
            "to" => $this->wallet_to,
            "amount" => $this->amount,
            //"amount_due" => $_SESSION['fcPriceItog'],
            //"amount_due" => 1,
            "message" => $this->message,
            'test_payment' => true,
            'test_card' => '23432424234',
            'test_result' => 'success'
        );


        $response = $this->external_payment->request($payment_options);
        if($response->status == "success") {
            $this->requestId = $response->request_id;
            return $this->requestId;
        }
        else {
            throw new Exception($response->error);
        }
    }

    /**
     * Проведение платежа, перекидывание на форму оплаты
     *
     * @param $request_id
     *
     * @return object
     *
     */

    private function processExternalPayment($request_id){
        # Process the request with process-payment
        $process_options = array(
            "request_id" => $this->requestId,
            'ext_auth_success_uri' => $this->ext_auth_success_uri,
            'ext_auth_fail_uri' => $this->ext_auth_fail_uri
            // other params..
        );
        $result = $this->external_payment->process($process_options);

        return $result;
    }


    private function redirectToPay($result){
        #Если требуется перекинуть пользователя на форму оплаты
        if ($result->status == 'ext_auth_required'){
            $paymentUrl = $result->acs_uri.'?cps_context_id='.$result->acs_params->cps_context_id.'&paymentType='.$result->acs_params->paymentType;
            header( 'Location: '.$paymentUrl, true, 302);
            die;
        }

    }







}