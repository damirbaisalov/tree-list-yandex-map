<!doctype html>
<html lang="en">
<head>

<?php

session_start();
include('php/connect.php');

$sql = "SELECT lat,lon,areaName FROM trees ORDER BY areaName";

$result = mysqli_query($link, $sql);

if (!$result) {
    echo "Ошибка ($sql) from DB: " . mysqli_error();
    exit;
}
else{
    //echo "подключение";
}

$areaNameTemp = "dsadsaddsa";
while ($row = mysqli_fetch_assoc($result))
{
	$areaNameUnique = $row['areaName'];

	if (strcmp($areaNameUnique, $areaNameTemp) == 0) {
		
	} else {

			$lat = $row['lat'];
			$lon = $row['lon'];
			$point = $lat.",".$lon;
			$masspoint[] = $point;

			$areaName = $row['areaName'];

			// $areaName2ForBalloon = $row['areaName'];
			$areaNameForBalloonArray[] = $areaName;
	}
	
	$areaNameTemp = $areaNameUnique;
}
?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- <script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script> -->
	<script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <title>Карта деревьев</title>
  </head>
  <body>

  <div  style = "height: 100%"> 
		<div style="margin-top: 5px; margin-left: 10px">
		<!-- <label for="fname">Поиск по id:</label><br>
		<input type="text" id="fname" name="fname" placeholder="Введите id"><button type="button" style="background-color: FFDB4D; color: black">Найти</button><br>
		</div> -->

		<div class="col-8 input-group rounded"  >
                    <input type="search" class="form-control rounded" id="id" placeholder="id" aria-label="Search"
                        aria-describedby="search-addon" />   
					<button type="button" id="search-addon" class="btn btn-primary ml-1">Поиск</button>
					<button type="button" id="search-all-tree" class="btn btn-dark ml-1" >Все деревья</button>
                    <!-- <input id="match" /> -->
        </div>

		<div class="col-8 input-group rounded mb-3" style="margin-top: 10px"  >
                            <select class="form-control rounded" aria-label="Default select example" id="area">
                                <!-- <option selected>Выберите к какой инстанции отправить обращение</option> -->
                                <option disabled selected value> -- Выберите место -- </option>
								<option value="Сквер репрессивонных">Сквер репрессивонных</option>
                                <option value="Площадь Победы">Площадь победы</option>
                                <option value="Сквер Конституции">Сквер конституции</option>
                            </select>
							<select class="form-control rounded ml-1" aria-label="Default select example" id="specie">
                                <!-- <option selected>Выберите к какой инстанции отправить обращение</option> -->
                                <option disabled selected value> -- Выберите тип дерева -- </option>
								<option value="Береза">Береза</option>
                                <option value="Клён">Клён</option>
                                <option value="Карагач">Карагач</option>
								<option value="Сосна">Сосна</option>
								<option value="Ель">Ель</option>
								<option value="Береза бородавчатая">Береза бородавчатая</option>
								<option value="Тополь черный">Тополь черный</option>
								<option value="Яблоня ягодная">Яблоня ягодная</option>
								<option value="Смородина золотистая">Смородина золотистая</option>
								<option value="Яблоня">Яблоня</option>
								<option value="Лиственница">Лиственница</option>
								<option value="Рябина">Рябина</option>
								<option value="Ясень">Ясень</option>
								<option value="Акация">Акация</option>
								<option value="Тополь серебристый">Тополь серебристый</option>
								<option value="Вяз крупнолистный">Вяз крупнолистный</option>
								<option value="Ель колючая">Ель колючая</option>
								<option value="Клён татарский">Клён татарский</option>


                            </select> 
                            <button type="button" id="13" class="btn btn-primary ml-1">Сохранить</button>

							<!-- <input type="text" class="form-control rounded ml-5" id="poliv" placeholder="Полив" aria-label="Send"
                        	/>   
							<button type="button" id="update-poliv" class="btn btn-primary ml-1">Задать полив</button> -->
                            <!-- <input id="match" /> -->
        </div> 
	
		<div class="card-body">
            <table class="table table-hover" >
                <thead>
                    <tr>
                        <th scope="col">Id дерева</th>
                        <th scope="col">Вид</th>
                        <th scope="col">Название парка</th>
                        <th scope="col">Тип</th>
                        <th scope="col">Подрядчик</th>
                        <th scope="col">Возраст дерева</th>
                        <th scope="col">Статус дерева</th>
						<th scope="col">Срубить дерево</th>
                        <th scope="col">Паспорт дерева</th>
						<th scope="col">Удалить строку</th>
                    </tr>
                </thead>
                <tbody id="searchTree" >
                </tbody>
            </table>
        </div>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Задайте параметры для новых деревьев</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<h6>Название сквера:</h6>
				<input type="text" class="form-control rounded" id="newAreaName" aria-label="Send" disabled/>
				<h6 class="mt-2">Тип сквера:</h6>
				<input type="text" class="form-control rounded" id="newProperty" aria-label="Send" disabled/>
				<h6 class="mt-2">Подрядчик:</h6>
				<input type="text" class="form-control rounded" id="newContractor" aria-label="Send"/>
				<h6 class="mt-2">Вид дерева:</h6>  
				<input type="text" class="form-control rounded" id="newSpecie" placeholder="Вид" aria-label="Send"/>
				<h6 class="mt-2 mb-2">Количество:</h6>
				<input type="number" class="form-control rounded" id="newCountTree" placeholder="Количество деревьев" aria-label="Send"/>   
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" id="insert-tree-btn" class="btn btn-primary">Сохранить</button>
			</div>
			</div>
		</div>
		</div>

		<div style="margin-top:5px">
		<div id="map" style="width: 100%; height:350px"></div>
		</div>

	</div>

	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=d811ec43-1783-4052-a752-a52f361f333d" type="text/javascript"></script>
	<!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> -->
	<script type="text/javascript">
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	var curLat = 0;
	var curLon = 0;
	var curId = 0;
 
	function init() {
		var myMap = new ymaps.Map("map", {
			center: [<?php echo $masspoint[0];?>],
			zoom: 16
		}, {
			searchControlProvider: 'yandex#search'
		});

		var myCollection = new ymaps.GeoObjectCollection(); 
	
		<?php for ($i=0;$i<count($masspoint);$i++): ?>
	
		var myPlacemark = new ymaps.Placemark([
			<?php echo $masspoint[$i]; ?>
		], {
			hintContent: '<?php echo "Название сквера: " . $areaNameForBalloonArray[$i]; ?>'
		}, {
			hasBalloon: false,
			preset: 'islands#icon',
			iconColor: '#0000ff'
		});
	
		myCollection.add(myPlacemark);
		myPlacemark.events.add('click', function () {
			var areaName = '<?php echo $areaNameForBalloonArray[$i];?>';
			getTreesByArea(areaName);
        });
	
		<?php endfor; ?>

		myMap.geoObjects.add(myCollection);

		// Сделаем у карты автомасштаб чтобы были видны все метки.
		myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});

		//DEFINE SEARCH BUTTON
		$('#search-addon').click(function(){
		var id = $('#id').val();

		console.log(id);
		if (id == "") {
			$('#map').empty();
			init();
		} else {
			getTreesById(id);
		}
		});

		$('#search-all-tree').click(function(){
			$('#map').empty();
			init();
		});

		$('#13').click(function(){
		var area = $('#area').val();
		var specie = $('#specie').val();
		console.log(area);
		console.log(specie);
		
		if (area == null && specie == null) {

		} else if (specie == null && area != null) {
			getTreesByArea(area);
			// let timerId = setInterval(function() { getTreesFirstThread(area); }, 3000);
		} else if (area == null && specie != null) {
			getTreesBySpecie(specie);
		} else 	{
			getTreesBySpecieAndArea(area, specie);
		}
		});

		$('#insert-tree-btn').click(function() {
			console.log("hellow before");
			var newAreaName = $('#newAreaName').val();
			var newProperty = $('#newProperty').val();
			var newLat = curLat;
			var newLon = curLon;
			var newContractor = $('#newContractor').val();
			var newSpecie = $('#newSpecie').val();
			var count = $('#newCountTree').val();

			if (newSpecie.length == 0 || newContractor.length==0 || count<=0){
				alert("пожалуйста заполните все обязательные поля");

				$("#exampleModal").modal('show');

			} else {
				insertTree(newLat, newLon, newContractor,newSpecie,newAreaName,newProperty,count);
				console.log(newAreaName);
				console.log(newProperty);
				console.log(newLat);
				console.log(newLon);
				console.log(newContractor);
				console.log(newSpecie);
				console.log(count);
				console.log("hellow after");
				updateTreeStatusById(curId);
				console.log(curId);
				// window.location.reload(false);
				alert("Новый объект добавлен!");
				$("#exampleModal").modal('hide');
			}
		});

	}

	ymaps.ready(init);
