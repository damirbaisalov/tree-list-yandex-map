var myMap = new ymaps.Map("map", {
			center: [52.27401, 77.00438],
			zoom: 11
		}, {
			searchControlProvider: 'yandex#search'
		});

		var paintProcess;

		// Опции многоугольника или линии.
		var styles = [
			{strokeColor: '#ff00ff', strokeOpacity: 0.7, strokeWidth: 3, fillColor: '#ff00ff', fillOpacity: 0.4},
			{strokeColor: '#ff0000', strokeOpacity: 0.6, strokeWidth: 6, fillColor: '#ff0000', fillOpacity: 0.3},
			{strokeColor: '#00ff00', strokeOpacity: 0.5, strokeWidth: 3, fillColor: '#00ff00', fillOpacity: 0.2},
			{strokeColor: '#0000ff', strokeOpacity: 0.8, strokeWidth: 5, fillColor: '#0000ff', fillOpacity: 0.5},
			{strokeColor: '#000000', strokeOpacity: 0.6, strokeWidth: 8, fillColor: '#000000', fillOpacity: 0.3},
		];

		var currentIndex = 0;

		// Создадим кнопку для выбора типа рисуемого контура.
		var button = new ymaps.control.Button({data: {content: 'Обновить карту'}, options: {maxWidth: 150}});
		myMap.controls.add(button);

		button.events.add('click', function () {
			$('#map').empty();
			$('#area').empty();
			init();
		});

		// Подпишемся на событие нажатия кнопки мыши.
		myMap.events.add('mousedown', function (e) {
			// Если кнопка мыши была нажата с зажатой клавишей "alt", то начинаем рисование контура.
			if (e.get('altKey')) {
				if (currentIndex == styles.length - 1) {
					currentIndex = 0;
				} else {
					currentIndex += 1;
				}
				paintProcess = ymaps.ext.paintOnMap(myMap, e, {style: styles[currentIndex]});
			}
		});

		var myCollection = new ymaps.GeoObjectCollection(); 

			// Подпишемся на событие отпускания кнопки мыши.
		myMap.events.add('mouseup', async function (e) {
			var cnt = 0;
			cnt = parseInt(cnt);
			if (paintProcess) {

				// Получаем координаты отрисованного контура.
				var coordinates = paintProcess.finishPaintingAt(e);
				paintProcess = null;
				// В зависимости от состояния кнопки добавляем на карту многоугольник или линию с полученными координатами.
				var geoObject = new ymaps.Polygon([coordinates], {}, styles[currentIndex]);

				myCollection.add(geoObject);

				// await getAllTrees();
				<?php for ($i=0;$i<count($masspoint);$i++): ?> 
					if (geoObject.geometry.contains([<?php echo $masspoint[$i]; ?>]))
					 {
						var areaName = '<?php echo $areaNameForBalloonArray[$i];?>';
						console.log(areaName);
						await getCountTreesOfArea(areaName);
						var intVal = parseInt(getCountTreesOfAreaArray[0]["countTrees"]);
						cnt+= intVal;
					 }
				<?php endfor; ?>

			}
			alert("Сумма деревьев в полигоне: " + cnt);
		});



        async function getCountTreesOfArea(area) {
		await $.ajax({
			url:'php/requests.php',
			type:'post',
			cache:false,
			data:{
				'countTreesByArea': 'countTreesByArea',
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
				// returnLoadedSpeciesCountOfTress(data1);

				getCountTreesOfAreaArray = data1;
				console.log(getCountTreesOfAreaArray.length);
			}
		});	
	}