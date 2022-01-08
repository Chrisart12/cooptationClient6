<?php

namespace App;


class Job 
{
    public $id;
    public $date_start;
    public $date_end;
    public $reference_number;
    public $title;
    public $titleHeading;
    public $alternativeCompanyName;
    public $location;
    public $county;
    public $categories;
    public $departementId;
    public $logoURL;
    public $imageURL;
    public $vacancyURL;
    public $ApplicationURLL;


    public function __construct($id, $date_start, $date_end, $reference_number, $title,
                                $titleHeading, $alternativeCompanyName, $location,
                                $county, $categories, $departementId, $logoURL, $imageURL,
                                $vacancyURL, $ApplicationURLL)
    {
        $this->id = $id;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->reference_number = $reference_number;
        $this->title = $title;
        $this->titleHeading = $titleHeading;
        $this->alternativeCompanyName = $alternativeCompanyName;
        $this->location = $location;
        $this->county= $county;
        $this->categories = $categories;
        $this->departementId = $departementId;
        $this->logoURL = $logoURL;
        $this->imageURL = $imageURL;
        $this->vacancyURL = $vacancyURL;
        $this->ApplicationURLL = $ApplicationURLL;
       
    }
}

