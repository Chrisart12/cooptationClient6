<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobId extends Model
{
    public $id;
    public $date_start;
    public $date_end;
    public $reference_number;
    public $title;
    // public $titleHeading;
    // public $alternativeCompanyName;
    public $location;
    public  $description;
   
    public $county;
    public $departments;
    // public $departmentsName;
    // public $categories;
    // public $departementId;
    public $logoURL;
    public $imageURL;
    public $vacancyURL;
    // public $ApplicationURLL;

    // public function __construct($id, $date_start, $date_end, $reference_number, $title,
    // $titleHeading, $alternativeCompanyName, $location,
    // $county, $categories, $departementId, $logoURL, $imageURL,
    // $vacancyURL, $ApplicationURLL)
    public function __construct($id, $date_start, $date_end, $reference_number, $title, 
                                $location, $description, $county, $departments, $logoURL,
                                $imageURL, $vacancyURL)
    {
        $this->id = $id;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->reference_number = $reference_number;
        $this->title = $title;
        // $this->titleHeading = $titleHeading;
        // $this->alternativeCompanyName = $alternativeCompanyName;
        $this->location = $location;
        $this->description = $description;
        $this->county= $county;
        $this->departments= $departments;
        // $this->departmentsName= $departmentsName;
        // $this->categories = $categories;
        // $this->departementId = $departementId;
         $this->logoURL = $logoURL;
         $this->imageURL = $imageURL;
         $this->vacancyURL = $vacancyURL;
        // $this->ApplicationURLL = $ApplicationURLL;

    }
}
