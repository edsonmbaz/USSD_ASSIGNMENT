# USSD/SMS Online Quiz System

This project implements a USSD and SMS-based online quiz system that allows users to add and view quiz questions through USSD/SMS interfaces.

## Features
- Add new quiz questions
- View existing questions
- USSD interface for interaction
- SMS integration for notifications

## Project Structure
```
├── README.md
├── config/
│   └── database.php
├── src/
│   ├── models/
│   │   └── Question.php
│   ├── controllers/
│   │   └── QuestionController.php
│   └── services/
│       └── USSDService.php
├── public/
│   └── index.php
└── database/
    └── schema.sql
```

## Setup Instructions

1. Clone the repository:
```bash
git clone [repository-url]
cd [project-directory]
```

2. Configure your database:
   - Create a MySQL database
   - Update database credentials in `config/database.php`

3. Import the database schema:
```bash
mysql -u [username] -p [database_name] < database/schema.sql
```

4. Configure your web server (Apache/XAMPP) to point to the `public` directory

5. Access the application through your USSD simulator or web interface

## Development Team
EDSON
CLAUDINE

## Technologies Used
- PHP
- MySQL
- USSD Gateway Integration
- SMS Gateway Integration

## License
This project is licensed under the MIT License. 