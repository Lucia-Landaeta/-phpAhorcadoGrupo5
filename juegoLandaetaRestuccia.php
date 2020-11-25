<?php

/******************************************
 * NOMBRE Y APELLIDOS     -    LEGAJOS
    Restuccia Joshua Matias       FAI-1654
    Landaeta Lucía Anahí          FAI-1981

 * REPOSIORIOS GIT

 ******************************************/

/**
 * Genera un arreglo de palabras para jugar
 * @return array
 */
function cargarPalabras(){
    /** @var array $coleccionPalabras */
    $coleccionPalabras = array();
    $coleccionPalabras[0] = array("palabra" => "papa", "pista" => "se cultiva bajo tierra", "puntosPalabra" => 7);
    $coleccionPalabras[1] = array("palabra" => "hepatitis", "pista" => "enfermedad que inflama el higado", "puntosPalabra" => 7);
    $coleccionPalabras[2] = array("palabra" => "volkswagen", "pista" => "marca de vehiculo", "puntosPalabra" => 10);
    $coleccionPalabras[3] = array("palabra" => "paralelepipedo", "pista" => "paralelogramo en 3 dimensiones", "puntosPalabra" => 20);
    $coleccionPalabras[4] = array("palabra" => "ajolote", "pista" => "salamandra blanca de branqueas rosadas y carita sonriente", "puntosPalabra" => 23);
    $coleccionPalabras[5] = array("palabra" => "gaita", "pista" => "instrumento de viento con fuelle", "puntosPalabra" => 15);
    $coleccionPalabras[6] = array("palabra" => "onomatopeya", "pista" => "BOOM!,POW!,BANG!,PLOP!", "puntosPalabra" => 50);

    return $coleccionPalabras;
}

/**
 * /*Genera un arreglo de juegos previos 
 * @return array
 */
function cargarJuegos(){
    /** @var array $coleccionJuegos */
    $coleccionJuegos = array();
    $coleccionJuegos[0] = array("puntos" => 0, "indicePalabra" => 1);
    $coleccionJuegos[1] = array("puntos" => 10, "indicePalabra" => 2);
    $coleccionJuegos[2] = array("puntos" => 0, "indicePalabra" => 1);
    $coleccionJuegos[3] = array("puntos" => 8, "indicePalabra" => 0);
    $coleccionJuegos[4] = array("puntos" => 16, "indicePalabra" => 5);
    $coleccionJuegos[5] = array("puntos" => 23, "indicePalabra" => 3);
    $coleccionJuegos[6] = array("puntos" => 0, "indicePalabra" => 6);

    return $coleccionJuegos;
}

/**
 * A partir de la palabra genera un arreglo para determinar si sus letras fueron o no descubiertas
 * @param string $palabra
 * @return array
 */
function dividirPalabraEnLetras($palabra){
    /** 
     * @var array $coleccionLetras
     *@var int $tamanio , $i */
    $tamanio = strlen($palabra);

    for ($i = 0; $i < $tamanio; $i++) {
        $coleccionLetras[$i] = array("letra" => $palabra[$i], "descubierta" => false);
    }
    return $coleccionLetras;
}

/**
 * Muestra y obtiene una opcion de menú ***válida***
 * @return int
 */
function seleccionarOpcion(){
    /** @var int $opcion 
     *@var boolean $esValido */
    $esValido = false;

    echo "\n"." Ingrese una opcion: " . "\n";
    echo "--------------------------------------------------------------";
    echo "\n ( 1 ) Jugar con una palabra aleatoria";
    echo "\n ( 2 ) Jugar con una palabra seleccionada";
    echo "\n ( 3 ) Agregar una palabra al listado";
    echo "\n ( 4 ) Mostrar la informacion completa de un numero de juego";
    echo "\n ( 5 ) Mostrar la informacion completa del juego con mas puntaje";
    echo "\n ( 6 ) Mostrar la informacion completa del primer juego que supere un puntaje";
    echo "\n ( 7 ) Mostrar la lista de palabras en orden alfabetico";
    echo "\n ( 8 ) Salir del juego";
    echo "\n--------------------------------------------------------------\n";
    
    do {
        $opcion = trim(fgets(STDIN));

        if ($opcion >= 1 && $opcion <= 8) {
            $esValido = true;
        } else {
            echo "Ingrese una opcion valida." . "\n";
        }
    } while (!$esValido);

    return $opcion;
}

