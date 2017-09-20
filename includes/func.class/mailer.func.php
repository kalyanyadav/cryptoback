<?php

function sendMail($to, $message, $subject)
{
    global $app;
    $mailsetting = unserialize(getSetting('mail'));
    if ($mailsetting != '' && $mailsetting['mailmode'] == 'smtp') {
        $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom(array($mailsetting['uname'] => $mailsetting['sender']))
                    ->setTo(array($to))
                    ->setBody($message, 'text/html');
        $app['mailer']->send($message);
    } elseif ($mailsetting['mailmode'] == 'phpmail') {
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

        // Additional headers
        $headers .= 'To: '.$to."\r\n";
        $headers .= 'From: '.$mailsetting['sender'].' <'.$mailsetting['uname'].'>'."\r\n";

        // Mail it
        mail($to, $subject, $message, $headers);
    }
}

function sendMessage($mobile,$message){
    $url = 'http://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hdTb8Yd4woA&MobileNo='.$mobile.'&SenderID=MYSAIW&Message='.$message.'&ServiceName=TEMPLATE_BASED';
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$output =curl_exec($ch);
	curl_close($ch);
}

function sendMessageI($mobile,$message){
    $url = 'http://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hdTb8Yd4woA&MobileNo='.$mobile.'&SenderID=MYSAIW&Message='.$message.'&ServiceName=INTERNATIONAL';
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$output =curl_exec($ch);
	curl_close($ch);
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
