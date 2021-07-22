<?
$name=$_POST['name'];
$surname=$_POST['surname'];
$email=$_POST['email'];
$message=$_POST['message'];

/* получатели */
$to= "kupieli.pvl@gmail.com";
// $to= "elegant4444@gmail.com";

/* тема/subject */
$subject = "Форма обртаной связи с сайта kupieli.kz";

/* сообщение */
$message = '
<html>
<head>
 <title>Форма обртаной связи с сайта kupieli.kz</title>
</head>
<body>
<p>'.$name.' '.$surname.'<br>
'.$email.'<br>
'.$message.'</p>

</body>
</html>
';

/* Для отправки HTML-почты вы можете установить шапку Content-type. */
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

/* дополнительные шапки */
$headers .= "From: webmaster@controlsoft.kz\r\n";

/* и теперь отправим из */
mail($to, $subject, $message, $headers);


echo 'success';
?>
