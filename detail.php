<?php
session_start();
include __DIR__ . '/includes/conn.php';
include __DIR__ . '/includes/html-start.php';

// fetch data from id
$statement = $db_connection->prepare('SELECT * FROM user WHERE id = ?');
$statement->execute([$_GET["id"]]);

$row = $statement->fetch();
?>

<div class="container mt-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 ">
            <div class="d-flex justify-content-between align-items-center p-1">
                <div>
                    <h1 class="text-light fw-lighter">.User Details</h1>
                </div>
                <div><a href="./index.php"><button type="button" class="btn btn-outline-light"><i class="bi bi-house-door-fill"></i></button></a>
                </div>
            </div>

            <div class="bg-light fw-lighter">
                <h1 class="ps-3 pt-2 mb-1 fw-lighter"> <?= $row['name'] . '&nbsp' . $row['surname'] ?> </h1>
                <ul class="list-group list-group-flush p-2">
                    <li class="list-group-item"><strong>Email: </strong><?= $row['email'] ?></li>
                    <li class="list-group-item"><strong>Phone: </strong><?= $row['phone'] ?></li>
                    <li class="list-group-item"><strong>From: </strong><?= $row['nationality'] ?></li>
                    <li class="list-group-item mb-2"><strong>My work: </strong><?= $row['work'] ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/includes/html-end.php';
