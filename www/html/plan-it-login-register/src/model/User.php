<?php

use \Illuminate\Database\Eloquent\Model;

class User extends Model {
  public $timestamps = false;

  public function task()
  {
    return $this->hasOne(Task::class);
  }

  public static function validate($data) {
    $errors = [];

    $checkusername = User::where('username', 'LIKE', '%' .$data['username'] . '%')->get();
    $checkemail = User::where('email', 'LIKE', '%' .$data['email'] . '%')->get();

    if (empty($data['username'])) {
      $errors['username'] = 'Please choose a username.';
    }
    if(count($checkusername) >=1){
      $errors['username'] = 'Username already taken';
    }
    if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
      $errors['email'] = 'Please fill in email';
    }
    if(count($checkemail) >=1){
      $errors['email'] = 'Email already used';
    }
    if(empty($data['password'])){
      $errors['password'] = 'Please fill in password';
    }

    return $errors;
  }
}
