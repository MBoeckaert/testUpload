import {validateTaskForm} from './validate.js';

export const removeServerForm = () => {
  const $taskForm = document.querySelector(`.add-task`);
  const taskDeletes = document.querySelectorAll(`.delete-task`);
  // if adjustments are made in php, it automatically changes in js
  const taskformLayout = $taskForm.innerHTML;

  // delete server side form and replace
  $taskForm.remove();
  taskDeletes.forEach($taskDelete => {
    $taskDelete.remove();
  });

  addDeleteButtons();

  const $taskWrapper = document.querySelector(`.task-wrapper`);
  const $newAddButton = document.createElement(`button`);
  $newAddButton.textContent = `add`;
  $taskWrapper.appendChild($newAddButton);

  $newAddButton.addEventListener(`click`, () => {
    createTaskForm(taskformLayout);
  });
};

const addDeleteButtons = () => {
  const tasks = document.querySelectorAll(`.task`);

  tasks.forEach($task => {
    const $newButton = document.createElement(`button`);
    $newButton.textContent = `delete`;
    $task.appendChild($newButton);
    $newButton.addEventListener(`click`, handleDeleteTask);
  });
};

const createTaskForm = taskFormLayout => {
  const $container = document.querySelector(`.container`);
  const $newOverlay = document.createElement(`div`);
  $newOverlay.classList.add(`overlay`);

  const $newTaskForm = document.createElement(`form`);
  $newTaskForm.classList.add(`add-task`);
  $newTaskForm.classList.add(`add-task--withjs`);
  $newTaskForm.innerHTML = taskFormLayout;

  createCloseButton($newTaskForm);

  $container.appendChild($newTaskForm);
  $container.appendChild($newOverlay);

  $newTaskForm.addEventListener(`submit`, handleAddTask);
};

const handleAddTask = e => {
  e.preventDefault();
  const formData = getFormData();
  const errors = validateTaskForm(formData);
  if (errors.length === 0) {
    const ajax = setupAjax(formData);

    ajax.onreadystatechange = () => {
      if (ajax.readyState === 4 && ajax.status === 200) {
        document.querySelector(`.add-task`).innerHTML = `Progress saved`;
        showLatestTask(formData);
        setTimeout(closeTaskForm, 1000);
      }
    };
  } else {
    const nameError = errors.find(error => error.key === `name`);
    const daysError = errors.find(error => error.key === `days`);
    const timeError = errors.find(error => error.key === `time`);

    const $nameErrorField = document.querySelector(`.name-error`);
    if (nameError !== undefined) {
      $nameErrorField.textContent = nameError.value;
    } else {
      $nameErrorField.textContent = ``;
    }

    const $daysErrorField = document.querySelector(`.days-error`);
    if (daysError !== undefined) {
      $daysErrorField.textContent = daysError.value;
    } else {
      $daysErrorField.textContent = ``;
    }

    const $timeErrorField = document.querySelector(`.time-error`);
    if (timeError !== undefined) {
      $timeErrorField.textContent = timeError.value;
    } else {
      $timeErrorField.textContent = ``;
    }
  }
};

const handleDeleteTask = e => {
  const $task = e.target.parentElement;
  const id = $task.querySelector(`.hidden`).textContent;

  const formData = new FormData();
  formData.append(`action`, `deleteTask`);
  formData.append(`id`, id);

  const ajax = setupAjax(formData);

  ajax.onreadystatechange = () => {
    if (ajax.readyState === 4 && ajax.status === 200) {
      $task.remove();
    }
  };

};

const showLatestTask = formData => {
  const $taskList = document.querySelector(`.tasks`);

  const $newTask = document.createElement(`li`);
  $newTask.classList.add(`task`);

  const $nameText = document.createElement(`p`);
  $nameText.textContent = formData.get(`name`);
  $nameText.classList.add(`task__name`);

  const $timeText = document.createElement(`p`);
  $timeText.textContent = formData.get(`time`);
  $nameText.classList.add(`task__time`);

  const $checkButton = document.createElement(`button`);
  $checkButton.textContent = `check`;

  $newTask.appendChild($nameText);
  $newTask.appendChild($timeText);
  $newTask.appendChild($checkButton);

  $taskList.appendChild($newTask);
};

const getFormData = () => {
  const formData = new FormData();
  const days = [];
  if (document.getElementById(`monday`).checked) {
    days.push(`monday`);
  }
  if (document.getElementById(`tuesday`).checked) {
    days.push(`tuesday`);
  }
  if (document.getElementById(`wednesday`).checked) {
    days.push(`wednesday`);
  }
  if (document.getElementById(`thursday`).checked) {
    days.push(`thursday`);
  }
  if (document.getElementById(`friday`).checked) {
    days.push(`friday`);
  }
  if (document.getElementById(`saturday`).checked) {
    days.push(`saturday`);
  }
  if (document.getElementById(`sunday`).checked) {
    days.push(`sunday`);
  }

  const urlParams = new URLSearchParams(window.location.search);

  formData.append(`name`, document.getElementById(`name`).value);
  formData.append(`time`, document.getElementById(`time`).value);
  formData.append(`description`, document.getElementById(`description`).value);
  formData.append(`days`, days.join(`,`));
  formData.append(`type`, urlParams.get(`task`));
  formData.append(`action`, `addTask`);

  return formData;
};

const createCloseButton = $wrapper => {
  const $newCloseButton = document.createElement(`button`);
  $newCloseButton.textContent = `close`;
  $newCloseButton.classList.add(`close-button`);

  $wrapper.appendChild($newCloseButton);

  $newCloseButton.addEventListener(`click`, closeTaskForm);
};

const closeTaskForm = () => {
  document.querySelector(`.add-task`).remove();
  document.querySelector(`.overlay`).remove();
};

const setupAjax = formData => {
  const ajax = new XMLHttpRequest();
  ajax.open(`POST`, `index.php?page=task-api`, true);
  ajax.send(formData);
  return ajax;
};
