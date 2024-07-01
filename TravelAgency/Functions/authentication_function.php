<?php 
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    
    include "../config/db_connect.php"; 

    $email = $_POST['email'];
    $password = $_POST['password'];

    $ms = "error";
    if (empty($email)) {
        $error = "The email is required";
        header("Location: ../Views/login.php?$ms=$error");
        exit();
    }
    if (empty($password)) {
        $error = "The password is required";
        header("Location: ../Views/login.php?$ms=$error");
        exit();
    }

    try {
        $sqlQueryAdmin = "SELECT adminID, emailAddress, password FROM admins WHERE emailAddress=?";
        $stmtAdmin = $conn->prepare($sqlQueryAdmin);
        $stmtAdmin->execute([$email]);

        $sqlQueryUser = "SELECT userID, emailAddress, password FROM users WHERE emailAddress=?";
        $stmtUser = $conn->prepare($sqlQueryUser);
        $stmtUser->execute([$email]);

        if ($stmtAdmin->rowCount() === 1) {
            $user = $stmtAdmin->fetch();
            $userType = 'admin';
            $user_id = $user['adminID'];
        } elseif ($stmtUser->rowCount() === 1) {
            $user = $stmtUser->fetch();
            $userType = 'user';
            $user_id = $user['userID'];
        } else {
            $error = "Incorrect username or password";
            header("Location: ../Views/login.php?error=$error");
            exit();
        }

        $user_email = $user['emailAddress'];
        $user_password = $user['password'];

        if ($email === $user_email) {
            if (password_verify($password, $user_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_type'] = $userType;

                if ($userType === 'admin') {
                    header("Location: ../Views/admin.php");
                } else {
                    header("Location: ../Views/home.php");
                }
                exit();
            } else {
                $error = "Incorrect username or password";
                header("Location: ../Views/login.php?error=$error");
                exit();
            }
        } else {
            $error = "Incorrect username or password";
            header("Location: ../Views/login.php?error=$error");
            exit();
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
        header("Location: ../Views/login.php?error=$error");
        exit();
    }
} else {
    header("Location: ../Views/login.php");
    exit();
}
