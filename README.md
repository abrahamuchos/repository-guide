## Repository guide
Project developed under Test Driven Development (TDD) methodology, maintaining a list of repositories of interest to the community.

This project aims to experiment and provide guidance for Laravel development under the TDD methodology.

<img src="/docs/images/guest.png" alt="guest" width="auto"/>


## ✅ Features
- Login/Sign up user
- Show user profile
- Edit user profile
- Show Repositories
- Create new Repository
- Edit Repository
- Delete Repository
## ⚙️ Tech Stack

- Laravel 11.9
- Postgre 14.12
- Laravel Jetstream 5.1
- PHPUnit 11.0


## 💾 Installation

Install and run

1. Clone and move to folder
```bash
$ git clone git@github.com:abrahamuchos/repository-guide.git
$ cd repository-guide
```

2. Install dependecies
```bash
$  composer install
$  npm install
```
3. You can run all test

``
$ php artisan test
``

Or you can run tests individually at

``
$ php artisan test --filter RepositoryControllerTest::test_anyone
``

You can view  tests individually at

``/tests/Feature/Http/Controllers/PageControllerTest.php``
``/tests/Feature/Http/Controllers/RepositoryControllerTest.php``

4. Create a copy of the `.env.example` file and rename it to `.env`. Next, configure the necessary environment variables.

5. Generate an application key by running `php artisan key:generate`.

6. Run `php artisan migrate` to create the database tables.

7. Run `php artisandb:seed` to create dummy data and admin user.
8. Run `php artisan serve` to start the Laravel development server.
## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

```
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
```

## Screenshots
<img src="/docs/images/index.png" alt="drawing" width="500px"/>
<img src="/docs/images/login.png" alt="login" width="500px"/>
<img src="/docs/images/edit.png" alt="edit" width="500px"/>


## 🧑‍💻 Authors

- [@abrahamuchos](https://github.com/abrahamuchos)
- [Contact mail](mailto:j.abraham29@gmail.com)


## 📄 License

[MIT](https://choosealicense.com/licenses/mit/)
