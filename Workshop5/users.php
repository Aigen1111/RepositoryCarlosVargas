<?php
require('utils/functions.php');


$conn = getConnection();
$sql = "SELECT u.firstName, u.lastName, u.email, p.name AS province, u.status, u.last_login_datetime 
        FROM users u 
        JOIN provinces p ON u.province_id = p.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of Users</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1 class="my-4">Users</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Province</th>
          <th>Status</th>
          <th>Last Login</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['firstName']; ?></td>
          <td><?php echo $row['lastName']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['province']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td><?php echo $row['last_login_datetime']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>
