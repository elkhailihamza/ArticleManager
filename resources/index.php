<?php

// require_once (__DIR__ . '/../config/db.php');

// try {
//     $query = "SELECT * FROM `article`";

//     $stmt = $pdo->prepare($query);
//     $stmt->execute();
//     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     if(empty($result)) {
//         echo "empty";
//     } else {
//         foreach($result as $row) {
//             echo "Article " . $row['id_article'] . ":<hr style='width: 100px; margin-left: 0;'>";
//             echo $row['title'] . "<br>";
//             echo $row['content'] . "<br>";
//             echo $row['date_cr'] . "<br>";
//             echo "By User: " . $row['user_id'] . "<hr style='width: 400px;'>";
//         }
//     }

// } catch(PDOException $e) {  
//     die("query failed: " . $e);
// }
?>
