<?php 
	session_start(); 
	$route = include('./../Configuration/config.php');
    function returnQuery($col, $table){
        if($col == "date"){
            $query = "SELECT `date`, count(`date`) as count from $table GROUP BY `date` ORDER BY `date`";
        }elseif($col == "hours"){
            $query = "SELECT `date`, $col, count(`date`) as count from $table GROUP BY `date`,$col ORDER BY `date`";
        }elseif($col == "minutes"){
            $query = "SELECT `date`, `hours`, $col, count(`date`) as count from $table GROUP BY `date`,`hours`, $col ORDER BY `date`";
        }else{
            $query = "SELECT `date`, `hours`, `minutes`, $col, count(`date`) as count from $table GROUP BY `date`,`hours`,`minutes`,$col ORDER BY `date`";
        }
        return $query;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="<?php echo $route?>Graphs/Lib/Chart.min.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script> -->
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <title>My Chart.js Chart</title>
</head>
<body>
    <?php
        if($_SESSION["loggedin"]){
            #Connessione al Database.
            $mysqli = new mysqli("".$_SESSION['host'], "".$_SESSION['username'], "".$_SESSION['password'], "".$_SESSION['database']);
            #Query effettuata al Database.
            $table = $_SESSION['table'];
            $col = "date";
            $query = returnQuery("$col", "".$_SESSION['table']);
            $date = array();
            $count = array();
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $dateRow = $row["date"];
                    $countRow = $row["count"];
                    $date[sizeof($date)] = $dateRow;
                    $count[sizeof($count)] = $countRow;
                    if($col == "hours"){
                        $hoursRow = $row["hours"];
                        $hours[sizeof($hours)] = $hoursRow;
                    }elseif($col == "minutes"){
                        $hoursRow = $row["hours"];
                        $hours[sizeof($hours)] = $hoursRow;
                        $minutesRow = $row["minutes"];
                        $minutes[sizeof($minutes)] = $minutesRow;
                    }elseif($col == "seconds"){
                        $hoursRow = $row["hours"];
                        $hours[sizeof($hours)] = $hoursRow;
                        $minutesRow = $row["minutes"];
                        $minutes[sizeof($minutes)] = $minutesRow;
                        $secondsRow = $row["seconds"];
                        $seconds[sizeof($seconds)] = $secondsRow;
                    }
                }
            
    ?>
    <label for="typeGraph">Select type of the graph:</label>
	<select id="typeGraph" onChange="createGraph(value)">
		<option value="bar">Bar</option>
		<option value="horizontalBar">Horizontal Bar</option>
		<option value="pie">Pie</option>
		<option value="line">Line</option>
		<option value="doughnut">Doughnut</option>
        <option value="radar">Radar</option>
        <option value="polarArea">Polar Area</option>
    </select>
    <label for="rangeGraph">Select the range of the graph:</label>
    <select id="rangeGraph" name="changeRange">
        <option value="date">Days</option>
        <option value="hours">Hours</option>
        <option value="minutes">Minutes</option>
        <option value="seconds">Seconds</option>
    </select>
    <div class="container">
        <canvas id="myChart"></canvas>
    </div>
    <script>
    window.onload = function () {
        createGraph('bar');
    }

    function createGraph(type) {
        var myChart = document.getElementById("myChart").getContext("2d");
        if(window.bar != undefined) 
            window.bar.destroy(); 
        
        // Global Options
        Chart.defaults.global.defaultFontFamily = 'Lato';
        Chart.defaults.global.defaultFontSize = 18;
        Chart.defaults.global.defaultFontColor = '#777';
        window.bar = new Chart(myChart, {
        type: type, // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels:[<?php
                        for($i = 0 ; $i < sizeof($date) ; $i++){
                            $text = "";
                            if($i != sizeof($date)-1){
                                $text.= "'".$date[$i];
                                if($hours){
                                    $text.= " ".$hours[$i];
                                    if($minutes){
                                        $text.= ":".$minutes[$i];
                                        if($seconds){
                                            $text.= ":".$seconds[$i];
                                        }
                                    }else{
                                        $text .= ":00";
                                    }
                                }
                                $text.= "',";
                            }else{
                                $text.= "'".$date[$i];
                                if($hours){
                                    $text.= " ".$hours[$i];
                                    if($minutes){
                                        $text.= ":".$minutes[$i];
                                        if($seconds){
                                            $text.= ":".$seconds[$i];
                                        }
                                    }else{
                                        $text .= ":00";
                                    }
                                }
                                $text.= "'";
                            }
                            echo $text;
                        }
                    ?>],
            datasets:[{
            label:'Persone',
            data:[<?php
                    for($i = 0 ; $i < sizeof($count) ; $i++){
                        if($i != sizeof($count)-1){
                            echo $count[$i].",";
                        }else{
                            echo $count[$i];
                    
                        }
                    }
                ?>],
            backgroundColor :[
                <?php
                    for($i = 0 ; $i < sizeof($date) ; $i++){
                        if($i != sizeof($date)-1){
                            echo "'rgba(".random_int(0,255).", ".random_int(0,255).", ".random_int(0,255).", ".(rand(0, 10) / 10)."',";
                        }else{
                            echo "'rgba(".random_int(0,255).", ".random_int(0,255).", ".random_int(0,255).", ".(rand(0, 10) / 10)."'";
                        }
                    }
                ?>
            ],
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:3,
            hoverBorderColor:'#000'
            }]
        },
        options:{
            title:{
            display:true,
            text:'Persone presenti alla tua postazione',
            fontSize:25
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend:{
            display:true,
            position:'right',
            labels:{
                fontColor:'#000',
            }
            },
            layout:{
            padding:{
                left:50,
                right:0,
                bottom:0,
                top:0
            }
            },
            tooltips:{
            enabled:true
            }
        }
        });
    }
        
    </script>
    <?php
            }else{
                echo "Unable to do the query";
            }
        }else{
            echo "non sei loggato";
        }    
    ?>
</body>
</html>
