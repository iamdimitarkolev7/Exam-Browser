function loadSession() {
  getData('http://localhost:80/exam-browser-api/server/controllers/index.php')
  .then(response => {
    window.localStorage.setItem('username', response.user);
    window.localStorage.setItem('userRole', response.role);
    setAuthorizedUserNavButtons(+response.role);
  })
  .catch(err => {
    if (err) {
      setUnathorizedUserButtons();
    }
  });
}

function setAuthorizedUserNavButtons(role) {
  let signInBtn = document.getElementById('sign-in-btn');
  let signUpBtn = document.getElementById('sign-up-btn');
  let showTestsBtn = document.getElementById('show-tests-btn');
  let createTestBtn = document.getElementById('create-test-btn');
  let myProfileBtn = document.getElementById('my-profile-btn');
  let logoutBtn = document.getElementById('logout-btn');

  document.cookie = `role=${+role}`;

  if (role == 1) {
    showTestsBtn.style.display = 'inline-block';
    showTestsBtn.parentElement.style.margin = 0;
    createTestBtn.style.display = 'none';
  } else if (role == 2) {
    showTestsBtn.style.display = 'none';
    createTestBtn.style.display = 'inline-block';
  }

  signInBtn.style.display = 'none';
  signUpBtn.style.display = 'none';
  signInBtn.parentElement.style.margin = 0;
  signUpBtn.parentElement.style.margin = 0;
  myProfileBtn.style.display = 'inline-block';
  logoutBtn.style.display = 'inline-block';
}

function setUnathorizedUserButtons() {
  let signInBtn = document.getElementById('sign-in-btn');
  let signUpBtn = document.getElementById('sign-up-btn');
  let showTestsBtn = document.getElementById('show-tests-btn');
  let createTestBtn = document.getElementById('create-test-btn');
  let myProfileBtn = document.getElementById('my-profile-btn');
  let logoutBtn = document.getElementById('logout-btn');

  signInBtn.style.display = 'inline-block';
  signUpBtn.style.display = 'inline-block';
  showTestsBtn.style.display = 'none';
  createTestBtn.style.display = 'none';
  myProfileBtn.style.display = 'none';
  logoutBtn.style.display = 'none';
}