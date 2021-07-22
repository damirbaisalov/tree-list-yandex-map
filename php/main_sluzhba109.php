<?php
    session_start();
    include('api/mydb.php');
    
    $menu_page='Главная';
    include('top.php');
?>
  <head>
    <link rel="stylesheet" href="css/request.css">
  </head>
  <?
  $col = 0;
  $col_new = 0;
  $col_god = 0;
  $ksk_id =  $_SESSION['ksk_id'];
  $sqlcol = "SELECT * FROM reqestDoma WHERE `ksk_id` = '$ksk_id'";
  $result = mysql_query($sqlcol) or die (mysql_error());
  while ($itog = mysql_fetch_array($result, MYSQL_ASSOC))
  {
    $col++;
  }
  ///////////////////////////////
  $sqlcol = "SELECT * FROM reqestDoma WHERE status = 5 AND `ksk_id` = '$ksk_id'";
  $result = mysql_query($sqlcol) or die (mysql_error());
  while ($itog = mysql_fetch_array($result, MYSQL_ASSOC))
  {
    $col_new++;
  }
  ////////////////////////////////
  $sqlcol = "SELECT * FROM reqestDoma WHERE status = 1 AND `ksk_id` = '$ksk_id'";
  $result = mysql_query($sqlcol) or die (mysql_error());
  while ($itog = mysql_fetch_array($result, MYSQL_ASSOC))
  {
    $col_god++;
  }
  ////////////////////////////////
  $sqlcol = "SELECT * FROM Doma2 WHERE ksk_id = '$ksk_id'";
  $result = mysql_query($sqlcol) or die (mysql_error());
  while ($itog = mysql_fetch_array($result, MYSQL_ASSOC))
  {
      $col_home++;
  }
  ////////////////////////////////
  $sqlcol = "SELECT * FROM `KSK`";
  $result = mysql_query($sqlcol) or die (mysql_error());
  while ($itog = mysql_fetch_array($result, MYSQL_ASSOC))
  {
      $col_ksk++;
  }
  ?>

<div class="page-content d-flex align-items-stretch" style = "margin-bottom: 40px"> 
           
            
            <!-- <div class="content-inner"> -->
            <div class="container-fluid">
              <header class="page-header">
                  <div class="container-fluid">
                  <h2 class="no-margin-bottom"><?echo $menu_page;?></h2>
                  
                  <div class="col-6 input-group rounded"  >
                    <input type="search" class="form-control rounded" id="street" placeholder="Улица" aria-label="Search"
                        aria-describedby="search-addon" />
                    <input type="search" class="col-8 form-control rounded" id="nomer" placeholder="номер" aria-label="Search"
                    aria-describedby="search-addon" />    
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fa fa-search"></i>
                    </span>
                    <!-- <input id="match" /> -->
                    </div>
                  
                    <div id="display"></div>
                  </div>
                </header>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" >
                                <thead>
                                <tr>
                                    <th scope="col">Улица</th>
                                    <th scope="col">Номер квартиры</th>
                                    <th scope="col">Дата отключения</th>
                                    <th scope="col">Дата устранения</th>
                                    <th scope="col">Причина отключения</th>
                                    <th scope="col">Обращение</th>
                                    <th scope="col">Кому</th>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Номер телефона</th>
                                    <th scope="col">Удалить</th>
                                </tr>
                                </thead>
                                <tbody id="searchDom" >
                               
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 input-group rounded mb-3"  >
                            <input type="search" class="form-control rounded" style="width:30%" id="request" placeholder="Обращение" aria-label="Send"
                                aria-describedby="send-addon" />
                            <!-- <input type="search" class="col-8 form-control rounded" id="dlya_kogo" placeholder="Кому" aria-label="Send"
                            aria-describedby="send-addon" />     -->
                            <select class="form-control rounded" aria-label="Default select example" id="dlya_kogo">
                                <!-- <option selected>Выберите к какой инстанции отправить обращение</option> -->
                                <option selected value="КСК">КСК</option>
                                <option value="Жилищная инспекция">Жилищная инспекция</option>
                                <option value="Тепловые сети">Тепловые сети</option>
                            </select> 
                            <input type="search" class=" form-control rounded" id="fio" placeholder="ФИО" aria-label="Send"
                                aria-describedby="send-addon" />
                            <input type="search" class=" form-control rounded"  id="phone_number" placeholder="Номер телефона" aria-label="Send"
                            aria-describedby="send-addon" />    
                            <span class="input-group-rounded border-0" id="send-addon">
                            <button type="button" id="13"  class="btn btn-primary">Сохранить</button>
                            </span>
                            <!-- <input id="match" /> -->
                        </div>    
                    </div>
                </div>
                <div>
                
                </div>
                <div class="container-fluid mt-4">
                
                    <div class="col-md-12">
                        <div class="card map">
                            <div class="card-header">
                                <!-- <h5>Карта </h5> -->
                               <button type="button" id="12" stat="status_voda" class="btn btn-primary">Все дома</button> 

                            </div>
                                <div id="map" style="height: 500px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
         
