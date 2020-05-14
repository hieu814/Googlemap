var customLabel = {
    restaurant: {
      label: ''
    },
    bar: {
      label: ''
    }
  };

    function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(21.022966, 105.846092),
      zoom: 12
    });
    ////event
    map.addListener('click', function(e) {
      placeMarker(e.latLng, map);
      markers[markerId] = marker; // cache marker in markers object
  });
  
    var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP or XML file
      downloadUrl('data.php', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
          var id = markerElem.getAttribute('id');
          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var type = markerElem.getAttribute('type');
          var image = markerElem.getAttribute('image');
          var description = markerElem.getAttribute('description');
          var point = new google.maps.LatLng(
              parseFloat(markerElem.getAttribute('lat')),
              parseFloat(markerElem.getAttribute('lng')));

          var infowincontent = document.createElement('div');
          var strong = document.createElement('strong');
          strong.textContent = name
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var text = document.createElement('text');
          text.textContent = address
          infowincontent.appendChild(text);
          var icon = customLabel[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            label: icon.label
          });
          marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
            var inforstring =
            '</br>'+'<img src="'+image+'" alt="" width="100%" height="80%">'+
            '<b id="name">'+ name+'</b></br>'+
            '<a>'+ address+'</a></br>'+
            '<a>Mô tả:</a></br>'+
            '<a>'+description+'</a>';
            document.getElementById("infor").innerHTML = inforstring;
          });
        });
      });
    }

//add marker

    function placeMarker(position, map) {
      var marker = new google.maps.Marker({
          position: position,
          map: map,
          animation: google.maps.Animation.DROP,

      });
      var contentString = "    <div id=''>\n" +
      "        <table class=\"map1\">\n" +
      "            <tr>\n" +
      "                <td><a>Description:</a></td>\n" +
      "                <td><textarea  id='manual_description' placeholder='Description'></textarea></td></tr>\n" +
      "            <tr><td></td><td><input type='button' value='Save' onclick=''/></td></tr>\n" +
      "        </table>\n" +
      "    </div>";

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });
  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
      map.panTo(position);
  }
  
  function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }

  function doNothing() {}