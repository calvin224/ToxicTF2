<?php
// Sample data for demonstration purposes only - replace with your actual data
$data = array(
    array("message" => "You suck!", "toxicity_level" => "high"),
    array("message" => "This game is terrible.", "toxicity_level" => "medium"),
    array("message" => "Good game, but needs some improvements.", "toxicity_level" => "low")
);

foreach ($data as $row) {
    echo "<tr>";
    echo "<td>" . $row['message'] . "</td>";
    if ($row['toxicity_level'] == 'high') {
        echo "<td class='toxic-high'>High</td>";
    } elseif ($row['toxicity_level'] == 'medium') {
        echo "<td class='toxic-medium'>Medium</td>";
    } else {
        echo "<td class='toxic-low'>Low</td>";
    }
    echo "</tr>";
}
?>