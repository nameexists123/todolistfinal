<?php
require 'mysqli.php';

$query = 'SELECT * FROM categories';
$rs_categories = $mysqli->query($query) or die($mysqli->error);
$categories = array();
while ($row = $rs_categories->fetch_object()) {
    $categories[] = $row;
}
$rs_categories->free();



$pattern = "/[0-9]{2}-[0-9]{4}/";

if (isset($_GET['month']) && preg_match($pattern, $_GET['month'])) {
    $montharr = explode('-', $_GET['month']);
    $month = $montharr[0];
    $year = $montharr[1];
} else {
    $month = date('m');
    $year = date('Y');
}

$firstday = strtotime($year . '-' . $month . '-1');
$monthname = date('F', $firstday);
$firstweekday = date('w', $firstday);

$monthdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

$lastday =strtotime($year.'-'.$month.'-'.$monthdays);

$from = date('Y-m-d',$firstday);
$to = date('Y-m-d',$lastday); 

if ($month == 1) {
    $prevmonth = 12;
    $prevyear = $year - 1;
} else {
    $prevmonth = $month - 1;
    $prevyear = $year;
}

if ($month = 12) {
    $nexmonth = 1;
    $nextyear = $year + 1;
} else {
    $nexmonth = $month + 1;
    $nextyear = $year;
}

$prevmonthdays = cal_days_in_month(CAL_GREGORIAN, $prevmonth, $prevyear);
$startweekday = $prevmonthdays - $firstweekday + 1;
$weekcount = 1;
$daycount = 1;
$nextday = 1;
 
$eventsQuery = "SELECT
                     DATE_FORMAT( date,'%d%m%Y') AS  arr_index,
                     events.name, 
                     categories.name as category,
                     icon,
                     date
                FROM 
                     events,categories
                WHERE 
  categories.id= cat
  AND
   date BETWEEN '$from' AND '$to'
   ORDER BY 
   date";
   $rsEvents =$mysqli->query($eventsQuery)or die($mysqli->error);
   $events = array();

   while ($row = $rsEvents->fetch_object()) {
    $events[$row->arr_index][]=$row;
   }
$mysqli->close();
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
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-datepicker.js"></script>


<script>
    $(function() {
        $('.datepicker').datepicker({
            format: "mm-yyyy",
            startView: 1,
            minViewMode: 1
        });

        $('.btn-dark').on('click', function() {
            $('#newEventModal .input-date').val($(this).data('date'));
            $('#newEventModal').modal('show');
        });
    });
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
                <h4 class="float-end"><?= "$monthname $year" ?></h4>
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
                while ($firstweekday > 0) {
                    echo '<td class="text-muted">' . $startweekday++ . '</td>';
                    $firstweekday--;
                    $weekcount++;
                }
                while ($daycount <= $monthdays) {
                    echo '<td><butoon data-date="' . $year . '-' . $month . '-' . $daycount . '" class="btn btn-sm btn-dark">';
                    echo $daycount++;
                    echo '</butoon>';
                    $index =str_pad($daycount, 2, '0', STR_PAD_LEFT) . $month .$year;
                    if (isset($events[$index])) {
                        echo'<ul>';
                        foreach($events[$index]as $event){
                            echo '<li>'.$event->name . '</li>';
                        }
                        echo'</ul>';
                    }
                    echo '</td>';
                    $daycount++;
                    $weekcount++;
                    if ($weekcount > 7) {
                        echo '</tr><tr>';
                        $weekcount = 1;
                    }
                }
                while ($weekcount > 1 && $weekcount <= 7) {
                    echo '<td class="text-muted">' . $nextday++ . '</td>';
                    $weekcount++;
                }
                ?>
            </tr>
        </table>
        <!--calendario-->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="newEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="new.php"method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="icon-calendar">
                                Agregar nueva tarea
                            </i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control input-date" name="date" placeholder="Fecha">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="time" name="time" placeholder="Hora">
                        </div>
                        <div class="form-group">
                            Categoria
                            <?php if(count($categories) > 0): ?>
                                <select class="form-control" name="category">
                                    <?php foreach ($categories as $cat) : ?>
                                        <option value="<?= $cat->id ?>">
                                        <?= $cat->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            <?php
                            else : ?>
                                <div class="alert alert-warning">No categorias </div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Nombre de la tarea">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>