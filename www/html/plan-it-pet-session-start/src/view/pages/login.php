<h1>Sign In Page</h1>

<div class="login-wrapper">
    <!-- log in -->
    <form method="post" action="index.php?page=login" class="login__form">
        <input type="hidden" name="action" value="loginPerson">
        <h2>Log In</h2>
        <div class="form__field">
          <p class="error"><?php if (!empty($errors['email'])) echo $errors['email']; ?></p>
          <label for="email">Email</label><br>
          <input type="email" name="email" id="email" placeholder="johndoe@doe.com" required value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>"/>
        </div>
        <div class="form__field">
          <p class="error"><?php if (!empty($errors['password'])) echo $errors['password']; ?></p>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="..." required value="<?php if (!empty($_POST['password'])) echo $_POST['password']; ?>"/>
        </div><br>
        <!-- <a href="index.php?page=profile"> -->
            <input type="submit" value="Log In" class="button">
        <!-- </a> -->
    </form>
    <!-- Register -->
    <form method="post" action="index.php?page=login" class="login__form">
        <input type="hidden" name="action" value="addPerson">
        <h2>Register</h2>
        <div class="form__field">
          <p class="error"><?php if (!empty($errors['username'])) echo $errors['username']; ?></p>
          <label for="username">Name</label><br>
          <input type="text" id="username" name="username" placeholder="John Doe" required value="<?php if (!empty($_POST['username'])) echo $_POST['username']; ?>"/>
        </div>
        <div class="form__field">
          <p class="error"><?php if (!empty($errors['email'])) echo $errors['email']; ?></p>
          <label for="email">Email</label><br>
          <input type="email" id="email" name="email" placeholder="johndoe@doe.com" required value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>"/>
        </label>
        </div>
        <div class="form__field">
          <p class="error"><?php if (!empty($errors['password'])) echo $errors['password']; ?></p>
          <label for="password">Password</label><br>
          <input type="password" id="password" name="password" placeholder="..." minlength="4" required value="<?php if (!empty($_POST['password'])) echo $_POST['password']; ?>"/>
        </div>
        <div class="form__field">
          <p class="error"><?php if (!empty($errors['password__repeat'])) echo $errors['password__repeat']; ?></p>
          <label for="password__repeat">Repeat Password</label><br>
          <input type="password" id="password__repeat" name="password__repeat" placeholder="..." required>
        </div><br>
        <!-- <a href="index.php?page=profile"> -->
            <input type="submit" class="button" value="Register">
        <!-- </a> -->
    </form>
</div>
