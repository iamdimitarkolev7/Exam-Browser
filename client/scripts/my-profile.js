function loadSessionMyProfile() {
  const createdTestsTable = document.getElementById('created-tests-table');
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
    let number = 0;

    switch (+localStorage.getItem('userRole')) {
      case 1:
        const performedTestsArr = deserialisedGrades(response.resultGrade);
        for (const test of performedTestsArr) {
          const st = `
            <tr class="table-body-row">
              <td class="table-data">${number}</td>
              <td class="table-data">${test.testName}</td>
              <td class="table-data">${test.testGrade}</td>
            </tr>`
          number++;
          performedTestsTable.insertRow().innerHTML = st;
        }
        break;
      case 2:
        const createdTests = response.createdTests.split('|').filter(e => e !== '');

        for (const testName of createdTests) {
          const st = `
          <tr class="table-body-row">
            <td class="table-data">${number}</td>
            <td class="table-data">${testName}</td>
            <td class="table-data">
              <button id="delete-test-btn${number}">Delete test</button>
            </td>
          </tr>`
          number++;
          createdTestsTable.insertRow().innerHTML = st;
        }

        for (let i = 0; i < number; i++) {
          const btn = document.getElementById(`delete-test-btn${i}`);

          btn.addEventListener('click', deleteTest);
        }

        break;
    }
  })
  .catch(err => {
    console.log(err);
  });

  if (localStorage.getItem('userRole') == 1) {
    createdTestsTable.style.display = 'none';
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

const deleteTest = (e) => {
  const testName = e.target.parentElement.parentElement.children[1].textContent;

  sendData('http://localhost:80/exam-browser-api/server/controllers/delete-test.php', {testName})
  .then(response => {
    e.target.parentElement.parentElement.innerHTML = '';
  })
  .catch(err => console.log(err));
}