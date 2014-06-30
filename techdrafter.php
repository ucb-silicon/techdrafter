<?php
session_name('linkedin');
session_start();

$user = $_SESSION['user'];

function getURLFromPage($page, $searchTerm) {
  // $pattern = "/<a\s[]/"
  $patternContactUrl = "/<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(" . $searchTerm . ".*)<\/a>/";
  // echo $patternContactUrl;
  preg_match($patternContactUrl, $page, $matches);
  return $matches[0];
  }

function GetThings($url) {
  // echo "something";
  $html = file_get_contents ($url);

  // $patternContactUrl = "/aashni/";
  $patternContactUrl = "/<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>([cC]ontact.*)<\/a>/";
  preg_match($patternContactUrl, $html, $matches);
  print_r($matches);

  // echo $matches[0];

  $getURLRegex = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
  preg_match($getURLRegex, $matches[0], $matchesURL);
  // print_r($matchesURL);

  $contactPage = file_get_contents(substr($matchesURL[0], 0, strlen($matchesURL[0]) - 1));
  // echo $contactPage;

  $links[0] = getURLFromPage($contactPage, "[Ff]acebook");
  $links[1] = getURLFromPage($contactPage, "[Gg]ithub");
  $links[2] = getURLFromPage($contactPage, "[Ss]tackoverflow");
  $links[3] = getURLFromPage($contactPage, "[Tt]witter");

  return $links;
}

$output = shell_exec("./parse.py " . json_encode($user));
$links = explode("\n", $output);

$extra_links = array();
foreach ($links as $link) {
  array_push($extra_links, GetThings($link));
}
echo json_encode($user);
echo json_encode($extra_links);
?>
