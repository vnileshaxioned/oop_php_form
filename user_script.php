<?php

require_once('database/database_connection.php');

function fieldRequired($data) {
    if (empty($data)) {
        return "Field is required";
    }
}

function regEx($pattern, $data, $message) {
    if (!preg_match($pattern, $data)) {
        return $message;
    }
}

function checkPass($pass, $cpass) {
    $password_check = regEx("/^\S*(?=\S*[A-Z])(?=\S*[a-z])(?=\S*[0-9])(?=\S*[@#])\S*$/", $pass, "Uppercase, lowercase, numbers and @# characters needed");
    if ($pass !== $cpass) {
        return "Password not match";
    } elseif ($password_check) {
        return $password_check;
    } else {
        if (strlen($pass) <= 6) {
            return "Password must be greater than 6 characters";
        }
    }
}

function checkName($data) {
    return regEx("/^[a-zA-Z ]*$/", $data, "only characters are allowed");
}

function checkEmail($data) {
    return regEx("/^[a-z0-9\.]+@[a-z]+\.(\S*[a-z])$/", $data, "Invalid email format");
}

function phoneNumber($data) {
    $check_number = regEx("/^[0-9]*$/", $data, "Only numbers are allowed");
    if ($check_number) {
        return $check_number;
    } else {
        if (strlen($data) != 10) {
            return "maximum 10 digits are allowed";
        }
    }
}

function checkFile($size, $type) {
    if ($type != 'jpg' && $type != 'jpeg' && $type != 'png' && $type != '') {
        return "File should be in jpg, jpeg & png format allowed";
    } else {
        if ($size > 1000000) {
            return "File is less than or equal to 1mb are allowed";
        }
    }
}

$message = "";

if (isset($_POST['submit-button'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_num = $_POST['phone_num'];
    $gender = $_POST['gender'];
    $pass = $_POST['pass'];
    $cpass = $_POST['c_pass'];
    $f_name = $_FILES['file']['name'];
    $f_size = $_FILES['file']['size'];
    $type = strtolower(pathinfo($f_name,PATHINFO_EXTENSION));
    
    $temp_name = $_FILES['file']['tmp_name'];
    $path = "upload/".$f_name;
    
    $name_error = fieldRequired($name);
    $name_check = checkName($name);
    $email_error = fieldRequired($email);
    $email_check = checkEmail($email);
    $phone_num_error = fieldRequired($phone_num);
    $phone_num_check = phoneNumber($phone_num);
    $gender_error = fieldRequired($gender);
    $pass_error = fieldRequired($pass);
    $cpass_error = fieldRequired($cpass);
    $check_pass = checkPass($pass, $cpass);
    $check_file = checkFile($f_size, $type);
    
    if (!($name_error
    || $email_error
    || $email_check
    || $phone_num_error
    || $phone_num_check
    || $gender_error
    || $pass_error
    || $cpass_error
    || $check_pass
    || $check_file)) {

        $email_exist = $connection->prepare("SELECT * FROM user_detail WHERE email = ?");
        $email_exist->bind_param('s', $email);
        $email_exist->execute();
        $email_exist->store_result();
        if ($email_exist->num_rows > 0) {
            $message = "Email already exist";
        } else {
            $query = $connection->prepare("INSERT INTO user_detail (name, email, phone_number, gender, password, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param('ssssss', $name, $email, $phone_num, $gender, $pass, $f_name);

            if ($query->execute()) {
                $moved = move_uploaded_file($temp_name, $path);
                if (!$moved) {
                    $message = "failed ".$_FILES['file']['error'];
                }
                $message = "User detail inserted";
            } else {
                $message = "User detail not inserted";
            }
        }
    }
}
$connection->close();
?>