window.addEventListener("load", () => {
  // DOM elements
  const loadingScreen = document.getElementById("loading-screen");
  const startScreen = document.getElementById("start-screen");
  const quizScreen = document.getElementById("quiz-screen");
  const resultScreen = document.getElementById("result-screen");
  const startBtn = document.getElementById("start-btn");
  const startOverBtn = document.getElementById("start-over-btn");
  const tryAgainBtn = document.getElementById("try-again-btn");
  const questionContainer = document.getElementById("question-container");
  const progress = document.getElementById("progress");
  const scoreDisplay = document.getElementById("score");

  // Quiz state
  let questions = [];
  let currentQuestionIndex = 0;
  let correctAnswers = 0;

  // Load saved state if exists
  const loadState = () => {
    const savedIndex = localStorage.getItem("currentQuestionIndex");
    const savedScore = localStorage.getItem("correctAnswers");
    const savedQuestions = localStorage.getItem("questions");

    if (savedIndex) currentQuestionIndex = parseInt(savedIndex);
    if (savedScore) correctAnswers = parseInt(savedScore);
    if (savedQuestions) questions = JSON.parse(savedQuestions);
  };

  // Save current state
  const saveState = () => {
    localStorage.setItem("currentQuestionIndex", currentQuestionIndex);
    localStorage.setItem("correctAnswers", correctAnswers);
    localStorage.setItem("questions", JSON.stringify(questions));
  };

  // Clear state and reset to start screen
  const resetQuiz = () => {
    localStorage.clear();
    currentQuestionIndex = 0;
    correctAnswers = 0;
    questions = [];
    window.location.hash = "";
    resultScreen.classList.remove("active"); // Ensure result screen is hidden
    quizScreen.classList.remove("active"); // Ensure quiz screen is hidden
    startScreen.classList.add("active"); // Show start screen
    fetchQuestions(); // Fetch new questions
  };

  // Fetch questions from API
  const fetchQuestions = () => {
    fetch("https://opentdb.com/api.php?amount=20")
      .then((response) => response.json())
      .then((data) => {
        questions = data.results;
        saveState();
        loadingScreen.classList.remove("active");

        // Only show start screen on initial load or reset
        if (currentQuestionIndex === 0) {
          startScreen.classList.add("active");
        } else if (currentQuestionIndex < questions.length) {
          quizScreen.classList.add("active");
          showQuestion();
        } else {
          showResult();
        }
      })
      .catch((error) => {
        console.error("Error fetching questions:", error);
        loadingScreen.innerHTML =
          "<h1>Failed to load questions. Please try again later.</h1>";
      });
  };

  // Show current question
  const showQuestion = () => {
    if (!questions.length || currentQuestionIndex >= questions.length) {
      showResult();
      return;
    }

    const question = questions[currentQuestionIndex];
    const answers = [...question.incorrect_answers, question.correct_answer];
    answers.sort(() => Math.random() - 0.5);

    questionContainer.innerHTML = `
      <h2 class="animated fadeIn">${question.question}</h2>
      <div class="answers">
        ${answers
          .map(
            (answer) =>
              `<button class="answer-btn btn btn-outline-secondary">${answer}</button>`
          )
          .join("")}
      </div>
      <div class="category mt-3">${question.category}</div>
    `;

    document
      .querySelectorAll(".answer-btn")
      .forEach((btn) =>
        btn.addEventListener("click", () =>
          checkAnswer(btn.textContent, question.correct_answer)
        )
      );

    window.location.hash = `question-${currentQuestionIndex + 1}`;
    progress.innerHTML = `Completed: ${currentQuestionIndex}/20`;
  };

  // Check answer and proceed
  const checkAnswer = (selectedAnswer, correctAnswer) => {
    if (selectedAnswer === correctAnswer) correctAnswers++;
    currentQuestionIndex++;
    saveState();

    if (currentQuestionIndex < questions.length) {
      showQuestion();
    } else {
      showResult();
    }
  };

  // Show results
  const showResult = () => {
    quizScreen.classList.remove("active");
    resultScreen.classList.add("active");
    startScreen.classList.remove("active"); // Ensure start screen is hidden
    scoreDisplay.textContent = `Total Correct Answers: ${correctAnswers}/20`;
    localStorage.clear(); // Clear state after showing results
  };

  // Start quiz
  const startQuiz = () => {
    currentQuestionIndex = 0;
    correctAnswers = 0;
    saveState();
    startScreen.classList.remove("active");
    quizScreen.classList.add("active");
    showQuestion();
  };

  // Event listeners
  startBtn.addEventListener("click", startQuiz);
  startOverBtn.addEventListener("click", resetQuiz);
  tryAgainBtn.addEventListener("click", resetQuiz);

  // Initial setup
  loadState();
  if (!questions.length) {
    fetchQuestions();
  } else {
    loadingScreen.classList.remove("active");
    if (currentQuestionIndex === 0) {
      startScreen.classList.add("active");
    } else if (currentQuestionIndex < questions.length) {
      quizScreen.classList.add("active");
      showQuestion();
    } else {
      showResult();
    }
  }
});
