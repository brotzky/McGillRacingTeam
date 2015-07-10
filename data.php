<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>McGill FSAE Racing</title>
        <link rel="stylesheet" href="/mrt/styles/style.css" type="text/css">
        <style type="text/css">
        html, body {
            background-color: #f1f1f1;
        }
        </style>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
    <body class="inApp">
        <header>
          <nav>
            <div class="nav-logo"><img src="/mrt/img/mcgill-fsae-logo-car-only.png"></div>
            <ul>
              <li><button class="logoutButton">Log Out</button></li>
              <li class="toggleComments">
                    <svg class="notebook-icon" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 405.72 477.27" enable-background="new 0 0 405.72 477.267" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M61.24 28.77c0 5.23 0 9.5 0 14.48 -7.91 0-15.52 0.12-23.13-0.02 -15.67-0.31-23.9 2.16-23.82 23.55 0.48 125.48 0.25 250.96 0.25 376.44 0 12.23 7.15 19.48 19.64 19.49 85.32 0.05 170.64 0.03 255.96 0.04 3.83 0 7.67 0.08 11.5 0 7.95-0.17 13.14-4.44 14.7-12.26 0.49-2.43 0.66-4.96 0.66-7.44 0.04-30.66-0.06-61.32 0.15-91.98 0.03-3.83 1.05-7.88 2.56-11.42 3.24-7.6 7.1-14.93 11.85-22.27 0 1.87 0 3.73 0 5.6 0 40.16 0.08 80.32-0.1 120.48 -0.02 4.91-0.69 10.05-2.28 14.66 -4.24 12.26-14.02 19.07-26.95 19.11 -35.66 0.11-71.32 0.06-106.98 0.06 -51.82 0.01-103.64 0.03-155.46-0.03 -5.14-0.01-10.45 0.2-15.4-0.94 -14.59-3.36-24.3-16.37-24.33-31.94C-0.01 401.36 0 358.37 0 315.38c0-84.82 0.03-169.64 0.03-254.46C0.03 41.23 11.78 29.13 31.49 28.8 41.27 28.64 51.06 28.77 61.24 28.77zM238.78 336.84c6.79-14.18 13.3-27.82 19.85-41.44 3.82-7.94 7.74-15.83 11.5-23.8 1.21-2.56 2.51-4.06 5.77-4.48 7.94-1.03 12.82-6.23 16.19-13.3 15.4-32.26 30.94-64.46 46.43-96.68 0.85-1.77 1.74-3.53 2.88-5.83 10.17 4.86 20.06 9.48 29.85 14.3 3.96 1.95 9.67 3.53 10.95 6.73 1.11 2.77-2.8 7.65-4.66 11.52 -27.88 58-55.79 115.99-83.71 173.97 -0.64 1.32-1.37 2.6-2.31 4.37C273.98 353.77 256.67 345.44 238.78 336.84zM390.21 159.32c-8.83-4.22-16.75-8-24.66-11.8 -7.49-3.6-14.96-7.26-22.47-10.83 -6.19-2.94-8.36-2.19-11.37 4.01 -8.26 17.06-16.46 34.15-24.69 51.23 -8.66 17.98-17.32 35.95-25.98 53.93 -0.43 0.9-0.83 1.82-1.3 2.7 -1.72 3.27-3.78 6.22-8.12 4.53 -3.35-1.3-4.04-5.01-1.88-9.5 9.22-19.18 18.5-38.34 27.74-57.51 9.67-20.08 19.31-40.17 28.99-60.24 3.43-7.1 4.92-7.75 11.89-4.65 2.54 1.13 3.92 0.76 5.06-1.76 2.33-5.15 4.71-10.29 7.28-15.33 3.4-6.68 9.52-9.01 16.35-5.89 10.74 4.91 21.36 10.07 31.94 15.3 4.9 2.42 8.05 7.75 6.21 12.33C400.69 137.01 395.4 147.86 390.21 159.32zM266.53 158.95c-67.37 0-134.04 0-201.47 0 0-3.98-0.03-7.74 0.01-11.5 0.04-3.53 2.8-2.68 4.74-2.69 13.65-0.07 27.31-0.04 40.96-0.04 49.45 0.01 98.9 0.01 148.35 0.05 8.02 0.01 7.44-1.11 7.41 7.53C266.53 154.29 266.53 156.27 266.53 158.95zM266.26 195.12c0 4.68 0 8.95 0 13.7 -66.9 0-133.7 0-200.86 0 0-4.52 0-8.91 0-13.69C132.27 195.12 198.95 195.12 266.26 195.12zM65.61 258.85c-2.24-14.13-2.24-14.1 11.11-14.1 56.46 0.01 112.93 0 169.39 0 1.95 0 3.9 0 5.53 0 1.08 5.02 2.02 9.37 3.04 14.1C191.83 258.85 128.86 258.85 65.61 258.85zM286.6 374.58c-8.6 7.86-16.29 14.94-24.03 21.97 -8.5 7.73-16.96 15.52-25.61 23.08 -1.6 1.4-4.03 1.84-6.07 2.72 -0.78-2.2-2.35-4.44-2.23-6.6 1.17-21.42 2.61-42.82 4-64.22 0.04-0.6 0.38-1.19 0.81-2.49C251.03 357.48 268.31 365.78 286.6 374.58zM331.41 102.69c-5.14 2.29-9.48 4.22-14.39 6.41 0-4.41 0-8.67 0-12.93 0-12.17 0.05-24.33-0.03-36.5 -0.08-12.16-4.43-16.36-16.75-16.42 -8.83-0.04-17.66-0.09-26.49-0.15 -0.3 0-0.6-0.22-1.3-0.49 0-4.24 0-8.63 0-13.28 0.8-0.18 1.57-0.51 2.35-0.52 10.16-0.02 20.34-0.29 30.49 0.07 14.64 0.52 25.59 11.13 26.02 25.77C331.78 70.78 331.41 86.93 331.41 102.69zM256.53 31.27c0 6.83-0.15 13.66 0.1 20.47 0.06 1.73 1.01 3.81 2.24 5.05 6.17 6.24 6.64 15.34 0.83 21.47 -5.7 6.02-14.97 6.15-21.04 0.3 -5.88-5.66-6.08-14.94 0.08-20.98 2.55-2.5 3.35-4.96 3.31-8.3 -0.14-11.32-0.07-22.64-0.07-33.96 0-1.66-0.06-3.34 0.07-4.99 0.35-4.63 2.9-7.11 7.26-7.19 4.34-0.08 7.03 2.4 7.15 7.15 0.17 6.99 0.04 13.98 0.04 20.98C256.51 31.27 256.52 31.27 256.53 31.27zM91.56 31.53c0 4.66 0.02 9.32 0 13.99 -0.03 5.07-0.34 9.62 4.32 13.89 5.27 4.82 3.54 14.75-2.05 19.75 -5.55 4.96-14 4.92-19.62-0.09 -5.78-5.15-7.26-14.15-1.71-19.63 4.66-4.6 4.56-9.46 4.55-14.89 -0.03-10.99-0.05-21.98 0.02-32.97 0.04-5.71 2.64-8.52 7.5-8.44 4.63 0.08 6.87 2.71 6.94 8.41 0.08 6.66 0.02 13.32 0.02 19.98C91.53 31.53 91.54 31.53 91.56 31.53zM173.53 31.58c0 4.66 0.04 9.32-0.01 13.99 -0.05 5.09-0.21 9.61 4.36 13.88 5.27 4.93 3.54 14.71-2.1 19.73 -5.68 5.06-14.38 4.86-19.99-0.47 -5.55-5.28-6.6-14.27-1.06-19.75 4.01-3.98 4.35-8.09 4.31-12.96 -0.11-11.65-0.13-23.31 0.02-34.97 0.08-6.15 5.48-10 10.34-7.11 1.99 1.18 3.74 4.32 3.92 6.7 0.52 6.96 0.18 13.97 0.18 20.97C173.52 31.58 173.52 31.58 173.53 31.58zM226.24 29.14c0 4.58 0 8.84 0 13.73 -1.56 0.12-3.13 0.35-4.71 0.35 -9.46 0.04-18.92-0.04-28.38 0.09 -2.87 0.04-4.34-0.72-4.15-3.89 0.2-3.27 0.04-6.57 0.04-10.28C201.55 29.14 213.57 29.14 226.24 29.14zM107.08 28.81c11.79 0 22.87-0.05 33.96 0.1 0.83 0.01 2.3 1.45 2.36 2.3 0.26 3.76 0.11 7.54 0.11 11.98 -11.78 0-23 0.05-34.23-0.11 -0.75-0.01-2.04-1.63-2.1-2.56C106.93 36.9 107.08 33.26 107.08 28.81z"/></svg>
               </li>
              <!-- <li><a class="moreButton">More</a></li> -->
              <li class="border-left">
                <select name="select" class="selectInput ">
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
              <input type="text" class="toBeUploaded" readonly="readonly" />
            </ul>
          </nav>
        </header>
        <aside class="aside-default" data-scroll-scope>
            <ul id="sideList"></ul>
        </aside>

        <aside class="aside-comments">

          <form method="POST" class="postComments">
              <textarea name="addComment"  class="addComment"></textarea>
              <input type="submit" name="submit" class="submitComment" value="Add Notes">
          </form>

          <ul id="commentList">

            </ul>

        </aside>

        <div class='loader hideLoading'>
          <div class="loadingMessage">Fetching Data</div>
          <div class='circle one'></div>
          <div class='circle two'></div>
          <div class='circle three'></div>
        </div>

        <div class="uploadMessage"><p></p></div>

        <div class="moreInfo">
          <div class="moreInfo-container">
            <div><h2>Instructions</h2></div>
            <div><h2>About McGill Racing</h2></div>
            <div><h2>Credits</h2></div>
          </div>
        </div>

        <div id="amchartContainer"></div>


        <script src="/mrt/papaparse/papaparse.min.js"></script>
        <script src="/mrt/scrollscope/scroll-scope.min.js"></script>
        <script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="http://www.amcharts.com/lib/3/serial.js"></script>
        <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>

        <script type="text/javascript">


        // Initiazliaing scroll scope plugin for side bar
        $(document).scrollScope();

        AmCharts.ready(function(){

             var myDataRef = new Firebase('https://torrid-fire-7257.firebaseio.com');


            $('.uploadForm').submit(function( event ) {
                event.preventDefault();
                var url = "/mrt/csvUploader.php"; // the script where you handle the form input.
                var data = new FormData(this);
                var fileName = $("#fileToUpload").val().split('\\').pop().split('.').shift();

                    $.ajax({
                           type: "POST",
                           url: url,
                           data: data,
                           processData: false,
                           contentType: false,
                           success: function(data)
                           {

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
              tmp = {};
              tmp[keyHolderArr[0][33]] = holderArr[i+33];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[32].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][34]] = holderArr[i+34];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[33].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][35]] = holderArr[i+35];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[34].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][36]] = holderArr[i+36];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[35].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][37]] = holderArr[i+37];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[26].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][38]] = holderArr[i+38];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[37].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][39]] = holderArr[i+39];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[38].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][40]] = holderArr[i+40];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[39].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][41]] = holderArr[i+41];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[40].push(tmp);
              tmp = {};
              tmp[keyHolderArr[0][42]] = holderArr[i+42];
              tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();
              makers[41].push(tmp);

          }

            var prettyColors = [
                "#ed5153",
                "#323a45",
                "#3F51B5",
                "#009688",
                "#BF360C",
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

              var chartConfig = [];
              for(var i = 0; i<keyHolderArr[0].length-1; i++) {
                  chartConfig[i] = [];
              }

              charts = [];
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
                temp.style.borderRadius = "2px";
                temp.style.margin ="10px 50px 50px";
                temp.style.padding = "15px 5px";
                temp.style.boxShadow = "0 1px 2px rgba(0,0,0,.1)";

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

                  chartConfig[i] = {
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
                        "bulletSize": 6,
                        "connect": false,
                        "gapPeriod": 200,
                        "lineColor": prettyColors[i],
                        "lineThickness": 1,
                        "negativeLineColor": "#487dac",

                        "valueField": keyHolderArr[0][i+1].toString()
                      }],
                      "chartCursor": {
                        "categoryBalloonDateFormat":  "HH:NN:SS",
                        "cursorAlpha": 0.1,
                        "cursorColor": prettyColors[i],
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
                    };
                    // Adding all the made charts to an Array
                    // This is to sync al the zooming of the graphs.
                     charts.push(AmCharts.makeChart(divID, chartConfig[i]));
                }

                for (var x in charts) {
                    charts[x].addListener("zoomed", syncZoom);
                    charts[x].addListener("init", addCursorListeners);
                }

                function addCursorListeners(event) {
                    event.chart.chartCursor.addListener("changed", handleCursorChange);
                    event.chart.chartCursor.addListener("onHideCursor", handleHideCursor);
                }

                function syncZoom(event) {
                    for (x in charts) {
                        if (charts[x].ignoreZoom) {
                            charts[x].ignoreZoom = false;
                        }
                        if (event.chart != charts[x]) {
                            charts[x].ignoreZoom = true;
                            charts[x].zoomToDates(event.startDate, event.endDate);
                        }
                    }
                }
                function handleCursorChange(event) {
                    for (var x in charts) {
                        if (event.chart != charts[x]) {
                            if (event.position) {
                                charts[x].chartCursor.isZooming(event.target.zooming);
                                charts[x].chartCursor.selectionPosX = event.target.selectionPosX;
                                charts[x].chartCursor.forceShow = true;
                                charts[x].chartCursor.setPosition(event.position, false, event.target.index);
                            }
                        }
                    }
                }

                function handleHideCursor() {
                    for (var x in charts) {
                        if (charts[x].chartCursor.hideCursor) {
                            charts[x].chartCursor.forceShow = false;
                            charts[x].chartCursor.hideCursor(false);
                        }
                    }
                }
              }


          // Default view of Data selection
          var selectedValue = $('.selectInput > option:first-child').val();
          var last = selectedValue.substr(selectedValue.lastIndexOf('/') + 1);
          var splitValue = last.split('.');
          var popValue = splitValue.shift();


          $('.moreButton').click(function(){
            $('.moreInfo').toggleClass('showMoreInfo');
          });



          $(".hideLoading").show();
          $.getJSON( selectedValue, function( data ) {
               useData(data);
               $('.aside-default').addClass('aside-active');
               $(".hideLoading").fadeOut(333);
            });

          var buildComments = function(queryDate){
                var queryFireBase = new Firebase("https://torrid-fire-7257.firebaseio.com/" + queryDate);
                queryFireBase.on("value", function(snapshot) {
                snapshotObj = snapshot.val();

                var toBeFilled = [];
                for(prop in snapshotObj) {
                    for(secondProp in snapshotObj[prop]) {
                        toBeFilled.push(snapshotObj[prop][secondProp]);
                    }
                }
                var createListItems = [];
                for (var i = 0; i < toBeFilled.length; i++) {
                    createListItems[i] = document.createElement('li');
                }
                var items = document.getElementById("commentList");
                var unorderedList = $('#commentList');

                for (var i = 0; i < toBeFilled.length; i++ ) {
                    createListItems[i] = '<li>' + toBeFilled[i] + '</li>';
                    unorderedList.append(createListItems[i]);
                }

                }, function (errorObject) {
                        console.log("The read failed: " + errorObject.code);
                    });
            }
                buildComments(popValue);


          $('.postComments').submit(function(event) {
              event.preventDefault();

               var selectedValue = $(".selectInput").val();
               var noSlashSelectedValue = selectedValue.substr(selectedValue.lastIndexOf('/') + 1);
               var splitValue = noSlashSelectedValue.split('.');
               var theDate = splitValue.shift();
              var theComment = $('.addComment').val();


              $('.addComment').val('');


              console.log(theComment);
               var unorderedList = $('#commentList');
              if(unorderedList.children().length > 1) {
                    unorderedList.children().remove();
              }
              // Submitting POST to Firebase databse.
              var postsRef = myDataRef.child(theDate);
                postsRef.push({
                  comment: theComment,
                });

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

            var unorderedList = $('#commentList');

            if(unorderedList.children().length > 1) {
                $('#amchartContainer').fadeOut(300);
                  unorderedList.children().remove();
            }


            var last = selectedValue.substr(selectedValue.lastIndexOf('/') + 1);
            var splitValue = last.split('.');
            var popValue = splitValue.shift();


            // Added in setTimout to give aside time to transform: translateX(0%)
            setTimeout(function(){
                buildComments(popValue);
              $.getJSON( selectedValue, function( data ) {
                 useData(data);
                 $('.aside-default').addClass('aside-active');
                 $(".hideLoading").fadeOut(333);

              });
             }, 505);

          });

            var asideComments = $(".aside-comments");

            $('.toggleComments').click(function(){
              asideComments.toggleClass('aside-active');
            });
            $(document).keyup(function(e) {
                 if (e.keyCode == 27) {
                    asideComments.removeClass('aside-active');
                }
            });




        });
      </script>
    </body>
</html>
