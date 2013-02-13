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
      $title = "Dashboard";
      include("header.php"); 
    ?>
    <link href="assets/css/exhibit.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px;
      }
    </style>
    <?php include("process_data/process_backend_data.php"); ?>
    <?php include("process_data/process_stage2_data.php"); ?>
    <?php include("process_data/process_stage1_data.php"); ?>
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      
      
      
      
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php 
          foreach ($backend_region_pie as $key => $value) {
            echo "['" . $key . "'," . $value . "],";
          }
          ?>

        ]);

        var options = {
          title: 'Organistaion Type'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        
        google.visualization.events.addListener(chart, 'click', selectHandler);
        
        
      }
      
    </script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          
          
          <?php 
          foreach ($backend_area_of_focus_pie as $key => $value) {
            echo "['" . $key . "'," . $value . "],";
          }
          ?>
        ]);

        var options = {
          title: 'Area of focus'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
        
        google.visualization.events.addListener(chart, 'click', selectHandler);
        function selectHandler() {
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var topping = data.getValue(selectedItem.row, 0);
            if (topping == "Young People") {
              window.location.assign("http://bntest.vm.bytemark.co.uk/david/nominet/website/exhibit_backend.php#eyJub3JtYWxpemVkIjp0cnVlLCJ0aXRsZSI6Ik5vbWluZXQgVHJ1c3Qge1NlbGVjdCBvbmx5IFlvdW5nIFBlb3BsZSBpbiBmYWNldCBBcmVhIE9mIEZvY3VzfSIsInVybCI6Imh0dHA6Ly9ibnRlc3Qudm0uYnl0ZW1hcmsuY28udWsvZGF2aWQvbm9taW5ldC93ZWJzaXRlL2V4aGliaXRfYmFja2VuZC5waHAiLCJoYXNoIjoiLi8vZGF2aWQvbm9taW5ldC93ZWJzaXRlL2V4aGliaXRfYmFja2VuZC5waHA_Jl9zdWlkPTEzNjAxNTU4MTIxNjkwNTA2ODU0Nzg3MDAzMjQ4OSIsImRhdGEiOnsiY29tcG9uZW50cyI6eyJmYWNldC1saXN0LS5BcmVhT2ZGb2N1cy1kZWZhdWx0LTAiOnsidHlwZSI6ImZhY2V0Iiwic3RhdGUiOnsic2VsZWN0aW9uIjpbIllvdW5nIFBlb3BsZSJdLCJzZWxlY3RNaXNzaW5nIjpmYWxzZX19LCJmYWNldC1udW1lcmljcmFuZ2UtLkdyYW50QW1vdW50LWRlZmF1bHQtMSI6eyJ0eXBlIjoiZmFjZXQiLCJzdGF0ZSI6eyJyYW5nZXMiOltdfX0sImZhY2V0LWxpc3QtLk9yZ2FuaXNhdGlvbl90eXBlLWRlZmF1bHQtMiI6eyJ0eXBlIjoiZmFjZXQiLCJzdGF0ZSI6eyJzZWxlY3Rpb24iOltdLCJzZWxlY3RNaXNzaW5nIjpmYWxzZX19LCJmYWNldC1udW1lcmljcmFuZ2UtLm9yZ2FuaXNhdGlvbl9zdGFmZi1kZWZhdWx0LTMiOnsidHlwZSI6ImZhY2V0Iiwic3RhdGUiOnsicmFuZ2VzIjpbXX19LCJmYWNldC1saXN0LS5wcm9qZWN0X2FwcGxpY2FudF9zdWJjYXRlZ29yeS1kZWZhdWx0LTQiOnsidHlwZSI6ImZhY2V0Iiwic3RhdGUiOnsic2VsZWN0aW9uIjpbXSwic2VsZWN0TWlzc2luZyI6ZmFsc2V9fSwiZmFjZXQtdGV4dC0tZGVmYXVsdC01Ijp7InR5cGUiOiJmYWNldCIsInN0YXRlIjp7InRleHQiOm51bGx9fSwidGh1bWJuYWlsLWRlZmF1bHQtMCI6eyJ0eXBlIjoidmlldyIsInN0YXRlIjp7Im9yZGVyZWRWaWV3RnJhbWUiOnsib3JkZXJzIjpbeyJwcm9wZXJ0eSI6ImxhYmVsIiwiZm9yd2FyZCI6dHJ1ZSwiYXNjZW5kaW5nIjp0cnVlfSx7InByb3BlcnR5IjoiT3JnYW5pc2F0aW9uX3R5cGUiLCJmb3J3YXJkIjp0cnVlLCJhc2NlbmRpbmciOnRydWV9XSwic2hvd0FsbCI6dHJ1ZSwic2hvd0R1cGxpY2F0ZXMiOmZhbHNlLCJncm91cGVkIjp0cnVlLCJwYWdlIjowfX19LCJ2aWV3UGFuZWwtZGVmYXVsdC0wIjp7InR5cGUiOiJ2aWV3UGFuZWwiLCJzdGF0ZSI6eyJ2aWV3SW5kZXgiOjB9fX0sInN0YXRlIjoxLCJsZW5ndGh5Ijp0cnVlfSwiaWQiOiIxMzYwMTU1ODEyMTY5MDUwNjg1NDc4NzAwMzI0ODkiLCJjbGVhblVybCI6Imh0dHA6Ly9ibnRlc3Qudm0uYnl0ZW1hcmsuY28udWsvZGF2aWQvbm9taW5ldC93ZWJzaXRlL2V4aGliaXRfYmFja2VuZC5waHAiLCJoYXNoZWRVcmwiOiJodHRwOi8vYm50ZXN0LnZtLmJ5dGVtYXJrLmNvLnVrL2RhdmlkL25vbWluZXQvd2Vic2l0ZS8vZGF2aWQvbm9taW5ldC93ZWJzaXRlL2V4aGliaXRfYmFja2VuZC5waHA_Jl9zdWlkPTEzNjAxNTU4MTIxNjkwNTA2ODU0Nzg3MDAzMjQ4OSJ9");
            }
          }
        }
      }
    </script>
   
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Year', 'Applications'],
        <?php 
          foreach ($stage2_years as $key => $value) {
            echo "['" . $key . "'," . $value . "],";
          }
          ?>
          

        ]);

        var options = {
          title: 'Stage 2 Applications by year',
          hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div4'));
        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Benficiaries', 'Funding'],
        <?php
        $i=0;
        foreach ($this_row_to_array['NT_funding'] as  $row) {
          $i++;
          if ($i <50) {
            echo "[" . $row . "],";
          }
        }
        ?>
        ]);

        var options = {
          title: 'Beneficiaries vs. Funding (50 projects)',
          hAxis: {title: 'Beneficiaries', minValue: 0, maxValue: 100000},
          vAxis: {title: 'Funding', minValue: 0, maxValue: 1000000},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div5'));
        chart.draw(data, options);
      }
    </script>

  </head>
  <body>

    <?php include("top_nav.php"); ?>
    
      <div class="container">
        <div class="span12">
            <div class="span3" style="margin-left:0">
              <?php if (isset($org)) { echo "Filter: Organisation Type = " . $org; } ?>
            </div>
        </div>
        <div class="span12">
          <h3>Funded Projects</h3>
          <div class="span5">
            <div id="chart_div" style="width: 500px; height: 300px;"></div>
          </div>
          <div class="span5">
            <div id="chart_div2" style="width: 500px; height: 300px;"></div>
          </div>
          <!--<div class="span3">
            <div id="chart_div3" style="width: 400px; height: 300px;"></div>
          </div>-->
        </div>
        
        <div class="span12">
          
           
              
              <div>
                <!---->
                <div class="metric-box">
                  <div class="title">Total Project Funding</div>
                  <div class="number"><?php echo "&pound;" .  round((array_sum($backend_values["GrantAmount"])/1000000),2) . "M"; ?></div>
                </div>
                <div class="metric-box">
                  <div class="title">Number of Projects</div>
                  <div class="number"><?php echo count($backend_values["GrantAmount"]); ?></div>
                </div>
                <div class="metric-box">
                  <div class="title">Mean<br/>Funding</div>
                  <div class="number"><?php echo "&pound;" . round((array_sum($backend_values["GrantAmount"]) / count($backend_values["GrantAmount"])),0); ?></div>
                </div>
                 <div class="metric-box">
                  <div class="title">Projects with Websites</div>
                  <div class="number"><?php echo count($backend_values["Website"]); ?></div>
                </div>
                <div class="metric-box">
                  <div class="title">Projects with Twitter</div> 
                  <div class="number"><?php if (isset($backend_values["Twitter_ID"])) { echo count($backend_values["Twitter_ID"]); } else { echo "0"; } ?></div>
                </div>
                <div class="metric-box">
                  <div class="title">Project Beneficiaries</div> 
                  <div class="number"><?php echo array_sum($backend_values["TotalBeneficiariesActual"]); ?></div>
                </div> 
             </div>
      
        </div>
        <?php 
          if (!isset($org)) { //only show stage 2 data if $org filter is not set
        ?>
        <div class="span12">
          <div class="span5">
            <div style="width: 500px; height: 300px;">
              <img src="images/staff1.png";/>
            </div>
          </div>
          <div class="span5">
            <div style="width: 500px; height: 300px;">
               <img src="images/staff2.png";/>
            </div>
          </div>
          <!--<div class="span3">
            <div id="chart_div3" style="width: 400px; height: 300px;"></div>
          </div>-->
        </div>
        <?php } ?>
        
        <hr>
        <?php 
          if (!isset($org)) { //only show stage 2 data if $org filter is not set
        ?>
        <div class="span12">
          <h3>Applications Stage 2</h3>
          <div class="span5">
            <div id="chart_div4" style="width: 500px; height: 300px;"></div>
          </div>
          <div class="span5">
            <div id="chart_div5" style="width: 500px; height: 300px;"></div>
          </div>
          <!--<div class="span3">
            <div id="chart_div6" style="width: 400px; height: 300px;"></div>
          </div>-->
        </div>
        <div class="span12">
          <div>
            <div class="metric-box">
              <div class="title">Pending</div>
              <div class="number"><?php echo $values["pending"]; ?></div>
            </div>
            <div class="metric-box">
              <div class="title">Approved</div>
              <div class="number"><?php echo $values["approved"]; ?></div>
            </div>
            <div class="metric-box">
              <div class="title">In progress</div>
              <div class="number"><?php echo $values["inprogress"]; ?></div>
            </div>
             <div class="metric-box">
              <div class="title">Completed</div>
              <div class="number"><?php echo $values["completed"]; ?></div>
            </div>
            <div class="metric-box">
              <div class="title">Rejected</div> 
              <div class="number"><?php echo $values["rejected"]; ?></div>
            </div>
            <div class="metric-box">
              <div class="title">All time </div> 
              <div class="number"><?php echo array_sum($values); ?></div>
            </div> 
         </div>
        </div>
        <?php 
          if (!isset($org)) { //only show stage 2 data if $org filter is not set
        ?>
        <div class="span12">
         
              <img src="images/stage2.png";/>
        
        </div>
        <?php } ?>
        
        <?php } else {
        ?>
        <div class="span12">
           <h3>Applications Stage 2</h3>
           <p>We cannot apply the filter '<?php echo $org; ?>' to this data</p>
        </div>
        <?php } ?>
          
      <hr>
       <div class="span12">
           
              <h3>Applications Stage 1</h3>
              <div>
                <div class="metric-box">
                  <div class="title">Pending</div>
                  <div class="number"><?php if(isset($stage1_values["pending"])) { echo $stage1_values["pending"]; } else { echo "0"; } ?></div>
                </div>
                <div class="metric-box">
                  <div class="title">Approved</div>
                  <div class="number"><?php echo $stage1_values["approved"]; ?></div>
                </div>
                <div class="metric-box">
                  <div class="title">In progress</div>
                  <div class="number"><?php echo $stage1_values["inprogress"]; ?></div>
                </div>
                 <div class="metric-box">
                  <div class="title">Completed</div>
                  <div class="number"><?php echo $stage1_values["completed"]; ?></div>
                </div>
                <div class="metric-box">
                  <div class="title">Rejected</div> 
                  <div class="number"><?php echo $stage1_values["rejected"]; ?></div>
                </div>
                <div class="metric-box">
                  <div class="title">All time </div> 
                  <div class="number"><?php echo array_sum($stage1_values); ?></div>
                </div> 
             </div>
              
        </div>
        <?php 
          if (!isset($org)) { //only show stage 2 data if $org filter is not set
        ?>
         <div class="span12">
         
              <img src="images/stage1.png";/>
        
        </div>
        <?php } ?>
        
        
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>-->
    <!--<script src="assets/js/bootstrap-transition.js"></script>
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
    <script src="assets/js/bootstrap-typeahead.js"></script>-->
    <!--
    <script type="text/javascript">
      
        $('.dropdown-toggle').dropdown();   
      </script>
    -->

  </body>
</html>

