<?
$to = "texnololwot@gmail.com";
$from = 'texnololwot@gmail.com';
$subject = "Проверка почты";
$message = 'У вас новая заявка на бронирование <br><br> Имя '.$_POST['name1']
."<br>".' Город : '.$_POST['city1']
."<br>".' Телефон : '.$_POST['telephone1']."<BR><BR><BR> Это ообщение было сгенерированно автоматически";
$headers = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: <texnololwot@gmail.com>\r\n";
$result = mail($to, $subject, $message, $headers);
?>
