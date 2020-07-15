<?php
/**
 * Created by PhpStorm.
 * User: bro
 * Date: 22.01.2017
 * Time: 19:45
 */

require_once('api.php');
require_once('external_payment.php');
require_once('YandexPay.php');


session_start();

//print_r($_POST);


//Отправляем email
$to = "loctevgeorgy@yandex.ua";
$subject = "Новый заказ № " . $_POST['id-order'];
$message = "Name: <b>" . $_POST['name'] . "</b><br>"
. "Phone: <b>" . $_POST['phone'] . "</b><br>"
. "Zip: <b>" . $_POST['zip'] . "</b><br>"
. "Adress: <b>" . $_POST['adress'] . "</b><br>"
. "Option: <b>" . $_POST['ves'] . "</b><br>"
. "Amount: <b>" . $_POST['amount'] . "</b><br>";

$mailheaders = "Content-type:text/html; charset=utf-8 \r\n";
$mailheaders .= "From: Powerbank <noreply@powerbank.rumarket.store> \r\n";
$mailheaders .= "Reply-To: noreply@powerbank.rumarket.store \r\n";

mail($to, $subject, $message, $mailheaders);

/**
 * Если платёж уже проведен
 */


try{

    if (!empty($_GET['Ya_status'])){

        $money = $_SESSION['yandexPayObject'];

        switch ($_GET['Ya_status']){
            case 'ok':
                $money->checkPay();
                break;
            case 'fail':
                $errMess = "Произошла ошибка при проведении платежа: \n
                отказ аутентификации банковской карты по 3-D Secure,\n
                обратитесь к администратору
                ";

                throw new exception($errMess);
                //print_r($money);
                die;
            case 'in_progress':
                $money->checkPay();
                break;


        }
        die;
    }

   /* if ($_GET['status'] == 'ok'){


    }else if ($_GET['status'] == 'fail'){

    }else if ($_GET['status'] == 'in_progress'){
        $money->checkPay();

    }*/

} catch (Exception $e){

    echo 'Поймано исключение: '.$e->getMessage();
    die;


}



/**
 * Если только начинаем платёж
 */


$client_id = '6D4139893FA134A4631051B6FA42207C33510575F0A1AEC605DB6C77CB4BF125';
$ext_auth_success_uri = 'http://'.$_SERVER['SERVER_NAME'].'/yapay/payOnline.php?Ya_status=ok';
$ext_auth_fail_uri = 'http://'.$_SERVER['SERVER_NAME'].'/yapay/payOnline.php?Ya_status=fail';
$wallet_to = '410017230537595';
$amount = $_POST['amount'];
$successPage = 'http://'.$_SERVER['SERVER_NAME'].'/thanks/';
$message = 'ANTIRADAR360 - Защитная пленка.'.' Оплата заказа № '.$_POST['id-order'];

if ($_POST['pay_type'] == 'prepaid'){
    $amount = 300;
}else if($_POST['pay_type'] == 'fullpaid'){
    $amount = $_POST['amount'];
}

try {

    $money = new YandexPay($client_id, $successPage, $ext_auth_success_uri, $ext_auth_fail_uri, $wallet_to, $amount, $message);
    $money->externalPayment();

}catch (exception $e){
    echo 'Поймано исключение: '.$e->getMessage();
}

die;



