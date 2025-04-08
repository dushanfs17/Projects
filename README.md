# Project 05 - JS - Brainster Quiz App

## Project Overview

This Project for a **Brainster Quiz App** manages a series of trivia questions, allowing users to start a quiz, answer questions, track their progress, and see their final score.

## Features

- **Start Quiz**: Users can start the quiz and be presented with a series of trivia questions.
- **Answer Questions**: Users can answer multiple-choice questions.
- **Progress Tracking**: Progress is displayed, and users can continue from where they left off even after refreshing the page.
- **Display Results**: Users are shown their total correct answers at the end of the quiz.
- **Validation**: Ensures that questions are properly loaded and displayed.
- **Alerts**: Error messages are displayed if there is an issue loading questions.

## Technologies Used

- **JavaScript**: ES6+ for functionality and interactivity.
- **Bootstrap**: Styling components for a responsive and modern UI.
- **CSS**: Custom styling for layout and design.
- **HTML**: Structure and DOM manipulation.
- **Animate CSS Library**: A library of ready-to-use, cross-browser animations for use in web projects. Great for adding attention-grabbing visual effects to your application.

## File Structure

- **index.html**: Main HTML file containing the quiz interface.
- **assets/js/**:
  - **main.js**: Initializes the application, fetches questions, handles quiz logic, and manages state.
- **assets/style/style.css**: Contains custom styling for the application layout and components.

## Explanation of Code

The `index.html` file contains the structure of the quiz application, including sections for the loading screen, start screen, quiz screen, and result screen. Bootstrap and custom CSS are used for styling.

### main.js

1. **Event Listeners**: Sets up event listeners for the start button, start over button, and try again button.
2. **Fetching Questions**: Fetches trivia questions from an external API.
3. **Quiz Logic**: Manages the quiz state, including the current question index and correct answers. It shows the current question and checks the user's answer.
4. **Saving State**: Saves the current quiz state to `localStorage` to persist data across page reloads.
5. **Hash Routing**: Uses hash routing to display the current question based on the URL hash.

### Session Management

In both solutions, the quiz state (current question index and correct answers) is saved to `localStorage`, ensuring that refreshing the page does not reset the quiz. This feature prevents the user from losing progress if they accidentally refresh the page.

In addition to this self-initiated feature, the basic requirement that if the user clicks on Start Over or Try Again, reload the page and clear the local storage has been implemented.

## Reflection

This project demonstrates proficiency in creating reusable and maintainable JavaScript code using different types of functions and techniques. Through completing this challenge, I've deepened my understanding of JavaScript's role in creating dynamic and interactive web applications. Handling API calls to fetch questions, implementing robust session management to ensure the quiz state is preserved on page reload, and managing data structures like arrays of objects have been key learning points. Exploring ES6+ features such as classes and modules has allowed me to write cleaner and more organized code, promoting better maintainability and scalability of the application.

## Conclusion

This project has been a significant milestone in my journey as a developer, reinforcing fundamental programming principles and expanding my toolkit in JavaScript development. By building a functional trivia quiz app, I've gained practical experience in frontend scripting, UI/UX design considerations, and integrating external libraries like Bootstrap for enhanced styling and responsiveness. Moving forward, I look forward to applying these skills in more complex projects and contributing meaningfully to the field of web development.

#### Sincerely,

#### Dushan Hadji-Vasilev
