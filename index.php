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
                <td></td>
                <td></td>
                <td>1</td>
                <td>2</td>
                <td><a href="#">3</a>
                    <small>
                        <span class="badge bg-dark float-end">2 tareas</span>
                        <ul>
                            <li><a href="#"><i class="icon-pencil"></i>Clases</a></li>
                            <li><a href="#"><i class="icon-cog"></i>Compras</a></li>
                        </ul>
                        <button class="btn btn-sm btn-success">Agregar Tarea</button>
                    </small>
                </td>
                <td>4</td>
                <td>5</td>                
            </tr>
            <tr>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>                
            </tr>
        </table>
        <!--calendario-->
    </div>
</body>
</html>