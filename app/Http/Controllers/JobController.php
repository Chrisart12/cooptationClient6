<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\XmlConvertController;

use App\Http\Requests;
use App\Job;
use App\JobId;


class JobController extends Controller
{
    
    /**
     * On fait un filtre pour éviter des éléments vides dans le tableau
     * On fait également un filtre en fonction de la clé (ici Vacancy)
    */
    public function filterData($data, $element)
    {
        // return $json[$element];
        return array_filter($data[$element]);
    }

    /**
    * Retourne la listes des offres quand on passe l'url dans la fonction
    * convertXmlToJson
    */
    public function showJobs()
    {
        // On crée une instance de la class new XmlConvertController
        $XmlConvertController = new XmlConvertController();
    
        // On récupère l'url
        $offresUrl = Config::get('custom.offres_url');
        // On utilise la methode convertXmlToJson de la classe $XmlConvertController
        // pour convertir les données.
        $data = $XmlConvertController->convertXmlToJson($offresUrl);
    
        $filterData = $this->filterData($data, "Vacancy");

        $jobs = [];
        $dataLangues = '';

        foreach($filterData as $offres) {
            $attributes = array_filter(($offres["@attributes"]));
            //   dd($attributes);

            $LesVersions = array_filter(($offres["Versions"]["Version"]));
            $departments = array_filter(($offres["Departments"]));
        
                $dataLangues = $LesVersions['@attributes'];

                //On vérifie si la langue est en français
                if($dataLangues['language'] == "fr") {
                    
                    if(array_key_exists("Title", $LesVersions) && array_key_exists("TitleHeading", $LesVersions)
                    && array_key_exists("AlternativeCompanyName", $LesVersions) && array_key_exists("Location", $LesVersions) 
                    && array_key_exists('Region', $LesVersions) && array_key_exists('Country', $LesVersions['Region'])
                    && array_key_exists('County', $LesVersions['Region']['Country']) && array_key_exists('Categories', $LesVersions)
                    && array_key_exists('Item', $LesVersions['Categories']) && array_key_exists('Departments', $offres)
                    && array_key_exists('Department', $departments) && array_key_exists('@attributes', $departments["Department"])
                    && array_key_exists('id', $departments["Department"]['@attributes']))
                    {
                        array_push($jobs, new Job($attributes['id'], $attributes['date_start'], $attributes['date_end'],
                        $attributes['reference_number'], $LesVersions['Title'], $LesVersions['TitleHeading'], 
                        $LesVersions['AlternativeCompanyName'], $LesVersions['Location'], $LesVersions['Region']['Country']['County'], 
                        $LesVersions['Categories']['Item'], $departments["Department"]['@attributes']['id'],
                        $departments["Department"]['LogoURL'], $departments["Department"]['ImageURL'],
                        $departments["Department"]['VacancyURL'], $departments["Department"]['ApplicationURL']));
                    }   

                }
        }

        return view("admin/jobs", compact("jobs"));
    }

   

    /**
     * Retourne la listes des offres quand on passe l'url dans la fonction
     * convertXmlToJson
     */
     public function showJob($vacancy_id)
     {
        // On récupère l'url du job
        $offreUrl = Config::get('custom.offre_url');

        //On  ajoute le $vacancy_id
        $offreUrlId = $offreUrl . $vacancy_id . ".xml";
        // On crée une instance de la class new XmlConvertController
        $XmlConvertController = new XmlConvertController();

        $data = $XmlConvertController->convertXmlToJson( $offreUrlId);
        //  dd($data);

        $jobIds = [];

        if($vacancy_id && $data["@attributes"]["id"] == $vacancy_id){
            // dd($data["@attributes"]["id"]);
            array_push($jobIds, new JobId($data["@attributes"]["id"], $data["@attributes"]["date_start"],
                        $data["@attributes"]["date_end"], $data["@attributes"]["reference_number"],
                        $data["Versions"]["Version"]["Title"], $data["Versions"]["Version"]["Location"],
                        $data["Versions"]["Version"]["Description"], 
                        $data["Versions"]["Version"]['Region']["Country"]["County"],
                        $data["Departments"]["Department"]["Name"], $data["Departments"]["Department"]["LogoURL"],
                        $data["Departments"]["Department"]["ImageURL"], $data["Departments"]["Department"]["VacancyURL"]));

        } else {
            return "Cet poste n'existe pas";
        }

        return view("admin/job", compact("jobIds"));
        
    }
}
