<?php
// Path to your SQLite database
$dbPath = 'locations.db';

header('Content-Type: application/json');

// Create a connection to the SQLite database
try {
  $pdo = new PDO("sqlite:$dbPath");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $e->getMessage()]);
  exit();
}

// Get the POST data
$postData = file_get_contents("php://input");
$request = json_decode($postData, true);

if ($request['action'] === 'incrementColumn' && isset($request['columnName'])) {
  // Sanitize the column name to prevent SQL injection
  $columnName = preg_replace('/[^a-zA-Z0-9_]/', '', $request['columnName']);
  
  // Ensure column name is valid
  $validColumns = [
    'Cross Cultural Center',
    'Biological Sciences Lecture Hall',
    'Antill Pub and Grill',
    'Physical Sciences Lecture Hall',
    'Brandywine',
    'Social Sciences Lab',
    'Anteater Learning Pavilion',
    'Blood Donation Center',
    'UTC Taco Bell',
    'Humanities Hall',
    'Information and Computer_Science 2',
    'Natural_Sciences_II',
    'Student_Center',
    'Science_Library',
    'Human_Resources',
    'Natural_Sciences_I',
    'Engineering_Lecture_Hall',
    'Anteatery',
    'Rowland_Hall',
    'Information_and_Computer_Science'
  ];
  
  if (!in_array($columnName, $validColumns)) {
    echo json_encode(['success' => false, 'error' => 'Invalid column name']);
    exit();
  }

  try {
    // Use a prepared statement to increment the specified column
    $sql = "UPDATE your_table_name SET $columnName = $columnName + 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    echo json_encode(['success' => true]);
  } catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Query failed: ' . $e->getMessage()]);
  }
} else {
  echo json_encode(['success' => false, 'error' => 'Invalid request']);
}

$pdo = null;
?>
