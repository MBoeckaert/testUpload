<?php

use \Illuminate\Database\Eloquent\Model;

class Task extends Model {
  public $timestamps = false;

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public static function validate($data) {
    $errors = [];

    if (empty($data['name'])) {
      $errors['name'] = 'Please write down a name.';
    }

    if (empty($data['days'])) {
      $errors['days'] = 'Select at least one day.';
    }

    if (empty($data['time'])) {
      $errors['time'] = 'At what time is the task?';
    }

    return $errors;
  }
}
