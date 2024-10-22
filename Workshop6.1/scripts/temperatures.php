<?php
$temperatures = array(
    78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 
    76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 
    74, 62, 62, 65, 64, 68, 73, 75, 79, 73
);

// Calculate average temperature
$averageTemperature = array_sum($temperatures) / count($temperatures);

// Remove duplicates and sort the temperatures
$uniqueTemperatures = array_unique($temperatures);
sort($uniqueTemperatures);

// Get the 5 lowest and 5 highest temperatures
$lowestTemperatures = array_slice($uniqueTemperatures, 0, 5);
$highestTemperatures = array_slice($uniqueTemperatures, -5);

echo "Average Temperature is: " . round($averageTemperature, 1) . "<br>";
echo "List of 5 lowest temperatures (no duplicates): " . implode(", ", $lowestTemperatures) . "<br>";
echo "List of 5 highest temperatures (no duplicates): " . implode(", ", $highestTemperatures) . "<br>";
?>
