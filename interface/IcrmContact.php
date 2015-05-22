<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace crm;

/**
 *
 * @author Admin
 */
interface IcrmContact {
    //put your code here
    function addNewCrmContact($user);
    function getCrmContactByUserId($user);
    function updateCrmContact($user);
    function deleteCrmContact($user);
    function searchCrmContactByEmail($user);
}
