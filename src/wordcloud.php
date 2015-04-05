<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Word Cloud Page</title>

	<style>
		body {
			background-color: gray;
			padding: 30px;
		}

		#websitetitle {
			color: black;
			font-family: Lucida Handwriting;
			font-size: 50px;	
		}
		#cloudBox{
  			position: absolute; 
			top: 13em;
			left:22%;
		}
		#submit{
			clear:left;
   			position: absolute; 
			bottom: 3em;
			left: 30%;
		}

		#backButton{
			clear:left;
  			position: absolute; 
			left: 8em;
			width:100px;
			height:40px;
			background: purple;
		}
		#downloadButton{
			clear:left;
  			position: absolute; 
			left: 30em;
			width:100px;
			height:40px;
			background: purple;
		}
		#wordCloud{
			height: 300px;
			width: 66%;
  			position: absolute; 
			top: 20%;
			left:19%;
			size: <?php echo "$size"; ?>;
			overflow-y: scroll;
			padding: 10px;
		}
		</style>
</head>
<body>
<center id = "websitetitle">Scholar Search</center>
			<?php
				include("wordCloudArray.php");
			?>

				<p id = "wordCloud" style = "background-color:white;">
					<?php
					$text = $_GET["text"];
					$content = new WordCloudArray($text);
					$content->generatewordcloud($content->getMap());
					?>
				</p>
		
		
		</textarea>
		<div id = "submit">
				<br>
				<br>
				<button type = "button" id = "backButton">Back</button>
				<button type = "button" id = "downloadButton">Download</button>
		</div>
</body>
</html>