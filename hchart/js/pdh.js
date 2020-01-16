var app = angular.module('app', ['ui.bootstrap'])

app.controller('ctrl', function($scope, $timeout) {

	// On Feed CHART
	$(function() {
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'onFeedChart',
				type: 'pie'
			},
			title: {
				text: 'Pie Chart'
			},
			plotOptions: {
				pie: {
					dataLabels: {
						enabled: false					},
					size: 200,
					innerSize: '0%',
					center: ['50%', '40%']
				}
			},
			credits: {                                 
				enabled:  false                          
			},
			series: [{
				data: [{
					name: 'Prospects',
					color: 'rgba(52, 152, 219, 0.5)',
					y: 20
				}, {
					name: 'On Feed',
					color: 'rgba(52, 152, 219,1.0)',
					y: 70
				}]
			}]

		});
		// PHOTO CHART
		var chart = new Highcharts.Chart({
				chart: {
					renderTo: 'photoUploadChart',
					type: 'pie'
				},
				title: {
					text: 'Donut Chart'
				},

				credits: {                                 
					enabled:  false                          
				},
				plotOptions: {
					pie: {
						dataLabels: {
							enabled: false
						},
						size: 200,
						innerSize: '50%',
						center: ['50%', '40%']
					}
				},
				series: [{
					data: [{
						name: 'Yes',
						color: 'rgba(155, 89, 182,1.0)',
						y: 50
					}, {
						name: 'No',
						color: 'rgba(155, 89, 182, .5)',
						y: 50
					}]
				}]
			},
			// using 

			function(chart) { // on complete

				var xpos = '50%';
				var ypos = '50%';
				var circleradius = 102;

				// Render the circle
				chart.renderer.circle(xpos, ypos, circleradius).attr({
					fill: '#ffffff',
				}).add();

			});

		// Vendor CHART
		$('#vendorChart').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: 0,
				plotShadow: false
			},
			credits: {                                 
				enabled:  false                          
			},

			title: {
				text: 'Half Donut',
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					dataLabels: {
						enabled: false
					},
					startAngle: -90,
					endAngle: 90,
					size: 200,
					center: ['50%', '60%']
				}
			},
			series: [{
				type: 'pie',
				innerSize: '40%',
				data: [{
					name: 'Vendor A',
					color: 'rgba(26, 188, 156,1.0)',
					y: 40
				}, {
					name: 'Vendor B',
					color: 'rgba(26, 188, 156,0.75)',
					y: 40
				}, {
					name: 'Vendor C',
					color: 'rgba(26, 188, 156,0.5)',
					y: 20
				}]
			}]
		});

	});
});