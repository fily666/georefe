<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
	<div id="map" style="width: 100%;height: 1000px;"></div>
	
    
    <script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-8wZz-ns8U051dxYcWQLaR-tMC4cw4NA&libraries=places"
	></script>
	<script type="text/javascript"  src="https://code.jquery.com/jquery-2.1.0.min.js"
    ></script>
    <script>


	var recibo = JSON.parse('<?php echo $direccion;?>');
    const getLocations = () => {
    fetch('https://www.datos.gov.co/resource/g373-n3yy.json')
    .then(response => response.json())
    .then(locations => {
		let locationsInfo = []
		var locations = JSON.parse('<?php echo $direccion;?>');
		
        locations.forEach(location => {
			
			if(location.mapa === 1){
				 if(location.map_lat === null || location.map_lng === null){
					localizar("mapa-geocoder", location.direccion+" "+location.ciudad.valor, location.id, "Si_gts")
				}
				var locationData = {
                position:{lat:location.map_lat,lng:location.map_lng},
				name:location.direccion+" Tel: "+ location.telefono,
				icon:'img/mapa1.png' 		
				} 
				
			}else{
				if(location.map_latitud === null || location.map_longitud === null){
					if(location.direccion  === null){
						location.direccion = "sin direccion";
					}
					
					localizar("mapa-geocoder", location.direccion, location.id, "SiDatosBasicos")
				}
				var locationData = {
				position:{lat:location.map_latitud,lng:location.map_longitud},
				name:location.nombres+"  "+ location.apellidos,    	 
				icon:'img/map.png' 	
				} 
			}	 
			
            locationsInfo.push(locationData)
		})
	//}
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition((data)=>{
                let currentPosition = {
                    lat: data.coords.latitude,
                    lng: data.coords.longitude
                }
                dibujarMapa(currentPosition, locationsInfo)
            })
			
        }
    })
}

const dibujarMapa = (obj, locationsInfo) => {
   let map = new google.maps.Map(document.getElementById('map'),{
        zoom: 12,
        center: obj
    })

    let marker = new google.maps.Marker({
        
    })
    marker.setMap(map)

    let markers = locationsInfo.map(place => {
		
			return new google.maps.Marker({
            position: place.position,
			map: map,
			title: place.name,
			icon:place.icon
        	})
		
        
    })
}
window.addEventListener('load',getLocations)

function localizar(elemento,direccion, id, controler) {
		var geocoder = new google.maps.Geocoder();
		if (direccion == "sin direccion"){

		}else{
		geocoder.geocode({'address': direccion}, function(results, status) {
		if (status === 'OK') {
			var resultados = results[0].geometry.location,
				resultados_lat = resultados.lat(),
				resultados_long = resultados.lng();
				
				var map_lat = resultados_lat = resultados.lat();
				var map_lng = resultados_lng = resultados.lng();
			var dato = id+"/"+map_lat+"/"+map_lng+"/"+controler;
				
				$.ajax({
					data : {dato:dato},
					url :'<?= $this->Url->build(array('action' => 'pinta')) ?>/',
					type : 'post',
					success : function(json) {
						//console.log(json);
					}
				}); 
				 
		} 
		});
		}
	}
	
    


        </script>
</body>

</html>