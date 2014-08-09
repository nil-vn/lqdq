<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$str = "";
$ret = WpPostCategory::model()->f_privilege_contract_op($id, $str);
if ($ret > 0)
    echo $str;
?>