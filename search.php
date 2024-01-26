<?php
include 'connect.php';

// Check if the 'searchTerm' query parameter is set
if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    // Prepare and execute the search query
    $search_query = $conn->prepare("SELECT * FROM `products` WHERE name LIKE :search_term OR category LIKE :search_term");
    $search_query->bindValue(':search_term', "%$searchTerm%", PDO::PARAM_STR);
    $search_query->execute();

    // Fetch search results
    $search_results = $search_query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Search</title>
    <style>
    body {
        font-family: "Arial", sans-serif;
        background-color: #f1f1f1;
        margin: 0;
    }

    .search-container {
        background-color: #fff;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #searchTerm {
        width: 80%;
        padding: 10px;
        font-size: 16px;
    }

    #searchButton {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-results {
        max-width: 800px;
        margin: 20px auto;
    }

    .result-item {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .result-item p {
        margin: 5px 0;
    }

    .no-results {
        margin-top: 20px;
        color: #777;
    }

    .result-item {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .result-item p {
        margin: 5px 0;
    }

    .no-results {
        margin-top: 20px;
        color: #777;
    }

    .result-item:hover {
        cursor: pointer;
        background-color: #f5f5f5;
    }
    .btn {
        background: #f01616;
        background-image: -webkit-linear-gradient(top, #f01616, #e80c0c);
        background-image: -moz-linear-gradient(top, #f01616, #e80c0c);
        background-image: -ms-linear-gradient(top, #f01616, #e80c0c);
        background-image: -o-linear-gradient(top, #f01616, #e80c0c);
        background-image: linear-gradient(to bottom, #f01616, #e80c0c);
        -webkit-border-radius: 28;
        -moz-border-radius: 28;
        border-radius: 28px;
        font-family: Arial;
        color: #ffffff;
        font-size: 20px;
        padding: 10px 20px 10px 20px;
        text-decoration: none;
    }

    .btn:hover {
      background: #3cb0fd;
      background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
      background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
      background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
      background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
      background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
      text-decoration: none;
    }
    </style>
</head>
<body>
<?php
include 'admin_header.php';
?>
<div class="search-container">
    <h2>Car Search</h2>
    <form action="search.php" method="GET">
        <input type="text" id="searchTerm" name="searchTerm" placeholder="Search by Car Name" required>
        <button type="submit" id="searchButton">Search</button>
    </form>
</div>

<?php
if (isset($search_results)) {
    echo '<div class="search-results">';

    if (!empty($search_results)) {
        echo "<h2>Search Results:</h2>";
        foreach ($search_results as $result) {
            echo "<div class='result-item'>";
            echo "<p>Name: {$result['name']}</p>";
            echo "<p>Category: {$result['category']}</p>";
            echo "<p>Fuel: {$result['fuel']}</p>";
            echo "<p>Variant: {$result['variant']}</p>";
            echo "<p>Kilometers Travelled: {$result['condition']}</p>";
            echo "<p>Manufacturing Year: {$result['year']}</p>";
            echo "<p class='price'  style='margin-bottom: 20px;'>Price: {$result['price']}</p>";
            echo "<a class ='btn' href='quick_view.php?id={$result['id']}'>View Details</a>";
            echo '</div>';
        }
    } else {
        echo "<p class='no-results'>No results found for '{$searchTerm}'</p>";
    }

    echo '</div>';
}
?>
</body>
</html>
