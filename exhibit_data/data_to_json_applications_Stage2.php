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
$allowed_columns = array( "Tel",	
                          "Website",	
                          "Postcode",	
                          "Name",	
                          "Organisation",	
                          "Email",	
                          "Reference",
                          "Created date",	
                          "Status",	
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
                          "Organisation_staff",	
                          "Twitter ID",	
                          "project_applicant_category",	
                          "project_applicant_subcategory",
                          "lat",
                          "lng"
                          );

include("pretty_json.php");
$file  = "20130129 Stage2 submitted Apr12-Jan13 +S1 fields.csv"; //input file
$file  = "Stage2 Apr12-Jan13.csv";
$file  = str_replace(" ", "\x20", $file);
//echo $file;
//$file  = "20130129 Stage1_submitted_Apr12-Jun12.csv"; //input file
//$save_file_as = "data1.json";
$headers = TRUE;
$this_row_to_array = array();
$new_data = array();
//$new_data["properties"]["label"] = array( "valueType" => "number");
$new_data["properties"]["Created_date"] = array( "valueType" => "date");
$new_data["properties"]["Organisation_staff"] = array( "valueType" => "number");
$new_data["properties"]["applicant_numberbenefit"] = array( "valueType" => "number");
$new_data["properties"]["NT_funding"] = array( "valueType" => "number");

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
      foreach ($row1 as $key=>$value) { //e.g. $row1[0] = projectid
      //echo $value . PHP_EOL;
        if (in_array($value,$allowed_columns)) {
          $value = trim($value);
          if ($value == "Project name") {
          //if ($value == "Reference") {
            $value = "label";
          }
          $value = str_replace(" ", "_", $value);
          if($value == "Created_date") {
            $date = $data[(int)$key];
            $new_date = substr($date,6,4) . "-" . substr($date,3,2) . "-" . substr($date,0,2) ;
            $data[(int)$key] = $new_date;
          }
          //if ($value == "Project_outline") {
          //  $data[(int)$key] = substr($data[(int)$key],0,250) . "...";
          //}
          $this_row_to_array[$value] = utf8_encode($data[(int)$key]);
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
      if ($this_row_to_array["lat"] != NULL && $this_row_to_array["lng"] !=NULL) {
        $this_row_to_array["latlng"] = $this_row_to_array["lat"] . "," . $this_row_to_array["lng"];
      } else {
        $this_row_to_array["latlng"] = "";
      }
      /*
      $this_row_to_array["count"] = $i; 
      * */
      $new_data["items"][] = $this_row_to_array; //an array of the rows
      //print_r($crs_data);  
      //die;
    }
    fclose($handle);
}
$new_data = json_encode($new_data);
$new_data = json_format($new_data);
echo $new_data; 
