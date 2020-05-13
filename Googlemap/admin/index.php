<?php
include_once 'header.php';
?>
<div>
<div id="box">
      <div class="form_container">
        <div >
                      <form action="search.php" method="get">
                          Search: <input type="text" name="search" />
                          <input type="submit" name="find" value="search" />
                      </form>
                  </div>
                  
      </form>
      </div>
    </div>

    <div id="map"></div>
    <script src="js/function.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEh62sBH1Lr4_9cpLecHynrjqrzCGjrJc&callback=initMap">
    </script>
</div>
<?php
include_once 'ft.php';
?>