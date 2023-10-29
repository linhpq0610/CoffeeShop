<?php 
  require_once ADMIN_COMPONENTS_DIR . "/backBtn.php";
?>
<h4 class="mt-2">Biểu đồ sản phẩm</h4>
<div id="productChart" class="mx-auto" style="width: 100%; max-width: 600px; height: 500px"></div>

<script
  type="text/javascript"
  src="https://www.gstatic.com/charts/loader.js"
></script>
<script>
  google.charts.load("current", { packages: ["corechart"] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    const data = google.visualization.arrayToDataTable([
      ["Product", "Quantity"],
      <?php 
        foreach ($dataForProductChart as $data):
          extract($data);
      ?>
          ["<?=$name;?>", <?=$NUMBERS_OF_PRODUCT;?>],
      <?php 
        endforeach;
      ?>
    ]);

    const options = {
      title: "Tỉ lệ sản phẩm",
      is3D: true,
    };

    const chart = new google.visualization.PieChart(
      document.getElementById("productChart")
    );
    chart.draw(data, options);
  }
</script>
