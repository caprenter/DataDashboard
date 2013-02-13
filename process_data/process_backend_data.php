<?php
/*
 * This file is part of Data Dashboard Project.
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
$allowed_columns = array( /*"Tel",	
                          "Website",	
                          "Postcode",	
                          "Name",	
                          "Organisation",	
                          "Email",	
                          "Reference",
                          "Created date",	
                          	
                          "Project name",	
                          "Project summary",	
                          "Start date",	
                          "Finish date",
                          "applicant_numberbenefit",	
                          "NT_funding",	
                          "Total_projectcost",	
                          "Declaration date",	
                          "Grant amount awarded",	
                          "Anticipated project start date",	
                          "Anticipated project completion date",
                          "Organisation type",
                          "organisation_staff",	
                          "Twitter ID",	
                          "project_applicant_category",	
                          "project_applicant_subcategory"*/
                          "Status",
                          "Organisation type",
                          "TotalBeneficiariesActual",
                          "GrantAmount",
                          "Twitter ID",
                          "Website",
                          //"BeneficiaryRegion",
                          "AreaOfFocus",


                          );

//include("pretty_json.php");
$file  = "process_data/data/20130130 InvDB-backend lookup.csv"; //input file
//$file  = "data/20130130 InvDB-backend lookup.csv"; //input file
$file  = str_replace(" ", "\x20", $file);
//echo $file;
//$file  = "20130129 Stage1_submitted_Apr12-Jun12.csv"; //input file
//$save_file_as = "data1.json";
$headers = TRUE;
$this_row_to_array = array();
$new_data = array();

$acceptable_orgs = array("Charity","University","Not for profit","For profit","Community association","Governmental organisation","Community Interest Company");
//Validate the list id
if (isset($_GET['org'])) {
  //echo $_GET['org'];die;
  //this is passed from the main set list page. We need to post it back
  $org = filter_var($_GET['org'], FILTER_SANITIZE_STRING);
  if (!in_array($org,$acceptable_orgs)) {
    unset($org);
  }
  //echo $list_id;
}

//$i=0;
//Parse the csv file and get the whole thing into a great big array
if (($handle = fopen($file, "r")) !== FALSE) {
    
    if($headers == TRUE) {
      $row1 = fgetcsv($handle, 0, ',','"'); // read and store the first line
      //fgets($handle); // read and ignore the first line
      //print_r($row1);
    } 
    
    while (($data = fgetcsv($handle, 0, ',','"')) !== FALSE) { //set string length parameter to 0 lets us pull in very long lines.
    //$i++;
    //if ($i > 152) {
    //  break;
    //}
      //data[] is an array of values we need to create a big array of type:
      // array("projectid"= {value from column 1 of csv},
      //       "title = = {value from column 2 of csv},
      //        ........
      
      $filter_key = array_search("Organisation type",$row1);
      if (isset($org)) {
        if ($data[$filter_key] != $org) {
          continue;
        }
      }
      //echo $filter_key; die;
      foreach ($row1 as $key=>$value) { //e.g. $row1[0] = projectid
        if (in_array($value,$allowed_columns)) {
          //Approved,in progress,rejected
          $value = str_replace(" ", "_", $value);
          if ($value == "Website" || $value =="Twitter_ID") {
            if (strlen($data[(int)$key]) < 3) {
              continue;
            } 
          }
          $this_row_to_array[$value][] = utf8_encode($data[(int)$key]);
          //$this_row_to_array[$value] = $data[(int)$key];
          /*if ($value = "ProjectEndDate") {
            $date = explode("-",$data[(int)$key]);
            $new_date = "20" . $date[2] . "-" . 
            $this_row_to_array[$value] = date("Y-m-d",strtotime($data[(int)$key]));
          }*/
          //e.g. $this_row_to_array['projectid'] = utf8_encode($data[0])
          //Create our array of region/county codes
        }
      }  
      /*if ($this_row_to_array["lat"] != NULL && $this_row_to_array["lng"] !=NULL) {
        $this_row_to_array["latlng"] = $this_row_to_array["lat"] . "," . $this_row_to_array["lng"];
      } else {
        $this_row_to_array["latlng"] = "";
      }
      $this_row_to_array["count"] = $i; 
      * */
      //$new_data["items"][] = $this_row_to_array; //an array of the rows
      //print_r($crs_data);  
      //die;
    }
    fclose($handle);
}
//print_r($this_row_to_array);
$backend_values = $this_row_to_array;

//Pie Chart

//$backend_regions  = array_count_values($backend_values['BeneficiaryRegion']);
$backend_regions  = array_count_values($backend_values['Organisation_type']);
$backend_regions_sum = array_sum($backend_regions);

foreach ($backend_regions as $key => $value) {
  $backend_region_pie[$key] = round(($value*100/$backend_regions_sum),0);
} 

$backend_area_of_focus  = array_count_values($backend_values['AreaOfFocus']);
$backend_area_of_focus_sum = array_sum($backend_area_of_focus);

foreach ($backend_area_of_focus as $key => $value) {
  $backend_area_of_focus_pie[$key] = round(($value*100/$backend_area_of_focus_sum),0);
} 

  

//$new_data = json_encode($new_data);
//$new_data = json_format($new_data);
//echo $new_data; 
