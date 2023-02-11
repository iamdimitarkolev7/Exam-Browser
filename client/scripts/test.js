const loadTest = () => {
  const testName = this.location.href.split('=')[1];

  getData('http://localhost:80/exam-browser-api/server/controllers/show-tests.php', testName)
  .then(response => {
    const deserialisedTest = deserialiseTests(response.testsData)[0];
    const testName = deserialisedTest.testName;
    const questions = deserialisedTest.questions;
    console.log(questions);
  })
  .catch(err => console.log(err));
}

const createTestHTML = () => {
  // TODO: create the structure of the test in HTML
}