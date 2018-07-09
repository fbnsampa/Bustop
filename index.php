<!DOCTYPE html>
<html>
    <head>
        <title>BusTOP</title>
        
        <!--define a viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        
        
        <!-- adicionar CSS Bootstrap-->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
        
        <!-- adicionar CSS Personalizado-->
        <link href="css/style.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <h1>Olá Mundolalalala!</h1>

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        
        <?php
        use LuizCesar\OlhoVivoAPI\Bulletins\ArrivalForecast;
        use LuizCesar\OlhoVivoAPI\Entities\BusLine;
        use LuizCesar\OlhoVivoAPI\Entities\BusStop;
        use LuizCesar\OlhoVivoAPI\OlhoVivo;
        
        //get an instance of OlhoVivo object
        $spTrans = OlhoVivo::getInstance();
        
        $aBusLine = ($spTrans->seekLines("875A",BusLine::WAY_FIRST_LEG))[0]; //The first match of a line search
        $busStops = $spTrans->seekBusStopsByLine($aBusLine); //all stops served by $aBusLine
        $aBusStop = $busStops[rand(0,count($busStops)-1)]; //get a random bus stop of $busStops'
        
        //Get a Map of all Lines that have buses forecasted to arrive on the chosen bus stop.
        $arrivalForecast = $spTrans->getArrivalForecastByStop($aBusStop);
        $arrivalsMap = $arrivalForecast->getArrivalsMap(); //Map of Lines and array of buses
        
        echo "Arrival forecast for bus stop at {$aBusStop->getName()}" . PHP_EOL .
        "Issued at: {$arrivalForecast->getTime()}" . PHP_EOL;
        
        //The way to iterate over SplObjectStorage objects.
        foreach($arrivalsMap as $line)
        {
            echo "{$line->getFullSignCode()} {$line->getActualSignName()}" . PHP_EOL .
            "\t_______________________________" . PHP_EOL .
            "\t| Time  | Bus Id | Accessible |" . PHP_EOL .
            "\t|-------|--------|------------|" . PHP_EOL;
            foreach($arrivalsMap[$line] as $busForecast)
                echo "\t| {$busForecast->getTime()} | {$busForecast->getBus()->getId()}  |    " .
                ($busForecast->getBus()->isAcc() == true ? ' YES' : ' NO ') . "    |" . PHP_EOL;
                echo "\t===============================" . PHP_EOL . PHP_EOL;
        }
        ?>
    </body>
</html>