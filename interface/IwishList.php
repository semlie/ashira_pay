<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */
require_once 'IusersConection.php';
interface IwishList extends IusersConection{
    //put your code here
    public function addUserToLevel($levelId,$UserID); 
    public function deleteUserFromLevel($levelId,$UserID); 
//    public function addUserLevel($levelId,$UserID); 
    
}
