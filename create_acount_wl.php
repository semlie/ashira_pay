<?php

/**
 * Description of create_acount_wl
 *
 * @author Admin
 */
include_once 'config.php';
class create_acount_wl {

    //put your code here
    // the post URL
    public static function callWLMember($parms) {
        $postURL = url;
// the Secret Key
        $secretKey = secret;
// prepare the data
        $post  = $parms->post;
        $data = array();
        $data['cmd'] = 'CREATE';
        $data['transaction_id'] = $parms->referenceNumber."-".$parms->voucherNumber;
        $data['lastname'] = $post['pname'];
        $data['firstname'] = 'NA';
        $data['email'] = $post['mail'];
        $data['level'] = level;
// generate the hash
        $delimiteddata = strtoupper(implode('|', $data));
        $hash = md5($data['cmd'] . '__' . $secretKey . '__' . $delimiteddata);
// include the hash to the data to be sent
        $data['hash'] = $hash;
// send data to post URL
        $ch = curl_init($postURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $returnValue = curl_exec($ch);
// process return value
        list ($cmd, $url) = explode("\n", $returnValue);
// check if the returned command is the same as what we passed
        if ($cmd == 'CREATE') {
            //header('Location:' . $url);
            return $url;
            exit;
        } else {
            die('Error');
        }
    }

}
