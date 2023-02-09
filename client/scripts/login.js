const form = document.getElementById('login-form');
const loginBtn = document.getElementById('login-btn');

form.onsubmit = (e) => {
  e.preventDefault();
}

loginBtn.onclick = () => {
  let username = document.getElementById('username').value;
  let password = document.getElementById('password').value;
  console.log(username);
  console.log(password);

  let user = {
    username,
    password
  };

  sendData('http://localhost:80/exam-browser-api/server/controllers/login.php', user)
  .then(response => {
    console.log(response);
    load(response);
    location.href = './index.php';
  })
  .catch(err => {
    console.log(err);
  });
}

function load(response) {
    var errors = document.getElementById('errors');
    errors.innerHTML = '';
    errors.style.display = 'none';
}

function handleError(error) {
    console.log(error)
    var errors = document.getElementById('errors');

    errors.style.display = 'block';
    errors.style.color = 'red';

    errors.innerHTML = error['message'];
}