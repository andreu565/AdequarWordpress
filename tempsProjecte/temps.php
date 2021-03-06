<form method="post">
    <input type="submit" name="inici" id="inici" value="Iniciar Comptatge"><br><br><br>
    <input type="submit" name="fi" id="fi" value="Finalitzar Comptatge">
</form>

<?php
function inici()
{
    #Data i hora actual per al camp horaInici
    $connexio = mysqli_connect('localhost', 'user', 'aplicacions', 'tempsProjecte');
    $sql= "SELECT NOW();";
    $resultat = mysqli_query($connexio, $sql);
    $array = mysqli_fetch_array($resultat);
    $horaInici=$array[0];

    #Total de registres de la taula que ens servirà per saber el nou id
    $count= "SELECT COUNT(*) FROM temps;";
    $resultatCount = mysqli_query($connexio, $count);
    $arrayCount = mysqli_fetch_array($resultatCount);
    $totalRegistres=$arrayCount[0]+1;

    #Inserció del nou id i de la horaInici
    $insert= "INSERT INTO temps (id,hora_inici) VALUES ($totalRegistres,'$horaInici');";
    $resultat = mysqli_query($connexio, $insert);
    mysqli_close($connexio);
    echo "<p><b>Inici Comptatge:</b> ".$horaInici."</p>";
}

function fi(){
    #Data i hora actual per al camp horaFi
    $connexio = mysqli_connect('localhost', 'user', 'aplicacions', 'tempsProjecte');
    $data_hora_act= "SELECT NOW();";
    $resDataHoraAct = mysqli_query($connexio, $data_hora_act);
    $array = mysqli_fetch_array($resDataHoraAct);
    $horaFinal=$array[0];

    #Total de registres de la taula que ens servirà per saber el id del registre que modificarem el horaFi
    $count= "SELECT COUNT(*) FROM temps;";
    $resultatCount = mysqli_query($connexio, $count);
    $arrayCount = mysqli_fetch_array($resultatCount);
    $totalRegistres=$arrayCount[0];

    #Actualització del horaFi amb la horaFi i el id trobat anteriorment
    $update= "UPDATE temps SET hora_fi = '$horaFinal' WHERE id = $totalRegistres;";
    $resultat = mysqli_query($connexio, $update);

    #Mostrar horaInici trobat anteriorment
    $selectHoraFi= "SELECT hora_inici FROM temps WHERE id = $totalRegistres;";
    $resDataHoraIni = mysqli_query($connexio, $selectHoraFi);
    $array2 = mysqli_fetch_array($resDataHoraIni);
    $horaInici=$array2[0];

    #Restem les dues dates i obtenim el resultat en segons.
    #Seguidament actualització del camp intervalTemps amb la variable de segons per al registre actual.
    $segons = strtotime($horaFinal) - strtotime($horaInici);
    $insertIntervalTemps = "UPDATE temps SET intervalTemps = $segons WHERE id = $totalRegistres;";
    $intervalTemps = mysqli_query($connexio, $insertIntervalTemps);

    #Hores, minuts i segons treballats actualment
    $hor = floor($segons / 3600);
    $min = floor(($segons - ($hor * 3600)) / 60);
    $seg = $segons - ($hor * 3600) - ($min * 60);

    #Sumatori de tots els registres del camp intervalTemps per saber els segons totals treballats
    $sumIntervalTemps = "SELECT SUM(intervalTemps) FROM temps;";
    $resSum = mysqli_query($connexio, $sumIntervalTemps);
    $array3 = mysqli_fetch_array($resSum);
    $totalSegons=$array3[0];

    #Hores, minuts i segons totals treballats
    $totHor = floor($totalSegons / 3600);
    $totMin = floor(($totalSegons - ($totHor * 3600)) / 60);
    $totSeg = $totalSegons - ($totHor * 3600) - ($totMin * 60);

    mysqli_close($connexio);

    echo "<p><b>Fi Comptatge:</b> ".$horaFinal."</p>";
    echo "<p><b>Temps actual treballat:</b> ". $hor . ' hores, ' . $min . " minuts i " . $seg . " segons</p>";
    echo "<p><b>Temps total treballat:</b> ". $totHor . ' hores, ' . $totMin . " minuts i " . $totSeg . " segons</p>";
}
if(array_key_exists('inici',$_POST)){
    inici();
}
elseif (array_key_exists('fi',$_POST)){
    fi();
}
