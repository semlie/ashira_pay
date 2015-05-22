<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testPaymant
 *
 * @author Admin

 * 
 */
include dirname(__FILE__) .'/../pay.php';
class testPaymant extends PHPUnit_Framework_TestCase {
    function test1() {
        $a = new Tranzaction();
        var_dump($a);
         $this->assertTrue(false);
    }
}