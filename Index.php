<!doctype html>
<html lang="en">
<head>

<?php

session_start();
include('php/connect.php');

$sql = "SELECT * FROM trees order by id DESC limit 300";
$sql2 = "SELECT * FROM trees ORDER BY areaName";

$result = mysqli_query($link, $sql);
$result2 = mysqli_query($link, $sql2);

if (!$result) {
    echo "Ошибка ($sql) from DB: " . mysqli_error();
    exit;
}
else{
    //echo "подключение";
}

if (!$result2) {
    echo "Ошибка ($sql2) from DB: " . mysqli_error();
    exit;
}
else{
    //echo "подключение";
}

while ($row = mysqli_fetch_assoc($result))
{
   	$lat = $row['lat'];
   	$lon = $row['lon'];
   	$point = $lat.",".$lon;
   	$masspoint[] = $point;

	//for searching 1st row  
   	$idForSearch = $row['id'];
	$idArray[] = $idForSearch;

	//for 2 option filter area and specie
	$areaNameOption = $row['areaName'];
	$specieOption = $row['specie'];

	$areaNameArray[] = $areaNameOption;
	$specieArray[] = $specieOption;


	$id = "id: " . $row['id'] . " <br>";
	$specie = "Тип: " . $row['specie'] . " <br>";
	$contractor = "Подрядчик: ". $row['contractor'] . " <br>";
	$property = "Категория: " . $row['property'] . " <br>";
	$areaName = "Место: " . $row['areaName'] . " <br>";

	$treeInfo = $id. " " . $specie . " " . $contractor . " " . $property . " " . $areaName;
	$treeInfoArray[] = $treeInfo;
}

