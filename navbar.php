<?php
$active_page = basename($_SERVER['PHP_SELF'], ".php");
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2" aria-label="Tenth navbar example">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= ($active_page == 'researches_list') ? 'active':''; ?>" href="researches_list.php">Researches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active_page == 'researchers_list') ? 'active':''; ?>" href="researchers_list.php">Researchers</a>
                </li>
            </ul>
        </div>
    </div>
</nav>