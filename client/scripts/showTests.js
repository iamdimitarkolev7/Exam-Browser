const loadAllTests = () => {
  getData('http://localhost:80/exam-browser-api/server/controllers/show-tests.php')
  .then(response => {
    console.log();

    const performedTests = deserialisedGrades(response.resultGrade);
    const deserialisedTests = deserialiseTests(response.testsData);
    const performedTestNames = [];

    let i = 0;

    for (const curr in performedTests) {
      performedTestNames.push(performedTests[i].testName);
      i++;
    }

    createTestSections(performedTestNames, deserialisedTests);
  })
  .catch(err => {
    console.log(err);
  });
}

const createTestSections = (performedTestNames, deserialisedTests) => {
  const table = document.getElementById('tests-table').getElementsByTagName('tbody')[0];
  let number = 0;
  let i = 0;

  for (const test of deserialisedTests) {
    const bt = `
      <tr class="table-body-row">
        <td class="table-data">${number}</td>
        <td class="table-data">${test.testName}</td>
        <td class="table-data">Performed test</td>
      </tr>`
    
      const tr = `
      <tr class="table-body-row">
        <td class="table-data">${number}</td>
        <td class="table-data">${test.testName}</td>
        <td class="table-data">
          <button id="do-test-btn${number}">Do this test</button>
        </td>
      </tr>`

      if (performedTestNames.includes(test.testName)) {
        table.insertRow().innerHTML = bt;
      } else {
        table.insertRow().innerHTML = tr;
        number++;
      } 
  }

  for (let i = 0; i < number; i++) {
    const btn = document.getElementById(`do-test-btn${i}`);

    btn.onclick = (e) => {
      e.preventDefault();

      const testName = btn.parentElement.parentElement.children[1].textContent;

      location.href = `./test.php?testName=${testName}`;
    }
  }
}
