<?php

require 'vendor/slim/slim/Slim/Slim.php';
require 'pay.php';
require 'zcredit_manager.php';
require 'invoice_manager.php';
require 'create_acount_wl.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

//routes
$app->get("/", "payGet");

$app->get('/pay', 'payGet');
$app->post('/pay', 'payPost');

function payGet() {
    global $app;
    $app->render('pay.php');
}

function payPost() {
    global $app;
    $ret = "";
    $app->response->headers->set('Content-Type', 'application/json');
    $post = json_decode($app->request()->getBody(), TRUE);
    $data= new MapData($post);
    $postData = $data->build();
    $credit = new zcredit_manager($postData);
    $creditRet = $credit->DoTransaction();
    if ($creditRet->referenceNumber != "") {
        $invoice = new invoice_manager($postData, $creditRet);
        $ret = $invoice->DoInvoice();
    } else {

        echo json_encode($creditRet->returnMessage);
        exit();
    }
    if (isset($ret->returnMessage["OK"])) {
        $UrlToCompliteRegisteration = create_acount_wl::callWLMember($creditRet);
        $retUrl= Array("OK"=>"Paymant complite","Url"=>$UrlToCompliteRegisteration);
        echo json_encode($retUrl);
        exit();
    } else {
        $msg = Array("Error" => "תקלה בהפקת החשבונית צרו קשר עם צוות המשרד. מספר התשלום הוא  " . $creditRet->referenceNumber);
        echo json_encode($msg);
        $data->sendtofile("Invoice Error", $msg);
        exit();
    }
}

$app->run();
