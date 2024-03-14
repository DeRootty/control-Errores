<?php
    $sql="SELECT * FROM examen_empl";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $resulTabla= "<table id='tabla' class='table  table-hover'>\n";
            $resulTabla.= "<tr><th  class='titulo'>NIF</th><th class='titulo'>NOMBRE</th><th  class='titulo'>PRIMER APELLIDO</th><th class='titulo'>SEGUNDO APELLIDO</th><th class='titulo'>ELIMINAR</th><th class='titulo'>EDITAR</th><th class='titulo'>DUPLICAR</th></tr>\n";
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                // FILA A FILA
                $resulTabla.= "<tr>";
                $resulTabla.= "<td id='".$row["id"] . "'>". "<input type='hidden' name='id' value='".$row["id"] . "'>"."<input type='text' name='nif' value='".$row["nif"]. "'></td><td><input type='text' name='nombre'  value='" . $row["nombre"] . "'></td>";
                $resulTabla.= "<td><input type='text' name='apellido1'  value='" . $row["apellido1"]. "'></td>";
                $resulTabla.= "<td><input type='text' name='apellido2' value='" . $row["apellido2"] ."'></td>";
                $resulTabla.= "<td><form action ='empl_accion.php' method='post'><input type='hidden' name = 'uno' value='" .  $row["id"] . "'><input type='submit' value='Eliminar' onclick='return confirmacion();'></form></td>";
                $resulTabla.= "<td><form action ='empl_accion.php' method='post'><input type='hidden' name = 'dos' value='" .  $row["id"] . "'><input type='submit' value='Editar' onclick='return confirmacion();'></form></td>";
                $resulTabla.= "<td><form action ='empl_accion.php' method='post'><input type='hidden' name = 'tres' value='" .  $row["id"] . "'><input type='submit' value='Duplicar' onclick='return confirmacion();'></form></td>";
                $resulTabla.= "</tr>\n";
            }
            $resulTabla.="</table>\n";
        }else{
            $resulTabla="No hay resultados: ";
        }
    require_once "index.php";
?>