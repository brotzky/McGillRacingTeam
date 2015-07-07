<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>McGill FSAE Racing</title>
        <link rel="stylesheet" href="/mrt/styles/style.css" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
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
                    $files = glob(dirname(__FILE__) . '/inputdata/*.json');
                    usort($files, function($a, $b) {
                        return filemtime($a) < filemtime($b);
                    });
                    foreach($files as $file){
                      $filename = substr($file, strrpos($file, '/') + 1);
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
                        Upload Data
                    </label>
                    <input type="file" name="fileToUpload" id="fileToUpload" placeholder="Upload Data">
                    <input type="submit" value="Confirm" class="uploadButton" name="submit" disabled>
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
          var keyHolderArr = [];

          for(prop in originalJSON) {

            for(secondProp in originalJSON[prop]) {
                holderArr.push(originalJSON[prop][secondProp]);
            }
          }

          for(nextProp in originalJSON) {
            keyHolderArr.push(Object.keys(originalJSON[nextProp]));
          }

          // Creating dynamic variables to fill
          var makers = []
          console.log("orignalJSON.length: " + originalJSON.length + " | numProperties: " + numProperties);
          for (var i = 0; i < (numProperties*2); i++) {
            makers[i] = [];
          }

          // Build all the objects to give to amcharts
          for (var i = 0; i < holderArr.length; i += numProperties) {

            var timeOfDay = holderArr[i].toHHMMSS();

              tmp = {};
              tmp[keyHolderArr[0][1]] = holderArr[i+1];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[0].push(tmp);

              tmp = {};
              tmp[keyHolderArr[0][2]] = holderArr[i+2];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[1].push(tmp);

              tmp = {};
              tmp[keyHolderArr[0][3]] = holderArr[i+3];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[2].push(tmp);

             tmp = {};
             tmp[keyHolderArr[0][4]] = holderArr[i+4];
             tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[3].push(tmp);
             tmp = {};
             tmp[keyHolderArr[0][5]] = holderArr[i+5];
             tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[4].push(tmp);

              tmp = {};
             tmp[keyHolderArr[0][6]] = holderArr[i+6];
             tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[5].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][7]] = holderArr[i+7];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[6].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][8]] = holderArr[i+8];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[7].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][9]] = holderArr[i+9];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[8].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][10]] = holderArr[i+10];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[9].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][11]] = holderArr[i+11];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[10].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][12]] = holderArr[i+12];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[11].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][13]] = holderArr[i+13];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[12].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][14]] = holderArr[i+14];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[13].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][15]] = holderArr[i+15];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[14].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][16]] = holderArr[i+16];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[15].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][17]] = holderArr[i+17];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[16].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][18]] = holderArr[i+18];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[17].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][19]] = holderArr[i+19];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[18].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][20]] = holderArr[i+20];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[19].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][21]] = holderArr[i+21];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[20].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][22]] = holderArr[i+22];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[21].push(tmp);

               tmp = {};
              tmp[keyHolderArr[0][23]] = holderArr[i+23];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[22].push(tmp);

                tmp = {};
               tmp[keyHolderArr[0][24]] = holderArr[i+24];
               tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[23].push(tmp);
               tmp = {};
              tmp[keyHolderArr[0][25]] = holderArr[i+25];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[24].push(tmp);
               tmp = {};
              tmp[keyHolderArr[0][26]] = holderArr[i+26];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[25].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][25]] = holderArr[i+25];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[26].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][27]] = holderArr[i+27];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[26].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][28]] = holderArr[i+28];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[27].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][29]] = holderArr[i+29];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[28].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][30]] = holderArr[i+30];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[29].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][31]] = holderArr[i+31];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[30].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][32]] = holderArr[i+32];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[31].push(tmp);

          }

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
                "#283593",
                "#FF5722",
                "#607D8B",
                "#673AB7",
                "#D32F2F",
                "#880E4F",
                "#283593"
            ]

            // If Container, remove it so we can build a new one.

            var sideList = document.getElementById('sideList');
                // Loop to make the divs + charts
              for (i = 0; i < keyHolderArr[0].length-1; i++) {

                // If not amChartContainer, make one to insert graphs into
                if(!($('#amchartContainer').length)) {
                  var amChartContainer = document.createElement('div');
                  amChartContainer.id = 'amchartContainer';
                  document.getElementsByTagName('body')[0].appendChild(amChartContainer);
                }

                header = document.createElement('h2');
                header.id = keyHolderArr[0][i+1];
                amChartContainer =  document.getElementById('amchartContainer');

                header.innerHTML = keyHolderArr[0][i+1];
                temp = document.createElement('div');
                temp.id = 'chartdiv'+[i];
                temp.style.height = "450px";
                temp.style.backgroundColor = "#fff";
                temp.style.borderRadius = "5px";
                temp.style.margin ="10px 50px 50px"
                temp.style.border = "1px solid #eee";
                temp.style.borderBottom = "2px solid #eee";
                temp.style.padding = "15px 5px";
                temp.style.boxShadow = "0px 2px 2px rgba(0,0,0,0,0.26)";

                // Aside navigation builder
                var amChartList = document.createElement("li");
                var amChartAnchor = document.createElement('a');

                amChartAnchor.href = '#' + keyHolderArr[0][i+1];
                amChartAnchor.innerHTML = keyHolderArr[0][i+1];
                amChartList.appendChild(amChartAnchor);

                amChartList.innerHTML = "<a href='#"+keyHolderArr[0][i+1]+"'>" + keyHolderArr[0][i+1] + " </a>";

                amChartContainer.appendChild(header);
                amChartContainer.appendChild(temp);
                sideList.appendChild(amChartList);

                var divID = temp.id.toString();

                    var chart = AmCharts.makeChart(divID, {
                      "type": "serial",
                      "theme": "dark",
                      "dataDateFormat": "HH:NN:SS",
                      "marginRight": 50,
                      "autoMarginOffset": 50,
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
                        "bulletSize": 8,
                        "connect": false,
                        "gapPeriod": 200,
                        "lineColor": prettyColors[i],
                        "lineThickness": 2,
                        "negativeLineColor": "#487dac",
                        "valueField": keyHolderArr[0][i+1].toString()
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