/**
 * Determina si una palabra existe en el arreglo de palabras
 * @param array $coleccionPalabras
 * @param string $palabra
 * @return boolean
 */
function existePalabra($coleccionPalabras, $palabra){
/** @var int $i, $cantPal 
 * @var boolean $existe */
    $i = 0;
    $cantPal = count($coleccionPalabras);
    $existe = false;
    while ($i < $cantPal && !$existe) {
        $existe = $coleccionPalabras[$i]["palabra"] == strtolower($palabra);
        $i++;
    }
    return $existe;
}


/**
 * Determina si una letra existe en el arreglo de letras
 * @param array $coleccionLetras
 * @param string $letra
 * @return boolean
 */
function existeLetra($coleccionLetras, $letra){
    /** @var boolean $existe
     *@var int $i , $tamanio  */
    $tamanio = count($coleccionLetras);
    $i = 0;
    $existe = false;
    while ($i < $tamanio && !$existe) {
        if ($coleccionLetras[$i]["letra"] == $letra) {
            $existe = true;
        }
        $i++;
    }
    return $existe;
}

/**
 * Solicita los datos correspondientes a un elemento de la coleccion de palabras: palabra, pista y puntaje. 
 * Internamente la función también verifica que la palabra ingresada no exista en la colección de palabras.
 * @param array $coleccionPalabras
 * @return array  //coleccionPalabras modificada con la nueva palabra.
 */
function agregarPalabra($coleccionPalabras){
    /** @var int $i, $puntaje
     *@var boolean $encontrado
     *@var String $palabraNueva , $pista */
    $encontrado = true;
            
    while ($encontrado) {
        echo "Ingrese la nueva palabra:" . "\n";
        $palabraNueva = strtolower(trim(fgets(STDIN)));
        
        if (existePalabra($coleccionPalabras,$palabraNueva)) {
            echo "La palabra: '".$palabraNueva."'. Ya existe!\n";
        }else{            
                echo "Ingrese la pista de la palabra:"."\n";
                $pista = trim(fgets(STDIN));
                echo "Ingrese el puntaje de la palabra"."\n";
                $puntaje = trim(fgets(STDIN));
                $coleccionPalabras[] = array("palabra" => $palabraNueva, "pista" => $pista, "puntosPalabra" => $puntaje);
                $encontrado=false;
        }       
    }
    return $coleccionPalabras;
}

/**
 * Obtiene un indice aleatorio
 * @param int $min
 * @param int $max
 * @return int
 */
function indiceAleatorioEntre($min, $max){
/** 
 * @var int $i */
    $i = rand($min, $max); // La funcion rand, genera un número entero aleatorio, entre los rangos asignados
    return $i;
}

/**
 * Solicita un valor entre min y max
 * @param int $min
 * @param int $max
 * @return int
 */
function solicitarIndiceEntre($min, $max){
/**
 * @var int $i  */
    do {
        echo "Seleccione un valor entre $min y $max: \n";
        $i = trim(fgets(STDIN));
    } while (!($i >= $min && $i <= $max));

    return $i;
}

/**
 * Determinar si la palabra fue descubierta, es decir, todas las letras fueron descubiertas
 * @param array $coleccionLetras
 * @return boolean
 */
function palabraDescubierta($coleccionLetras){
/** 
 * @var int $i , $tamanio
 * @var boolean $descubierto */
    $descubierto = true;
    $i = 0;
    $tamanio = count($coleccionLetras);
    while ($i <$tamanio && $descubierto) {
        $descubierto = $coleccionLetras[$i]["descubierta"];
        $i++;
    }
    return $descubierto;
}

/**
 * Solicita una letra al usuario, y valida que el string ingresado tenga un único carácter
 * @return String
 */
