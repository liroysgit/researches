<?php
require_once 'db.php';

try {
    $sql = "UPDATE research_researcher SET `order`='111' WHERE researcher_id='82'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

} catch (PDOException $e) {
    echo $e->getMessage();
}
