function loadSessionMyProfile() {
  const createdTests = document.getElementById('created-tests');
  const createdTitle = document.querySelector(".created-tests-title");
  const performedTests = document.getElementById('performed-tests');
  const performedTitle = document.querySelector(".performed-tests-title");
  const allTitle = document.querySelector(".all-tests-title");
  const allTests = document.getElementById('all-students-tests');
  const performedTestsTable = document.getElementById('performed-tests-table').getElementsByTagName('tbody')[0];

  let btnCreateTest = document.getElementById('create-test-btn');
  let btnShowTest = document.getElementById('show-tests-btn');

  getData('http://localhost:80/exam-browser-api/server/controllers/show-tests.php')
  .then(response => {
    const performedTestsArr = deserialisedGrades(response.resultGrade);
    let number = 0;
    for (const test of performedTestsArr) {
      console.log(test);
      const st = `
        <tr class="table-body-row">
          <td class="table-data">${number}</td>
          <td class="table-data">${test.testName}</td>
          <td class="table-data">${test.testGrade}</td>
        </tr>`
      number++;
      performedTestsTable.insertRow().innerHTML = st;
    }


    
  })
  .catch(err => {
    console.log(err);
  });


  if (localStorage.getItem('userRole') == 1) {
    createdTests.style.display = 'none';
    createdTitle.style.display = 'none';
    allTitle.style.display = 'none';  
    allTests.style.display = 'none';
    btnCreateTest.style.display = 'none';
    btnShowTest.parentElement.style.margin = 0;

    
  } else {
    performedTests.style.display = 'none';
    performedTitle.style.display = 'none';
    btnShowTest.style.display = 'none';
    btnShowTest.style.margin = 0;
  }

}