function solicitarLetra(){
/** 
* @var boolean $letraCorrecta 
* @var String letra  */
    $letraCorrecta = false;
    do {
        echo "Ingrese una letra: ";
        $letra = strtolower(trim(fgets(STDIN)));
        if (strlen($letra) != 1) {
            echo "Debe ingresar 1 letra!\n";
        } else {
            $letraCorrecta = true;
        }
    } while (!$letraCorrecta);

    return $letra;
}

/**
 * Descubre todas las letras de la colección de letras iguales a la letra ingresada.
 * @param array $coleccionLetras
 * @param string $letra
 * @return array //colección de letras modificada.
 */
function destaparLetra($coleccionLetras, $letra){
/** @var int $i, $tamanio  */
    $tamanio = count($coleccionLetras);
    for ($i = 0; $i < $tamanio; $i++) {
        if ($coleccionLetras[$i]["letra"] == $letra) {
            $coleccionLetras[$i]["descubierta"] = true;
        }
    }
    return $coleccionLetras;
}

/**
 * Obtiene la palabra con las letras descubiertas y * (asterisco) en las letras no descubiertas. Ejemplo: he**t*t*s
 * @param array $coleccionLetras
 * @return string  Ejemplo: "he**t*t*s"
 */
function stringLetrasDescubiertas($coleccionLetras){
/** 
 * @var String $pal   
 * @var int $tamanio , $i  */
    $pal = "";
    $tamanio = count($coleccionLetras);
    for($i = 0;$i<$tamanio;$i++){
        if($coleccionLetras[$i]["descubierta"]){
            $pal = $pal . $coleccionLetras[$i]["letra"];
        }else{ 
            $pal = $pal . "*";
        }
    }
    return $pal;
}


/**
 * Desarrolla el juego y retorna el puntaje obtenido
 * Si descubre la palabra se suma el puntaje de la palabra más la cantidad de intentos que quedaron
 * Si no descubre la palabra el puntaje es 0.
 * @param array $coleccionPalabras
 * @param int $indicePalabra
 * @param int $cantIntentos
 * @return int 
 */
function jugar($coleccionPalabras, $indicePalabra, $cantIntentos){
/** 
* @var int $puntaje
* @var String $pal,$letra
* @var array $coleccionLetras
* @var boolean $palabraFueDescubierta , $existeLet */

    $pal = $coleccionPalabras[$indicePalabra]["palabra"];
    $coleccionLetras = dividirPalabraEnLetras($pal);
    $puntaje = 0;

    $palabraFueDescubierta = false;
    echo "\nPista: ".$coleccionPalabras[$indicePalabra]["pista"]."\n";

    while($cantIntentos > 0 && !$palabraFueDescubierta){
        $letra = solicitarLetra();
        $existeLet = existeLetra($coleccionLetras,$letra);
        if($existeLet){
            echo"\nLa letra '".$letra."' pertenece a la palabra.\n";
            $coleccionLetras = destaparLetra($coleccionLetras,$letra);
            $palabraFueDescubierta = palabraDescubierta($coleccionLetras);
        }else{
            $cantIntentos--;
            echo"\nLa letra '".$letra."' NO pertenece a la palabra. Quedan ".$cantIntentos." intentos."."\n";
            
        }
        echo "Palabra a descubrir:  ".stringLetrasDescubiertas($coleccionLetras)."\n\n";
    }
    if($palabraFueDescubierta){
        $puntaje = $coleccionPalabras[$indicePalabra]["puntosPalabra"]+$cantIntentos;
        echo"¡¡¡Ganaste ". $puntaje. " puntos!!!\n";
    }else{
       echo"¡¡¡Ahorcado, Ahorcado!!!!\n";
    }
    return $puntaje;
}

/**
 * Agrega un nuevo juego al arreglo de juegos
 * @param array $coleccionJuegos
 * @param int $puntos
 * @param int $indicePalabra
 * @return array 
 */
