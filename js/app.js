$(document).ready(function(){
    // storing init of firebase in myDataRef variable
    var myDataRef = new Firebase('//torrid-fire-7257.firebaseio.com');

     var uploadMessage = $('.uploadMessage');
     var toBeUploaded = $('.toBeUploaded');
     var asideComments = $(".aside-comments");

     (function initPage() {
         var selectedValue = document.querySelector('.selectInput > option:first-child').value;
         document.getElementById('topNav').className += 'onload-reveal';
         document.querySelector(".hideLoading").style.display = 'block';

          if(selectedValue.indexOf('csv') === -1) {
             $.getJSON( selectedValue, function( data ) {
                 useData(data);
                 buildComments();
                 showAndHide();
             });
         } else {
            Papa.parse(selectedValue, {
               download: true,
                header: true,
                skipEmptyLines: true,
                complete: function(results) {
                    console.log(results.data);
                    useData(results.data);
                     buildComments();
                     showAndHide();
                }
            });
        }
     })();

     // Change Data file on user selection
     $(".selectInput").change(function (){
           var acContainer = $('#amchartContainer');
           document.querySelector(".hideLoading").style.display = 'block';
           $('aside').removeClass('aside-active');

           if(acContainer.children().length > 1) {
               acContainer.fadeOut(300);

               setTimeout(function(){
                   acContainer.remove();
                   $('#sideList').children().remove();
               },300);
           }

           removeAmchartLists();
           var pickedValue = getSelectedValue();
           // Added in setTimout to give aside time to transform: translateX(0%)
           setTimeout(function(){
                if(pickedValue.indexOf('csv') === -1) {
                     $.getJSON( pickedValue, function( data ) {
                         useData(data);
                         buildComments();
                         showAndHide();
                     });
                 } else {
                    Papa.parse(pickedValue, {
                       download: true,
                        header: true,
                        skipEmptyLines: true,
                        complete: function(results) {
                            console.log(results.data);
                            useData(results.data);
                             buildComments();
                             showAndHide();
                        }
                    });
                }
           }, 525);
       });

     function showAndHide() {
        var asideDefault = document.querySelector('.aside-default');
        // Add class
        if (asideDefault.classList) {
            asideDefault.classList.add("aside-active");
        } else {
            asideDefault.className += ' ' + "aside-active";
        }

        $(".hideLoading").fadeOut(333);
     }

  // Seconds to HH:MM:SS
  // Attaching to prototype --> important note
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
    function countProp(obj) {
        var count=0;
        for(var prop in obj) {
            for( var secondProp in obj[prop]) {
                ++count;
            }
        }
        return count/obj.length;
    }

    function buildVariables(varName) {
        var emptyArr = [];
        for(prop in varName) {
            for(secondProp in varName[prop]) {
                emptyArr.push(varName[prop][secondProp]);
            }
        }
        return emptyArr;
    }
    function useData(originalJSON) {

        var numProperties = countProp(originalJSON);
        var holderArr = buildVariables(originalJSON);

        var keyHolderArr = [];

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


        for(var j = 1; j < keyHolderArr.length*2 - 1; j++ ) {

          var tmp = {};
          var timeOfDay = holderArr[i].toHHMMSS();
          var keyHolderArrInner = keyHolderArr[0][j];

          tmp[keyHolderArrInner] = holderArr[i+j];
          tmp[keyHolderArr[0][0]] = holderArr[i].toHHMMSS();

          // if makers is definted, push into it
          if(makers[j-1]) {
            makers[j-1].push(tmp);
          } else {
            break
          };
      }
    }

    // Coloring the arrays with custom colors
    // Formatted for easy editing. Leave stacked vertically.
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
      "#283593",
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
      "#3F51B5"
    ];

    var sideList = document.getElementById('sideList');
    var chartConfig = [];

    for(var i = 0; i<keyHolderArr[0].length-1; i++) {
        chartConfig[i] = [];
    }

    var charts = [];
    for (i = 0; i < keyHolderArr[0].length-1; i++) {

      var amChartContainer = document.createElement('div');
      var amChartList = document.createElement("li");
      var amChartAnchor = document.createElement('a');
      var header = document.createElement('h2');
      var spanOff = document.createElement('span');

      // If not amChartContainer, make one to insert graphs into
      if(!($('#amchartContainer').length)) {
          amChartContainer.id = 'amchartContainer';
          document.getElementsByTagName('body')[0].appendChild(amChartContainer);
      }

      spanOff.id = keyHolderArr[0][i+1];
      amChartContainer =  document.getElementById('amchartContainer');

      header.innerHTML = keyHolderArr[0][i+1];
      temp = document.createElement('div');
      temp.id = 'chartdiv'+[i];

      amChartAnchor.href = '#' + keyHolderArr[0][i+1];
      amChartAnchor.innerHTML = keyHolderArr[0][i+1];
      amChartList.appendChild(amChartAnchor);
      amChartList.innerHTML = "<a href='#"+keyHolderArr[0][i+1]+"'>" + keyHolderArr[0][i+1] + " </a>";
      amChartContainer.appendChild(header);
      amChartContainer.appendChild(temp);
      sideList.appendChild(amChartList);
      header.appendChild(spanOff);
      //loadingMessage

      var divID = temp.id.toString();

      chartConfig[i] = {
          "type": "serial",
          "theme": "dark",
          "dataDateFormat": "HH:NN:SS",
          "marginRight": 50,
          "autoMarginOffset": 50,
          "dataProvider": makers[i],
          "responsive": {
              "enabled": true
            },
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

      // Adding Zoom All functionality to charts
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
    // End Add zoom functionality to charts

     // Default view of Data selection
    var moreButton = document.querySelector('.moreButton');
    moreButton.addEventListener( 'click', moreInfoToggler, false );

    function moreInfoToggler() {
        $('.moreInfo').toggleClass('showMoreInfo');
        if($(this).text() === "More") {
            moreButton.innerHTML = "Less";
            moreButton.style.paddingLeft = "19px";
        } else {
            moreButton.innerHTML = "More";
            moreButton.style.paddingLeft = "16px";
       }
    }

    function buildComments() {
        var queryFireBase = new Firebase("//torrid-fire-7257.firebaseio.com/" + getTheSelectedDate());

        queryFireBase.on("value", function(snapshot) {
            snapshotObj = snapshot.val();
            var toBeFilled = buildVariables(snapshotObj);
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

    function removeAmchartLists() {
        var unorderedList = $('#commentList');
        if(unorderedList.children().length > 1) {
            $('#amchartContainer').fadeOut(300);
            unorderedList.children().remove();
        }
    }

    function getSelectedValue() {
        return  document.querySelector(".selectInput").value;
    }

    function getTheSelectedDate() {
        return getSelectedValue().substr(getSelectedValue().lastIndexOf('/') + 1).split('.').shift();
    }

  $('.postComments').submit(function(event) {
      event.preventDefault();

      var theComment =  document.querySelector('.addComment').value;
       var unorderedList = document.getElementById('commentList');

      if(unorderedList.children.length > 1) {
            unorderedList.children.remove();
      }
      // Submitting POST to Firebase databse.
      var postsRef = myDataRef.child(getTheSelectedDate());
        postsRef.push({
          comment: theComment,
        });
    });

    $('.toggleComments').click(function(){
      asideComments.toggleClass('aside-active');
    });

    $(document).keyup(function(e) {

        if (e.keyCode === 27) {

          var moreInfo = $('.moreInfo');
          var moreButton = document.querySelector('.moreButton');

          if($('.moreButton').text() === "More" && moreInfo.hasClass('showMoreInfo')) {
            moreButton.innerHTML = "Less";
            moreButton.style.paddingLeft = "19px";
          } else {
            moreButton.innerHTML = "More";
            moreButton.style.paddingLeft = "16px";
          }
          asideComments.removeClass('aside-active');
          moreInfo.removeClass('showMoreInfo');
        }

    });

    // Initiazliaing scroll scope plugin for side bar
    $(document).scrollScope();

    // Logout button
    var logoutButton = document.querySelector('.logoutButton');
    logoutButton.addEventListener( 'click', doLogOut, false );

    function doLogOut() {
         myDataRef.unauth();
         var authData = myDataRef.getAuth();
         if (!authData) {
            window.location = "/mrt/";
         }
    }

    $('#fileToUpload').change(function(){
     if(toBeUploaded.val().length > 30) {
      $('.uploadMessage > p').text('Sorry, file name must be less than 30 characeters');
      uploadMessage.addClass('uploadMessage-active').delay(5000).queue(function(next){
          $(this).removeClass("uploadMessage-active");
          next();
        });
      } else {
        toBeUploaded.val($(this).val().split('\\').pop());
        $('.confirmUpload').addClass('confirmUpload-active');
      }
    });

    // Submittion of upload data
    $('.uploadForm').submit(function(event) {
        event.preventDefault();

        var url = "/mrt/csvUploader.php"; // the script where we handle the form input.
        var data = new FormData(this);
         var originalFile = $("#fileToUpload").val();
         (originalFile.indexOf('json') === -1) ? fileExt = ".csv" : fileExt = ".json";
        var fileName = originalFile.split('\\').pop().split('.').shift();

        $('.confirmUpload').removeClass('confirmUpload-active');
        uploadMessage.css("background-color","#D32F2F");

        $.ajax({
         type: "POST",
         url: url,
         data: data,
         processData: false,
         contentType: false,
         success: function(data)
         {
          $('.uploadMessage > p').text(data);
          uploadMessage.addClass('uploadMessage-active').delay(4800).queue(function(next){
            $(this).removeClass("uploadMessage-active");
            next();
          });

          if (data.indexOf("succesfully") > -1) {
            $('.uploadMessage').css("background-color","#388E3C");
            var optionElement = document.createElement('option');
            fileNameReplaced = fileName.replace(/_/g, " ");
            optionElement.innerHTML = fileNameReplaced;
            optionElement.value = '/mrt/inputdata/' + fileName + fileExt;
            $('.selectInput').prepend(optionElement);
          }
         }
       });
      return false; // avoid to execute the actual submit of the form.
    });
});