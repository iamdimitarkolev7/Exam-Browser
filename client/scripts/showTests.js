const loadAllTests = () => {
  getData('http://localhost:80/exam-browser-api/server/controllers/show-tests.php')
  .then(response => {
    console.log(response.testsData);
    const deserialisedTests = deserialiseTests(response.testsData);

    // TODO: load tests in show-tests.html
    console.log(deserialisedTests);
  })
  .catch(err => {
    console.log(err);
  });
}