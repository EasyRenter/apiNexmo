<?php

// Nexmo API Call in PHP / Curl

class Easyrenter_Nexmo_Model_Api
{


    // To use sendSms() you need a string $message and $telephone as a international phone number
    
    public function sendSms($message, $telephone)
    {

        // Get nexmo configuration data, i conf in my admin
        // $emetteur is just the transmitter - for me it s "Easy Renter"
        
        $key = Mage::getStoreConfig('gnexmo/general/sitekey');
        $secretKey = Mage::getStoreConfig('gnexmo/general/secretkey');
        $emetteur = Mage::getStoreConfig('gnexmo/general/emetteur');



        // Curl authentification
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Authorization: Basic",
            "Content-Type: application/json; charset=utf-8",
            "Accept:application/json, text/javascript, */*; q=0.01"
        ));
        curl_setopt($curl, CURLOPT_URL, "https://rest.nexmo.com/sms/json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '{
            "grant_type" : "client_credentials",
            "from" : "'.$emetteur.'",
            "text" : "'.$message.'",
            "to" : "'.$telephone.'",
            "api_key" : "'.$key.'",
            "api_secret" : "'.$secretKey.'"
        }');

        $result = curl_exec($curl);

        if (curl_errno($curl)) {
            print curl_error($curl);
        } else {
            curl_close($curl);
        }

        return $result;


    }

    // phonenumberConvertion() is use to convert french phone number, to international number
    // it also make a minimum cleaning because my phone number come from customer form
    
    public function phonenumberConvertion($telephone){

        
        $caractereARetirer = array(" ", "/\s+/", "-", "_", ".");
        $telephone = str_replace($caractereARetirer, '', $telephone);


        if (strlen($telephone) == 10 && (substr($telephone, 0, 2) == "06" || substr($telephone, 0, 2) == "07")){

            $telephone = substr($telephone, 1, 10);
            $telephone = "33".$telephone;
            return $telephone;

        } else{

            return false;
        }


        



    }




}

?>
