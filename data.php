<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>McGill FSAE Racing</title>
        <link rel="stylesheet" href="/mrt/styles/style.css" type="text/css">
        <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
        <script src="https://cdn.firebase.com/js/simple-login/1.6.4/firebase-simple-login.js"></script>
        <script type="text/javascript">
         var myDataRef = new Firebase('https://torrid-fire-7257.firebaseio.com');
          var authData = myDataRef.getAuth();
          if (!authData) {
            window.location = "/mrt/";
          }
        </script>
    </head>
    <body>
        <header>
          <nav>
            <div class="nav-logo"><img src="/mrt/img/mcgill-fsae-logo-car-only.png"></div>
            <ul>
              <li><button class="logoutButton">Log Out</button></li>
              <li>
                <select name="select" class="selectInput">
                  <?php
                         foreach(glob(dirname(__FILE__) . '/inputdata/*') as $filename){
                         $filename = basename($filename);
                         $filenameNoExt = basename($filename, ".json");
                         $filenameNoSpace =  str_replace('_', ' ', $filenameNoExt);
                         echo "<option value='/mrt/inputdata/" . $filename . "'>" . $filenameNoSpace . "</option>";
                      }
                      ?>
                </select>
              </li>
              <li>
                <form class="uploadForm" action="csvUploader.php" method="post" enctype="multipart/form-data">
                    <label for="fileToUpload" class="custom-file-upload">
                        Select Data
                    </label>
                    <input type="file" name="fileToUpload" id="fileToUpload" placeholder="Upload Data">
                    <input type="submit" value="Upload" class="uploadButton" name="submit">
                </form>
              </li>
              <input type="text" class="toBeUploaded" />
            </ul>
          </nav>
        </header>
        <aside class="aside-default" data-scroll-scope>
            <ul id="sideList"></ul>
        </aside>

        <div class='loader hideLoading'>
          <div class="loadingMessage">Fetching Data</div>
          <div class='circle one'></div>
          <div class='circle two'></div>
          <div class='circle three'></div>
        </div>

        <div class="uploadMessage"><p></p></div>
        <div id="amchartContainer"></div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="/mrt/papaparse/papaparse.min.js"></script>
        <script src="/mrt/scrollscope/scroll-scope.min.js"></script>
        <script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="http://www.amcharts.com/lib/3/serial.js"></script>
        <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>

        <script type="text/javascript">

        // Initiazliaing scroll scope plugin for side bar
        $(document).scrollScope();

        AmCharts.ready(function(){

            $('.uploadForm').submit(function( event ) {
                var url = "/mrt/csvUploader.php"; // the script where you handle the form input.
                var data = new FormData(this);
                var fileName = $("#fileToUpload").val().split('\\').pop().split('.').shift();
                console.log(fileName);
                    $.ajax({
                           type: "POST",
                           url: url,
                           data: data,
                           processData: false,
                           contentType: false,
                           success: function(data)
                           {
                              console.log(data);
                              $('.uploadMessage > p').text(data);
                              $('.uploadMessage').addClass('uploadMessage-active').delay(4800).queue(function(next){
                                    $(this).removeClass("uploadMessage-active");
                                    next();
                                });

                              if (data.indexOf("succesfully") > -1) {
                                  var optionElement = document.createElement('option');
                                  fileNameReplaced = fileName.replace(/_/g, " ");
                                  optionElement.innerHTML = fileNameReplaced;
                                  optionElement.value = '/mrt/inputdata/' + fileName + '.json';
                                  $('.selectInput').prepend(optionElement);
                              }
                           }
                         });


                    // var dir = "uploadedCSV/";
                    // var fileextension = ".csv";
                    // $.ajax({
                    //     //This will retrieve the contents of the folder if the folder is configured as 'browsable'
                    //     type: 'GET',
                    //     url: dir,
                    //     success: function (data) {
                    //         //Lsit all png file names in the page
                    //         console.log('test');
                    //         $(data).find("a:contains(" + fileextension + ")").each(function () {
                    //             var filename = this.href.replace(window.location.host, "").replace("http:///", "");
                    //             $("body").append($("<div" + dir + filename + "></div>"));
                    //         });
                    //     }
                    // });

                    return false; // avoid to execute the actual submit of the form.
          });

          $('#fileToUpload').change(function(){

              $('.toBeUploaded').val($(this).val().split('\\').pop());
              $('.uploadButton').removeAttr('disabled').css('opacity','1');

               if($('.toBeUploaded').val().length > 30) {

                       $('.uploadButton').disabled = false;
                        $('.uploadMessage > p').text('Sorry, file must be less than 30 characeters');
                        $('.uploadButton').attr('disabled','disabled').css('opacity','0.4');

                        $('.uploadMessage').addClass('uploadMessage-active').delay(5000).queue(function(next){
                        $(this).removeClass("uploadMessage-active");
                        next();
                    });
                  }

            });

          $('nav').addClass('onload-reveal');
          var myDataRef = new Firebase('https://torrid-fire-7257.firebaseio.com');
          // Log out button
          $('button').on('click', function(){
             myDataRef.unauth();
             var authData = myDataRef.getAuth();
             if (authData) {
             } else {
               window.location = "/mrt/";
             }
          });

          // Seconds to HH:MM:SS
          String.prototype.toHHMMSS = function () {
            var sec_num = parseInt(this, 10); // don't forget the second param
            var hours   = Math.floor(sec_num / 3600);
            var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
            var seconds = sec_num - (hours * 3600) - (minutes * 60);

            if (hours   < 10) {hours   = "0"+hours;}
            if (minutes < 10) {minutes = "0"+minutes;}
            if (seconds < 10) {seconds = "0"+seconds;}
            var time    = hours+':'+minutes+':'+seconds;
            return time;
          }

          // Function to parse the data
          var useData = function(originalJSON) {

             function count(obj) {
                var count=0;
                for(var prop in obj) {
                  for( var secondProp in obj[prop]) {
                      ++count;
                   }
                }
                return count/originalJSON.length;
             }
             var numProperties = (count(originalJSON));

          var holderArr = [];

          for(prop in originalJSON) {
            for(secondProp in originalJSON[prop]) {
                holderArr.push(originalJSON[prop][secondProp]);
            }
          }
          // Creating dynamic variables to fill
          var makers = []

          console.log("orignalJSON.length: " + originalJSON.length + " | numProperties: " + numProperties);
          for (var i = 0; i < (numProperties*2); i++) {
            makers[i] = [];
          }

          // Build all the objects to give to amcharts
          for (var i = 0; i < holderArr.length; i += numProperties) {


              var lapTime = holderArr[i+1];
              var timeOfDay = holderArr[i].toHHMMSS();
              tmp = {
                  'lapTime': lapTime,
                  'lapTimeOfDay': timeOfDay
              };
              makers[0].push(tmp);

              var timeOfDay = holderArr[i].toHHMMSS();
              var lap_v_max = holderArr[i+2];
              tmp2 = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_v_max': lap_v_max
              };
              makers[1].push(tmp2);


              var lap_ect_max = holderArr[i+3];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_ect_max': lap_ect_max
              };
              makers[2].push(tmp);


              var lap_ect_mean = holderArr[i+4];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_ect_mean': lap_ect_mean
              };
              makers[3].push(tmp);


              var lap_oilt_max = holderArr[i+5];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_oilt_max': lap_oilt_max
              };
              makers[4].push(tmp);


              var lap_oilt_mean = holderArr[i+6];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_oilt_mean': lap_oilt_mean
              };
              makers[5].push(tmp);


              var lap_iat_max = holderArr[i+7];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_iat_max': lap_iat_max
              };
              makers[6].push(tmp);


              var lap_iat_mean = holderArr[i+8];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_iat_mean': lap_iat_mean
              };
              makers[7].push(tmp);


              var lap_rhf_max = holderArr[i+9];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_rhf_max': lap_rhf_max
              };
              makers[8].push(tmp);


              var lap_rhr_max = holderArr[i+10];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_rhr_max': lap_rhr_max
              };
              makers[9].push(tmp);


              var lap_rhf_mean = holderArr[i+11];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_rhf_mean': lap_rhf_mean
              };
              makers[10].push(tmp);


              var lap_rhr_mean = holderArr[i+12];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_rhr_mean': lap_rhr_mean
              };
              makers[11].push(tmp);


              var lap_pbrakef_max = holderArr[i+13];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_pbrakef_max': lap_pbrakef_max
              };
              makers[12].push(tmp);


              var lap_pbraker_max = holderArr[i+14];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_pbraker_max': lap_pbraker_max
              };
              makers[13].push(tmp);


              var lap_brakebias_mean = holderArr[i+15];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_brakebias_mean': lap_brakebias_mean
              };
              makers[14].push(tmp);


              var lap_rollf_max = holderArr[i+16];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_rollf_max': lap_rollf_max
              };
              makers[15].push(tmp);


              var lap_rollr_max = holderArr[i+17];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_rollr_max': lap_rollr_max
              };
              makers[16].push(tmp);


              var lap_rpm_max = holderArr[i+18];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_rpm_max': lap_rpm_max
              };
              makers[17].push(tmp);


              var lap_exh_t_max = holderArr[i+19];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_exh_t_max': lap_exh_t_max
              };
              makers[18].push(tmp);


              var lap_oilp_mean = holderArr[i+20];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_oilp_mean': lap_oilp_mean
              };
              makers[19].push(tmp);


              var lap_oilp_min = holderArr[i+21];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_oilp_min': lap_oilp_min
              };
              makers[20].push(tmp);


              var lap_fuelp_min = holderArr[i+22];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_fuelp_min': lap_fuelp_min
              };
              makers[21].push(tmp);


              var lap_battv_mean = holderArr[i+23];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'lap_battv_mean': lap_battv_mean
              };
              makers[22].push(tmp);


               var CL_F = holderArr[i+24];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'CL_F': CL_F
              };
              makers[23].push(tmp);

              var CL_R = holderArr[i+25];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'CL_R': CL_R
              };
              makers[24].push(tmp);

              var CL = holderArr[i+26];
              tmp = {
                  'lapTimeOfDay': timeOfDay,
                  'CL': CL
              };
              makers[25].push(tmp);
          }



            var graphNames = [
                  "lapTimeOfDay",
                  "lapTime",
                  "lap_v_max",
                  "lap_ect_max",
                  "lap_ect_mean",
                  "lap_oilt_max",
                  "lap_oilt_mean",
                  "lap_iat_max",
                  "lap_iat_mean",
                  "lap_rhf_max",
                  "lap_rhr_max",
                  "lap_rhf_mean",
                  "lap_rhr_mean",
                  "lap_pbrakef_max",
                  "lap_pbraker_max",
                  "lap_brakebias_mean",
                  "lap_rollf_max",
                  "lap_rollr_max",
                  "lap_rpm_max",
                  "lap_exh_t_max",
                  "lap_oilp_mean",
                  "lap_oilp_min",
                  "lap_fuelp_min",
                  "lap_battv_mean",
                  "CL_R",
                  "CL_F",
                  "CL"
                ]

                // Stops from building unnecessary empty graphs
                graphNames.length = numProperties;

            var prettyColors = [
                "#ed5153",
                "#323a45",
                "#3F51B5",
                "#009688",
                "#CDDC39",
                "#4CAF50",
                "#FF9800",
                "#FF5722",
                "#607D8B",
                "#673AB7",
                "#D32F2F",
                "#880E4F",
                "#283593",
                "#004D40",
                "#01579B",
                "#4CAF50",
                "#FBC02D",
                "#424242",
                "#3F51B5",
                "#7CB342",
                "#00BCD4",
                "#455A64",
                "#1565C0",
                "#4CAF50",
                "#990000",
                "#283593"
            ]

            // If Container, remove it so we can build a new one.

            var sideList = document.getElementById('sideList');
                // Loop to make the divs + charts
              for (i = 0; i < graphNames.length-1; i++) {

                // If not amChartContainer, make one to insert graphs into
                if(!($('#amchartContainer').length)) {
                  var amChartContainer = document.createElement('div');
                  amChartContainer.id = 'amchartContainer';
                  document.getElementsByTagName('body')[0].appendChild(amChartContainer);
                }

                header = document.createElement('h2');
                header.id = graphNames[i+1];
                amChartContainer =  document.getElementById('amchartContainer');

                header.innerHTML = graphNames[i+1];
                temp = document.createElement('div');
                temp.id = 'chartdiv'+[i];
                temp.style.height = "450px";


                // Aside navigation builder
                var amChartList = document.createElement("li");
                var amChartAnchor = document.createElement('a');


                amChartAnchor.href = '#' + graphNames[i+1];
                amChartAnchor.innerHTML = graphNames[i+1];
                amChartList.appendChild(amChartAnchor);


                amChartList.innerHTML = "<a href='#"+graphNames[i+1]+"'>" + graphNames[i+1]+ " </a>";


                amChartContainer.appendChild(header);
                amChartContainer.appendChild(temp);
                sideList.appendChild(amChartList);

                var divID = temp.id.toString();

                    var chart = AmCharts.makeChart(divID, {
                      "type": "serial",
                      "theme": "dark",
                      "dataDateFormat": "HH:NN:SS",
                      "marginRight": 25,
                      "autoMarginOffset": 25,
                      "dataProvider": makers[i],
                      "balloon": {
                        "cornerRadius": 0
                      },
                      "valueAxes": [{
                        "axisAlpha": 0
                      }],
                      "graphs": [{
                        "balloonText": "[[lapTimeOfDay]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                        "bullet": "round",
                        "bulletSize": 7,
                        "connect": false,
                        "gapPeriod": 200,
                        "lineColor": prettyColors[i],
                        "lineThickness": 2,
                        "negativeLineColor": "#487dac",
                        "valueField": graphNames[i+1].toString()
                      }],
                      "chartCursor": {
                        "categoryBalloonDateFormat": "YYYY",
                        "cursorAlpha": 0.1,
                        "cursorColor": "#000000",
                        "fullWidth": true,
                        "graphBulletSize": 2
                      },
                      "chartScrollbar": {},
                      "categoryField": "lapTimeOfDay",
                      "categoryAxis": {
                        "minPeriod": "ss",
                        "parseDates": true,
                        "minorGridEnabled": true
                      },
                      "export": {
                        "enabled": true
                      }
                    });
                }
              }

          // Default view of Data selection
          var selectedValue = $('.selectInput > option:first-child').val();
          $(".hideLoading").show();
          $.getJSON( selectedValue, function( data ) {
               useData(data);
               $('aside').addClass('aside-active');
               $(".hideLoading").fadeOut(333);
            });

          // Change Data file on user selection
          $(".selectInput").change(function (){

            var selectedValue = $(this).val();
            $(".hideLoading").show();
            $('aside').removeClass('aside-active');

            if($('#amchartContainer').children().length > 1) {
                $('#amchartContainer').fadeOut(300);
                setTimeout(function(){
                  $('#amchartContainer').remove();
                  $('#sideList').children().remove();
                },300);

            }

            // Added in setTimout to give aside time to transform: translateX(0%)
            setTimeout(function(){
              $.getJSON( selectedValue, function( data ) {
                 useData(data);
                 $('aside').addClass('aside-active');
                 $(".hideLoading").fadeOut(333);

              });
             }, 505);

          });
        });
      </script>
    </body>
</html>