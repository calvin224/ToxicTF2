<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'toxicity');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Set default sort order
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

// Set limit and offset
$limit = 200;
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

// Get messages and their toxicity level
$sql = "SELECT Name, commenttext, toxic FROM messagestable ORDER BY toxic $order LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
// Set default values
$searchTerm = '';
$whereClause = '';

// Check if a search term was submitted
if (isset($_GET['search'])) {
    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    // Add the search term to the WHERE clause
    $whereClause = "WHERE Name LIKE '%$searchTerm%' OR commenttext LIKE '%$searchTerm%'";
}

// Set default sort order
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

// Set limit and offset
$limit = 200;
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

// Get messages and their toxicity level
$sql = "SELECT Name, commenttext, toxic FROM messagestable $whereClause ORDER BY toxic $order LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
// Check if there are any results
if (mysqli_num_rows($result) > 0) {
// Loop through the results and display them
while ($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['commenttext'] . "</td>";
    echo "<td>" . $row['toxic'] . "</td>";
    echo "</tr>";
}
} else {
echo "<tr><td colspan='3'>No results found.</td></tr>";
}

// Close the database connection
mysqli_close($conn);
?>