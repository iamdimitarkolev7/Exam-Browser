(function() {
    let register = document.getElementById('register');
  
    register.addEventListener('click', sendForm);
})();
  
function sendForm(event) {
  event.preventDefault();
  
  let firstName = document.getElementById('first-name').value;
  let lastName = document.getElementById('last-name').value;
  let username = document.getElementById('user-name').value;
  let password = document.getElementById('password').value;
  let confirmPassword = document.getElementById('confirm-password').value;

  let role;

  if (document.getElementById('student').checked) {
    role = 1;
  } else if (document.getElementById('teacher').checked) {
    role = 2;
  }
  
  let user = { firstName, lastName, username, password, confirmPassword, role };

  sendRequest('../../server/controllers/register.php', { method: 'POST', data: `data=${JSON.stringify(user)}` }, load, handleError);
}

function load(response) {
  let errors = document.getElementById('errors');
  errors.innerHTML = '';
  errors.style.display = 'none';

  // TODO: handle response

  window.location = './login.html';
}

function handleError(error) {
  let errors = document.getElementById('errors');

  errors.style.display = 'block';
  errors.style.color = 'red';

  // TODO: handle errors

  errors.innerHTML = error['message'];
}

function checkTeacherBtn() {
  const teacherRadiobutton = document.getElementById('teacher');
  const studentRadioBtn = document.getElementById('student');

  studentRadioBtn.checked = false;
  teacherRadiobutton.checked = true;
}

function checkStudentBtn() {
  const teacherRadiobutton = document.getElementById('teacher');
  const studentRadioBtn = document.getElementById('student');

  studentRadioBtn.checked = true;
  teacherRadiobutton.checked = false;
}