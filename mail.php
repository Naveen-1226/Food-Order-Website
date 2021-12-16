<?php

$to="thatipallinaveenkumar@gmail.com";
$subject="Test Mail";
$message="Hello !This is a simple email message.";
$from="thatipallinaveen1226@gmail.com";

$headers="From : $from";
if(mail($to,$subject,$message,$headers)){

echo "Mail Sent";}
else{
    echo "failed ro semde";
}

?>
