<?php
$dbPath = '/Users/shreyanakum/Downloads/vhacks2024/VenusHacks2024Final/locations.db';

header('Content-Type: application/json');

// Connect to the database
try {
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $e->getMessage()]);
    exit();
}

// Read and decode the POST data
$postData = file_get_contents("php://input");
$request = json_decode($postData, true);

if ($request['action'] === 'incrementColumn' && isset($request['columnName'])) {
    // Sanitize and define the column name
    $columnName = preg_replace('/[^a-zA-Z0-9_]/', '', $request['columnName']);
    
    // Print the column name to the terminal
    printf("Column Name: %s\n", $columnName);
    // Alternatively, use error_log to print to the server's error log

    try {
        $sql = "UPDATE Location SET stock = stock + 1 WHERE bldg = :columnName";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':columnName', $columnName, PDO::PARAM_STR);
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
