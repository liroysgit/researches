<?php require_once 'db.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Researches</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once 'navbar.php'; ?>

    <?php
    $stmt = $conn->prepare("SELECT id, title FROM researches");
    $stmt->execute();
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-6 mx-auto">
                <ol class="list-group list-group-numbered">
                    <?php
                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) { ?>
                        <li class="list-group-item">
                            <a href="research.php?id=<?= $result['id'] ?>"><?= $result['title'] ?></a>
                        </li>
                    <?php
                    }
                    ?>

                </ol>
            </div>
        </div>
    </div>


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>