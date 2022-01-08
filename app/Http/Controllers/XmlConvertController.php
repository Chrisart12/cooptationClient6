<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;



class XmlConvertController extends Controller
{
    /**
     * Prend des données xml et les transforme en html
     */
    public function convertXmlToJson($xmlUrl)
    {

        // Read entire file into string 
        $xmlfile = file_get_contents($xmlUrl); 

        // Convert xml string into an object 
        $new = simplexml_load_string($xmlfile); 

        // Convert into json 
        $con = json_encode($new); 

        return json_decode($con, true); 
    }

}