</div>

<div style="position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  ">
  <?include('footer.php');?>
<div>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<!-- <script src="https://api-maps.yandex.ru/2.1/?apikey=b50edc77-a0e6-4e06-afb9-6a840ea522e4&lang=ru_RU"type="text/javascript"></script> -->
<script src="https://api-maps.yandex.ru/2.1/?apikey=c131dc74-f712-474d-8019-43a5c25a4d0f&lang=ru_RU"type="text/javascript"></script>
<!-- <script src="https://api-maps.yandex.ru/2.1/?apikey=ef104891-741d-4e06-930b-92abad06b41f&lang=ru_RU"type="text/javascript"></script> -->
<!-- JS file -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>


<script type="text/javascript">

$('#search-addon').click(function(){
    // address= $(this).attr('stat');
    var street = $('#street').val();
    var nomer = $('#nomer').val();

    console.log("street " + street + " "+ nomer);
    ListDoma(street,nomer);
    MapsLoadDom(street , nomer);
  });
  var options = {
	data: [],
	list: {
		match: {
			enabled: true
		}
	}
  };
  var options2 = {
	data: [],
	list: {
		match: {
			enabled: true
		}
	}
  };
    
  $("#street").easyAutocomplete(options);
  $("#nomer").easyAutocomplete(options2);


    function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            }
    function ListDoma(street , nomer)
        {
            $.ajax({
                type: 'POST',
                url: 'api/getZadvizhki.php',
                data:{
                    street:street,
                    nomer:nomer
                },
                success: function(data){
                    console.log("Doma gde off :"+ data);
                    tenantsList = JSON.parse(data);
                    console.log("Doma gde off  парсед :"+ tenantsList);
                        $.each(tenantsList, function(key1, data1){
                        $('#searchDom').append('<tr>\
                                                    <td>'+tenantsList[key1].street+'</td>\
                                                    <td>'+tenantsList[key1].nomer+'</td>\
                                                    <td>'+tenantsList[key1].data_otkl+'</td>\
                                                    <td>'+tenantsList[key1].data_ustr+'</td>\
                                                    <td>'+tenantsList[key1].prich_ots+'</td>\
                                                    <td>'+tenantsList[key1].obrashenie+'</td>\
                                                    <td>'+tenantsList[key1].dlya_kogo+'</td>\
                                                    <td>'+tenantsList[key1].fio+'</td>\
                                                    <td>'+tenantsList[key1].phone_number+'</td>\
                                                    <td><button type="button" class="btn btn-primary" onclick=console.log("вава"+deleteRow(this))>'+"Удалить"+'</button></td>\
                                                </tr>');						
                        });
                        
                }
            });
        }
    
    
    function unique(arr) {
    
        let result = [];

        for (let str of arr) {
            if (!result.includes(str)) {
            result.push(str);
            options.data.push(str);

            }
        }

        return result;
    }

    function unique2(arr) {
        let result = [];

        for (let str of arr) {
            if (!result.includes(str)) {
            result.push(str);
            options2.data.push(str);

            }
        }

    return result;
    }
    function MapsLoadVoda(stat){
    $('#map').empty();
    ymaps.ready(function () {
        var map = new ymaps.Map("map", {
            center: [52.269053, 76.961113],
            zoom: 10
        });

        map.geoObjects.events.add('click', function (e) {
            var object = e.get('target');
        });

        $.ajax({
            type: 'POST',
            url: 'api/Maps_KSK_all_new.php',
            data:{stat:stat},
            success: function(data){
                
                // console.log("Data :"+ data);
                spisokZakaz = JSON.parse(data);
                // street = spizokZakaz.map((item))
                // street = unique(spisokZakaz.map((item) => (item.street)));
                street = unique(spisokZakaz.map((item) => (item.street)));
                nomer = unique2(spisokZakaz.map((item) => (item.nomer)));

                console.log("street :"+ street);
                console.log("nomer :"+ nomer);

                // options.data.push(street);
                console.log("street фкк :"+ options.data);

                $.each(spisokZakaz, function(key1, data1){
                    adres = "Павлодар"+spisokZakaz[key1].street+" "+spisokZakaz[key1].nomer;
                    ymaps.geocode(adres,{
                        results: 1
                    }).then(function (res) {
                        // Выбираем первый результат геокодирования.
                        var firstGeoObject = res.geoObjects.get(0),
                            // Координаты геообъекта.
                            coords = firstGeoObject.geometry.getCoordinates(),
                            // Область видимости геообъекта.
                            bounds = firstGeoObject.properties.get('boundedBy');
                        
                        if(spisokZakaz[key1].status_voda == 0)
                        {
                            color = 'islands#darkBlueDotIcon';
                        }
                        
                        if(spisokZakaz[key1].status_voda==0){
                            myPlacemark = new ymaps.Placemark(coords,  {
                            balloonContentHeader: "Информация о доме",
                            balloonContentBody: "<a>http://ritualct.kz/smart_dom/homeTenants.php?home_id="+spisokZakaz[key1].id+"</a>",
                            hintContent: spisokZakaz[key1].street+ " " + spisokZakaz[key1].nomer  ,
                            
                            },
                            {
                                hasBalloon: false,
                                href: 'homeTenants.php?home_id='+spisokZakaz[key1].id+'',
                                preset: color
                            });}
                        
                        map.geoObjects.add(myPlacemark);
                        myPlacemark.events.add('click', function () {
                            var street = spisokZakaz[key1].street;
                            var nomer = spisokZakaz[key1].nomer;
                            ListDoma(street,nomer);
                            
                            ;
                        });
                        if(spisokZakaz[key1].status_voda==1){
                        myPlacemark.events.add('click', function (e) {
                        location = e.get('target').options.get('href');
                        console.log();
                        });}

                        
                    });
                });
            }
        });
    });}

    function MapsLoadDom(street , nomer){
        $('#map').empty();
        
        ymaps.ready(function () {
            var map = new ymaps.Map("map", {
                center: [52.269053, 76.961113],
            zoom: 12
        });
        map.geoObjects.events.add('click', function (e) {
            var object = e.get('target');
        });

        adres = "Павлодар"+street+" "+nomer;
        ymaps.geocode(adres,{
                results: 1
            }).then(function (res) {
                // Выбираем первый результат геокодирования.
            var firstGeoObject = res.geoObjects.get(0),
                // Координаты геообъекта.
                coords = firstGeoObject.geometry.getCoordinates(),
                // Область видимости геообъекта.
                bounds = firstGeoObject.properties.get('boundedBy');
            
                // if(spisokZakaz[key1].status_voda==0){
                myPlacemark = new ymaps.Placemark(coords,  {
                balloonContentHeader: "Информация о доме",
                hintContent: street+ " " + nomer  ,

                },
                {
                    hasBalloon: false,
                    preset: 'islands#darkBlueDotIcon'
                });
                    // }
                            
                map.geoObjects.add(myPlacemark);
            });    
        });
    }
    
