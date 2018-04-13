# RestfulBooks
A proof of concept for a book management RESTful API.
This API allows you to:
- Create books
- Filter books by author & category.

# Usage
You'll first need to copy the `.env.example` file to a `.env` file.
You'll then need to choose whichever DB driver you are going to use & create the
database. I used the `sqlite` driver for ease of testing.

You will also need to run `composer install` to install the composer packages on
your machine.

You can run the tests by running the command `composer test` in the root folder.
This will run the migrations & the database seeder to initially set up the database.

I have implemented the tests from the attached PDF scope.
