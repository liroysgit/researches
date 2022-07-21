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
    $stmt = $conn->prepare("SELECT id, name FROM researchers");
    $stmt->execute();
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-6 mx-auto">
                <ol class="list-group list-group-numbered">
                    <?php
                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) { ?>
                        <li class="list-group-item">
                            <a href="researcher.php?id=<?= $result['id'] ?>"><?= $result['name'] ?></a>
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