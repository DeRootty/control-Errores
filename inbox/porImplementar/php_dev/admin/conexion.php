<?php
    require_once "dataAccess/usersObj.php";

    function obtenNombresTabla($sqlAdHoc,$ixBDAccess,$ixIdsBDAccess,&$connActv){
        global $idsLogines;
        $ixExitPart1=array();
        $ixNameTup=array();
        $nameAdHoc=array();
        // Consulta SQL para obtener el total de tablas
        $result = $connActv->query($sqlAdHoc);
        // Verifica si la consulta fue exitosa
        if ($result->num_rows > 0) {
            $totalTablas = $result->num_rows;
            //echo "DEPURACION: ".__FILE__.": =>".__LINE__.": Total de tablas en la base de datos: " . $totalTablas."<br>";

            $ixNameRow=array("des_Tablas"=>array());
            $sqlSubInfo="";
            $ixExitPart1=array("des_Columnas"=>array());
            while ($row = $result->fetch_assoc()) {
                $nameAdHoc[]=$row["Tables_in_".$ixIdsBDAccess[$idsLogines[3]]];
                $verifica=explode("_",$nameAdHoc[count($nameAdHoc)-1]);
                if(count($verifica)>1){
                    if(strtolower($verifica[0])=="ex"){
                        $sqlSubInfo="DESCRIBE ".$nameAdHoc[count($nameAdHoc)-1];
                        $ixExitPart1["des_Columnas"]=obtenColumnasTabla($sqlSubInfo,$nameAdHoc[count($nameAdHoc)-1],$connActv);
                        $ixNameRow["des_Tablas"]["sub_examen"][][$nameAdHoc[count($nameAdHoc)-1]] = $ixExitPart1;
                        //$nombreTabla=$tuplaName;
                    }
                }else{
                    unset($sqlSubInfo);
                    $sqlSubInfo="DESCRIBE ".$nameAdHoc[count($nameAdHoc)-1];
                    $ixExitPart1["des_Columnas"]=obtenColumnasTabla($sqlSubInfo,$nameAdHoc[count($nameAdHoc)-1],$connActv);
                    $ixNameRow["des_Tablas"][][$nameAdHoc[count($nameAdHoc)-1]] = $ixExitPart1;
                }
            }
            $salida=$ixNameRow;
        } else {
            $salida="No se encontraron tablas en la base de datos.";
        }
        return $salida;
    }
    function obtenColumnasTabla($sqlAdHoc, &$tuplaName,&$connActv){
        $notificaciones="";
        $ixExitPart2=array();
        // Nombre de la tabla de la que deseas obtener los nombres de las columnas
        $nombreTabla = $tuplaName;

        // Consulta SQL para obtener los nombres de las columnas
        // Ejecutar la consulta SQL
        $resultado = $connActv->query($sqlAdHoc);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                array_push($ixExitPart2, $fila["Field"]);
                //echo "Nombre de columna: " . $fila["Field"] . "<br>";
            }
        } else {
            $notificaciones.= "No se encontraron columnas en la tabla.";
        }
        return $ixExitPart2;
    }
    /*
    $ixIdsFrmTSQL=array("new"=>"INSERT INTO","edit"=>"UPDATE","del"=>"DELETE","sel"=>"SELECT");
    $ixIdTSql=array("DELETE"=>0,"INSERT INTO"=>1,"SELECT"=>2,"UPDATE"=>3);
    $ixLeyendaTSql=array("DELETE","INSERT INTO","SELECT","UPDATE");
*/
    //capa de abstraccion entre la base de datos y la aplicacion
    echo __LINE__." :paso por defecto<br>\n";
    $notificaciones="";
    //capa de abstraccion entre la base de datos y la aplicacion
    settype($IxLeyendaCapaForm, "array");
    $IxLeyendaCapaForm=array("new","edit","del","sel");
    $ixLeyendaTSql=array("DELETE","INSERT INTO","SELECT","UPDATE");
    $ixIdCapaForm=array(
        $IxLeyendaCapaForm[0]=>1,
        $IxLeyendaCapaForm[1]=>3,
        $IxLeyendaCapaForm[2]=>0,
        $IxLeyendaCapaForm[3]=>2
    );
    $ixIdTSql=array(
        "flip"=>array(
            $ixLeyendaTSql[$ixIdCapaForm[$IxLeyendaCapaForm[2]]]=>$IxLeyendaCapaForm[$ixIdCapaForm[$IxLeyendaCapaForm[2]]],
            $ixLeyendaTSql[$ixIdCapaForm[$IxLeyendaCapaForm[0]]]=>$IxLeyendaCapaForm[$ixIdCapaForm[$IxLeyendaCapaForm[0]]],
            $ixLeyendaTSql[$ixIdCapaForm[$IxLeyendaCapaForm[3]]]=>$IxLeyendaCapaForm[$ixIdCapaForm[$IxLeyendaCapaForm[3]]],
            $ixLeyendaTSql[$ixIdCapaForm[$IxLeyendaCapaForm[1]]]=>$IxLeyendaCapaForm[$ixIdCapaForm[$IxLeyendaCapaForm[1]]]
        ),
        "flop"=>array(
            $IxLeyendaCapaForm[$ixIdCapaForm[$IxLeyendaCapaForm[2]]]=>$ixLeyendaTSql[$ixIdCapaForm[$IxLeyendaCapaForm[2]]],
            $IxLeyendaCapaForm[$ixIdCapaForm[$IxLeyendaCapaForm[0]]]=>$ixLeyendaTSql[$ixIdCapaForm[$IxLeyendaCapaForm[0]]],
            $IxLeyendaCapaForm[$ixIdCapaForm[$IxLeyendaCapaForm[3]]]=>$ixLeyendaTSql[$ixIdCapaForm[$IxLeyendaCapaForm[3]]],
            $IxLeyendaCapaForm[$ixIdCapaForm[$IxLeyendaCapaForm[1]]]=>$ixLeyendaTSql[$ixIdCapaForm[$IxLeyendaCapaForm[1]]]
        )
    );
    $ixTransactSQL=array(
        $IxLeyendaCapaForm[0]=>array(),
        $IxLeyendaCapaForm[1]=>array(),
        $IxLeyendaCapaForm[2]=>array(),
        $IxLeyendaCapaForm[3]=>array()
    );
    $userOK=0;
    echo __LINE__." :paso por defecto<br>\n";

    //$ixIdsDbAccess = $ixers_Login["permission"][$userOK]; // Acceder al arreglo dentro de "permission" correspondiente al usuario.
    $ixDbAccess["OnLine"] = array(
        $idsLogines[0] => array(),
        $idsLogines[1] => array(),
        $idsLogines[2] => array(),
        $idsLogines[3] => array()
    );
    echo __LINE__." :paso por defecto<br>\n";
    $ixTransactSQL=array($ixLeyendaTSql[0]=>array(),$ixLeyendaTSql[1]=>array(),$ixLeyendaTSql[2]=>array(),$ixLeyendaTSql[3]=>array());
    $userOK=0;
    $ixIdsDbAccess = $ixers_Login; // Acceder al arreglo dentro de "permission" correspondiente al usuario.
    echo __LINE__." :paso por defecto<br>\n";
    echo "<pre><br>\n";
    print_r($ixers_Login);
    print_r($idsLogines[0]);
    echo "</pre><br>\n";


    $ixDbAccess["OnLine"] = array(
        $idsLogines[0] => array(),
        $idsLogines[1] => array(),
        $idsLogines[2] => array(),
        $idsLogines[3] => array()
    );
    if (
        !(
            isset($ixDbAccess["OnLine"][$idsLogines[0]][$userOK]) &&
            isset($ixDbAccess["OnLine"][$idsLogines[1]][$userOK]) &&
            isset($ixDbAccess["OnLine"][$idsLogines[2]][$userOK]) &&
            isset($ixDbAccess["OnLine"][$idsLogines[3]][$userOK])
        )
    ) {
        array_push($ixDbAccess["OnLine"][$idsLogines[0]], $ixIdsDbAccess[$idsLogines[0]]);
        array_push($ixDbAccess["OnLine"][$idsLogines[1]], $ixIdsDbAccess[$idsLogines[1]]);
        array_push($ixDbAccess["OnLine"][$idsLogines[2]], $ixIdsDbAccess[$idsLogines[2]]);
        array_push($ixDbAccess["OnLine"][$idsLogines[3]], $ixIdsDbAccess[$idsLogines[3]]);
    }

    echo __LINE__." :paso por defecto<br>\n";
    echo "<pre>";
    print_r($ixIdsDbAccess);
    print_r($idsLogines[0]);
    echo "</pre>";
    
    if(!isset($conn)){
        echo __LINE__." :paso por defecto<br>\n";
        echo "<strong>ixDbAccess</strong><br>\n";
        echo "<pre>";
        print_r($ixDbAccess);
        echo "</pre>";
        echo __LINE__." :paso por defecto<br>\n";
        echo "<strong>ixers_loguin</strong><br>\n";
        echo "<pre><br>\n";
        print_r($ixers_Login);
        echo "</pre><br>\n";
        echo __LINE__." :paso por defecto<br>\n";
        echo "<strong>idsLoguines</strong><br>\n";
        echo "<pre><br>\n";
        print_r($idsLogines);
        echo "</pre>";
        echo __LINE__." :paso por defecto<br>\n";
        echo "<strong>ixIdsDbAccess</strong><br>\n";
        echo "<pre>";
        print_r($ixIdsDbAccess);
        echo "</pre>";
        echo __LINE__." :paso por defecto<br>\n";
        echo "<strong>ixTransactSQL</strong><br>\n";
        echo "<pre>";
        print_r($ixTransactSQL);
        echo "</pre>";
        echo __LINE__." :paso por defecto<br>\n";    
        echo "<strong>ixIdsDbAccess</strong><br>\n";
        echo "<pre>";
        print_r($ixIdTSql);
        echo "</pre>";


        $conn = new mysqli();
        $conn->real_connect(
            $ixDbAccess["OnLine"][$idsLogines[2]][count($ixDbAccess["OnLine"][$idsLogines[2]]) - 1],
            $ixDbAccess["OnLine"][$idsLogines[0]][count($ixDbAccess["OnLine"][$idsLogines[0]]) - 1],
            $ixDbAccess["OnLine"][$idsLogines[1]][count($ixDbAccess["OnLine"][$idsLogines[1]]) - 1],
            $ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]]) - 1]
        );
        $notificaciones.="<br>se crea nueva instancia de conexion<br>";
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            echo "Conexion establecida<br>";
        }
    }else{
        echo "La conexion ya existe<br>";
    }
    echo __LINE__." :paso por defecto<br>\n";
    if (!($conn->ping())) {
        echo "Se ha perdido la conexion<br>";
    }else{
        echo  "La conexion esta establecida<br>";
    }
    echo __LINE__." :paso por defecto<br>\n";
    // Create connection
    $ixIdBDLayer=array();
    $ixBDConexion=array();
    $sqlInfo="SHOW TABLES";
    //apuntamos al nombre de la base de datos, para asociar la resupuesta de la funcion
    echo __LINE__." :paso por defecto<br>\n";
    $camposTablaDatos=array();
    $ixBDConexion[$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1]]=obtenNombresTabla($sqlInfo,$ixDbAccess["OnLine"],$ixIdsDbAccess,$conn);
    $ixIdBDLayer=array();
    echo "<pre>";
    print_r($conn);
    echo "</pre>";
    mysqli_close($conn);
?>