<?php
$mail = new Zend\Mail\Storage\Pop3(array('host'     => 'localhost',
                                         'user'     => 'test',
                                         'password' => 'test'));

echo $mail->countMessages() . " messages found\n";
foreach ($mail as $message) {
    echo "Mail from '{$message->from}': {$message->subject}\n";
}