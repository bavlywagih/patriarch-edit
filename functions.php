<?php

function getPatriarchDetails($text): string {
  $textArray = explode("\n", $text);
  $detailedString = "<ul>";
  foreach ($textArray as $info) if (trim($info) !== "") $detailedString .= "<li style='margin-top: 1rem'>" . $info . "</li>";
  $detailedString .= "</ul>";
  return $detailedString;
}