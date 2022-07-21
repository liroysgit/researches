<?php
require_once 'db.php';

$post_data = trim(file_get_contents("php://input"));
$decoded_data = json_decode($post_data, true);
$research_id = $decoded_data["0"];
unset($decoded_data[0]);

try {
  $sql = "UPDATE research_researcher SET researcher_order=:researcher_order WHERE researcher_id=:researcher_id AND research_id=:research_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':research_id', $research_id);


  foreach ($decoded_data as $researcher_order => $researcher_id) {
    $stmt->bindParam(':researcher_id', $researcher_id);
    $stmt->bindParam(':researcher_order', $researcher_order);
    $stmt->execute();
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}


// $query = substr($query, 0, -1) . ';';
// $stmt = $this->dbh->prepare($query);

// $stmt->execute($values); 


// try {
//   $sql = "UPDATE research_researcher SET researcher_order=:researcher_order WHERE researcher_id=:researcher_id AND research_id=:research_id";
//   $stmt = $conn->prepare($sql);
//   $stmt->bindParam(':research_id', $research_id,  PDO::PARAM_INT);
//   $stmt->bindParam(':researcher_id', $researcher_id,  PDO::PARAM_INT);
//   $stmt->bindParam(':researcher_order', $researcher_order,  PDO::PARAM_INT);
//   $stmt->execute();
// } catch (PDOException $e) {
//   echo json_encode($e->getMessage());
// }


//echo json_encode($stmt->result);
