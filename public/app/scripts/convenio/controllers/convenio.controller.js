/**
 * Created by ediaimoborges on 25/04/16.
 */
(function (angular) {
  "use strict";
  angular.module('publicApp.convenioApp')
    .controller('ConvenioController', ConvenioController);

  function ConvenioController() {

    var chartConfig;
    var convenioCtrl = this;

      /**
       * Convenio por instrumento
       * @type {{options: {chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: boolean, type: string}, tooltip: {pointFormat: string}, plotOptions: {pie: {allowPointSelect: boolean, cursor: string, dataLabels: {enabled: boolean, format: string, style: {color: (*|string|string)}}}}}, series: *[], title: {text: string}, loading: boolean, useHighStocks: boolean, func: chartConfig.func}}
       */
    chartConfig = {
      options: {
        //This is the Main Highcharts chart config. Any Highchart options are valid here.
        //will be overriden by values specified below.
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              format: '<b>{point.name}</b>: {point.percentage:.1f} %',
              style: {
                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
              }
            }
          }
        }
      },
      //The below properties are watched separately for changes.

      //Series object (optional) - a list of series using normal Highcharts series options.
      series: [{
        name: 'Total',
        colorByPoint: true,
        data: [{
          name: 'Repasse',
          y: 56.33
        }, {
          name: 'Convênio',
          y: 24.03,
          sliced: true,
          selected: true
        }, {
          name: 'Termo de parceria',
          y: 10.38
        }]
      }],
      //Title configuration (optional)
      title: {
        text: 'Convênio por instrumento'
      },
      //Boolean to control showing loading status on chart (optional)
      //Could be a string if you want to show specific loading text.
      loading: false,
      //Whether to use Highstocks instead of Highcharts (optional). Defaults to false.
      useHighStocks: false,
      //size (optional) if left out the chart will default to size of the div or something sensible.
      //function (optional)
      func: function (chart) {
        //setup some logic for the chart
      }
    };

    convenioCtrl.chartConfig = chartConfig;


    convenioCtrl.chartConfig2 = {
      options: {
        //This is the Main Highcharts chart config. Any Highchart options are valid here.
        //will be overriden by values specified below.
        /*chart: {
         type: 'pie'
         },*/
        tooltip: {
          pointFormat: 'Total: <b>{point.y}</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              format: '<b>{point.name}</b>: {point.percentage:.1f} %',
              style: {
                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
              }
            }
          }
        }
      },
      //The below properties are watched separately for changes.
      //Series object (optional) - a list of series using normal Highcharts series options.
      series: [{
        name: 'Repasse',
        data: [7, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
      }, {
        name: 'Convênio',
        data: [2, 8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
      }, {
        name: 'Termo de parceria',
        data: [9, 6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
      }],
      //Title configuration (optional)
      title: {
        text: 'Evolução de celebrações dos convênios',
        x: -20 //center
      },
      subtitle: {
        text: 'Entre 2005 a 2016',
        x: -20
      },
      xAxis: {
        categories: ['2005', '2006', '2007', '2008', '2009', '2010',
          '2011', '2012', '2013', '2014', '2015', '2016']
      },
      yAxis: {
        title: {
          text: 'Total celebrado'
        },
        plotLines: [{
          value: 0,
          width: 1,
          color: '#808080'
        }]
      },
      //Boolean to control showing loading status on chart (optional)
      //Could be a string if you want to show specific loading text.
      loading: false,
      //Whether to use Highstocks instead of Highcharts (optional). Defaults to false.
      useHighStocks: false,
      //size (optional) if left out the chart will default to size of the div or something sensible.
      //function (optional)
      func: function (chart) {
        //setup some logic for the chart
      }
    };


    convenioCtrl.chartConfig3 = {
      options: {
        //This is the Main Highcharts chart config. Any Highchart options are valid here.
        //will be overriden by values specified below.
        chart: {
         type: 'column'
        },
        tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:0"><b>R$ {point.y:.2f}</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
        },
        plotOptions: {
          column: {
            pointPadding: 0.2,
            borderWidth: 0
          }
        }
      },
      //The below properties are watched separately for changes.
      //Series object (optional) - a list of series using normal Highcharts series options.
      series: [{
        name: 'Repasse',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

      }, {
        name: 'Convênio',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

      }, {
        name: 'Termo de parceria',
        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

      }],
      //Title configuration (optional)
      title: {
        text: 'Total investido por mês no ultimo ano - 2016'
      },
      subtitle: {
        text: 'Valores em Real(R$)'
      },
      xAxis: {
        categories: [
          'Jan',
          'Feb',
          'Mar',
          'Apr',
          'May',
          'Jun',
          'Jul',
          'Aug',
          'Sep',
          'Oct',
          'Nov',
          'Dec'
        ],
        crosshair: true
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Rainfall (R$)'
        }
      },
      //Boolean to control showing loading status on chart (optional)
      //Could be a string if you want to show specific loading text.
      loading: false,
      //Whether to use Highstocks instead of Highcharts (optional). Defaults to false.
      useHighStocks: false,
      //size (optional) if left out the chart will default to size of the div or something sensible.
      //function (optional)
      func: function (chart) {
        //setup some logic for the chart
      }
    };

  }

})(angular);
