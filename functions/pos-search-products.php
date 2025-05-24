<?php
// Connect to the database using PDO
try {
    $db = new PDO('mysql:host=localhost;dbname=db_hash', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get search term from POST request
$search = isset($_POST['search']) ? '%' . $_POST['search'] . '%' : '%%';

// Prepare and execute the SQL query
$sql = "SELECT * FROM products 
        WHERE product_name LIKE :search 
           OR size LIKE :search 
        ORDER BY product_name ASC";

$stmt = $db->prepare($sql);
$stmt->bindParam(':search', $search, PDO::PARAM_STR);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the search results as HTML table rows
if (count($results) > 0) {
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['product_code']) . '</td>'; // Display product_code
        echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['size']) . '</td>';
        echo '<td>' . htmlspecialchars($row['quantity']) . '</td>'; // Display quantity
        echo '<td>Nrs.' . htmlspecialchars($row['price']) . '</td>';
        echo '<td class="text-center">';
        echo '<button class="btn btn-success btn-sm" type="button" data-bs-target="#add-item" data-bs-toggle="modal" data-product-id="' . $row['id'] . '">';
        echo '<i class="fas fa-cart-plus"></i>';
        echo '</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6" class="text-center">No products found</td></tr>';
}
?>
