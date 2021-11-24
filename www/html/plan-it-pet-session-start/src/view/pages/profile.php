<h1>This is the profile page of <?php echo $_SESSION['userlogin'] ?></h1>

<div class="task-wrapper">
  <nav>
    <ul>
      <li>
        <a href="index.php?page=profile&task=daily">daily</a>
      </li>
      <li>
        <a href="index.php?page=profile&task=training">training</a>
      </li>
      <li>
        <a href="index.php?page=profile&task=freetime">free time</a>
      </li>
    </ul>
  </nav>
  <ul class="tasks" >
    <?php foreach ($tasks as $task): ?>
      <li class="task">
        <p class="hidden"><?php echo $task->id; ?></p>
        <p class="task__name"><?php echo $task->name; ?></p>
        <p class="task__time"><?php echo $task->time; ?></p>
        <form class="delete-task" action="index.php?page=profile" method="post">
          <input type="hidden" name="action" value="deleteTask">
          <input type="hidden" name="id" value="<?php echo $task->id; ?>">
          <input type="submit" value="delete">
        </form>
      </li>
    <?php endforeach; ?>
  </ul>
  <form class="add-task" method="post" action="index.php?page=profile">
        <input type="hidden" name="action" value="addTask">
        <div class="form__field">
          <p class="error name-error"><?php if(!empty($errors['name'])) echo $errors['name'] ;?></p>
          <label for="name">Name</label>
          <input type="text" name="name" id="name" <?php if(!empty($_POST['name'])) { echo 'value=' . $_POST['name'];} ?>>
        </div>
        <div class="days">
          <p class="error days-error"><?php if(!empty($errors['days'])) echo $errors['days'] ;?></p>
          <p>Which days?</p>
          <ul>
            <li class="day">
              <label for="monday">M</label>
              <input type="checkbox" name="monday" id="monday" <?php if(isset($_POST['monday'])) { echo 'checked'; } ?>>
            </li>
            <li class="day">
              <label for="tuesday">T</label>
              <input type="checkbox" name="tuesday" id="tuesday" <?php if(isset($_POST['tuesday'])) { echo 'checked'; } ?>>
            </li>
            <li class="day">
              <label for="wednesday">W</label>
              <input type="checkbox" name="wednesday" id="wednesday" <?php if(isset($_POST['wednesday'])) { echo 'checked'; } ?>>
            </li>
            <li class="day">
              <label for="thursday">T</label>
              <input type="checkbox" name="thursday" id="thursday" <?php if(isset($_POST['thursday'])) { echo 'checked'; } ?>>
            </li>
            <li class="day">
              <label for="friday">F</label>
              <input type="checkbox" name="friday" id="friday" <?php if(isset($_POST['friday'])) { echo 'checked'; } ?>>
            </li>
            <li class="day">
              <label for="saturday">S</label>
              <input type="checkbox" name="saturday" id="saturday" <?php if(isset($_POST['saturday'])) { echo 'checked'; } ?>>
            </li>
            <li class="day">
              <label for="sunday">S</label>
              <input type="checkbox" name="sunday" id="sunday" <?php if(isset($_POST['sunday'])) { echo 'checked'; } ?>>
            </li>
          </ul>
        </div>
        <div class="form__field">
          <p class="error time-error"><?php if(!empty($errors['time'])) echo $errors['time'] ;?></p>
          <label for="time">At what time?</label>
          <input type="time" name="time" id="time" <?php if(!empty($_POST['time'])) { echo 'value=' . $_POST['time'];} ?>>
        </div>
        <div class="form__field">
          <label for="description">Description</label>
          <input type="text" name="description" id="description" <?php if(!empty($_POST['description'])) { echo 'value=' . $_POST['description'];} ?>>
        </div>
        <input class="form__field add-task__submit" type="submit" value="Add task">
    </form>
</div>
