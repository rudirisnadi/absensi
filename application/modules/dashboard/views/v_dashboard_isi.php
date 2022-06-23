<div class="row">
    <div class="col-12">
        <div>
            <h4 class="header-title mb-3">Selamat Datang !</h4>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card-box widget-inline">
            <canvas id="myChart" style="max-width: 50%; margin: 0 auto;"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box widget-inline">
            <div class="row">
                <div class="col-xl-3 col-sm-6 widget-inline-box">
                    <div class="text-center p-3">
                        <h2 class="mt-2"><i class="text-danger mdi mdi-book-open mr-2"></i> <b>8954</b></h2>
                        <p class="text-muted mb-0">Data 1</p>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 widget-inline-box">
                    <div class="text-center p-3">
                        <h2 class="mt-2"><i class="text-teal mdi mdi-book-open-page-variant mr-2"></i> <b>7841</b></h2>
                        <p class="text-muted mb-0">Data 2</p>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 widget-inline-box">
                    <div class="text-center p-3">
                        <h2 class="mt-2"><i class="text-info mdi mdi-book-open-variant mr-2"></i> <b>6521</b></h2>
                        <p class="text-muted mb-0">Data 3</p>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="text-center p-3">
                        <h2 class="mt-2"><i class="text-warning mdi mdi-library-books mr-2"></i> <b>325</b></h2>
                        <p class="text-muted mb-0">Data 4</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--end row -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script type="text/javascript">
    
    var xValues = ["Data 1", "Data 2", "Data 3", "Data 4"];
    var yValues = [55, 49, 44, 24, 15];
    var barColors = ["red", "green","blue","orange"];

    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {display: false},
        title: {
          display: true,
          text: "Grafik Data 2022"
        }
      }
    });

</script>