function agregarJuego($coleccionJuegos, $puntos, $indicePalabra){

    $coleccionJuegos[] = array("puntos"=> $puntos, "indicePalabra" => $indicePalabra);    
    return $coleccionJuegos;
}

/**
 * Muestra los datos completos de un registro en la colección de palabras
 * @param array $coleccionPalabras
 * @param int $indicePalabra
 */
function mostrarPalabra($coleccionPalabras, $indicePalabra){

    echo "  Palabra: ".$coleccionPalabras[$indicePalabra]["palabra"]."\n";
    echo "  Pista: ".$coleccionPalabras[$indicePalabra]["pista"]."\n";
    echo "  Puntos palabra: ".$coleccionPalabras[$indicePalabra]["puntosPalabra"]."\n";
}

/**
 * Muestra los datos completos de un juego
 * @param array $coleccionJuegos
 * @param array $coleccionPalabras
 * @param int $indiceJuego
 */
function mostrarJuego($coleccionJuegos, $coleccionPalabras, $indiceJuego){
//array("puntos"=> 8, "indicePalabra" => 1)
    echo "\n\n";
    echo "<-<-< Juego " . $indiceJuego . " >->->\n";
    echo "Puntos ganados: " . $coleccionJuegos[$indiceJuego]["puntos"] . "\n";
    echo "Información de la palabra:\n";
    mostrarPalabra($coleccionPalabras, $coleccionJuegos[$indiceJuego]["indicePalabra"]);
    echo "\n";
}

/**
 * Muestra la informacion de un juego solicitando su indice
 * @param array $coleccionPalabras
 * @param array $coleccionJuegos
 */
function mostrarJuegoElegido($coleccionJuegos,$coleccionPalabras){
/**
 * @var int $indiceJuego  */
    $indiceJuego = solicitarIndiceEntre(0, count($coleccionJuegos)-1); 
    mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego);
}

/** 
 * Muestra los datos completos del juego con mayor puntaje
 * @param array $coleccionJuegos
 * @param $coleccionPalabra */
function  mostrarJuegoMayorPuntaje ($coleccionJuegos,$coleccionPalabras){
/** @var int $indice */
    $indice = partidaMayorPuntaje($coleccionJuegos);
    mostrarJuego($coleccionJuegos,$coleccionPalabras,$indice);
}


/** 
 * Muestra los datos completos del primer juego con mayor puntaje al ingresado
 * @param array $coleccionJuegos
 * @param $coleccionPalabras */
function mostrarJuegoMayorPuntajeDado ($coleccionJuegos,$coleccionPalabras) {
/** @var int $indice , $puntaje  */
    echo"Ingrese el puntaje que desea superar."."\n";
    $puntaje=trim(fgets(STDIN));
    $indice = partidaMayorPuntajeDado($coleccionJuegos,$puntaje);
    if($indice != -1){
        mostrarJuego($coleccionJuegos,$coleccionPalabras,$indice);
    }else{
        echo"No hay ningún juego que supere el puntaje \n".$puntaje;
    }
}


/** 
 * Muestra la informacion de las palabras, en orden alfabetico 
 * @param $coleccionPalabra */
function mostrarPalabrasOrdenadas($coleccionPalabras){
/** 
 * @var array $palabra  */
    asort($coleccionPalabras);
    foreach($coleccionPalabras as $palabra){
        print_r($palabra);  // la funcion print_r, muestra información sobre una variable en una forma que es legible por humanos.
    }
}

/** 
 * A partir de la colección de juegos obtiene el índice de la partida con mayor puntaje
 * @param array $coleccionJuegos
 * @return int
 */
function partidaMayorPuntaje($coleccionJuegos){
/** 
 * @var int $indiceMayorPuntaje, $puntajeMayor, $i,$tamanio 
 */
    $tamanio = count($coleccionJuegos);
    $puntajeMayor = 0;
    for ($i=0; $i< $tamanio ;$i++){
        if($coleccionJuegos[$i]["puntos"]>$puntajeMayor){
            $puntajeMayor = $coleccionJuegos[$i]["puntos"];
            $indiceMayorPuntaje = $i;
        }
    }
    return $indiceMayorPuntaje;
}

