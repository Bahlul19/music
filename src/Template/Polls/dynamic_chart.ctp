<!DOCTYPE HTML>
<html>
<head>
<script>

window.onload = function () {
	
	var datapointsTitle = document.getElementById('datapointsTitle').textContent;
	console.log(datapointsTitle);
	
//Better to construct options first and then pass it as a parameter
var options = {
	title: {
		text: datapointsTitle

		//text: "Avarage Question"            
	},
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "column",
		dataPoints: <?php echo $datapoints;?>
	}
	]
};

$("#chartContainer").CanvasJSChart(options);

}


</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<span id ="datapointsTitle" style="display: none"><?php echo $datapointsTitle;?></span>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>
</html>