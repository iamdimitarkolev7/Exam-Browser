function loadSession() {
  getData('../../server/controllers/index.php')
  .then(response => {
    window.localStorage.setItem('username', response.user);
    window.localStorage.setItem('userRole', response.role);
    setAuthorizedUserNavButtons(+response.role);
    setAuthorizedHomePage(response.role, response.user);
  })
  .catch(err => {
    if (err) {
      setUnathorizedUserButtons();
      setUnauthorizedHome();
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

function setAuthorizedHomePage(role, username) {
  const content = document.getElementById('content');

  if (role == 1) {
    content.innerHTML = `
      <div id="image-holder">
        <img src="../../images/student-home-page.png" alt="home-page-img">
      </div>
      <div id="description">
      <h1>Welcome @${username}</h1>
        <p>Now you can find tests, created by your teacher and do them. Also, you can keep track of your grades. Have fun!</p>
      </div>`;
  } else {
    content.innerHTML = `
      <div id="image-holder">
        <img src="../../images/teacher-home-page.png" alt="home-page-img">
      </div>
      <div id="description">
        <h1>Welcome @${username}</h1>
        <p>Now you can create tests and give them to your students. If you think that you made a mistake with the test, don't worry.
        Delete it and create a new one. Good luck!</p>
      </div>`;
  }
}

function setUnauthorizedHome() {
  const content = document.getElementById('content');

  content.innerHTML = `
    <div id="image-holder">
      <img src="../../images/home-page.png" alt="home-page-img">
    </div>
    <div id="description">
      <h1>Welcome to the Exam Browser</h1>
      <p>You can use this web application for creating tests, giving them to students and to keep track of made tests.</p>
    </div>`;
}