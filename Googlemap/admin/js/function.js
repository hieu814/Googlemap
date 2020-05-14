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
      center: new google.maps.LatLng(-33.863276, 151.207977),
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
          infowincontent.appendChild(document.createElement('br'));
          var text = document.createElement('text');
          text.innerHTML = "<td><a href='Delete_marker.php?id="+id+"'>Xóa</a> <a href='Update.php?id="+id+"'>Sửa</a></td>";
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
      var z ="<div><form action='add_marker.php' method='post'>"+
      "<table>"+
          "<tr>"+
             " <th>Tên:</th>"+
              "<td><input type='text' name='name' value=''></td>" +
              "</tr>" +
              "<tr>" +
              "<th>Địa chỉ:</th>" +
              "<td><input type='text' name='address' value=''></td>" +
              "</tr>" +
              "<tr>" +
              "<th>Image link:</th>" +
              "<td><input type='text' name='image' value=''></td>" +
              "</tr>" +
              "<th>Mô tả:</th>" +
              "<td><input type='textarea' rows='10' cols='50' name='description' value=''></td>" +
              
              
          "</tr>"+  
          "<tr>"+
          "<td><input type='hidden' name='lat' value='"+position.lat()+"'></td>" +
          "</tr>"+
          "<tr>"+
          " <td><input type='hidden' name='lng' value='"+position.lng()+"'></td>"+
          "</tr>"+
          "<tr>"+
          "<th>type:</th>"+
          "<td><input type='text' name='type' value=''></td>" +
          "</tr>" +  
          "</table>"+
          "<button type='submit'>Gửi</button>"+
          "</form>  </div>";


  var infowindow = new google.maps.InfoWindow({
    content: z
  });
  marker.addListener('click', function() {
    infowindow.open(map, marker);
    //document.getElementById("add").innerHTML = z;
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