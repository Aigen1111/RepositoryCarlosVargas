<?php
require 'utils/functions.php';

if (!isset($_GET['id'])) {
  header('Location: /Workshop4/users.php');
  exit();
}

$id = $_GET['id'];
$conn = getConnection();

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($_POST) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $username = $_POST['email'];

  $stmt = $conn->prepare("UPDATE users SET name = ?, lastname = ?, username = ? WHERE id = ?");
  $stmt->bind_param('sssi', $firstName, $lastName, $username, $id);

  if ($stmt->execute()) {
    header('Location: /Workshop4/users.php');
  } else {
    echo "Error al actualizar el usuario.";
  }
  $stmt->close();
}

?>

<?php require('inc/header.php') ?>
<div class="container-fluid">
  <div class="jumbotron">
    <h1 class="display-4">Edit User</h1>
    <hr class="my-4">
  </div>

  <form method="post" action="/Workshop4/edit_user.php?id=<?php echo $user['id']; ?>">
    <div class="form-group">
      <label for="first-name">First Name</label>
      <input id="first-name" class="form-control" type="text" name="firstName" value="<?php echo $user['name']; ?>">
    </div>
    <div class="form-group">
      <label for="last-name">Last Name</label>
      <input id="last-name" class="form-control" type="text" name="lastName" value="<?php echo $user['lastname']; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email Address</label>
      <input id="email" class="form-control" type="text" name="email" value="<?php echo $user['username']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
<?php require('inc/footer.php') ?>
