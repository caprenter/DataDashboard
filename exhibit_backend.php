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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
      $title = "Funded Projects";
      include("header.php"); 
    ?>
    <link href="exhibit_data/data_backend.json" type="application/json" rel="exhibit-data" />
    <link rel="exhibit-extension" type="text/javascript" href="http://api.simile-widgets.org/exhibit/3.0.0/extensions/map/map-extension.js" />
    <link rel="exhibit-extension" type="text/javascript" href="http://api.simile-widgets.org/exhibit/3.0.0/extensions/time/time-extension.js" />
    <script src="http://api.simile-widgets.org/exhibit/3.0.0/exhibit-api.js"></script>
    
    
    <link href="assets/css/exhibit.css" rel="stylesheet">
  </head>
  <body>

    <?php include("top_nav.php"); ?>
    
      <div class="container">
        <div class="span12">
          <div id="main-content">
        <div id="title-panel">
          <h2>Funded Projects</h2>
        </div>
    
        <div id="top-panels">
            <table width="100%"><tr>
                <td><div ex:role="facet" ex:expression=".AreaOfFocus" ex:facetLabel="Area Of Focus"></div></td>
                <td><div ex:role="facet" ex:facetLabel="Grant Amount" ex:expression=".GrantAmount" ex:facetClass="NumericRange" ex:interval="50000"></div></td>
                <td><div ex:role="facet" ex:expression=".Organisation_type" ex:facetLabel="Org. Type"></div></td>
                <td><div ex:role="facet" ex:expression=".organisation_staff" ex:facetLabel="Org. Staff" ex:facetClass="NumericRange" ex:interval="50"></div></td>
                <td><div ex:role="facet" ex:expression=".project_applicant_subcategory" ex:facetLabel="Project Applicant Subcategory"></div></td>
                <td><div ex:role="facet" ex:facetClass="TextSearch" ex:facetLabel="Search"></div></td>
            </tr></table>
        </div>
        <div ex:role="viewPanel" style="padding: 1em 0.5in;">
            <table ex:role="lens" class="nobelist" style="display: none;"><tr>
                <td>
                    <div ex:content=".label" class="name"></div>
                    <div>
                        (<span ex:content=".Organisation" class="discipline"></span>)<br/>
                        <span ex:content=".ProjectSummary" ex:formats ="text {max-length:250}"class="discipline"></span><br/><br/>
                        <span>Anticipated Beneficiaries: </span><span ex:content=".TotalBeneficiariesAnticipated" class="discipline"></span><br/> 
                        <span ex:content=".AreaOfFocus" class="discipline"></span><br/>
                        <span>&pound;</span><span ex:content=".GrantAmount" class="discipline"></span><br/>
                        From <span ex:content=".ProjectStartDate"  ex:formats ="date {mode:short; show : date}" class="discipline"></span> to <span  ex:content=".ProjectEndDate" ex:formats ="date {mode:short; show : date}" class="discipline"></span><br/>
                        <span>Location On Shared Drive: </span><a ex:href-subcontent="file:{{.LocationOnSharedDrive}}" ><span ex:content=".filename" class="discipline"></span></a>
                    </div>
                    
                </td>
            </tr></table>
        
            <div ex:role="view"
                ex:viewClass="Thumbnail"
                ex:showAll="true"
                ex:orders=".label, .Organisation_type">
                <div ex:role="exhibit-lens" class="nobelist-thumbnail" style="display: none;">
                    
                    <div ex:content=".label" class="name"></div>
                    <div>
                        
                        (<span ex:content=".Organisation" class="discipline"></span>)<br/>
                        <span ex:content=".ProjectSummary" ex:formats ="text {max-length:50}"class="discipline"></span><br/><br/>
                        <span>Anticipated Beneficiaries: </span><span ex:content=".TotalBeneficiariesAnticipated" class="discipline"></span><br/> 
                        <span ex:content=".AreaOfFocus" class="discipline"></span><br/>
                        <span>&pound;</span><span ex:content=".GrantAmount" class="discipline"></span><br/>
                        From <span ex:content=".ProjectStartDate"  ex:formats ="date {mode:short; show : date}" class="discipline"></span> to <span  ex:content=".ProjectEndDate" ex:formats ="date {mode:short; show : date}" class="discipline"></span><br/>
                        <span>Location On Shared Drive: </span><a ex:href-subcontent="file:{{.LocationOnSharedDrive}}" ><span ex:content=".filename" class="discipline"></span></a><br/>
                        

	
                    </div>
                </div>
            </div>
            <div ex:role="view"
                ex:label="Full Details"
                ex:viewClass="Tile"
                ex:showAll="true"
                ex:orders=".label"
                ex:possibleOrders=".label, .Organisation_type">
                 <div ex:role="lens" class="nobelist" style="display: none;">
                    
                    <div ex:content=".label" class="name"></div>
                    <div>
                        
                        
                        <span ex:content=".ProjectSummary" class="discipline"></span><br/><br/>
                        Organisation: <span ex:content=".Organisation" class="discipline"></span><br/>
                        Reference: <span ex:content=".Reference" class="discipline"></span><br/>
                        Funding Round: <span ex:content=".FundingRound" class="discipline"></span><br/>
                        
                        Organisation Location <span ex:content=".OrganisationLocation" class="discipline"></span><br/>
                        Total Anticipated Beneficiaries: <span ex:content=".TotalBeneficiariesAnticipated" class="discipline"></span><br/> 
                        Area Of Focus: <span ex:content=".AreaOfFocus" class="discipline"></span><br/>
                        Grant Amount: <span>&pound;</span><span ex:content=".GrantAmount" class="discipline"></span><br/>
                        Project Start Date: <span ex:content=".ProjectStartDate"  ex:formats ="date {mode:short; show : date}" class="discipline"></span><br/>
                        Project End Date: <span  ex:content=".ProjectEndDate" ex:formats ="date {mode:short; show : date}" class="discipline"></span><br/>
                        Location On Shared Drive: <a ex:href-subcontent="file:{{.LocationOnSharedDrive}}" ><span ex:content=".filename" class="discipline"></span></a><br/>
                        Type of Investment: <span ex:content=".Type_of_Investment" class="discipline"></span><br/>
                        Organisation type: <span ex:content=".Organisation_type" class="discipline"></span><br/>
                        Organisation staff: <span ex:content=".organisation_staff" class="discipline"></span><br/>
                        Email:	<span ex:content=".Email" class="discipline"></span><br/>
                        Website:	<a ex:if-exists=".Website" ex:href-subcontent="http://{{.Website}}" ><span ex:content=".Website" class="discipline"></span></a><br/>
                        Twitter ID: <span ex:content=".Twitter_ID" class="discipline"></span><br/>
                        Project Applicant Subcategory: <span ex:content=".project_applicant_subcategory" class="discipline"></span><br/>
                        Postcode: <span ex:content=".Postcode" class="discipline"></span><br/><br/>
                        

	
                    </div>
                </div>

            </div>
      
            
             <div ex:role="view" 
                  ex:label="Map"
                  ex:viewClass="Map" 
                  ex:latlng=".latlng"
                  ex:colorKey=".Organisation_type"
                  ex:center="54.46684525346424, -3.08990478515625"
                  ex:zoom="5">
                  
            </div>
            <div ex:role="view"
                ex:viewClass="Timeline"
                ex:start=".ProjectEndDate"
                ex:colorKey=".Organisation_type"
                ex:bubbleWidth="450"
                ex:bubbleHeight="450">
                
            </div>
            <div  ex:role="view" 
                  ex:viewClass="Tabular"
                  ex:columns=".label, .Organisation, .GrantAmount, .Organisation_type, .organisation_staff"
                  ex:columnLabels="Project Name, Organisation, Grant Amount, Organisation Type, Staff" >
                  
            </div>
            
          </div>
       

           
    </div><!--main content-->
        </div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>


