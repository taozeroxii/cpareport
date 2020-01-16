// CMI
    $(function() {
      $('#container').highcharts({
        data: {
          table: 'datatable'
        },
        chart: {
          type: 'column',
        },

        title: {
          text: ' '
        },
        yAxis: {
          allowDecimals: false,
          title: {
            text: 'ค่า'
          }
        },
        tooltip: {
          formatter: function() {
            return '<b>' + this.series.name + '</b><br/>' +
            this.point.y; + ' ' + this.point.name.toLowerCase();
          }
        }
      });
    });
//test
    $(function() {
      $('#test').highcharts({
//Highcharts.chart('test', {
    chart: {
        type: 'cylinder',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }
    },
    title: {
        text: 'Highcharts Cylinder Chart'
    },
    plotOptions: {
        series: {
            depth: 25,
            colorByPoint: true
        }
    },
    series: [{
        data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
        name: 'Cylinders',
        showInLegend: false
    }]
});
       });