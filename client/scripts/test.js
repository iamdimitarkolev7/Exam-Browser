let questionsMaxIndex = 0;
let currentSlide = 0;
let correctAnswers = [];

const loadTest = () => {
  const testName = this.location.href.split('=')[1];

  getData('http://localhost:80/exam-browser-api/server/controllers/show-tests.php', testName)
  .then(response => {
    const deserialisedTest = deserialiseTests(response.testsData)[0];
    const testName = deserialisedTest.testName;
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
      console.log(answerContainer.parent)
      answerContainer.parentElement.style.color = 'lightgreen';
    } else {
      answerContainer.parentElement.style.color = 'red';
    }

    num++;
    i++;
  }

  const resultsContainer = document.getElementById('results');

  resultsContainer.innerHTML = `${numCorrect} out of ${num - 1}`;

  homeButton.style.display = 'inline-block';
}

const showHomePage = () => {
  location.href = './index.php';
}

