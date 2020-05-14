<?php
include_once 'header.php';
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Các địa điểm</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh sách du liệu</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <?php 
                  require('config.php');
                  $connection = mysqli_connect ('', $username, $password, $database);
                  if (!$connection) 
                  {
                    die('Not connected : ' . mysqli_error());
                  }
                  // Selects all the rows in the markers table.
                  $query = 'SELECT * FROM markers WHERE 1';
                  $result = mysqli_query($connection,$query);

                  if (!$result) 
                  {
                    die('Invalid query: ' . mysqli_error());
                  }                 
                  ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>name</th>
                      <th>adress</th>
                      <th>lat</th>
                      <th>lng</th>
                      <th>type</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      if ($result) {
                        // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
                        // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts

                        while ($row=mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>".$row["id"]."</td>";
                            echo "<td>".$row["name"]."</td>";
                            echo "<td>".$row["address"]."</td>";
                            echo "<td>".$row["lat"]."</td>";
                            echo "<td>".$row["lng"]."</td>";
                            echo "<td>".$row["type"]."</td>";
                            echo "<td><a href='Delete_marker.php?id=".$row['id']."'>Xóa</a><a href='Update.php?id=".$row['id']."'>Sửa</a></td>";

                            echo "</tr>";
                         
                           
                        }
                    
                        // Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
                        // Do đó chúng ta nên giải phóng bộ nhớ sau khi hoàn tất đọc dữ liệu
                        mysqli_free_result($result);
                    }

                      ?>

                    
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>

          <?php
include_once 'ft.php';
?>