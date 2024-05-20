# Student-Faculty Counseling System

## Project Overview

The Student-Faculty Counseling System (SFCS) is a web-based application designed to facilitate effective communication and academic monitoring between students, faculty, and parents. Students can enter their semester-wise marks, faculty members can verify these marks and provide remarks, and parents can view their child's academic progress. The application is built using HTML, CSS, JavaScript, PHP, and MySQL.

## Features

- **Student Portal**: Allows students to enter their semester-wise marks.
- **Faculty Portal**: Enables faculty members to verify marks, provide feedback, and give remarks.
- **Parent Portal**: Allows parents to view their child's marks and faculty remarks.
- **User Authentication**: Secure login for students, faculty, and parents.
- **Responsive Design**: Accessible on various devices including desktops, tablets, and smartphones.

## Technology Stack

### Front-End
- **HTML**: Provides the structure and content of the web pages.
- **CSS**: Used for styling the visual presentation of the web pages.
- **JavaScript**: Adds interactivity and dynamic behavior to the web pages.

### Back-End
- **PHP**: Server-side scripting language used to handle form submissions, interact with the database, and generate dynamic content.
- **MySQL**: Relational database management system used to store and manage the application's data.

## Installation and Setup

### Prerequisites

- Web server (e.g., Apache)
- PHP (version 7.4 or higher)
- MySQL (version 5.7 or higher)
- Web browser (e.g., Chrome, Firefox)

### Installation Steps

1. **Clone the repository**:
    ```bash
    git clone https://github.com/Jaikumar0612/MST_Project.git
    ```

2. **Navigate to the project directory**:
    ```bash
    cd MST_Project
    ```

3. **Set up the database**:
    - Create a MySQL database named `mst`.
    - Import the provided SQL script to create the necessary tables:
      mst.sql(includes in the repository) in the localhost/phpmyadmin

4. **Configure the application**:
    - Open the `config.php` file and update the database connection settings:
      ```php
      define('DB_SERVER', 'localhost');
      define('DB_USERNAME', 'root');
      define('DB_PASSWORD', '');
      define('DB_DATABASE', 'mst');
      ```

5. **Start the web server**:
    - Ensure your web server is running and serving the project directory.

6. **Access the application**:
    - Open your web browser and navigate to `http://localhost/MST_Project/login.html`.(It is the starting page of this project)

## Usage

### Student Portal

1. **Login**: Students can log in using their credentials.
2. **Enter Marks**: Navigate to the 'Enter Marks' section to input semester-wise marks.
3. **View Remarks**: Check the 'Remarks' section to see feedback from faculty.

### Faculty Portal

1. **Login**: Faculty members can log in using their credentials.
2. **Verify Marks**: Navigate to the 'Verify Marks' section to review and verify students' marks.
3. **Provide Remarks**: Add feedback and remarks for students in the 'Remarks' section.

### Parent Portal

1. **Login**: Parents can log in using their credentials.
2. **View Marks**: Navigate to the 'View Marks' section to see their child's semester-wise marks and faculty remarks.


