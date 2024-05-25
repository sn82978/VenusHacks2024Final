<?php
// Path to your SQLite database
$dbPath = 'locations.db';

// Create a connection to the SQLite database
try {
  $pdo = new PDO("sqlite:$dbPath");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
  exit();
}

// Get the POST data
$postData = file_get_contents("php://input");
$request = json_decode($postData, true);

if ($request['action'] === 'getAllRows') {
  try {
    // Prepare SQL query to get all rows from a table (replace 'your_table_name' with the actual table name)
    $stmt = $pdo->query("SELECT * FROM Location");

    // Fetch all rows
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Send rows as JSON
    echo json_encode($rows);
  } catch (PDOException $e) {
    echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
  }
}

$pdo = null;
?>
