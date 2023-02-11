const loadAllTests = () => {
  getData('http://localhost:80/exam-browser-api/server/controllers/show-tests.php')
  .then(response => {
    const deserialisedTests = deserialiseTests(response.testsData);
    createTestSections(deserialisedTests);
  })
  .catch(err => {
    console.log(err);
  });
}

const createTestSections = (deserialisedTests) => {
  const table = document.getElementById('tests-table').getElementsByTagName('tbody')[0];
  let number = 0;

  for (const test of deserialisedTests) {
    const tr = `
      <tr class="table-body-row">
        <td class="table-data">${number}</td>
        <td class="table-data">${test.testName}</td>
        <td class="table-data">
          <button id="do-test-btn${number}">Do this test</button>
        </td>
      </tr>`

      number++;

      table.insertRow().innerHTML = tr;
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
