<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//require_once('zcredit.php');
//require_once('crm-api.php');
//require_once('d/wp-user-update.php');
//include('wlmapiclass.php');
//require('MadMimi.class.php');
class MapData {

    public $post;

    function __construct($post) {
        $this->post = $post;
        $this->date = date('Y/m/d');
    }

//header('Content-Type: text/html');
//
//// post paremter
//$postdata = file_get_contents("php://input");
////convert to arrey
//$request = json_decode($postdata);
//$request = (array) $request;
////address: "hert"
//
//
//
//$pname = isset($request['pname']) ? $request['pname'] : '';
//$username = isset($request['name']) ? $request['name'] : '';
//$pass = isset($request['pass']) ? $request['pass'] : '';
//$address = isset($request['address']) ? $request['address'] : '';
//$city = isset($request['city']) ? $request['city'] : '';
//$country = isset($request['country']) ? $request['country'] : '';
//$teacher = isset($request['teacher']) ? $request['teacher'] : '';
//$maslul = isset($request['maslul']) ? $request['maslul'] : '0';
//$maslulSum = isset($request['maslulSum']) ? $request['maslulSum'] : '0';
//$cardOwner = isset($request['card_owner']) ? $request['card_owner'] : '';
//$cardNumber = isset($request['card_number']) ? $request['card_number'] : '';
//$cardExpireMonth = isset($request['card_expire_month']) ? $request['card_expire_month'] : '';
//$cardExpireYear = isset($request['card_expire_year']) ? $request['card_expire_year'] : '';
//$ownerPhone = isset($request['phone']) ? $request['phone'] : '';
//$ownerEmail = isset($request['mail']) ? $request['mail'] : '';
//$referenceNumber = isset($request['refNum']) ? $request['refNum'] : '00000';
//$voucherNumber = isset($request['vonchNum']) ? $request['vonchNum'] : '0000';
//$sub = isset($request['sub']) ? $request['sub'] : '';
//$crmId = isset($request['crmId']) ? $request['crmId'] : '';
//
////================
//$ownerZehut = isset($request['owner_zehut']) ? $request['owner_zehut'] : '';
//$cardType = isset($request['card_type']) ? $request['card_type'] : '';
//$cardCvv = isset($request['card_cvv']) ? $request['card_cvv'] : '';
//$paymentsCount = isset($request['payments_num']) ? $request['payments_num'] : '0';
//$paymentsCount2 = isset($request['payments_num2']) ? $request['payments_num2'] : '0';
//$firstPaymentSum = 0;
//$otherPaymentsSum = 0;
//
//set time
//date_default_timezone_set('Asia,Jerusalem');
//-- Transaction parameters
//require_once('test.php');
////check if it alredy member or user
//if it member just updete the expe_date
//if it only user ,update all the data and add the group
//// if its new user create new account and add user to group
//add the levels
    private function culcMaslulim() {



        switch ($this->post['maslul']) {
            case 'sub10':
                $this->post['firstPaymentSum'] = 0;
                $this->post['otherPaymentsSum'] = 0;
                break;
            case 'sub30':
                $this->post['firstPaymentSum'] = 1;
                $this->post['otherPaymentsSum'] = 1;
                break;

            case 'sub34':
                $this->post['firstPaymentSum'] = 1;
                $this->post['otherPaymentsSum'] = 1;
                break;

            default:
                break;
        }


//add time to subscribe
        $maslulsum = $this->post['maslulSum'];

        $this->post['date'] = date('Y-m-d', strtotime("+{$maslulsum} months", strtotime($this->date)));
        $this->post['paymentsCount'] = $this->post['maslulSum'];



        $this->post['paymentSum'] = $this->post['paymentsCount'] * $this->post['firstPaymentSum'];


//-- For INVOICE ONLY, remove the VAT from the total sum
//$paymentSumForInvoice = $paymentSum / 1.16;
        $this->post['paymentSumForInvoice'] = $this->post['paymentSum'];
        $this->post['noOffPaymant'] = isset($this->post['noOffPaymant'])?$this->post['noOffPaymant'] :1;
        if ($this->post['noOffPaymant'] == 1 || $this->post['noOffPaymant'] == "1") {
            $this->post['creditType'] = 1;
            $this->post['paymentsCount'] = 1;
             $this->post['otherPaymentsSum'] = 0;
            $this->post['firstPaymentSum'] = $this->post['paymentSum'];
        } else {

            $this->post['creditType'] = 8;
        }
        $this->post['last4crditCard'] = substr($this->post['card_number'],(strlen($this->post['card_number'])-4),strlen($this->post['card_number']));

    }

