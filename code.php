<?php
session_start();
include __DIR__ . '/includes/conn.php';

// INSERT with bindParam()
if (isset($_POST['save_user'])) {

    $name = $_POST['name'] ?? "";
    $surname = $_POST['surname'] ?? "";
    $email = $_POST['email'] ?? "";
    $phone = $_POST['phone'] ?? "";
    $work = $_POST['work'] ?? "";
    $nationality = $_POST['nationality'] ?? "";

    try {
        $query = "INSERT INTO user (name, surname, email, phone, work, nationality) VALUES (?, ?, ?, ?, ?, ?)";
        // prepare
        $statement = $db_connection->prepare($query);
        // bindParam()
        $statement->bindParam(1, $name);
        $statement->bindParam(2, $surname);
        $statement->bindParam(3, $email);
        $statement->bindParam(4, $phone);
        $statement->bindParam(5, $work);
        $statement->bindParam(6, $nationality);
        // execute
        $query_execute = $statement->execute();

        // alert
        if ($query_execute) {
            $_SESSION['message'] = "Added Successfully";
            header('Location: insert_data.php');
            exit(0);
        } else {
            $_SESSION['message'] = "OPS! Something wrong";
            header('Location: insert_data.php');
            exit(0);
        }
    } catch (PDOException $e) {
        echo "My Error Type:" . $e->getMessage();
    }
}

// UPDATE
if (isset($_POST['update_user'])) {
    // id
    $user_id = $_POST['id'];

    $name = $_POST['name'] ?? "";
    $surname = $_POST['surname'] ?? "";
    $email = $_POST['email'] ?? "";
    $phone = $_POST['phone'] ?? "";
    $work = $_POST['work'] ?? "";
    $nationality = $_POST['nationality'] ?? "";

    try {
        $query = "UPDATE user SET name=:name, surname=:surname, email=:email, phone=:phone, work=:work, nationality=:nationality
        WHERE id=:user_id";
        // prepare
        $statement = $db_connection->prepare($query);
        // data
        $data = [
            ':name' => $name,
            ':surname' => $surname,
            ':email' => $email,
            ':phone' => $phone,
            ':work' => $work,
            ':nationality' => $nationality,
            ':user_id' => $user_id
        ];

        // execute
        $query_execute = $statement->execute($data);
        // alert
        if ($query_execute) {
            $_SESSION['message'] = "Updated Successfully";
            header('Location: edit.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Not Updated";
            header('Location: edit.php');
            exit(0);
        }
    } catch (PDOException $e) {
        echo "My Error Type:" . $e->getMessage();
    }
}

// DELETE
if (isset($_GET['delete_user'])) {
    // id
    $user_id = $_GET['delete_user'];

    try {
        // query
        $query = "DELETE FROM user WHERE id=:user_id";
        // prepare
        //$statement->execute([':user_id' => $user_id]);
        $statement = $db_connection->prepare($query);

        $data = [
            ':user_id' => $user_id
        ];
        // execute
        $query_execute = $statement->execute($data);
        // alert
        if ($query_execute) {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: index.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Not Deleted";
            header('Location: index.php');
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
