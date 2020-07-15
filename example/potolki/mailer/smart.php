<?php 
$messager = $_POST['messager'];
$phone = $_POST['phone'];
$name = $_POST['name'];
$summ = $_POST["SUMM"];
$area = $_POST["AREA"];
$angle = $_POST["ANGLE"];
$light = $_POST["LIGHTS"];
require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'potolki-boski@mail.ru';                 // Наш логин
$mail->Password = '1a2b3c4D';                           // Наш пароль от ящика
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
 
$mail->setFrom('potolki-boski@mail.ru', 'BOSKI Potolki');   // От кого письмо 
$mail->addAddress('potolkimo2018@gmail.com');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Данные пользователя';

 if (isset($area)) {$bodya =('
	Пользователь оставил свои данные <br>'.$name.
	'Телефон: ' . $phone   . '<br>Площадь потолка (м2): ' . $area . '<br>Люстры: '.$angle . '<br>Кол-во светильников: '.$light . '<br>Общая сумма: '.$summ);}
	else{$bodya =('
	Пользователь оставил свои данные <br> 
	Имя:'. $name .'<br>
	Телефон: ' . $phone . '<br>'. $messager);
	}


$mail->Body    =$bodya;
$mail->AltBody = 'Это альтернативный текст';
;
if(!$mail->send()) {
    echo "Error";
} else {
    header('location: ../index.html');
    exit;
} 

?>

