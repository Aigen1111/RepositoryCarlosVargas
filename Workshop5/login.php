<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="jumbotron">
      <h1 class="display-4">Login</h1>
      <p class="lead">Please enter your credentials</p>
      <hr class="my-4">
    </div>
    <form method="post" action="login_action.php">
      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <a href="index.php" class="btn btn-secondary">Registrarse</a>
    </form>
  </div>
</body>

</html>
