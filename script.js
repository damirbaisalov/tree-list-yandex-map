include('Index.php');
ymaps.ready(init);
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
		balloonContent: '<?php echo $treeInfoArray[$i] . "<br>" . "<button>Перейти</button>"  . "<br><br>" ?>'
	}, {
		preset: 'islands#icon',
		iconColor: '#0000ff'
	});
	myCollection.add(myPlacemark);
	<?php endfor; ?>
 
	myMap.geoObjects.add(myCollection);
	
	// Сделаем у карты автомасштаб чтобы были видны все метки.
	myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});
}
