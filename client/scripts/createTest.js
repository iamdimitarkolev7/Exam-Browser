const submitCreateTestForm = (e) => {
  e.preventDefault();

  const file = document.getElementById('file');

  readFile(file);
}

const readFile = (file) => {
  if (!file.value) {
    // TODO: Handle error
    return;
  }

  let fileToRead = file.files[0];

  let fileread = new FileReader();
  fileread.onload = function(e) {
    let content = e.target.result;
    try {
      let json = JSON.parse(content);
      
      uploadTest(json);
    } catch (err) {
      // TODO: Handle error
      console.log(err);
    }
  };

  fileread.readAsText(fileToRead);
}

const uploadTest = (test) => {
  const testName = test.testName;
  const questions = serialiseQuestions(test);
  const answers = serialiseAnswers(test);
  const correctAnswers = serialiseCorrectAnswers(test);

  const serialisedTest = { testName, questions, answers, correctAnswers };

  sendData('http://localhost:80/exam-browser-api/server/controllers/create-test.php', serialisedTest)
  .then(response => {
    console.log(response);
  })
  .catch(err => {
    console.log(err);
  });
}
