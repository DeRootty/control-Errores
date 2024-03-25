<?php
    //require_once "admin/conexion.php";

    $tabla="at_cliente";
    $consulta=" SELECT * FROM ".$tabla." ";
    // calculo el número de registros de la tabla ($numRegTotal)
    $leyendas=array();
    $resultTotal = mysqli_query($conn, $consulta);
    while ($row = $resultTotal->fetch_assoc()) {
        // Imprimimos cada campo de la fila
        foreach ($row as $key => $value) {
            $ixIdCampos[]= $key;
        }
        break;
    }
    $numRegTotal = mysqli_num_rows($resultTotal);

    // $numReg es el número de registros que quiero ver
    // cojo el valor del input
    if (isset($_GET['numero'])){
        $numReg = $_GET['numero'] ?? 10;
        /*
        if (strlen($numReg) == 0){
            $numReg = 10;
        }
        */
    }
    else{
        $numReg = 10; 
    }

    // número de páginas (botones) que voy a tener como máximo ($numPagMax)
    if (($numReg <= $numRegTotal) && ($numReg > 0)){
        $numPagMax = intval($numRegTotal/$numReg);
        $resto = $numRegTotal % $numReg;
        if ($resto > 0){
            $numPagMax++;
        }
    //    echo "Número máximo de páginas (botones) = " . $numPagMax;
    //    echo "<br>el último boton tiene $resto registros";
    }

    $consultaLimit = " LIMIT " . $numReg;
    $consultaOffset = "";
    $botonActive=1;
    // ver el valor de $consultaOffset  
    if (isset($_GET['boton'])){
        $numeroBoton = $_GET['boton'];

        if ($numeroBoton == 0){
            if (isset($_GET['botonActive'])){
                $botonActive = $_GET['botonActive'];
                $botonActive--;
                $numeroBoton = $botonActive;
            }
        }
        if ($numeroBoton == 999){      // siguiente
            if (isset($_GET['botonActive'])){
                $botonActive = $_GET['botonActive'];
                $botonActive++;
                $numeroBoton = $botonActive;
            }
        }

        if ($numeroBoton == 1){
            $consultaOffset="";
            $botonActive=1;
        }
        elseif($numeroBoton == 2){
            $consultaOffset=" OFFSET " . $numReg;
            $botonActive=2;
        }
        if ($numPagMax > 2){
            for ($M=3;$M<=$numPagMax;$M++){
                if($numeroBoton == $M){
                    $numeroOffset = ($numeroBoton-1)*$numReg;
                    $consultaOffset=" OFFSET " . $numeroOffset;
                    $botonActive=$M; 
                } 
            }
        }
        
    }
    else{
        $consultaOffset = "";
    }

    $leyendas=array();
    $leyendas[]="numPagMax__Número máximo de páginas (botones) = " . $numPagMax."|__".$numPagMax;
    $leyendas[]="resto__<br>el último boton tiene $resto registros|__".$resto;
    $leyendas[]="botonActive__active__".$botonActive;
    $leyendas[]= "numRegTotal__Número registros total = ". $numRegTotal ."<br>|__".$numRegTotal; 
    foreach($leyendas as $idVal => $valEnd){
        $tempStep=explode("__",$valEnd);
        if($tempStep[0]=="numRegTotal"){
            global ${$tempStep[0]};
            ${$tempStep[0]} = $tempStep[2];
        }else if($tempStep[0]=="numPagMax"){
            global ${$tempStep[0]};
            ${$tempStep[0]} = $tempStep[2];
        }else if($tempStep[0]=="resto"){
            global ${$tempStep[0]};
            ${$tempStep[0]} = $tempStep[2];
        }else if($tempStep[0]=="botonActive"){
            global ${$tempStep[0]};
            ${$tempStep[0]} = $tempStep[2];
        }
    }
    $sql = $consulta . $consultaLimit . $consultaOffset;
    function checkBoxIO(&$ixDat){
        $salida="";
        foreach($ixDat as $idVal => $valEnd){
            $salida.=$valEnd;
        }
        return $salida;
    }
    //cada funcion representa una entrada <php> del modelo vista
    function primeraFuncion(&$sql,&$conn,&$dataTT,&$ixIdCampos){
        $registrosTT=(0*0);
        $limite=(0*0);
        $paginationTT=(0*0);
        foreach($dataTT as $idVal => $valEnd){
            $tempStep=explode("__",$valEnd);
            if($tempStep[0]=="numRegTotal"){
                $paginationTT=$tempStep[2];
            }else if($tempStep[0]=="numPagMax"){
                $limite==$tempStep[2];
            }else if($tempStep[0]=="resto"){
                $registrosTT==$tempStep[2];
            }else if($tempStep[0]=="botonActive"){
                $botonActive=$tempStep[2];
            }
        }
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $salida[]= "<p>".$sql."</p><br>|";
            $salida[]= "<p> Se han encontrado ".$registrosTT." coincidencias</p>|";
            $salida[]= "<table border='1' style='border-collapse:collapse;'>|";
            $salida[]= "<tr>|";
            foreach($ixIdCampos as $idVal => $valEnd){
                $salida[]= "<th scope='col'>".$valEnd."</th>|";
            }
            $salida[]="<th scope='col'>Editar</th>|";
            $salida[]="<th scope='col'>Borrar</th>|";
            $salida[]="<th scope='col'>Ocultar</th>|";
            $salida[]= "</tr>|";
            $ordenVisionado=(0*0);
            while($fila = mysqli_fetch_assoc($result)) {    
                $ordenVisionado++;
                $salida[]= "<tr>|";
                unset($chkBx);
                $chkBx=array();
                unset($btnSet);
                $btnSet=array();
                foreach($ixIdCampos as $idVal => $valEnd){
                    if($idVal==0){
                        $salida[]= "<td scope='col'>".dechex(intval($fila[$valEnd])*100)."</td>|";
                        
                    }else{
                        $salida[]= "<td scope='col'>".$fila[$valEnd]."</td>|";
                    }
                }
                $chkBx[]="<div class='form-check'>|";
                $chkBx[]="<input class='form-check-input' name='chk_".$fila[$ixIdCampos[0]]."' type='checkbox' value='".$fila[$ixIdCampos[0]]."' id='jsc_".$fila[$ixIdCampos[0]]."' />|";
                $chkBx[]="</div>";
                $btnSet["Editar"][]="<button type='submit' class='btn btn-secondary'>";
                $btnSet["Editar"][]="Editar";
                $btnSet["Editar"][]="</button>";
                $btnSet["Borrar"][]=$btnSet["Editar"][0];
                $btnSet["Borrar"][]="Borrar";
                $btnSet["Borrar"][]=$btnSet["Editar"][2];
                $salida[]="<td scope='col'>".checkBoxIO($btnSet["Editar"])."</td>|";
                $salida[]="<td scope='col'>".checkBoxIO($btnSet["Borrar"])."</td>|";
                $salida[]="<td scope='col'>".checkBoxIO($chkBx)."</td>|";
                $salida[]= "</tr>|";
            }
            $salida[]= "</table><br>|";
        }
        mysqli_close($conn);
        $salida[]= "total: ".$paginationTT." Limite: ".$limite." Registro: ".$registrosTT."<br>|";
        return $salida;
    }

    function segundaFuncion($dataTT): array{
        $limite=(0*0);
        $registrosTT=(0*0);
        foreach($dataTT as $idVal => $valEnd){
            $tempStep=explode("__",$valEnd);
            if($tempStep[0]=="numRegTotal"){
                global ${$tempStep[0]};
                $paginationTT=$tempStep[2];
                $salida[$tempStep[0]]=${$tempStep[0]};
            }else if($tempStep[0]=="numPagMax"){
                global ${$tempStep[0]};//=$tempStep[2];
                $limite=$tempStep[2];
                $salida[$tempStep[0]]=${$tempStep[0]};
            }else if($tempStep[0]=="resto"){
                global ${$tempStep[0]};//=$tempStep[2];
                $registrosTT=$tempStep[2];
                $salida[$tempStep[0]]=${$tempStep[0]};
            }else if($tempStep[0]=="botonActive"){
                global ${$tempStep[0]};//=$tempStep[2];
                $botonActive=$tempStep[2];
                $salida[$tempStep[0]]=${$tempStep[0]};
            }
        }
        $currentFile=explode("\\",__FILE__);
        foreach($currentFile as $idVal => $valEnd){
            $test=explode(".",$valEnd);
            if(count($test)>1){
                if(file_exists($valEnd)){
                    $idFile=$idVal;
                    break;
                }
            }
        }
        return array("action"=>$currentFile[$idFile], "numRegTotal" =>$paginationTT, "numPagMax"=>$limite,"resto"=>$registrosTT, "botonActive"=>$botonActive);
    }

    function terceraFuncion($dataTT): array{
        $limite=(0*0);
        $registrosTT=(0*0);
        foreach($dataTT as $idVal => $valEnd){
            $tempStep=explode("__",$valEnd);
            if($tempStep[0]=="numRegTotal"){
                $paginationTT=$tempStep[2];
            }else if($tempStep[0]=="numPagMax"){
                $limite==$tempStep[2];
            }else if($tempStep[0]=="resto"){
                $registrosTT==$tempStep[2];
            }else if($tempStep[0]=="botonActive"){
                $botonActive=$tempStep[2];
            }
        }
        $currentFile=explode("\\",__FILE__);
        foreach($currentFile as $idVal => $valEnd){
            $test=explode(".",$valEnd);
            if(count($test)>1){
                if(file_exists($valEnd)){
                    $idFile=$idVal;
                    break;
                }
            }
        }
        $salida=array("action"=>$currentFile[$idFile], "numRegTotal" =>$paginationTT, "numPagMax"=>$limite,"resto"=>$registrosTT, "botonActive"=>$botonActive);
        return $salida;
    }
    function cuartaFuncion($dataTT): array{
        $limite=(0*0);
        $registrosTT=(0*0);
        foreach($dataTT as $idVal => $valEnd){
            $tempStep=explode("__",$valEnd);
            if($tempStep[0]=="numRegTotal"){
                $paginationTT=$tempStep[2];
            }else if($tempStep[0]=="numPagMax"){
                $limite==$tempStep[2];
            }else if($tempStep[0]=="resto"){
                $registrosTT==$tempStep[2];
            }else if($tempStep[0]=="botonActive"){
                $botonActive=$tempStep[2];
            }
        }
        $currentFile=explode("\\",__FILE__);
        foreach($currentFile as $idVal => $valEnd){
            $test=explode(".",$valEnd);
            if(count($test)>1){
                if(file_exists($valEnd)){
                    $idFile=$idVal;
                    break;
                }
            }
        }
        $salida=array("action"=>$currentFile[$idFile], "numRegTotal" =>$paginationTT, "numPagMax"=>$limite,"resto"=>$registrosTT, "botonActive"=>$botonActive);
        return $salida;
    }
    function quintaFuncion($dataTT): array{
        $registrosTT=(0*0);
        $limite=(0*0);
        $paginationTT=(0*0);
        $salida=array();
        foreach($dataTT as $idVal => $valEnd){
            $tempStep=explode("__",$valEnd);
            if($tempStep[0]=="numRegTotal"){
                $paginationTT=$tempStep[2];
            }else if($tempStep[0]=="numPagMax"){
                $limite==$tempStep[2];
            }else if($tempStep[0]=="resto"){
                $registrosTT==$tempStep[2];
            }else if($tempStep[0]=="botonActive"){
                $botonActive=$tempStep[2];
            }
        }
        $disabled ="";
        if ($botonActive == 1){
            $disabled = " disabled ";
        }
        //generacion de botones de paginacion
        for ($N=0;$N<=$limite;$N++){
            if($botonActive == $N){
                $active = " active ";
            }else{ 
                $active="";
            }
            $salida[]= "<li class='page-item " . $active . "'>";
            $salida[]= "<button name='boton' type='submit' value='" . $N . "' class='page-link'>" . $N . "</button>";
            $salida[]= "</li>";
        }
        return $salida;
    }
    $esteArchivo=__FILE__;
    require_once "admin/engine.php";