
    <?php
    /* [fecha] => 2022-12-1
    [hora] => 21:33
    [categorias] => 1
    [nombre] => clasica */
    require 'mysqli.php';
    $date = $mysqli->escape_string(strip_tags($_POST['date']) );
    $time = $mysqli->escape_string(strip_tags($_POST['time']));
    $category= $mysqli->escape_string(strip_tags($_POST['category']));
    $name = $mysqli->escape_string(strip_tags($_POST['name']));

    $fixedDate = date('Y-m-d h:i:s', strtotime($date.' '.$time));

    $query = "INSERT INTO events (cat, name, date) VALUES ($category,'$name','$fixedDate')";

    $mysqli->query($query)or die($mysqli->error);

    $url= date('m-Y',strtotime($date.' '.$time));
    
    header('Location: index.php?month='.$url);
    ?>
