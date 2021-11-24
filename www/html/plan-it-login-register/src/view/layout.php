<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo $css; ?>
  <title>Pet-Plan-It</title>
</head>
<body>
  <div class="container">
      <header>
        <nav>
          <ul>
            <a href="index.php?page=home">home</a>
            <a href="index.php?page=profile">profile</a>
            <a href="index.php?page=login">log in</a>
          </ul>
        </nav>
      </header>
      <?php echo $content;?>
  </div>
  <?php echo $js; ?>
</body>
</html>
