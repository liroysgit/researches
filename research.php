<?php
require_once 'db.php';
$research_id = htmlspecialchars($_GET["id"]);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Research Details</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once 'navbar.php'; ?>

    <?php
    try {
        $stmt = $conn->prepare("SELECT * FROM researches WHERE id=:id");
        $stmt->bindParam(':id', $research_id);
        $stmt->execute();
        $research = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    try {
        $stmt = $conn->prepare("SELECT researchers.name, researchers.id, research_researcher.researcher_order FROM research_researcher
         INNER JOIN researchers
         ON researcher_id=researchers.id
         WHERE research_id=:research_id
         ORDER BY research_researcher.researcher_order");
        $stmt->bindParam(':research_id', $research_id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <div class="container text-center">
        <div class="row">
            <div class="col-6 mx-auto">
                <div id="research_card" class="card text-center" data-research-id=<?= $research_id; ?>>
                    <div class="card-header">
                        <a class="btn" href="download.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                            </svg>
                            Download Full Article
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $research['title']; ?></h5>
                        <p class="card-text fw-bold fst-italic"> Abstract </p>
                        <p class="card-text"><?= $research['abstract']; ?></p>
                        <div class="card-footer">
                            List of researchers:
                            <span id="edit_order_span" role="button" onclick="toggleEditButtons(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit researchers order">(
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                                )
                            </span>
                            <span id="save_or_cancel_edit_span" style="display: none;">(
                                <span id="save_new_order_button" role="button" onclick="toggleEditButtons(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Save Changes">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                    </svg>
                                </span>
                                <span id="cancel_new_order_button" role="button" onclick="toggleEditButtons(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancel Changes">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg>
                                </span>
                                )
                            </span>
                            <ol id="order_list" class="list-group list-group-flush list-group-numbered">
                                <?php
                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) { ?>
                                    <li class="list-group-item order_list_item" data-researcher-id=<?= $result['id'] ?>>
                                        <a href="researcher.php?id=<?= $result['id'] ?>"><?= $result['name']; ?></a>
                                        <span style="display: none;" class="change_order_buttons">(<a role="button" class='up link-success'>Move Up</a> <a role="button" class='down link-danger'>Move Down</a>)</span>
                                    </li>
                                    </li>
                                <?php
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/change_order.js"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>