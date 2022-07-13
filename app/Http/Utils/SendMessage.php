<?php

namespace App\Http\Utils;

use Exception;

class SendMessage {
        static function OrderFromWhatsapp($order, $total , $user)
        {
            $message = '';
            $brokeLine = "%0A";
            
            $message .= 'Olá NeryImports eu sou *' . $user[1].'*'. $brokeLine. ' e gostaria dos seguintes itens: '. $brokeLine;
            foreach($order as $item){
                $message .= '_ID_: '.$item['id'].' _Nome_: '.$item['name'] . ' _Quantidade_ : ' . $item['quantity']. $brokeLine;
            }
            $message .= "Total aproximado: R$ " . $total;
            
            header("Location: https://api.whatsapp.com/send?phone=553194057527&text=" . $message);
            exit();
        }
        // static function sendMailBySendGrid($order, $total , $user){

        //     $message = '';
        //     $message .= 'Olá NeryImports eu sou *' . $user[1].'*'. ' e gostaria dos seguintes itens: ';
        //     foreach($order as $item){
        //         $message .= '_ID_: '.$item['id'].' _Nome_: '.$item['name'] . ' _Quantidade_ : ' . $item['quantity'];
        //     }
        //     $message .= "Total: R$ " . $total;
            
        //     $email = new \SendGrid\Mail\Mail(); 
        //     $email->setFrom("test@example.com", "Example User");
        //     $email->setSubject("Sending with SendGrid is Fun");
        //     $email->addTo("test@example.com", "Example User");
        //     $email->addContent("text/plain", $message);
        //     $email->addContent(
        //         "text/html", "<strong>".$message."</strong>"
        //     );
        //     $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        //     try {
        //         $response = $sendgrid->send($email);
        //         print $response->statusCode() . "\n";
        //         print_r($response->headers());
        //         print $response->body() . "\n";
        //     } catch (Exception $e) {
        //         echo 'Caught exception: '. $e->getMessage() ."\n";
        //     }
        // }
}