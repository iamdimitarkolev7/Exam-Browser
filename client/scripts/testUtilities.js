const serialiseQuestions = (test) => {
  let allQuestions = [];

  for (const [key, value] of Object.entries(test.questions)) {
    allQuestions.push(value.question);
  }

  return allQuestions.join('|nq|'); // |nq| is the delimiter for the questions
}

const serialiseAnswers = (test) => {
  let allAnswers = [];

  for (const [key, value] of Object.entries(test.questions)) {
    let currAnswers = value.answers.join('|cqa|') // |cqa| is the delimiter for current question answers
    allAnswers.push(currAnswers);
  }

  return allAnswers.join('|na|'); // |na| is the delimiter for all of the answers
}

const serialiseCorrectAnswers = (test) => {
  let allCorrectAnswers = [];

  for (const [key, value] of Object.entries(test.questions)) {
    allCorrectAnswers.push(value.correctAnswer);
  }

  return allCorrectAnswers.join('|nca|'); // |nqa| is the delimiter for the correct answers
}

const deserialiseTests = (testsData) => {
  let deserialisedTests = [];

  for (let testData of testsData) {
    let crrTest = {};
    crrTest.id = testData.id;
    crrTest.testName = testData.testName;
    crrTest.questions = deserialiseQuestions(testData.questions, testData.answers, testData.correctAnswers);

    deserialisedTests.push(crrTest);
  }

  return deserialisedTests;
}

const deserialiseQuestions = (questions, answers, correctAnswers) => {
  let questionsResult = [];
  let questionsArr = questions.split('|nq|');
  let answersArr = answers.split('|na|');
  let correctAnswersArr = correctAnswers.split('|nca|');

  for (let i = 0; i < questionsArr.length; ++i) {
    let crrQuestion = {};
    crrQuestion.question = questionsArr[i];
    crrQuestion.answers = answersArr[i].split('|cqa|');
    crrQuestion.correctAnswer = correctAnswersArr[i];

    questionsResult.push(crrQuestion);
  }

  return questionsResult;
}