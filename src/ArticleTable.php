<?php

// A table which contains the Articles that contain $word

	class ArticleTable {

		public static function generateTable($word) {

			// API call to find articles with $word
			// for(each article after the api call)
		
				$output = "<tr>" . "<td> article name </td>"
				 					. "<td> author name </td>" 
									. "</tr>"


			return $output;

		}

	}



?>



