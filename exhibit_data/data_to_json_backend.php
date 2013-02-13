<?php
 /*
 * This file is part of Data Dashboard Project.
 * Copyright caprenter@gmail.com January 2012 where applicable
 * 
 * Data Dashboard Project is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Foobar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
$allowed_columns = array("reference",
                          //"number",	
                          "FundingRound",
                          "Organisation",
                          "ProjectName",
                          "ProjectSummary",
                          "OrganisationLocation",
                          "BeneficiaryRegion",
                          //"Setting",
                          "TotalBeneficiariesAnticipated",
                          "TotalBeneficiariesActual",
                          "AreaOfFocus",
                          "GrantAmount",
                          //"OutputType",
                          "ProjectStartDate",
                          "ProjectEndDate",
                          "LocationOnSharedDrive",
                          "Type of Investment",
                          "Final Evaluation completed",
                          "Organisation type",
                          "organisation_staff",
                          "Email",
                          "Website",
                          "Twitter ID",
                          "project_applicant_category",
                          "project_applicant_subcategory",
                          "Postcode",
                          "lat",
                          "lng",
                          "Monitoring form count",
                          "CharityCommissionURL",	
                          "OpenCharVolunteers",	
                          "OpenCharEmployees",	
                          "OpenCorpURL",	
                          "OpenCorpIncorporationDate"
                          
                          //"Charity Number",
                          //"Company Number",
                          //"Other Registration"
                          );

include("pretty_json.php");
$file  = "20130130 InvDB-backend lookup.csv"; //input file
$file  = "Funded Projects.csv"; //input file
$file  = str_replace(" ", "\x20", $file);
//$save_file_as = "data1.json";
$headers = TRUE;
$this_row_to_array = array();
$new_data = array();
//$new_data["properties"]["label"] = array( "valueType" => "number");
$new_data["properties"]["ProjectEndDate"] = array( "valueType" => "date");
$new_data["properties"]["ProjectStartDate"] = array( "valueType" => "date");
$new_data["properties"]["GrantAmount"] = array( "valueType" => "number");
$new_data["properties"]["organisation_staff"] = array( "valueType" => "number");
$new_data["properties"]["TotalBeneficiariesAnticipated"] = array( "valueType" => "number");
//Parse the csv file and get the whole thing into a great big array
if (($handle = fopen($file, "r")) !== FALSE) {
    
    if($headers == TRUE) {
      $row1 = fgetcsv($handle, 0, ',','"'); // read and store the first line
      //fgets($handle); // read and ignore the first line
      //print_r($row1);
    } 
    
    while (($data = fgetcsv($handle, 0, ',','"')) !== FALSE) { //set string length parameter to 0 lets us pull in very long lines.
      //data[] is an array of values we need to create a big array of type:
      // array("projectid"= {value from column 1 of csv},
      //       "title = = {value from column 2 of csv},
      //        ........
      foreach ($row1 as $key=>$value) { //e.g. $row1[0] = projectid
        if (in_array($value,$allowed_columns)) {
          if ($value == "ProjectName") {
            $value = "label";
          }
          if ($value == "LocationOnSharedDrive") {
            $location = utf8_encode($data[(int)$key]);
            $location = explode("\\",$location);
            $location = array_pop($location);
            $this_row_to_array["filename"] = $location;
            unset($location);
          }
          $value = str_replace(" ", "_", $value);
          if($value == "ProjectEndDate" || $value == "ProjectStartDate" ) {
            $date = $data[(int)$key];
            $new_date = substr($date,6,4) . "-" . substr($date,3,2) . "-" . substr($date,0,2) ;
            $data[(int)$key] = $new_date;
          }

          $this_row_to_array[$value] = utf8_encode($data[(int)$key]);
          /*if ($value = "ProjectEndDate") {
            $date = explode("-",$data[(int)$key]);
            $new_date = "20" . $date[2] . "-" . 
            $this_row_to_array[$value] = date("Y-m-d",strtotime($data[(int)$key]));
          }*/
          //e.g. $this_row_to_array['projectid'] = utf8_encode($data[0])
          //Create our array of region/county codes
        }
      }  
      if ($this_row_to_array["lat"] != NULL && $this_row_to_array["lng"] !=NULL) {
        $this_row_to_array["latlng"] = $this_row_to_array["lat"] . "," . $this_row_to_array["lng"];
      } else {
        $this_row_to_array["latlng"] = "";
      }
      $new_data["items"][] = $this_row_to_array; //an array of the rows
      //print_r($crs_data);  
      //die;
    }
    fclose($handle);
}
$new_data = json_encode($new_data);
$new_data = json_format($new_data);
echo $new_data; 
