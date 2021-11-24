export const validateTaskForm = data => {
  const errors = [];

  if (data.get(`name`) === ``) {
    errors.push({
      key: `name`,
      value: `Please write down a name`
    });
  }

  if (data.get(`days`) === ``) {
    errors.push({
      key: `days`,
      value: `Select at least one day`
    });
  }
  
  if (data.get(`time`) === ``) {
    errors.push({
      key: `time`,
      value: `At what time is the task?`
    });
  }

  return errors;
};
