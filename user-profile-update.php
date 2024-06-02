<?php


require_once("./configs/connect.php");

session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
    header("location:login.php");
    die();
}

$user_id = $_SESSION['user_id'];

$user_data = ($gl_db->search_user_data("user", "user_id", $user_id))[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $err_msg = [];

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);

    $avatar = $user_data['user_avatar'];

    if (empty($name) || empty($email)) {

        $err_msg['emt_err'] = "emt_err";
        echo $err_msg['emt_err'];
    } else {

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $err_msg['name_err'] = "name_err";
            echo $err_msg['name_err'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err_msg['email_err'] = "email_err";
            echo $err_msg['email_err'];
        }

        if ($email == $user_data['user_email']) {

            if (count($err_msg) == 0) {

                if (!empty($_FILES['user-update-avatar']['name'])) {

                    if ($avatar !== null) {
                        unlink("uploads/" . $avatar);
                    }

                    $avatar = time() . "_" . str_replace(" ", "_", $name) . "_" . $_FILES['user-update-avatar']['name'];
                    move_uploaded_file($_FILES['user-update-avatar']['tmp_name'], "uploads/" . $avatar);
                }

                date_default_timezone_set("Asia/Kolkata");
                $update_data = date("y-m-d H:i:s");

                $updateSQL = "UPDATE user SET user_name='$name', user_email='$email', user_avatar='$avatar', update_user_data='$update_data'
                                WHERE user_id='$user_id'";
                // $resUpdate = $gl_db->conn->query($updateSQL);

                if ($gl_db->conn->query($updateSQL)) {
                    echo "success";
                } else {
                    echo "failed";
                }
            }
        } else {

            $searchUser = $gl_db->search_user("user", "user_email", "user_email", $email);
            if (count($searchUser) > 1) {

                $err_msg['alr_err'] = "alr_err";
                echo $err_msg['alr_err'];
            } else {

                if (count($err_msg) == 0) {

                    if (!empty($_FILES['user-update-avatar']['name'])) {

                        if ($avatar !== null) {
                            unlink("uploads/" . $avatar);
                        }

                        $avatar = time() . "_" . str_replace(" ", "_", $name) . "_" . $_FILES['user-update-avatar']['name'];
                        move_uploaded_file($_FILES['user-update-avatar']['tmp_name'], "uploads/" . $avatar);
                    }

                    date_default_timezone_set("Asia/Kolkata");
                    $update_data = date("y-m-d H:i:s");

                    $updateSQL = "UPDATE user SET user_name='$name', user_email='$email', user_avatar='$avatar', update_user_data='$update_data'
                                WHERE user_id='$user_id'";
                    // $resUpdate = $gl_db->conn->query($updateSQL);

                    if ($gl_db->conn->query($updateSQL)) {
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }
}
