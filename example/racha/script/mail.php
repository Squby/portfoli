<?
//Отправляем email
$to = "vladis.vasiljew@yandex.ru";
$subject = "Новый заказ на остров Рача" ;
$message = "Имя: <b>" . $_POST['name'] . "</b><br>"
. "Телефон: <b>" . $_POST['phone'] . "</b><br>"
. "Мессенджер: <b>" . $_POST['messeges'] . "</b><br>"
. "Колличество взрослых: <b>" . $_POST['oldman'] . "</b><br>"
. "Количество детей (от 4-х до 10 лет): <b>" . $_POST['yangman'] . "</b><br>"
. "Количество младенцев ( до 4-х лет): <b>" . $_POST['veryangman'] . "</b><br>"
. "Название отеля/района/улицы: <b>" . $_POST['area'] . "</b><br>"
. "Номер комнаты/дома: <b>" . $_POST['numberRoom'] . "</b><br>";
$mailheaders = "Content-type:text/html; charset=utf-8 \r\n";
$mailheaders .= "From: Racha <noreply@Racha> \r\n";
$mailheaders .= "Reply-To: noreply@Racha \r\n";
mail($to, $subject, $message, $mailheaders);
header("Location:../thanks.html");
?>