<?php

namespace App\Helpers;

function EstimateReadingTime($text)
{
    // Average reading speed in words per minute
    $wordsPerMinute = 200;

    // Count the number of words in the text
    $wordCount = str_word_count(strip_tags($text));

    // Calculate the reading time in minutes
    $readingTimeMinutes = ceil($wordCount / $wordsPerMinute);

    return $readingTimeMinutes;
}
