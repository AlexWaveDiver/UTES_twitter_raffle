<?php
require_once('../lib/TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "XXX",
    'oauth_access_token_secret' => "XXX",
    'consumer_key' => "XXX",
    'consumer_secret' => "XXX"
);

$url = 'https://api.twitter.com/1.1/followers/ids.json';
$getfield = '?username=undertaleES';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$result = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();    


$info = json_decode($result);
$total = count($info->ids);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Undertale-Spanish - Sorteo</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><img src="../logo.jpg" style="margin-top: -5px" /></a>
            </div>
            <!-- /.navbar-header -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x" id="img-icon"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$total;?></div>
                                    <div>Followers</div>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:;" onClick="getWinner()">
                            <div class="panel-footer">
                                <span class="pull-left">Realizar sorteo</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-star-o fa-fw"></i> Ganador
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" id="winner">
                        <!-- WINNER -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script>
    function getWinner(){
        $("#img-icon").removeClass("fa-user");
        $("#img-icon").addClass("fa-refresh");
        $.get( "ajax_get.php", function( data ) {
        $("#img-icon").removeClass("fa-refresh");
        $("#img-icon").addClass("fa-user");
            var winnerData = JSON.parse(data);
            $("#winner").html("<div class='row'><div class='col-sm-4'><img src='"+winnerData.image+"' style='width:256px; height:256px; border-radius:50%' /></div><div class='col-sm-8'><h1>"+winnerData.user+"</h1><br><h2>"+winnerData.account+"</h2></div></div>");
        });
    }
    </script>
</body>

</html>
