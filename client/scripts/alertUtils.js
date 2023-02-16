const showAlertBox = (success, message) => {
  const alertBox = document.getElementById('alert');

  if (success) {
    console.log(success);
    alertBox.style.backgroundColor = 'green';
  } else {
    alertBox.style.backgroundColor = '#f44336';
  }

  alertBox.textContent = message;
  alertBox.style.display = 'block';

  setTimeout(() => {
    alertBox.style.display = 'none'
  }, 3000);
}