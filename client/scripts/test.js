let questionsMaxIndex = 0;
let currentSlide = 0;
let correctAnswers = [];
let testName = '';

const loadTest = () => {
  testName = this.location.href.split('=')[1];

  getData('http://localhost:80/exam-browser-api/server/controllers/show-tests.php?testName=' + testName)
  .then(response => {
    const deserialisedTest = deserialiseTests(response.testsData)[0];
    testName = deserialisedTest.testName;
    const questions = deserialisedTest.questions;
    questionsMaxIndex = questions.length - 1;

    createTestHTML(testName, questions);
  })
  .catch(err => console.log(err));
}

const createTestHTML = (testName, questions) => {
  correctAnswers = questions.map(item => item.correctAnswer);
  const output = [];
  const h1 = document.querySelectorAll('h1')[0];
  h1.textContent = testName;
  let num = 1;

  for (const question of questions) {
    const answers = [];

    for (const answer of question.answers) {
      answers.push(
        `<label>
          <input type="radio" name="question${num}" value="${answer}">
          ${answer}
        </label>`);
    }

    num++;

    output.push(
      `<div class="slide">
        <div class="question"> ${question.question} </div>
        <div class="answers"> ${answers.join("")} </div>
      </div>`
    );
  }
  
  const quizContainer = document.getElementById('quiz');
    
  quizContainer.innerHTML = output.join('');

  const previousButton = document.getElementById("previous");
  const nextButton = document.getElementById("next");
  const submitButton = document.getElementById("submit");
  const homeButton = document.getElementById("home");
  
  const slides = document.querySelectorAll(".slide");
  slides[0].classList.add('active-slide');

  nextButton.style.display = 'inline-block';
  previousButton.style.display = 'none';
  submitButton.style.display = 'none';
  homeButton.style.display = 'none';

  nextButton.addEventListener('click', showNextSlide);
  previousButton.addEventListener('click', showPreviousSlide);
  submitButton.addEventListener('click', showResults);
  homeButton.addEventListener('click', showHomePage);
}

const showNextSlide = () => {
  const slides = document.querySelectorAll(".slide");
  slides[currentSlide + 1].classList.add('active-slide');
  slides[currentSlide].classList.remove('active-slide');

  currentSlide++;
  showSlide();
}

const showPreviousSlide = () => {
  const slides = document.querySelectorAll(".slide");
  slides[currentSlide - 1].classList.add('active-slide');
  slides[currentSlide].classList.remove('active-slide');
  
  currentSlide--;
  showSlide();
}

const showSlide = () => {
  const previousButton = document.getElementById("previous");
  const nextButton = document.getElementById("next");
  const submitButton = document.getElementById("submit");

  if (currentSlide === 0) {
    previousButton.style.display = 'none';
  } else{
    previousButton.style.display = 'inline-block';
  }

  if (currentSlide === questionsMaxIndex) {
    nextButton.style.display = 'none';
    submitButton.style.display = 'inline-block';
  } else {
    nextButton.style.display = 'inline-block';
    submitButton.style.display = 'none';
  }

}

const showResults = () => {
  const quizContainer = document.getElementsByClassName('quiz-container')[0];
  const answerContainers = quizContainer.querySelectorAll('.answers');
  const homeButton = document.getElementById("home");

  // keep track of user's answers
  let numCorrect = 0;
  let i = 0;
  let num = 1;

  for (const answers of answerContainers) {
    const answerContainer = document.querySelector(`input[name="question${num}"]:checked`);
    const givenAnswer = answerContainer.value;
    const correctAnswer = correctAnswers[i];
    
    if (givenAnswer === correctAnswer) {
      numCorrect++;
      answerContainer.parentElement.style.color = 'lightgreen';
    } else {
      answerContainer.parentElement.style.color = 'red';
    }

    num++;
    i++;
  }

  const percantige = (numCorrect/(num - 1))*100;
  const resultsContainer = document.getElementById('results');
  const gradeContainder = document.getElementById('grade');

  resultsContainer.innerHTML = `${numCorrect} out of ${num - 1}`;

  let grade = calculateGrade(percantige);

  gradeContainder.innerHTML = `Your grade is: ${grade}`;

  homeButton.style.display = 'inline-block';

  updateGrade(grade);
}

const updateGrade = (testGrade) => {
  let resultGrade = serialiseGrades(testName, testGrade);

  sendData('http://localhost:80/exam-browser-api/server/controllers/update-grade.php', {resultGrade})
  .then(response => {
    console.log(response);
  })
  .catch(err => {
    // Err when test exists
    console.log(err);
  });

}

const showHomePage = () => {
  location.href = './index.php';
}

const calculateGrade = (percentige) => {
  let calculatedGrade = 0;

  if (percentige <= 20) {
    calculatedGrade = 2;
  } else if (percentige > 20 && percentige < 40) {
    calculatedGrade = 3;
  } else if (percentige >= 40 && percentige < 60) {
    calculatedGrade = 4;
  } else if (percentige >= 60 && percentige < 80) {
    calculatedGrade = 5;
  } else {
    calculatedGrade = 6;
  }

  return calculatedGrade;
}