window.onload = function(){
    stat= "status_voda";
  console.log(stat);	
  let zadvizh = '';
  MapsLoadVoda(stat  );
}

  $('#12').click(function(){
    stat= $(this).attr('stat');
  console.log(stat);	
  MapsLoadVoda(stat);
  });
  $('#13').click(function(){
    var street = $('#street').val();
    var nomer = $('#nomer').val();
    var request = $('#request').val();
    var dlya_kogo = $('#dlya_kogo').val();
    var fio = $('#fio').val();
    var phone_number = $('#phone_number').val();
    console.log("Request: "+ request);
    console.log("dlya_kogo: "+ dlya_kogo);	
    console.log("fio: "+ fio);	
    console.log("phone_number: "+ phone_number);
    sendReq109(street , nomer , request , dlya_kogo, fio, phone_number)
	

  });

  function sendReq109(street , nomer , request , dlya_kogo, fio, phone_number)
        {
            $.ajax({
                type: 'POST',
                url: 'api/sendReq109.php',
                data:{
                    street:street,
                    nomer:nomer,
                    request:request,
                    dlya_kogo:dlya_kogo,
                    fio:fio,
                    phone_number:phone_number,
                },
                success: function(data){
                    console.log("Responce :"+ data);
                    // tenantsList = JSON.parse(data);
                    // console.log("Doma gde off  парсед :"+ tenantsList);
                        // $.each(tenantsList, function(key1, data1){
                        // $('#searchDom').append('<tr>\
                        //                             <td>'+tenantsList[key1].street+'</td>\
                        //                             <td>'+tenantsList[key1].nomer+'</td>\
                        //                             <td>'+tenantsList[key1].data_otkl+'</td>\
                        //                             <td>'+tenantsList[key1].data_ustr+'</td>\
                        //                             <td>'+tenantsList[key1].prich_ots+'</td>\
                        //                             <td>'+tenantsList[key1].obrashenie+'</td>\
                        //                             <td>'+tenantsList[key1].dlya_kogo+'</td>\
                        //                             <td>'+tenantsList[key1].fio+'</td>\
                        //                             <td>'+tenantsList[key1].phone_number+'</td>\
                        //                             <td><button type="button" class="btn btn-primary" onclick=console.log("вава"+deleteRow(this))>'+"Удалить"+'</button></td>\
                        //                         </tr>');						
                        // });
                        
                }
            });
        }

</script>




<?php  for ($i=0;$i<count($idArray);$i++): ?>
			if (<?php echo $idArray[$i]; ?> == id){
				findedP =  <?php echo $masspoint[$i]; ?>
			}
		<?php endfor; ?>