<?php

include_once("../src/autoload_manager.php");

class ArticleTable {

	// Takes an Article, and counts the number of occurences
	// of a word in that article
	public static function countNumTimes($article, $word) {
		// convert both the abstract and the word to lower case
		$textToSearch = $article->getAbstract()
			. " " . implode(" ", $article->getAuthors());
		$textToSearch = strtolower($textToSearch);
		$word = strtolower($word);

		// remove all non-word characters from $textToSearch and replace
		// with whitespace
		// add spaces to the beginning and end of $textToSearch so that
		// the substr search will match even if it is at the beginning
		// or end of the $textToSearch
		$textToSearch = " " . $textToSearch . " ";
		$textToSearch = preg_replace("/[\W\s]+/", "  ", $textToSearch);

		return substr_count($textToSearch, " " . $word . " ");
	}

	// 
	public static function createRowForArticle($article, $numTimes) {
		$ans = "<tr>";
		// goes title, authors, pub year, pub title, arnumber
		$ans .= "<td>" . $article->getTitle() . "</td>";
		// authors are in an array
		if(count($article->getAuthors()) > 1) {
			$ans .= "<td>" . implode("; ", $article->getAuthors());
			$ans .="</td>";
		}
		else if (count($article->getAuthors()) == 1) {
			$array = $article->getAuthors();
			$ans .= "<td>" . $array[0];
			$ans .="</td>";
		}
		else if(count($article->getAuthors()) == 0) {
			$ans .= "<td>" . "";
			$ans .="</td>";
		}
		// these are direct
		$ans .= "<td>" . $article->getPublishYear() . "</td>";
		// add link to conference table
		$ans .= "<td>" . "<a href=\"articlesWithConference.php?conference="
				.$article->getPubTitle() . ">" 
				.$article->getPubTitle() . "</a>" . "</td>";
		$ans .= "<td>" . $numTimes . "</td>";
		$ans .= "<td>" . $article->getArticleNumber() . "</td>";
		$ans .= "</tr>";
		return $ans;
	}
	
	public static function generateArticleTable($word, $articles) {
		// make the table
		$output = '<table>';
		$output .= "<tr>"
					.	"<th>Title</th>"
					.	"<th>Author(s)</th>"
					.	"<th>Publication Year</th>"
					.	"<th>Publication Title</th>"
					.	"<th>Frequency of Word</th>"
					.	"<th>Article Number</th>"
				.  "</tr>";
		// this will map the number of times a word occurs onto a list
		// of articles' row representation that have that frequency
		$numTimesOntoRow = array();
		foreach ($articles as $article) {
			$numTimes = ArticleTable::countNumTimes($article, $word);
			// only include articles that have the word
			if ($numTimes > 0) {
				// if this numTimes has not yet been encountered, add it
				if (!array_key_exists($numTimes, $numTimesOntoRow)) {
					$numTimesOntoRow[$numTimes] = array();
				}
				// add the row to the list for that numTimes
				$numTimesOntoRow[$numTimes][] =
					ArticleTable::createRowForArticle($article, $numTimes);
			}
		}
		$keys = array_keys($numTimesOntoRow);
		rsort($keys);
		foreach ($keys as $numTimes) {
			foreach ($numTimesOntoRow[$numTimes] as $row) {
				$output .= $row;
			}
		}
		// close out the table
		$output .= "</table>";
		return $output;
	}
}
?>