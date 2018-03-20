<?php
include 'services/connectDB.php';


 if (isset($_GET["filter"])){
      $filter = $_GET["filter"];

      if (isset($conn) && $filter=="name") {
        $search = $_GET["search"];
        $sql = "SELECT * FROM event_image INNER JOIN event ON event_image.eventID = event.eventID WHERE eventName LIKE '%$search%'";
        $stmt = $conn->prepare($sql);
        try {
          $stmt->execute();
        } catch(Exception $exc){
          echo $exc->getTraceAsString();
        }
        $showEvents = $stmt->fetchAll(PDO::FETCH_OBJ);
      }
      else if (isset($conn) && $filter=="location") {
        $search = $_GET["search"];
        $sql = "SELECT * FROM event_image INNER JOIN event ON event_image.eventID = event.eventID WHERE location LIKE '%$search%'";
        $stmt = $conn->prepare($sql);
        try {
          $stmt->execute();
        } catch(Exception $exc){
          echo $exc->getTraceAsString();
        }
        $showEvents = $stmt->fetchAll(PDO::FETCH_OBJ);
      }
      else if (isset($conn) && $filter=="organizer") {
        $search = $_GET["search"];
        $sql = "SELECT * FROM (event JOIN event_image USING (eventID)) INNER JOIN organizer_info ON organizer_info.userID = event.orgID  WHERE organizer_info.orgName LIKE '%$search%'";
        $stmt = $conn->prepare($sql);
        try {
          $stmt->execute();
        } catch(Exception $exc){
          echo $exc->getTraceAsString();
        }
        $showEvents = $stmt->fetchAll(PDO::FETCH_OBJ);
      }
      else if (isset($conn) && $filter=="date") {
        $from = '0000-00-00';
        if (array_key_exists('from', $_GET)) {
          $from = date('Y-m-d', strtotime($_GET['from']));
        }
        $to = '9999-12-31';
        if (array_key_exists('to', $_GET)) {
          $to = date('Y-m-d', strtotime($_GET['to']));
        }
        $sql = "SELECT * FROM event JOIN event_image USING (eventID) WHERE eventStart >= '$from' and eventStart <= '$to'";
        $stmt = $conn->prepare($sql);
        try {
          $stmt->execute();
        } catch(Exception $exc){
          echo $exc->getTraceAsString();
        }
        $showEvents = $stmt->fetchAll(PDO::FETCH_OBJ);
      }
  }

  else if(isset($_REQUEST['data'])){

      $category = $_REQUEST['data'];
        if ($category == "All" ||
            $category == "Science" ||
            $category == "Business" ||
            $category == "Education" ||
            $category == "Hobbies" ||
            $category == "Music" ||
            $category == "Health" ||
            $category == "Community" ||
            $category == "Sports"){
        }
        else {
          header('HTTP/1.0 404 Not Found');
          echo "<h1>Error 404 Not Found</h1>";
          echo "The page that you have requested could not be found.";
          exit();
        }
        if (isset($conn) && $category == "All") {
          $sql = "SELECT * FROM event_image INNER JOIN event ON event_image.eventID = event.eventID";
          $stmt = $conn->prepare($sql);
          try {
            $stmt->execute();
          } catch(Exception $exc){
            echo $exc->getTraceAsString();
          }
          $showEvents = $stmt->fetchAll(PDO::FETCH_OBJ);

        }
        else {
          $sql = "SELECT * FROM event_image INNER JOIN event ON event_image.eventID = event.eventID WHERE type='$category'";
          $stmt = $conn->prepare($sql);
          try {
            $stmt->execute();
          } catch(Exception $exc){
            echo $exc->getTraceAsString();
          }
          $showEvents = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Webwut Event</title>
</head>

<body>
  <?php include 'header.php';?>

<div class="container">
  <br><br>
  <!-- menu Button -->
  <div class="container-fluid">
     <div class="row" id="menuBar">
       <div class="col-sm-4 noPadding">
         <div class="btn-group">
           <button class="btn btn-default-dropdown btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <b><?php echo isset($_GET['data'])? ($_GET['data']=="Science" ? "Science & Technology" : $_GET['data']) :"Explore events" ?></b>
           </button>
           <div class="dropdown-menu">
               <a class="dropdown-item" href="events.php?data=All">All</a>
                 <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="events.php?data=Science">Science & Technology</a>
                <a class="dropdown-item" href="events.php?data=Business">Business</a>
                <a class="dropdown-item" href="events.php?data=Education">Education</a>
                <a class="dropdown-item" href="events.php?data=Hobbies">Hobbies</a>
                <a class="dropdown-item" href="events.php?data=Music">Music</a>
                <a class="dropdown-item" href="events.php?data=Health">Health</a>
                <a class="dropdown-item" href="events.php?data=Community">Community</a>
                <a class="dropdown-item" href="events.php?data=Sports">Sports</a>
              </div>
          </div>
        </div>
      <div class="col-sm-8 noPadding">
          order by :
          <div class="btn-group">
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">date</button>
            <form method="get" action="events.php">
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                  </div>
                  <div class="modal-body">

                    from <div class="container">
                        <div class="input-group date">
                          <input type="date" onclick="date()" class="form-control" name="from" id="datepicker1" placeholder="MM/DD/YYYY">
                        </div>
                    </div>
                    <br>to <div class="container">
                        <div class="input-group date">
                          <input type="date" onclick="date()" class="form-control" name="to" id="datepicker2" placeholder="MM/DD/YYYY">
                        </div>
                    </div>
                    <input hidden type="text" name="filter" id="filter" value="date">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit" value="submit">
                  </div>
                </div>
              </div>
            </div>
          </form>
            <button class="btn btn-filter-dropdown btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <b>event name</b>
            </button>
            <form class="form-inline" action="events.php" method="get">
            <input type="radio" name="filter" id="filter-organizer" value="organizer"  hidden>
            <input type="radio" name="filter" id="filter-location" value="location" hidden >
            <input type="radio" name="filter" id="filter-name" value="name" hidden checked>
            <ul class="dropdown-menu" id="filterSelected">
                  <label for="filter-name" onclick="changeSearchPlaceHolder('event name')"><li><p class="dropdown-item" id="name" href="#">event name</p></li></label>
                  <label for="filter-location" onclick="changeSearchPlaceHolder('location')"><li><p class="dropdown-item" id="location" href="#">location</p></li></label>
                  <label for="filter-organizer" onclick="changeSearchPlaceHolder('organizer')" ><li><p class="dropdown-item" id="organizer" href="#">organizer</p></li></label>
            </ul>
                  <input class="form-control mr-sm-2" type="search" placeholder="event name" aria-label="Search" name="search" id="search-input">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </div>
      </div>
  </div>

  <div class="container-fluid noPadding">
    <br><br>
    <div class="row">

      <div class="container-fluid">
        <div class="allEvents" id="allEvents"></div>
      </div>
    </div>
    <br>

</div>
</div>
<?php include 'footer.php';?>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <script type="text/javascript">
  function changeSearchPlaceHolder(str) {
    $("#search-input").attr("placeholder", str);
    $("#search-input").val('');
  }

  $("#filterSelected label").click(function(){
    var selText = $(this).text();
    $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+'<span class="caret"></span>');
  });
  $('#filterSelected a').click(function(e){
  e.preventDefault();
  console.log(e.target)
  });



      $("#filterSelected a").click(function(){
        var selText = $(this).text();
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+'<span class="caret"></span>');
      });
      $('#filterSelected a').click(function(e){
        e.preventDefault();
      });

    function formatDate(sqlDate) {
      sqlDate = sqlDate.split(" ");
      date = sqlDate[0];
      dateSplit = date.split("-");
      year = dateSplit[0];
      month = dateSplit[1];
      if (month == 01){month = "January";}
      else if (month == 02){month = "February";}
      else if (month == 03){month = "March";}
      else if (month == 04){month = "April";}
      else if (month == 05){month = "May";}
      else if (month == 06){month = "June";}
      else if (month == 07){month = "July";}
      else if (month == 08){month = "August";}
      else if (month == 09){month = "September";}
      else if (month == 10){month = "October";}
      else if (month == 11){month = "November";}
      else if (month == 12){month = "December";}
      day = dateSplit[2];

      time = sqlDate[1];
      timeSplit = time.split(":");
      hr = timeSplit[0];
      min = timeSplit[1];
      sec = timeSplit[2];

      return day + " " + month + " " + year + " | " + hr + ":" + min;
    }


      var count = 0;
      var allEvents = <?php echo json_encode($showEvents); ?>;
      var html = '';

      for (index in allEvents) {
      html += `<a href="event.php?id=`+allEvents[index].eventID+`">
        `+(index%3==0 ? '<div class="row">' : '')+`
        <div class="col-sm-4">
          <div class="row table-row">
            <div class="col-7">
              <img src="assets/events/`+allEvents[index].image+`" width="170" height="150" class="d-inline-block align-top" id="titleImage" alt="">
            </div>
            <div class="col-5 align-self-center">
              <a href="event.php?id=`+allEvents[index].eventID+`" class="btn btn-join" role="button">`+(allEvents[index].price == 0 ? 'Get ticket' : 'Buy ticket')+`</a>
            </div>
            <div class="col-12">
              <br>
              <p class="topic">`+allEvents[index].eventName+`</p>
              <div><i class="material-icons">access_time</i>&nbsp;`+formatDate(allEvents[index].eventStart)+`</div>
              <div><i class="material-icons">place</i>&nbsp;`+allEvents[index].location+`</div>
            </div>
          </div>
          </div>
          `+(index%3==2 || index+1==allEvents.length ? '</div>' : '')+`
      </a>`;
    }
    $(".allEvents").append(html);






  </script>

</body>
</html>
