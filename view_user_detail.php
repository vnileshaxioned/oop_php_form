<?php
require_once('user_script.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        .container {
            width: 90%;
            margin: 0 auto;
        }
        table {
            width: 100%;
        }
        th,td {
            border-bottom: 1px solid #000;
            padding: 10px 0;
            text-align: center;
        }
        img {
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>User Details</h3>
        <h3><?php echo $message; ?></h3>
        <a href="index.php">Back to form</a>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Profile Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = selectQuery('users');
                    $user_detail = $conn->query($query);
                    if ($user_detail > 0) {
                        $id = 1;
                        while ($detail = $user_detail->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $id++; ?></td>
                        <td><?php echo $detail['name']; ?></td>
                        <td><?php echo $detail['email']; ?></td>
                        <td><?php echo $detail['phone_number']; ?></td>
                        <td><?php echo $detail['gender']; ?></td>
                        <td>
                            <?php
                                if ($detail['profile_image']) {
                            ?>
                                <img src="upload/<?php echo $detail['profile_image']; ?>" alt="<?php echo $detail['profile_image']; ?>">
                            <?php } else {
                                    echo "No image";
                                }
                            ?>
                        </td>
                    <?php
                            }
                        } else {
                    ?>
                        <td colspan="6">No user data found</td>
                    </tr>
                <?php } $conn->close(); ?>
            </tbody>
        </table>
    </div>
</body>
</html>