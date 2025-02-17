<?php
session_start();
include('config.php'); // Include database connection

if (isset($_GET['query'])) {
    $searchQuery = trim($_GET['query']);
    
    if (!empty($searchQuery)) {
        // Secure query using prepared statements
        $sql = "SELECT * FROM movies WHERE title LIKE ? OR genre LIKE ? OR description LIKE ? LIMIT 10";
        $stmt = $con->prepare($sql);
        
        if ($stmt) { // Check if the statement prepared successfully
            $searchParam = "%" . $searchQuery . "%";
            $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $_SESSION['search_results'] = $result->fetch_all(MYSQLI_ASSOC);
            $_SESSION['search_query'] = $searchQuery;

            $stmt->close(); // Close the statement
        }
        
        header("Location: index.php"); // Redirect to display results
        exit();
    }
}
?>