    public function crm($param) {

        $this->post['dataToLog'] = $this->post['pname'] . " ," . $this->post['ownerEmail'] . "," . $this->post['address'] . "," . $this->post['city'] . "," . $this->post['country'] . "," . $this->post['ownerPhone'] . "," . $this->post['maslul'] . "," . $this->post['maslulSum'] . "," . $this->post['date'] . ",";
        $this->sendtofile("start", $this->post['dataToLog']);



//for CRM
        $forNote = "העיסקה עברה בהצלחה מס' העיסקה: " . $referenceNumber . "\nמס' שובר: " . $voucherNumber . "\nהמסלול שנבחר :" . $maslul . "\n,מספר חודשי מנוי:" . $maslulSum;
        $primaryEmail = array();
        $dataCrm = array();
        $primaryEmail['emailAddress'] = $ownerEmail;
        $primaryEmail['optOut'] = '0';

# Everybody Can Read type = 0
        $readWriteModelPermissions['type'] = '1';
        $state['id'] = '2';
        $state['name'] = null;
        $state['order'] = null;

# $dataCrm used to send the data to the API
//$dataCrm['firstName']           = $pname;
        $dataCrm['lastName'] = $pname;
        $dataCrm['mobilePhone'] = $ownerPhone;
        $dataCrm['primaryEmail'] = $primaryEmail;
        $dataCrm['state'] = $state;
        $dataCrm['subscriptionCstm'] = $sub;

        $primaryAddress = array();
        $primaryAddress['street1'] = $address;
        $primaryAddress['city'] = $city;
        $primaryAddress['country'] = $country;
        $dataCrm['primaryAddress'] = $primaryAddress;
//$dataCrm['explicitReadWriteModelPermissions'] = $readWriteModelPermissions;
        $state['id'] = '6';
        $dataCrm['state'] = $state;

        $dataCrm['explicitReadWriteModelPermissions'] = array('nonEveryoneGroup' => '', 'type' => 1);
    }

    public function addToMadmimi($post) {

        $mailer = new MadMimi('roni.ayalon@gmail.com', '6afecb2e51d2435bf773b84ab8140454');
        $userMadmimi = array('email' => $post->ownerEmail, 'firstName' => '', 'lastName' => $post->cardOwner, 'add_list' => $post->maslul);
        $mailer->AddUser($userMadmimi);
    }

//$returnMessage = (sendToWpDb($wpUrl,$userToWp)==""?array("Success" => 'ההרשמה הסתימה בהצלחה'):array("Error" => 'תקלה בהליך הרישום צרו קשר עם צוות המשרד'));
//createNewNoteForUser(searchContactIdCrm($dataCrm['primaryEmail']['emailAddress']), $forNote);

    public function sendtofile($stat, $parm) {
        $log = $stat . ", " . $parm . " ," . date("d/m/Y H:i:s") . "\n";
        $log = toHeb($log);
        $fileName = "logmenuim.csv";
        $file = fopen($fileName, 'a') or die("Can't open log file");
        fwrite($file, $log);
        fclose($file);
    }

    function toHeb($str) {
        return mb_convert_encoding($str, "ISO-8859-8", "UTF-8");
    }

    function sendToWpDb($postURL, $data) {
        $ch = curl_init($postURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $returnValue = curl_exec($ch);
//var_dump($returnValue);
        return $returnValue;
    }

    public function build() {
        $this->culcMaslulim();
        return $this->post;
    }

//echo ' ';
//echo 'alert('.json_encode($returnMessage).')';
//$resp = array("resp"=>$returnMessage);
}
