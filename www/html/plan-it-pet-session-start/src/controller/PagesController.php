<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/Task.php';
require_once __DIR__ . '/../model/User.php';


class PagesController extends Controller {

  public function index() {

  }

  public function login() {
    //save user to database
    if (!empty($_POST['action'])) {
      if ($_POST['action'] == 'addPerson') {
        if($_POST['password'] !== $_POST['password__repeat']){
          $errors['password__repeat'] = 'Password does not match';
        }
        $newUser = new User();
        $newUser->username = $_POST['username'];
        $newUser->email = $_POST['email'];
        $newUser->password = $_POST['password'];
        $errors = User::validate($newUser);
        if (empty($errors)) {
          $newUser->save();
          //header("Location:index.php?page=profile");
          $_SESSION['userlogin'] = $newUser->username;
          header('Location: index.php?page=profile&username=' . $_POST['username']);
          exit();
        } else {
          $this->set('errors', $errors);
        }
      }
      //  check if user is already a member
     if ($_POST['action'] == 'loginPerson') {
         $existingUser = User::where('email', '=', $_POST['email'])->get()->first();
       if($existingUser && $existingUser->password == $_POST['password']){
          $_SESSION['userlogin'] = $existingUser->username;
          header("Location:index.php?page=profile&username=" . $existingUser->username);
       };
     }
    }
  }

  public function profile() {
    if (empty($_GET['task'])) {
      $_GET['task'] = 'daily';
    }

    $tasks = Task::where('type', $_GET['task'])->get();

    if(!empty($_POST['action'])) {
      if($_POST['action'] == 'addTask') {
        $newTask = new Task;
        $newTask->recommended_id = NULL;
        $newTask->type = $_GET['task'];
        $newTask->name = $_POST['name'];
        $newTask->time = $_POST['time'];
        $newTask->description = $_POST['description'];

        $days = [];
        if (isset($_POST['monday'])) {
          $days[] = 'monday';
        }
        if (isset($_POST['tuesday'])) {
          $days[] = 'tuesday';
        }
        if (isset($_POST['wednesday'])) {
          $days[] = 'wednesday';
        }
        if (isset($_POST['thursday'])) {
          $days[] = 'thursday';
        }
        if (isset($_POST['friday'])) {
          $days[] = 'friday';
        }
        if (isset($_POST['saturday'])) {
          $days[] = 'saturday';
        }
        if (isset($_POST['sunday'])) {
          $days[] = 'sunday';
        }

        $newTask->days = $days;

        $errors = Task::validate($newTask);
        if (empty($errors)) {
          $newTask->days = implode(',', $days);
          $newTask->save();
          header("Location:index.php?page=profile");
          exit();
        } else {
          $this->set('errors', $errors);
        }
      }

      if ($_POST['action'] == 'deleteTask') {
        $task = Task::destroy($_POST['id']);
        header("Location:index.php?page=profile");
        exit();
      }
    }

    $this->set('tasks', $tasks);
  }

  public function taskApi () {
    if(!empty($_POST['action'])) {
      if ($_POST['action'] == 'addTask') {
        $newTask = new Task;
        $newTask->recommended_id = NULL;
        $newTask->type = $_POST['type'];
        $newTask->name = $_POST['name'];
        $newTask->time = $_POST['time'];
        $newTask->description = $_POST['description'];
        $newTask->days = $_POST['days'];

        $errors = Task::validate($newTask);
        if (empty($errors)) {
          $newTask->save();
          echo $newTask;
        }
      }

      if ($_POST['action'] == 'deleteTask') {
        $task = Task::destroy($_POST['id']);
      }
    }
  }
}
