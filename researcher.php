<?php
require_once 'db.php';
$researcher_id = htmlspecialchars($_GET["id"]);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Researcher Details</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once 'navbar.php'; ?>
    <?php
    try {
        $stmt = $conn->prepare("SELECT * FROM researchers WHERE id=:id");
        $stmt->bindParam(':id', $researcher_id);
        $stmt->execute();
        $researcher = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    try {
        $stmt = $conn->prepare("SELECT researches.title, researches.id FROM research_researcher
         INNER JOIN researches
         ON research_id=researches.id
         WHERE researcher_id=:researcher_id");
        $stmt->bindParam(':researcher_id', $researcher_id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?= $researcher['name']; ?></h3>
            <h4 class="card-subtitle mb-3 text-muted">Field of study: <?= $researcher['discipline']; ?></h4>
            <p class="card-text"><b><?= $researcher['name']; ?></b> participated in the following researches:</p>
            <ol class="list-group list-group-flush list-group-numbered">
                <?php
                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) { ?>
                    <li class="list-group-item">
                        <a href="research.php?id=<?= $result['id'] ?>"><?= $result['title']; ?></a>
                    </li>
                <?php
                }
                ?>
            </ol>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>