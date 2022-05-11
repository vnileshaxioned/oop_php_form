<?php
require_once('user_script.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Details</title>
        <style>
            .form-group {
                padding: 5px;
            }
            span {
                color: red;
            }
            .output {
                display: flex;
            }
            .box {
                width: 30%;
            }
            .box img {
                width: 100px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h3><?php echo $message; ?></h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    Name: <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Name">
                    <span> * <?php echo $name_error ? $name_error : $name_check ; ?></span>
                </div>
                <div class="form-group">
                    Email: <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter Email">
                    <span> * <?php echo $email_error ? $email_error : $email_check ; ?></span>
                </div>
                <div class="form-group">
                    Phone Number: <input type="text" name="phone_num" class="form-control" value="<?php echo $phone_num; ?>" placeholder="Enter Phone Number">
                    <span> * <?php echo $phone_num_error ? $phone_num_error : $phone_num_check ; ?></span>
                </div>
                <div class="form-group">
                    Gender:
                    <?php
                        $checked = "checked='checked'";
                        $genders = array('Male', 'Female', 'Other');
                        foreach ($genders as $gender_list) {
                            if ($gender == $gender_list) {
                    ?>
                    <input type="radio" name="gender" value="<?php echo $gender_list; ?>" <?php echo $checked; ?>> <?php echo $gender_list; ?>
                    <?php } else { ?>
                    <input type="radio" name="gender" value="<?php echo $gender_list; ?>"> <?php echo $gender_list; ?>
                    <?php } } ?>
                    <span> * <?php echo $gender_error; ?></span>
                </div>
                <div class="form-group">
                    Password: <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                    <span> * <?php echo $pass_error ? $pass_error : $check_pass ; ?></span>
                </div>
                <div class="form-group">
                    Confirm Password: <input type="password" name="c_pass" class="form-control" placeholder="Enter Confirm Password">
                    <span> * <?php echo $cpass_error ? $cpass_error : $check_pass ; ?></span>
                </div>
                <div class="form-group">
                    <input type="file" name="file">
                    <span> <?php echo $check_file; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit-button" value="Submit">
                </div>
            </form>
            <a href="view_user_detail.php">Show inserted user data</a>
        </div>
    </body>
</html>