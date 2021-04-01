<?php 
require_once('./config/dbconfig.php');
$db = new dbconfig();
?>
<!doctype html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>ActiveBas Evalutaion Task</title>
    <link rel="stylesheet" href="styles/style.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        
    <link rel="stylesheet" type="text/css" media="screen" href="styles/datetime-picker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="#" target="_blank"><img src="logo.png" width="80px" />Upload JSON File</a></h1>
                <hr>
                <form id="form" action="upload.php" method="post" enctype="multipart/form-data">

                    <input type="file" name="fileToUpload" id="fileToUpload" />
                    <input class="btn btn-success mt-2" type="submit" value="Upload JSON File" style="margin-top:10px;">
                </form>
                <div id="success" class="alert alert-success" style="display:none;"></div>
                <div id="err"></div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div id="text_filter">

                    <input type="text" id="searched_text" class="form-control" />
                </div>
                <div id="date_filter" style="display:none;">

                    <div class="col-md-5" style="float:left;">
                        <fieldset class="form-group m-0 position-relative has-icon-right input-append date"
                            id="from_short_date">
                            <input type="text" class="form-control input-control dateInput1" placeholder="From">
                            <div class="form-control-position add-on calender-icon">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar" style="display: inline;"
                                    class="fa fa-calendar"></i>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-5" style="float:left;margin-left:10px;margin-right:10px;">
                        <fieldset class="form-group m-0 position-relative has-icon-right input-append date"
                            id="to_short_date">
                            <input type="text" class="form-control input-control dateInput2" placeholder="To">
                            <div class="form-control-position add-on calender-icon">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar" style="display: inline;"
                                    class="fa fa-calendar"></i>
                            </div>
                        </fieldset>
                    </div>
                </div>

            </div>
            <div class="col-md-2">

                <select id="filter_option" class="form-select" aria-label="Default select example">
                    <option selected value="employee_name">employee name</option>
                    <option value="event_name"> event name</option>
                    <option value="date">Date</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" id="filterbtn" class="btn btn-primary" onclick="filterDate()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-filter" viewBox="0 0 16 16">
                        <path
                            d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                        </path>
                    </svg>
                    Filter
                </button>
                
                <button type="button" id="clearfilterbtn" class="btn btn-primary" onclick="clearfilterDate()" style="display:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-filter" viewBox="0 0 16 16">
                        <path
                            d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                        </path>
                    </svg>
                    Clearfilter
                </button>

            </div>
        </div>
        <div class="row">
            <table class="table table-light table-borderless mt-3">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Employee Name</th>
                      <th scope="col">Employee Email</th>
                      <th scope="col">Participation Fee</th>
                      <th scope="col">Event Id</th>
                      <th scope="col">Event Name</th>
                      <th scope="col">Event Date</th>
                      <th scope="col">version</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- ko foreach:get_all_record() -->
                    <tr>
                      <th scope="row" data-bind="text:participation_id"></th>
                      <td data-bind="text:employee_name"></td>
                      <td data-bind="text:employee_mail"></td>
                      <td data-bind="text:participation_fee"></td>
                      <td data-bind="text:event_id"></td>
                      <td data-bind="text:event_name"></td>
                      <td data-bind="text:event_date"></td>
                      <td data-bind="text:version"></td>
                    </tr>
                    <!--/ko-->
                  </tbody>
              </table>
              <div class="col-md-12">
                  <div class="col-md-8 text-center" style="float:left;">
                      <H5>Total Participation Fee</H5>
                  </div>
                  <div class="col-md-4 text-right" style="float:left;">
                      <h5 data-bind="text:Total_fee"></h5>
                  </div>
              </div>
        </div>
    </div>
</body>
<script type="text/javascript"
    src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript"
    src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js" integrity="sha512-2AL/VEauKkZqQU9BHgnv48OhXcJPx9vdzxN1JrKDVc4FPU/MEE/BZ6d9l0mP7VmvLsjtYwqiYQpDskK9dG8KBA==" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/home_ko.js"></script>
    
</html>