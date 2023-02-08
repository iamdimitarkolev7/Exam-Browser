(function() {
    let register = document.getElementById('sign-in-btn');
  
    register.addEventListener('click', sendForm);
})();
  
async function sendForm(event) {
  event.preventDefault();
  
  let firstName = document.getElementById('first-name').value;
  let lastName = document.getElementById('last-name').value;
  let username = document.getElementById('username').value;
  let password = document.getElementById('password').value;
  let confirmPassword = document.getElementById('repeat-password').value;

  let role = 0;

  if (document.getElementById('student').checked) {
    role = 1;
  } else if (document.getElementById('teacher').checked) {
    role = 2;
  }
  
  let user = { firstName, lastName, username, password, confirmPassword, role };

  const request = await fetch('http://localhost/exam-browser-api/server/controllers/register.php', {
    method: 'POST',
    headers: { 
      'Accept': 'application/json',
      'Content-Type': 'application/x-www-form-urlencoded' 
    },
    body: Object.entries(user).map(([k,v])=>{return k+'='+v}).join('&')
  });

  const response = await request.json();

  if (response.success) {
    load(response);
  } else {
    showError(response);
  }
}

function load(response) {
  let errors = document.getElementById('errors');
  errors.innerHTML = '';
  errors.style.display = 'none';

  window.location = '../pages/index.php';
}

function handleError(error) {
  let errors = document.getElementById('errors');

  errors.style.display = 'block';
  errors.style.color = 'red';

  errors.innerHTML = error['message'];
}

function showError(errors) {
  handleError(errors);
  setTimeout(() => {
    let errors = document.getElementById('errors');
    errors.style.display='none';
  }, 4000);
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