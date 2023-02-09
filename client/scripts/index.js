function loadSession() {
  getData('http://localhost:80/exam-browser-api/server/controllers/index.php')
  .then(response => {
    setAuthorizedUserNavButtons(+response.role); // converts string to int
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

  if (role == 1) {
    showTestsBtn.style.display = 'block';
    createTestBtn.style.display = 'none';
  } else if (role == 2) {
    showTestsBtn.style.display = 'none';
    createTestBtn.style.display = 'block';
  }

  signInBtn.style.display = 'none';
  signUpBtn.style.display = 'none';
  myProfileBtn.style.display = 'block';
  logoutBtn.style.display = 'block';
}

function setUnathorizedUserButtons() {
  let signInBtn = document.getElementById('sign-in-btn');
  let signUpBtn = document.getElementById('sign-up-btn');
  let showTestsBtn = document.getElementById('show-tests-btn');
  let createTestBtn = document.getElementById('create-test-btn');
  let myProfileBtn = document.getElementById('my-profile-btn');
  let logoutBtn = document.getElementById('logout-btn');

  signInBtn.style.display = 'block';
  signUpBtn.style.display = 'block';
  showTestsBtn.style.display = 'none';
  createTestBtn.style.display = 'none';
  myProfileBtn.style.display = 'none';
  logoutBtn.style.display = 'none';
}