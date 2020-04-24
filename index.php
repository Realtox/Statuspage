<?php
require_once("config/config.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//bootswatch.com/yeti/bootstrap.min.css" rel="stylesheet" type="text/css" />

<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Status Page</h1>
        </div>
      </div>
      <div class="row clearfix">
          <div class="col-md-12 column">
              <div class="panel panel-warning">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    <?php
                    $error = true;
                    if (@$fp = fsockopen("google.com", 80, $errno, $errstr, 1)) {
                      if (@$fp = fsockopen("youtube.com", 80, $errno, $errstr, 1)) {
                              $error = false;
                            }
                          }

                    if ($error) {
                      echo "Not all services are running ";
                    } else {
                      echo "All services are running";
                    }
                    ?>

                    <small class="pull-right">Loadet at <?php $datum = date("d.m.Y - H:i"); echo $datum; ?></small>
                  </h3>
                </div>
              </div>


              <div class="row clearfix">
                  <div class="col-md-12 column">
                      <div class="list-group">

                          <div class="list-group-item">
                              <h4 class="list-group-item-heading">
                                  Google.com
                                  <a data-toggle="tooltip" data-placement="bottom" title="Google.com">
                                    <i class="fa fa-question-circle"></i>
                                  </a>
                              </h4>
                              <?php
                              if (!@$fp = fsockopen("google.com", 80, $errno, $errstr, 1)){
                                echo "<span class='label label-danger'>Not Operational</span>";
                              } else {
                                echo "<span class='label label-success'>Operational</span>";
                              }
                              ?>
                          </div>

                          <div class="list-group-item">
                              <h4 class="list-group-item-heading">
                                  Youtube
                                  <a data-toggle="tooltip" data-placement="bottom" title="Youtube">
                                    <i class="fa fa-question-circle"></i>
                                  </a>
                              </h4>
                              <?php
                              if (!@$fp = fsockopen("youtube.com",80, $errno, $errstr, 1)){
                                echo "<span class='label label-danger'>Not Operational</span>";
                              } else {
                                echo "<span class='label label-success'>Operational</span>";
                              }
                              ?>
                          </div>

                      </div>
                  </div>
              </div>

              <br>
              <br>
              <br>

              <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <h1>Last Errors</h1>
                    </div>
                  </div>
                </div>

                <br>

              <div class="row clearfix">
                  <div class="col-md-12 column">
                      <div class="list-group">

                        <?php
                       $user_stantment = $pdo->prepare("SELECT * FROM status");
                       $user_stantment->execute();

                        $row2 = $user_stantment->fetchAll();
                        foreach ($row2 as $row) {

                          $time = htmlspecialchars($row["time"]);
                          $description = htmlspecialchars($row["description"]);
                          $title = htmlspecialchars($row['title']);
                          $id = htmlspecialchars($row['id']);

                          echo  '<div class=" '.'list-group-item'.' ">
                            <p>'. $time .'</p>
                              <h4 class=" '.'list-group-item-heading'.' ">Message #'. $id .': '. $title .'</h4>
                              <p>'. $description .'</p>
                          </div>';
                        }


                       ?>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>
<footer>
  <div class="footer-copyright text-center py-3">© 2020 Copyright
  <a href="https://realtox.de">Realtox</a>
  </div>
</footer>
</html>
