function loadSessionMyProfile() {
  const createdTests = document.getElementById('created-tests');
  const createdTitle = document.querySelector(".created-tests-title");
  const performedTests = document.getElementById('performed-tests');
  const performedTitle = document.querySelector(".performed-tests-title");
  const allTitle = document.querySelector(".all-tests-title");
  const allTests = document.getElementById('all-students-tests');

  let btnCreateTest = document.getElementById('create-test-btn');
  let btnShowTest = document.getElementById('show-tests-btn');



  if (localStorage.getItem('userRole') == 1) {
    createdTests.style.display = 'none';
    createdTitle.style.display = 'none';
    allTitle.style.display = 'none';
    allTests.style.display = 'none';
    btnCreateTest.style.display = 'none';
    
  } else {
    performedTests.style.display = 'none';
    performedTitle.style.display = 'none';
    btnShowTest.style.display = 'none';
  }

}

