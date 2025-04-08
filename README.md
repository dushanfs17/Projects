# Brainster Library | Full-Stack Academy Project

![Brainster Library Logo](https://i.postimg.cc/zyG6QcWF/Brainster-co.png)

## Project Overview

**Brainster Library** is an online platform where users can manage their library, leave public comments, and store private notes about the books they read. The platform is designed with two roles: administrators and end users, each with different functionalities.

Administrators are responsible for managing the platform's content, including books, authors, categories, and comments, while end users can browse the book catalog, leave public comments, and manage their private notes.

For testing purposes, two user profiles have been created, and additional test profiles (around 10) are available for preliminary testing.

### Test Profiles

To log in as an **Administrator**:

- **Username:** `admin`
- **Password:** `Admin123$`

To log in as a **Test User**:

- **Username:** `dusanhv`
- **Password:** `Dusan123$`

---

## Table of Contents

1. [Project Description](#project-description)
2. [Features](#features)
   - [Administrator Role](#administrator-role)
   - [End User Role](#end-user-role)
3. [Extra Features for Additional Points](#extra-features-for-additional-points)
4. [Technology Stack](#technology-stack)
5. [File Structure](#file-structure)
6. [Setup and Installation](#setup-and-installation)
7. [Usage Instructions](#usage-instructions)

---

## Project Description

This project is a comprehensive solution for managing books in an online library. Administrators can perform CRUD operations on books, authors, categories, and comments. End users can browse books, leave public comments (approved by administrators), and maintain private notes, which only they can access.

The project uses **PHP OOP**, **Bootstrap** for responsive design, and **AJAX** for asynchronous interactions, especially for private note management and comment approval.

---

## Features

### Administrator Role

1. **CRUD for Categories:**

   - Create, edit, and delete categories.
   - Each category has a title (required).
   - Categories can be soft-deleted, which means they remain in the database but are marked as inactive.

2. **CRUD for Authors:**

   - Manage authors by adding, editing, and deleting them.
   - Fields include name (required), surname (required), and a short biography (min. 20 characters).
   - Authors can be soft-deleted.

3. **CRUD for Books:**

   - Administrators can add new books, edit existing books, and delete books.
   - Book details include title, author (foreign key), year of publication, number of pages, image (URL), and category (foreign key).
   - When a book is deleted, all comments and notes associated with it are also removed. A confirmation popup using **SweetAlert** is triggered before deletion.

4. **Comment Management:**
   - Administrators must approve all public comments before they are displayed on the book's page.
   - A separate menu is available to view and manage rejected comments, allowing administrators to approve or delete them.

### End User Role

1. **Book Catalog:**

   - The homepage displays a catalog of all books in the library. Books are shown in card format with an image, title, author, and category.
   - Users can filter books by category. Multiple category selections are supported.

2. **Book Details:**

   - Clicking on a book displays all its details, including the title, author, publication year, number of pages, and any public comments approved by the administrator.
   - Comments are displayed below the book details, allowing users to see what others have said about the book.

3. **Authenticated User Features:**
   - Registered users can leave public comments (pending admin approval).
   - Users can also leave private notes for books. These notes are visible only to the user and are managed using AJAX for smooth interaction (adding, editing, and deleting notes without page reloads).
   - Users can delete their own public comments before they are approved.

---

## Extra Features for Additional Points

1. **Private Notes with AJAX:**
   - Private notes are dynamically managed using AJAX, so users can add, edit, or delete notes without refreshing the entire page.
2. **Dynamic Footer with Random Quotes:**
   - The footer includes a new quote with each page reload. Quotes are fetched from the [Quotable API](http://api.quotable.io/random).

---

## Technology Stack

- **Backend:** PHP (OOP, PDO)
- **Frontend:** HTML, CSS, JavaScript
- **Framework:** Bootstrap (for responsive design)
- **AJAX:** Used for private note management and comment approval
- **Database:** MySQL (for managing users, books, comments, categories, and notes)
- **Library:** SweetAlert (for confirmation dialogs)

---

## File Structure

```bash
brainster_library/
├── Admin/
│   ├── Author/
│   │   ├── add-author.php
│   │   ├── add-authorScript.php
│   │   ├── adminDeleteAuthor.php
│   │   ├── adminEditAuthor.php
│   │   └── editAuthor.php
│   ├── Book/
│   │   ├── add-book.php
│   │   ├── add-bookScript.php
│   │   ├── adminDeleteBook.php
│   │   ├── adminEditBook.php
│   │   └── editBookScript.php
│   ├── Category/
│   │   ├── add-category.php
│   │   ├── add-categoryScript.php
│   │   ├── adminDeleteCategory.php
│   │   ├── adminEditCategory.php
│   │   └── editCategoryScript.php
│   ├── Comment/
│   │   ├── adminApproveComment.php
│   │   ├── adminRejectComment.php
│   │   ├── comment.php
│   │   └── queue-comments.php
│   └── adminDashboard.php
├── Assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   ├── authorInputs.js
│   │   ├── categoryInputs.js
│   │   ├── confirmDelete.js
│   │   ├── fetchQuote.js
│   │   ├── filterBook.js
│   │   └── register-user.js
├── Database/
│   ├── Connection.php
│   └── brainster_library.sql
├── Notes/
│   ├── add-note.php
│   ├── delete-note.php
│   ├── see-notes.php
│   └── update-note.php
├── Public_components/
│   └── footer.php
├── Register&Login/
│   ├── checkRegistered.php
│   ├── login-user.php
│   ├── loginScript.php
│   ├── logout-user.php
│   ├── register-user.php
│   └── registerScript.php
├── bookAbout.php
├── index.php
├── README.md
└── users.txt
```

#### Sincerely,

#### Dushan Hadji-Vasilev FS17
