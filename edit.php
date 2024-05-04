<?php
session_start();
include __DIR__ . '/includes/conn.php';
include __DIR__ . '/includes/html-start.php';

// fetch data from id
$statement = $db_connection->prepare('SELECT * FROM user WHERE id = ?');
$statement->execute([$_GET["id"]]);

$row = $statement->fetch();
?>

<div class="container mt-1">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">

            <!-- ADVISE -->
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Congratulations!</strong> <?= $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['message']);
            }
            ?>
            <!-- end advise -->

            <!-- MAIN TITLE -->
            <div class="d-flex justify-content-between align-items-center p-1">
                <div>
                    <h1 class="text-light fw-lighter">.Update User Data</h1>
                </div>
                <div><a href="./index.php"><button type="button" class="btn btn-outline-light"><i class="bi bi-house-door-fill"></i></button></a>
                </div>
            </div>
            <!-- end main title -->

            <!-- FORM -->
            <div class="divbox p-3 mb-3">
                <form action="code.php" method="POST">

                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />

                    <label for="name" class="form-label"><span style="color: #F048E2">*</span>Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?= $row['name'] ?>" required />

                    <label for="surname" class="form-label"><span style="color: #F048E2">*</span>Surname</label>
                    <input type="text" name="surname" class="form-control" id="surname" value="<?= $row['surname'] ?>" required />

                    <label for="email" class="form-label"><span style="color: #F048E2">*</span>Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" required>

                    <label for="phone" class="form-label">Phone number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?= $row['phone'] ?>">

                    <label for="work" class="form-label">Work</label>
                    <input type="text" class="form-control" id="work" name="work" value="<?= $row['work'] ?>">

                    <label for="nationality" class="form-label">Nationality</label>
                    <input type="text" class="form-control" id="nationality" name="nationality" value="<?= $row['nationality'] ?>">

                    <button type="submit" name="update_user" class="btn mt-2 btn-color">Update</button>

                </form>
            </div>
            <!-- end form -->
        </div>
    </div>
</div>

<?php
include __DIR__ . '/includes/html-end.php';
