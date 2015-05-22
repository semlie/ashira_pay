<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

 *  */

require_once dirname(__FILE__) .'/../Models/usersModel.php';
/**
 *
 * @author Admin
 */
interface IusersConection {
    public function addNewUser(\model\usersModel $user);
    public function findUserByEmail($email);
    public function editUserDetails(\model\usersModel $user);
    public function deleteUserById($userId);
    public function getUserIdByEmail($userEmail);
    

    //put your code here
}
