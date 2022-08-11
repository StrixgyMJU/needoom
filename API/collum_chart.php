<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

//       var thmonth = new Array ("มกราคม","กุมภาพันธ์","มีนาคม",
// "เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
// "ตุลาคม","พฤศจิกายน","ธันวาคม");
      const d = new Date();
      let year = d.getFullYear();
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['สรุปยอดทั้งหมดในปี '+year, 'รายรับ', 'รายจ่าย', 'คงเหลือ'],
          <?php
          
          require('sql/sql_show_index.php');
          $result = $conn->query($sql_collum);
          while ($row = $result->fetch_assoc()){
          $date = date('"M"', strtotime($row['record_create_date']));
          ?>
          [<?= $date ?>,<?= $row['SUM(income)']?>,<?= $row['SUM(expense)']?> , <?=$row['SUM(income)'] - $row['SUM(expense)']?>],
          <?php
          }
          ?>
        ]);

        var options = {
          bars: 'horizontal'
          
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      //listen for window resize event
window.addEventListener('resize', function(event){
   drawChart()
});
      
    </script>