/** 
 * A partir de la colección de juegos obtiene el índice de la primer partida con mayor puntaje al recibido por parametro
 * @param array $coleccionJuegos
 * @param int $puntaje
 * @return int
 */
function partidaMayorPuntajeDado($coleccionJuegos, $puntaje){
/** 
 * @var int $i, $indice, $tamanio */
    $tamanio = count($coleccionJuegos);
    $indice = -1;
    $i = 0;
    while($i < $tamanio && $indice==-1){
        if($coleccionJuegos[$i]["puntos"]>$puntaje){
            $indice = $i;
        }
        $i++;
    }
    return $indice;
}


/**
 * Se realiza un juego con una palabra seleccionada aleatoriamente
 * @param array $coleccionJuegos
 * @param array $coleccionPalabras
 * @param int $cantIntentos
 * @return array
 */
function jugarPalabraAleatoria($coleccionPalabras, $coleccionJuegos, $cantIntentos){
    /** 
     * @var int $indice, $tamanioPalabras, $puntaje */
    $tamanioPalabras = count($coleccionPalabras)-1;
    $indice = indiceAleatorioEntre(0,$tamanioPalabras);
    $puntaje = jugar($coleccionPalabras, $indice, $cantIntentos);
    $coleccionJuegos= agregarJuego($coleccionJuegos, $puntaje, $indice);

    return $coleccionJuegos;
}


/** 
 * Se realiza un juego con una palabra elegida por el usuario
 * @param array $coleccionPalabras
 * @param array $coleccionJuegos
 * @param int $cantIntentos
 * @return array
 */
function jugarPalabraElegida($coleccionPalabras,$coleccionJuegos, $cantIntentos ){
/** 
 * @var int indice, tamanioPalabras,tamanioJuegos, puntaje */ 
    $tamanioPalabras = count($coleccionPalabras)-1;
    $indice = solicitarIndiceEntre(0,$tamanioPalabras);
    $puntaje = jugar($coleccionPalabras, $indice, $cantIntentos);
    $coleccionJuegos = agregarJuego($coleccionJuegos, $puntaje, $indice);

    return $coleccionJuegos;
}


/******************************************/
/************** PROGRAMA PRINCIAL *********/
/******************************************/
/** 
 * @var int $opcion, $CANT_INTENTOS
 * @var array $coleccionPalabras ,$coleccionJuegos
 * @var int $indiceJuego 
 */
define("CANT_INTENTOS",6); //Constante en php para cantidad de intentos que tendrá el jugador para adivinar la palabra.

$coleccionPalabras = cargarPalabras();
$coleccionJuegos = cargarJuegos();

do {
    $opcion = seleccionarOpcion();
    switch ($opcion) {   //La sentencia SWiTCH es similar a una serie de sentencias IF en la misma expresión.
        case 1: //Jugar con una palabra aleatoria
            $coleccionJuegos = jugarPalabraAleatoria($coleccionPalabras,$coleccionJuegos,CANT_INTENTOS);
            break;
        case 2: //Jugar con una palabra elegida
            $coleccionJuegos = jugarPalabraElegida($coleccionPalabras,$coleccionJuegos,CANT_INTENTOS);
            break;
        case 3: //Agregar una palabra al listado
            $coleccionPalabras = agregarPalabra($coleccionPalabras);
            break;
        case 4: //Mostrar la información completa de un número de juego
            mostrarJuegoElegido($coleccionJuegos,$coleccionPalabras);
            break;
        case 5: //Mostrar la información completa del primer juego con más puntaje
            mostrarJuegoMayorPuntaje ($coleccionJuegos,$coleccionPalabras);
            break;
        case 6: //Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario
            mostrarJuegoMayorPuntajeDado ($coleccionJuegos,$coleccionPalabras);
            break;
        case 7: //Mostrar la lista de palabras ordenada por orden alfabetico
            mostrarPalabrasOrdenadas($coleccionPalabras);
            break;
    }
} while ($opcion != 8);
