<?php
session_start();
include __DIR__ . '/includes/conn.php';
include __DIR__ . '/includes/html-start.php';

$URL = '/BackEndDocs/PHP_Es.1_CRUD database';
?>

<div class="container mt-2">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-7">

            <!-- ALERT -->
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Congratulations!</strong> <?= $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['message']);
            }
            ?>
            <!-- end alert  -->

            <!-- MAIN TITLE AND ADD USER BUTTON -->
            <div class="d-flex justify-content-between align-items-center p-1">
                <div>
                    <h1 class="text-light fw-lighter m-0">.User Database</h1>
                </div>
                <div><a href="<?= $URL ?>/insert_data.php"><button type="button" class="btn btn-outline-light"><i class="bi bi-plus-circle-fill"></i> Add User</button></a>
                </div>
            </div>
            <!-- end title  -->

            <!-- TABLE -->
            <div class="table-responsive bg-light p-2 mt-2">
                <table class="table table-light m-0 align-middle ">
                    <thead>
                        <tr>
                            <th scope="col" id="th">Name</th>
                            <th scope="col" id="th">Surname</th>
                            <th scope="col" id="th">Email</th>
                            <th scope="col" id="th"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $table_user = $db_connection->query('SELECT * FROM user');
                        foreach ($table_user as $row) { ?>
                            <tr>
                                <td id="td"><?= $row['name'] ?></td>
                                <td id="td"><?= $row['surname'] ?></td>
                                <td id="td"><?= $row['email'] ?></td>
                                <td>
                                    <div class='d-flex'>

                                        <!-- DETAIL BUTTON -->
                                        <form action="code.php" method="GET">
                                            <a href="<?= $URL ?>/detail.php?id=<?= $row['id'] ?>">
                                                <button class='btn btn-success me-1' type="button">
                                                    <i class="bi bi-clipboard2-data"></i>
                                                </button>
                                            </a>
                                        </form>
                                        <!-- end button -->

                                        <!-- EDIT BUTTON -->
                                        <form>
                                            <a href="<?= $URL ?>/edit.php?id=<?= $row['id'] ?>">
                                                <button class='btn btn-primary me-1' type="button">
                                                    <i class='bi bi-pencil'></i>
                                                </button>
                                            </a>
                                        </form>
                                        <!-- end button -->

                                        <!-- DELETE BUTTON -->
                                        <form action="code.php" method="GET" onsubmit="return confirm('Are you sure to delete?')">
                                            <button type=" submit" name="delete_user" value="<?= $row['id'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                        <!-- end button -->
                                    </div>
                                </td>
                            </tr>
                        <?php };
                        ?>

                    </tbody>
                </table>
            </div>
            <!-- end table -->
        </div>
    </div>
</div>

<?php
include __DIR__ . '/includes/html-end.php';
?>