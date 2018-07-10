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
        
        <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;  /* The height is 400 pixels */
            width: 90%;  /* The width is the width of the web page */
        }
        </style>
    </head>
    <body class="backgroundColor">
        <div class="container">
        	<h1 class="text-center light-white"><strong>BusTop</strong></h1>
            <hr/>
            <div class="col-xs-8" id="search">
            	<br>
                <div class="row" id="search-text">
                	<form id="search-form" action="" method="POST" enctype="multipart/form-data">
                    	 <div class="col-xs-9">
                        	<input class="form-control" type="text" placeholder="Digite o endereco" />
                         </div>
    					 <div class="col-xs-3">
            				<button class="btn btn-block btn-danger" type="submit">Buscar</button>
                         </div>
                	</form>
                </div>
                <br>
            	<div class="row" id="search-filter">
            		<form>
    					<div class="col-xs-12">
                    			<select class="filter form-control">
                    				<option value="">Selecione uma opcao</option>
                    				<option value="">Onibus em Movimento</option>
                    				<option value="">Paradas de Onibus</option>
                    			</select>
                        </div>
            		</form>
            	</div>
            </div>

           	<div class="col-xs-4">
           		<div class="col-xs-12 headerColor">
           			<h4 class="text-right"><strong>Integrantes do grupo:</strong></h4>
   					<h5 class="text-right">Fabiano Figueira Fernandes Sampaio - 9074802</h5>            		
   					<h5 class="text-right">Fernando Gavinhos dos Santos - 8516563</h5> 
   					<h5 class="text-right">Renan Rodrigues Goncalves - 9065718</h5>            		
           		</div>
           	</div>
        </div>
        <div class="container" id="map">
            <hr/>
        	<div class="row">
                <div class="col-xs-12 mapStyle">
                    <script>
                        // Initialize and add the map
                        function initMap() {
                        var uluru = {lat: -23.483486, lng: -46.501887};
                        var map = new google.maps.Map(
                            document.getElementById('map'),
                            {zoom: 20, center: uluru}
                        );
                        var marker = new google.maps.Marker({position: uluru, map: map});
                        }
                    </script>
                    
                    <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADUk4Y_cwF5ObmSJTMZ8w3L2g6E-GZEE4&callback=initMap">
                    </script>
                </div>
           </div>
           
            <?php
                require './vendor/autoload.php';

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

        </div>

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
