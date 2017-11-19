<?php 
/**
 * return the percentage of each element
 * @param number $whole 
 * @param  array  $elements
 * @return array 
*/
function calculatePercentage($whole, $items = []) {
	return array_map(function ($item) use($whole) {
      return ceil(($item / $whole) * 100);
    }, $items);
}