////////////////////////////////////////////////////////////////////////////////////////////////////
	function deleteRow(btn , id, poliv, areaNameCol) {
			console.log(id);
			console.log(poliv);
			console.log(areaNameCol);
			
			treeUpdatePoliv(id, poliv, areaNameCol);

            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
			// alert("Полив обновлен");

    }

	function removeRow(btn) {


            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
			// alert("Полив обновлен");

    }
	

	function listTreesSelected(id)
        {
            jQuery.ajax({
                type: 'POST',
                url: 'php/requests.php',
                data:{
					'listTreesById' : 'listTreesById', 
                    id: id
                },
                success: function(data){
                    console.log("Tree of park:");
                    tenantsList = JSON.parse(data);
                    console.log("Tree of park :"+ tenantsList);
                        $.each(tenantsList, function(key1){
						var areaNameForChop = tenantsList[key1].areaName;
						var propertyForChop = tenantsList[key1].property;
						var contractorForChop = tenantsList[key1].contractor;
						curLat = tenantsList[key1].lat;
						curLon = tenantsList[key1].lon;	
						curId = tenantsList[key1].id;
						if ($('#searchTree').children().length == 0 ){
							$('#searchTree').append('<tr>\
                                                    <td>'+tenantsList[key1].id+'</td>\
                                                    <td>'+tenantsList[key1].specie+'</td>\
                                                    <td>'+tenantsList[key1].areaName+'</td>\
                                                    <td>'+tenantsList[key1].property+'</td>\
                                                    <td>'+tenantsList[key1].contractor+'</td>\
                                                    <td>'+tenantsList[key1].age+'</td>\
                                                    <td>'+tenantsList[key1].status+'</td>\
													<td><button type="button" id="open-model-btn" onclick="treeChopInfo(\''+areaNameForChop+'\',\''+propertyForChop+'\',\''+contractorForChop+'\')" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Срубить</button></td>\
													<td><a href="pages/treeInfo.php?id='+tenantsList[key1].id+'" class="btn btn-primary">Перейти</a></td>\
													<td><button class="btn btn-danger" onclick=(removeRow(this))>Удалить</button></td>\
                                                </tr>');

						} else {
							$("#searchTree").empty();
							$('#searchTree').append('<tr>\
                                                    <td>'+tenantsList[key1].id+'</td>\
                                                    <td>'+tenantsList[key1].specie+'</td>\
                                                    <td>'+tenantsList[key1].areaName+'</td>\
                                                    <td>'+tenantsList[key1].property+'</td>\
                                                    <td>'+tenantsList[key1].contractor+'</td>\
                                                    <td>'+tenantsList[key1].age+'</td>\
													<td>'+tenantsList[key1].status+'</td>\
													<td><button type="button" id="open-model-btn" onclick="treeChopInfo(\''+areaNameForChop+'\',\''+propertyForChop+'\',\''+contractorForChop+'\')" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Срубить</button></td>\
													<td><a href="pages/treeInfo.php?id='+tenantsList[key1].id+'" class="btn btn-primary">Перейти</a></td>\
													<td><button class="btn btn-danger" onclick=(removeRow(this))>Удалить</button></td>\
                                                </tr>');
						}				
                        });

						// $('#poliv-btn').click(function(){

						// 	var currentRow = $(this).closest("tr"); 
						// 	var col = currentRow.find("td:eq(7)").find('input').val();	
						// 	var idCol = currentRow.find("td:eq(0)").text();

						// 	var areaNameCol = currentRow.find("td:eq(2)").text();
							
						// 	deleteRow(this, idCol, col, areaNameCol);
						// });	

						// $('#open-model-btn').click(funcion() {
							
						// })
                }
            });
        }

	function treeChopInfo(areaName, property, contractor) {
		console.log(areaName);
		console.log(property);
		console.log(contractor);
		$('#newAreaName').val(areaName);
		$('#newProperty').val(property);
		$('#newContractor').val(contractor);
	}

		// function treeUpdatePoliv(id, poliv, areaNameCol)
        // {
		// 	console.log("clicked "+ poliv + " " + id);
        //     jQuery.ajax({
        //         type: 'POST',
        //         url: 'php/updatePoliv.php',
        //         data:{
        //             id: id,
		// 			poliv: poliv
        //         },
        //         success: function(data){
        //             // console.log("Tree of park:");
        //             // tenantsList = JSON.parse(data);
        //             // console.log("Tree of park :"+ tenantsList);

		// 			alert("ПОЛИВ ДЕРЕВА " + id + " ОБНОВЛЕН");
					
				
		// 			$('#map').empty();
		// 			// MapsLoadTreeByArea(areaNameCol);
		// 			init();
		// 			window.location.reload(false);
        //         }
        //     });
        // }
    

	
	
	
	function getTreesByArea(area){
		
			$.ajax({
			url:'php/requests.php',
			type:'post',
			cache:false,
			data:{
				'onlyArea': 'onlyArea',
				'area': area
			},
			dataType:'html',
			beforeSend: function(){
				console.log("Идет загрузка...");
			},
			success:function(data){
				// startFrom+=501;

				data1 = JSON.parse(data);
				console.log(data);
				loadTreesByArea(data1);

			}
			});	
	}

	function insertTree(lat,lon,contractor,specie,areaName,property,count){
		for (var i=0; i<count;i++) {

			$.ajax({
			url:'php/requests.php',
			type:'post',
			cache:false,
			data:{
				'insert_tree': 'insert_tree',
				'lat': lat,
				'lon': lon,
				'specie': specie,
				'contractor': contractor,
				'specie': specie,
				'area': areaName,
				'property': property
			},
			dataType:'html',
			beforeSend: function(){
				console.log("Идет загрузка...");
			},
			success:function(data){
				console.log(data);
			}
			});	
		}
	}

	function updateTreeStatusById(id){
		
		$.ajax({
		url:'php/requests.php',
		type:'post',
		cache:false,
		data:{
			'update_tree': 'update_tree',
			'id': id
		},
		dataType:'html',
		beforeSend: function(){
			console.log("Идет загрузка...");
		},
		success:function(data){
			console.log(data);
		}
		});	
	}

	function getTreesById(id){
		
		$.ajax({
		url:'php/requests.php',
		type:'post',
		cache:false,
		data:{
			'listTreesById' : 'listTreesById', 
            id: id
		},
		dataType:'html',
		beforeSend: function(){
			console.log("Идет загрузка...");
		},
		success:function(data){

			data1 = JSON.parse(data);
			console.log(data);
			loadTreesById(data1);

		}
		});	
	}

	function getTreesBySpecie(specie){
		
		$.ajax({
		url:'php/requests.php',
		type:'post',
		cache:false,
		data:{
			'onlySpecie' : 'onlySpecie',
			'specie': specie
		},
		dataType:'html',
		beforeSend: function(){
			console.log("Идет загрузка...");
		},
		success:function(data){

			data1 = JSON.parse(data);
			console.log(data);
			loadTreesBySpecie(data1);

		}
		});	
	}

	function getTreesBySpecieAndArea(area, specie){
		
		$.ajax({
		url:'php/requests.php',
		type:'post',
		cache:false,
		data:{
			'withSpecie' : 'withSpecie',
			'withArea' : 'withArea',
			'specie': specie, 
			'area': area
		},
		dataType:'html',
		beforeSend: function(){
			console.log("Идет загрузка...");
		},
		success:function(data){

			data1 = JSON.parse(data);
			console.log(data);
			loadTreesBySpecieAndArea(data1);

		}
		});	
	}

	function loadTreesBySpecieAndArea(data){
		$('#map').empty();

		var myMap1 = new ymaps.Map("map", {
			center: [52.269053, 76.961113],
			zoom: 12
		}, {
			searchControlProvider: 'yandex#search'
		});
		
		var myCollection1 = new ymaps.GeoObjectCollection();

		for(var i=0; i<data.length; i++){
			
			var dataConverted = convertDataForHintBalloon(data[i]);
			var selectedTreeId = data[i]["id"];

				var myPlacemark = new ymaps.Placemark([
					data[i]["lat"], data[i]["lon"]
				], {
					hintContent: dataConverted
				}, {
					hasBalloon: false,
					preset: 'islands#icon',
					iconColor: '#0000ff'
				});
				myCollection1.add(myPlacemark);

				myPlacemark.events.add('click', function () {
					listTreesSelected(selectedTreeId);
					console.log(selectedTreeId);
        		});
			
		}

		myMap1.geoObjects.add(myCollection1);

		// Сделаем у карты автомасштаб чтобы были видны все метки.
		myMap1.setBounds(myCollection1.getBounds(),{checkZoomRange:true, zoomMargin:9});
	}

	function loadTreesBySpecie(data){
		$('#map').empty();

		var myMap1 = new ymaps.Map("map", {
			center: [52.269053, 76.961113],
			zoom: 12
		}, {
			searchControlProvider: 'yandex#search'
		});
		
		var myCollection1 = new ymaps.GeoObjectCollection();

		for(var i=0; i<data.length; i++){
			
			var dataConverted = convertDataForHintBalloon(data[i]);
			var selectedTreeId = data[i]["id"];
			console.log(data[0]["specie"]);

				var myPlacemark = new ymaps.Placemark([
					data[i]["lat"], data[i]["lon"]
				], {
					hintContent: dataConverted
				}, {
					hasBalloon: false,
					preset: 'islands#icon',
					iconColor: '#0000ff'
				});
				myCollection1.add(myPlacemark);

				myPlacemark.events.add('click', function () {
					listTreesSelected(selectedTreeId);
					console.log(selectedTreeId);
        		});
			
		}

		myMap1.geoObjects.add(myCollection1);

		// Сделаем у карты автомасштаб чтобы были видны все метки.
		myMap1.setBounds(myCollection1.getBounds(),{checkZoomRange:true, zoomMargin:9});

	}


	function loadTreesByArea(data){
		$('#map').empty();

		var myMap1 = new ymaps.Map("map", {
			center: [52.269053, 76.961113],
			zoom: 12
		}, {
			searchControlProvider: 'yandex#search'
		});

		clusterer = new ymaps.Clusterer({
     
            preset: 'islands#icon',
			iconColor: '#0000ff',
           
            groupByCoordinates: false,
            
            clusterDisableClickZoom: true,
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        });
		
		var geoObjects = [];

		for(var i=0; i<data.length; i++){
	
			var dataConverted = convertDataForHintBalloon(data[i]);
			var selectedTreeId = data[i]["id"];

				var myPlacemark = new ymaps.Placemark([
					data[i]["lat"], data[i]["lon"]
				], {
					balloonContentBody: dataConverted,
					balloonContentFooter: '<button class="btn btn-primary" onclick=(listTreesSelected('+selectedTreeId+'))>Добавить дерево в таблицу</button>',
					clusterCaption: 'дерево <strong>' + data[i]["id"] + '</strong>'
				}, {
					hasBalloon: false,
					preset: 'islands#icon',
					iconColor: '#0000ff'
				});
				// myCollection1.add(myPlacemark);

				geoObjects[i] = myPlacemark;

				myPlacemark.events.add('click', function () {
					// var idOfTree  = data[i]["id"];
					listTreesSelected(selectedTreeId);
					console.log(selectedTreeId);
        		});
			
		}

		clusterer.options.set({
        gridSize: 80,
        clusterDisableClickZoom: true
    	});

		clusterer.add(geoObjects);
    	myMap1.geoObjects.add(clusterer);

		// myMap1.geoObjects.add(myCollection1);

		// Сделаем у карты автомасштаб чтобы были видны все метки.
		// myMap1.setBounds(myCollection1.getBounds(),{checkZoomRange:true, zoomMargin:9});

		myMap1.setBounds(clusterer.getBounds(), {
        checkZoomRange: true
   		 });

	}

	function loadTreesById(data){
		$('#map').empty();

		var myMap1 = new ymaps.Map("map", {
			center: [52.269053, 76.961113],
			zoom: 12
		}, {
			searchControlProvider: 'yandex#search'
		});
		
		var myCollection1 = new ymaps.GeoObjectCollection();

		var dataConverted = convertDataForHintBalloon(data[0]);
		var dataId = data[0]["id"];

		var myPlacemark = new ymaps.Placemark([
			data[0]["lat"], data[0]["lon"]
		], {
			hintContent: dataConverted
		}, {
			hasBalloon: false,
			preset: 'islands#icon',
			iconColor: '#0000ff'
		});
		myCollection1.add(myPlacemark);

		myPlacemark.events.add('click', function () {
			// var idOfTree  = data[i]["id"];
			listTreesSelected(dataId);
			console.log(dataId);
        });
			
		myMap1.geoObjects.add(myCollection1);

		// Сделаем у карты автомасштаб чтобы были видны все метки.
		myMap1.setBounds(myCollection1.getBounds(),{checkZoomRange:true, zoomMargin:9});

	}

	
	function convertDataForHintBalloon(data) {
		var id = "id: " + data["id"] + " <br>";
		var specie = "Тип: " + data["specie"] + " <br>";
		var contractor = "Подрядчик: " + data["contractor"] + " <br>";
		var property = "Категория: " + data["property"] + " <br>";
		var areaName = "Место: " + data["areaName"] + " <br>";
		var poliv = "Полив: " + data["poliv"] + " <br>";
		var status = "Статус: " + data["status"] + " <br>";

		var treeInfo = id + " " + specie + " " + contractor + " " + property + " " + areaName + " " + poliv + " " + status;

		return treeInfo;
	}


	</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

	<script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

