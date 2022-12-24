<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
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
                <form action="">
                    <div class="input-group">
                        <input class="form-control datepicker" type="text">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="icon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div> 
            <div class="col-md-8">
                <h4 class="float-end">Marzo 2019</h4>
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
                <th></th>
                <th></th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>                
            </tr>
            <tr>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>                
            </tr>
        </table>
        <!--calendario-->
    </div>
</body>
</html>