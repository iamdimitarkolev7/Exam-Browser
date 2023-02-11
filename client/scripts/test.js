const loadTest = () => {
  const testName = this.location.href.split('=')[1];

  getData('http://localhost:80/exam-browser-api/server/controllers/show-tests.php', testName)
  .then(response => {
    const deserialisedTest = deserialiseTests(response.testsData)[0];
    const testName = deserialisedTest.testName;
    const questions = deserialisedTest.questions;

    createTestHTML(testName, questions);
  })
  .catch(err => console.log(err));
}

const createTestHTML = (testName, questions) => {
  const output = [];

  for (const question of questions) {
    const answers = [];
    let questionNum = 1;

    for (const answer of question.answers) {
      answers.push(
        `<label>
          <input type="radio" name="question${questionNum}" value="${answer}">
          ${answer}
        </label>`);

      questionNum++;
    }

    output.push(
      `<div class="slide">
        <div class="question"> ${question.question} </div>
        <div class="answers"> ${answers.join("")} </div>
      </div>`
    );
  }
  
  const quizContainer = document.getElementById('quiz');
    
  quizContainer.innerHTML = output.join('');

  const questionsMaxIndex = questions.length - 1;

  showSlide(questionsMaxIndex, 0);
}


const showNextSlide = (numOfSlides, currentSlide) => {
  showSlide(numOfSlides, currentSlide + 1);
}

const showPreviousSlide = (numOfSlides, currentSlide) => {
  showSlide(numOfSlides, currentSlide - 1);
}

const showSlide = (numOfSlides, currentSlide) => {
  const previousButton = document.getElementById("previous");
  const nextButton = document.getElementById("next");
  const submitButton = document.getElementById("submit");
  const slides = document.querySelectorAll(".slide");

  slides[currentSlide].classList.remove('active-slide');
  slides[numOfSlides].classList.add('active-slide');
  currentSlide = numOfSlides;
  if(currentSlide === 0){
    previousButton.style.display = 'none';
  }
  else{
    previousButton.style.display = 'inline-block';
  }
  if(currentSlide === slides.length-1){
    nextButton.style.display = 'none';
    submitButton.style.display = 'inline-block';
  }
  else{
    nextButton.style.display = 'inline-block';
    submitButton.style.display = 'none';
  }
  submitButton.addEventListener('click', showResults);
  previousButton.addEventListener("click", showPreviousSlide(numOfSlides, currentSlide));
  nextButton.addEventListener("click", showNextSlide(numOfSlides, currentSlide));
}

function showResults(){
  
  // gather answer containers from our quiz
  const answerContainers = quizContainer.querySelectorAll('.answers');

  // keep track of user's answers
  let numCorrect = 0;

  // for each question...
  myQuestions.forEach( (currentQuestion, questionNumber) => {

    // find selected answer
    const answerContainer = answerContainers[questionNumber];
    const selector = `input[name=question${questionNumber}]:checked`;
    const userAnswer = (answerContainer.querySelector(selector) || {}).value;

    // if answer is correct
    if(userAnswer === currentQuestion.correctAnswer){
      // add to the number of correct answers
      numCorrect++;

      // color the answers green
      answerContainers[questionNumber].style.color = 'lightgreen';
    }
    // if answer is wrong or blank
    else{
      // color the answers red
      answerContainers[questionNumber].style.color = 'red';
    }
  });

  // show number of correct answers out of total
  resultsContainer.innerHTML = `${numCorrect} out of ${myQuestions.length}`;
}
