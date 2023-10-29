


    <script type="text/javascript">
		// Product Stock Graph

        $(function () {

            var areaChartData = {
              labels  : <?php echo json_encode($product_stock['labels']); ?>,
              datasets: [
                {
                  label               : 'Stock ',
                  backgroundColor     : 'rgba(60,141,188,0.9)',
                  borderColor         : 'rgba(60,141,188,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : <?php echo json_encode($product_stock['data']); ?>
                },
              ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#product_stock').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }

            new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })

            
          })
    </script>



    <script type="text/javascript">
    // Product fast_to_slow Graph

        $(function () {

            var data = @json($fast_to_slow['data']);
            var areaChartData = {
              labels  : @json($fast_to_slow['labels']),
              datasets: [
                {
                  label               : 'Ratio ',
                  backgroundColor     : 'rgba(0, 153, 51,0.9)',
                  borderColor         : 'rgba(0, 153, 51,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : data
                },
              ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#fast_to_slow').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false,
              tooltips: {
                  callbacks: {
                      footer: function (tooltipItems,data) {
                          var text = 'Sold ' + data['datasets'][tooltipItems[0].datasetIndex]['data'][tooltipItems[0].index].sold + ' in ' + data['datasets'][tooltipItems[0].datasetIndex]['data'][tooltipItems[0].index].days + 'Days';
                          return text;
                      }
                  }
              },              
            }

            new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })

            
          })
    </script>


    <script type="text/javascript">
    // Product fast_to_slow_with_profit Graph

        $(function () {

            var data = @json($fast_to_slow_with_profit['data']);
            var areaChartData = {
              labels  : @json($fast_to_slow_with_profit['labels']),
              datasets: [
                {
                  label               : 'Profit Per Unit ',
                  backgroundColor     : 'rgba(153, 0, 77,0.9)',
                  borderColor         : 'rgba(153, 0, 77,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : data
                },
              ]
            }

            //-------------
            //- line CHART -
            //-------------
            var barChartCanvas = $('#fast_to_slow_with_profit').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false,
              tooltips: {
                  callbacks: {
                      footer: function (tooltipItems,data) {
                          var text = 'Sold ' + data['datasets'][tooltipItems[0].datasetIndex]['data'][tooltipItems[0].index].sold + ' in ' + data['datasets'][tooltipItems[0].datasetIndex]['data'][tooltipItems[0].index].days + 'Days';
                          return text;
                      }
                  }
              },              
            }

            new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })

            
          })
    </script>



    <script type="text/javascript">
    // Product customer_by_profit Graph

        $(function () {

            var areaChartData = {
              labels  : <?php echo json_encode($customer_by_profit['labels']); ?>,
              datasets: [
                {
                  label               : 'Profit BDT ',
                  backgroundColor     : 'rgba(60,141,188,0.9)',
                  borderColor         : 'rgba(60,141,188,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : <?php echo json_encode($customer_by_profit['data']); ?>
                },
              ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#customer_by_profit').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }

            new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })

            
          })
    </script>

    <script type="text/javascript">
    // Product customer_by_balance Graph

        $(function () {

            var areaChartData = {
              labels  : <?php echo json_encode($customer_by_balance['labels']); ?>,
              datasets: [
                {
                  label               : 'Balance BDT ',
                  backgroundColor     : 'rgba(71, 71, 107,0.9)',
                  borderColor         : 'rgba(71, 71, 107,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : <?php echo json_encode($customer_by_balance['data']); ?>
                },
              ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#customer_by_balance').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }

            new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })

            
          })
    </script>