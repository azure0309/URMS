<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Invoice_Data_Source extends Controller
{
//    function data_source(){
//
//        $url = 'http://10.21.64.60:5005/billing/roaming';
//        $data = array("first_name" => "First name","last_name" => "last name","email"=>"email@gmail.com","addresses" => array ("address1" => "some address" ,"city" => "city","country" => "CA", "first_name" =>  "Mother","last_name" =>  "Lastnameson","phone" => "555-1212", "province" => "ON", "zip" => "123 ABC" ) );
//
//        $postdata = json_encode($data);
//
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//        $result = curl_exec($ch);
//        curl_close($ch);
//        $source_data = json_decode($result);
//
////        $array = array();
//        foreach ($source_data as $data){
//            print_r($data);
//        }
////        print_r($array);
//    }
    function data_source()
    {
        // outputs the username that owns the running php/httpd process
        // (on a system with the "whoami" executable in the path)
        $output = null;
        $retval = null;
        exec('python test.py', $output, $retval);
        echo "Returned with status $retval and output:\n";
        print_r($output);
    }

}