$areaNameTemp = "dsadsaddsa";
while ($row2 = mysqli_fetch_assoc($result2))
{
	$areaNameUnique = $row2['areaName'];

	if (strcmp($areaNameUnique, $areaNameTemp) == 0) {
		
	} else {

			$lat2 = $row2['lat'];
			$lon2 = $row2['lon'];

			$point2 = $lat2.",".$lon2;
			$masspoint2[] = $point2;

			$id2 = "id: " . $row2['id'] . " <br>";
			$specie2 = "Тип: " . $row2['specie'] . " <br>";
			$contractor2 = "Подрядчик: ". $row2['contractor'] . " <br>";
			$property2 = "Категория: " . $row2['property'] . " <br>";
			$areaName2 = $row2['areaName'];

			// $areaName2ForBalloon = $row['areaName'];
			$areaName2ForBalloonArray[] = $areaName2;

			$treeInfo2 = $id2. " " . $specie2 . " " . $contractor2 . " " . $property2 . " " . $areaName2;
			$treeInfoArray2[] = $treeInfo2;
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
                            <!-- <input id="match" /> -->
        </div> 

		<div class="card-body">
            <table class="table table-hover" >
                <thead>
                    <tr>
                        <th scope="col">Id дерева</th>
                        <th scope="col">Вид</th>
                        <th scope="col">Название парка</th>
                        <th scope="col">Property</th>
                        <th scope="col">Подрядчик</th>
                        <th scope="col">Возраст дерева</th>
                        <th scope="col">Grade</th>
						<th scope="col">Полив</th>
						<th scope="col">val poliv</th>
                        <th scope="col">Обновить строку</th>
                    </tr>
                </thead>
                <tbody id="searchTree" >
					<td><input class="form-control rounded" id="poliv" placeholder="Полив" aria-label="Send"/></td>
                </tbody>
            </table>
        </div>


		<div style="margin-top:5px">
		<div id="map" style="width: 100%; height:800px"></div>
		</div>

	</div>

	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=d811ec43-1783-4052-a752-a52f361f333d" type="text/javascript"></script>
	<!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> -->
	<script type="text/javascript">
	// ymaps.ready(init);


	function init() {
		var myMap = new ymaps.Map("map", {
			center: [<?php echo $masspoint2[0];?>],
			zoom: 16
		}, {
			searchControlProvider: 'yandex#search'
		});

	
		var myCollection = new ymaps.GeoObjectCollection(); 
	
		<?php for ($i=0;$i<count($masspoint2);$i++): ?>
	
		var myPlacemark = new ymaps.Placemark([
			<?php echo $masspoint2[$i]; ?>
		], {
			hintContent: '<?php echo "Название парка: " . $areaName2ForBalloonArray[$i]; ?>'
		}, {
			hasBalloon: false,
			preset: 'islands#icon',
			iconColor: '#0000ff'
		});
	
	
		myCollection.add(myPlacemark);
		myPlacemark.events.add('click', function () {
			var areaName = '<?php echo $areaName2ForBalloonArray[$i];?>';
			MapsLoadTreeByArea(areaName);
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
			MapsLoadTreeById(id);
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

			MapsLoadTreeByArea(area);

		} else if (area == null && specie != null) {

			MapsLoadTreeBySpecie(specie);
		
		} else 	{

			MapsLoadTreeByAreaSpecie(area, specie);
		}

		});

	}

	ymaps.ready(init);

	function MapsLoadTreeByAreaSpecie(area, specie){
		$('#map').empty();

		var myMap = new ymaps.Map("map", {
			center: [52.269053, 76.961113],
			zoom: 12
		}, {
			searchControlProvider: 'yandex#search'
		});
		
		var myCollection = new ymaps.GeoObjectCollection();

		<?php for ($i=0;$i<count($idArray);$i++): ?>
			
			var areaNameConverted = "<?php echo $areaNameArray[$i]; ?>";
			var specieConverted = "<?php echo $specieArray[$i]; ?>";
			console.log(areaNameConverted);
			console.log(specieConverted);
			
			if (( (area.localeCompare(areaNameConverted) == 0) && (specie.localeCompare(specieConverted) == 0) ) ||
			((area.localeCompare(areaNameConverted) == 0 && specie == null ))){
				
				var myPlacemark = new ymaps.Placemark([
					<?php echo $masspoint[$i]; ?>
				], {
					balloonContent: '<?php echo $treeInfoArray[$i] . "<br>" . "<button>Перейти</button>"  . "<br><br>" ?>'
				}, {
					preset: 'islands#icon',
					iconColor: '#0000ff'
				});
				myCollection.add(myPlacemark);
			}

		<?php endfor; ?>

		myMap.geoObjects.add(myCollection);

		// Сделаем у карты автомасштаб чтобы были видны все метки.
		myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});

	}

	function MapsLoadTreeByArea(area){
		$('#map').empty();

		var myMap = new ymaps.Map("map", {
			center: [52.269053, 76.961113],
			zoom: 12
		}, {
			searchControlProvider: 'yandex#search'
		});
		
		var myCollection = new ymaps.GeoObjectCollection();

		<?php for ($i=0;$i<count($idArray);$i++): ?>
			
			var areaNameConverted = "<?php echo $areaNameArray[$i]; ?>";
			console.log(areaNameConverted);
	
			
			if (( (area.localeCompare(areaNameConverted) == 0))){
				
				var myPlacemark = new ymaps.Placemark([
					<?php echo $masspoint[$i]; ?>
				], {
					hintContent: '<?php echo $treeInfoArray[$i];?>'
				}, {
					hasBalloon: false,
					preset: 'islands#icon',
					iconColor: '#0000ff'
				});
				myCollection.add(myPlacemark);

				myPlacemark.events.add('click', function () {
					var idOfTree  = '<?php echo $idArray[$i];?>';
					listTreesSelected(idOfTree);
					console.log(idOfTree);
        		});
			}

		<?php endfor; ?>

		myMap.geoObjects.add(myCollection);

		// Сделаем у карты автомасштаб чтобы были видны все метки.
		myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});

	}

	function MapsLoadTreeBySpecie(specie){
		$('#map').empty();

		var myMap = new ymaps.Map("map", {
			center: [52.269053, 76.961113],
			zoom: 12
		}, {
			searchControlProvider: 'yandex#search'
		});
		
		var myCollection = new ymaps.GeoObjectCollection();

		<?php for ($i=0;$i<count($idArray);$i++): ?>
			
			var specieConverted = "<?php echo $specieArray[$i]; ?>";
			console.log(specieConverted);
	
			
			if (( (specie.localeCompare(specieConverted) == 0))){
				
				var myPlacemark = new ymaps.Placemark([
					<?php echo $masspoint[$i]; ?>
				], {
					balloonContent: '<?php echo $treeInfoArray[$i] . "<br>" . "<button>Перейти</button>"  . "<br><br>" ?>'
				}, {
					preset: 'islands#icon',
					iconColor: '#0000ff'
				});
				myCollection.add(myPlacemark);
			}

		<?php endfor; ?>

		myMap.geoObjects.add(myCollection);

		// Сделаем у карты автомасштаб чтобы были видны все метки.
		myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});

	}


	function MapsLoadTreeById(id){
        $('#map').empty();

		var myMap = new ymaps.Map("map", {
			center: [52.269053, 76.961113],
			zoom: 12
		}, {
			searchControlProvider: 'yandex#search'
		});


		var myCollection = new ymaps.GeoObjectCollection(); 
	
		<?php for ($i=0;$i<count($idArray);$i++): ?>

			if (<?php echo $idArray[$i]; ?> == id){

				var myPlacemark = new ymaps.Placemark([
					<?php echo $masspoint[$i]; ?>
				], {
					balloonContent: '<?php echo $treeInfoArray[$i] . "<br>" . "<button>Перейти</button>"  . "<br><br>" ?>'
				}, {
					preset: 'islands#icon',
					iconColor: '#0000ff'
				});
				myCollection.add(myPlacemark);
			}
				<?php endfor; ?>
			
			myMap.geoObjects.add(myCollection);

			// Сделаем у карты автомасштаб чтобы были видны все метки.
		myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});
    }

	function deleteRow(btn , id, poliv ) {
		console.log(id);
			console.log(poliv);
			
			// treeUpdatePoliv(id, polivFromInput);

            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
			alert("Полив обновлен");

    }
	

	function listTreesSelected(id)
        {
            jQuery.ajax({
                type: 'POST',
                url: 'php/requests.php',
                data:{
                    id: id
                },
                success: function(data){
                    console.log("Tree of park:");
                    tenantsList = JSON.parse(data);
                    console.log("Tree of park :"+ tenantsList);
                        $.each(tenantsList, function(key1){
                        $('#searchTree').append('<tr>\
                                                    <td>'+tenantsList[key1].id+'</td>\
                                                    <td>'+tenantsList[key1].specie+'</td>\
                                                    <td>'+tenantsList[key1].areaName+'</td>\
                                                    <td>'+tenantsList[key1].property+'</td>\
                                                    <td>'+tenantsList[key1].contractor+'</td>\
                                                    <td>'+tenantsList[key1].age+'</td>\
                                                    <td>'+tenantsList[key1].grade+'</td>\
													<td><input class="form-control rounded" id="poliv" placeholder="Полив" aria-label="Send"/></td>\
													<td>'+$('#area').val()+'</td>\
													<td><button type="button" class="btn btn-info" onclick=deleteRow(this,'+tenantsList[key1].id+','+$('#poliv').val()+'); >'+"Обновить"+'</button></td>\
                                                </tr>');						
                        });    
                }
            });
        }

		function treeUpdatePoliv(id, poliv)
        {
			console.log("xlixked"+poliv);
            // jQuery.ajax({
            //     type: 'POST',
            //     url: 'php/updatePoliv.php',
            //     data:{
            //         id: id,
			// 		poliv: poliv
            //     },
            //     success: function(data){
            //         console.log("Tree of park:");
            //         tenantsList = JSON.parse(data);
            //         console.log("Tree of park :"+ tenantsList);
                       
            //     }
            // });
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

