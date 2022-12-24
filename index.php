<?php

$pattern="/[0-9]{2}-[0-9]{4}/";

if(isset($_GET['month'])&&preg_match($pattern,$_GET['month']))
{
    $montharr=explode('-',$_GET['month']);
    $month=$montharr[0];
    $year=$montharr[1];
}
else
{
    $month = date('m');
    $year = date('Y');
}

$firstday = strtotime($year . '-' . $month . '-1');
$monthname = date('F', $firstday);
$firstweekday = date('w', $firstday);

$monthdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

if($month==1)
{
    $prevmonth = 12;
    $prevyear = $year - 1;   
}
else
{
    $prevmonth = $month - 1;
    $prevyear = $year;
}

if ($month = 12) {
    $nexmonth = 1;
    $nextyear = $year + 1;
} 
else 
{
    $nexmonth = $month + 1;
    $nextyear = $year;
}

$prevmonthdays = cal_days_in_month(CAL_GREGORIAN, $prevmonth, $prevyear);
$startweekday = $prevmonthdays - $firstweekday + 1;
$weekcount = 1;
$daycount = 1;
$nextday = 1;    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>    
  </head>
    <style>
        @import url('css/bootstrap.css');
        @import url('css/fontello.css');
        @import url('css/bootstrap-datepicker.css');
        @import url('css/style.css');
    </style> 
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script>
        $(function()
        {
            $('.datepicker').datepicker({
                format: "mm-yyyy",
                startView: 1,
                minViewMode: 1
            });
        })     

    </script>
</head>
<body>
    <div class="container">
        <h3><i class="icon-calendar"></i>To Do List</h3>
        <!-- formulario-->
        <div class="row">
            <div class="col-md-4">
                <form class="form-control-lg" action="index.php" method="get">
                    <div class="input-group">
                        <input name="month" class="form-control datepicker" type="text">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="icon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div> 
            <div class="col-md-8">
                <h4 class="float-end"><?="$monthname $year"?></h4>
            </div>        
        </div>        
        <!--formulario-->
        <!--calendario-->
        <table class="table">
            <tr>
                <th>Domingo</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sabado</th>                
            </tr>
            <tr>
                <?php
                while($firstweekday>0)
                {
                    echo '<td class="text-muted">' . $startweekday++ . '</td>';
                    $firstweekday--;
                    $weekcount++;
                }               
                while($daycount<=$monthdays)
                {
                    echo '<td>' . $daycount++ . '</td>';
                    $weekcount++;
                    if($weekcount>7)
                    {
                        echo'</tr><tr>';
                        $weekcount = 1;
                    }
                }
                while($weekcount>1 && $weekcount<=7)
                {
                    echo '<td class="text-muted">' . $nextday++ . '</td>';
                    $weekcount++;
                }
                ?>
            </tr>
        </table>
        <!--calendario-->
    </div>
</body>
</html>