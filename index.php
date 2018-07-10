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
            width: 100%;  /* The width is the width of the web page */
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
                    <!-- <img src="img/westeros.jpg" alt="Imagem" class="img-responsive" />     -->
                </div>
                <script>
                    // Initialize and add the map
                    function initMap() {
                    // The location of Uluru
                    var uluru = {lat: -25.344, lng: 131.036};
                    // The map, centered at Uluru
                    var map = new google.maps.Map(
                        document.getElementById('map'), {zoom: 4, center: uluru});
                    // The marker, positioned at Uluru
                    var marker = new google.maps.Marker({position: uluru, map: map});
                    }
                </script>
                <!--Load the API from the specified URL
                * The async attribute allows the browser to render the page while the API loads
                * The key parameter will contain your own API key (which is not needed for this tutorial)
                * The callback parameter executes the initMap() function
                -->
                <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADUk4Y_cwF5ObmSJTMZ8w3L2g6E-GZEE4&callback=initMap">
                </script>
           </div>
        
        </div>


        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>