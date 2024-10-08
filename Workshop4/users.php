<?php
include('utils/functions.php');

$conn = getConnection();
$result = $conn->query("SELECT * FROM users");

?>
<?php require('inc/header.php') ?>
<div class="container-fluid">
  <div class="jumbotron">
    <h1 class="display-4">Users</h1>
    <p class="lead">List of users</p>
    <hr class="my-4">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($user = $result->fetch_assoc()) : ?>
        <tr>
          <td><?php echo $user['name']; ?></td>
          <td><?php echo $user['lastname']; ?></td>
          <td><?php echo $user['username']; ?></td>
          <td>
            <a href="/Workshop4/edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="/Workshop4/delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php require('inc/footer.php'); ?>
