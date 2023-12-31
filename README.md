An application for storing contacts with the ability to add categories to a contact, associate a contact with a business (which can also be added as a contact category), add tags (keywords) to a contact, by which you can filter contacts. It is possible to create notes (also with keywords and filters, pin notes to the top of the list). A system of links by keywords is implemented between the notes. There is a system for searching contacts, business and notes. For contacts and businesses, it is possible to add tasks, which can then be given the status "completed" (when a task is created, a message is sent to the e-mail). You can also download all your contacts as a PDF file. The application has two languages: English and Ukrainian (you can change the language in the navigation bar on any page using the 'EN' and 'UA' buttons)

```git clone https://github.com/Volodymyr0587/laravel-contact-app```

```cd laravel-contact-app```

```composer install```

```cp .env.example .env```

```php artisan key:generate```

```create mysql db contact_app```

```php artisan migrate```

```php artisan storage:link```

```npm install```

```npm run dev```

```php artisan serve```

Register new users.

After registering a new user, you can populate the database with fake data by running the `php artisan db :seed` command

To enable the functionality of sending a message to mail when a new task is created for a contact, add the details of your Email Delivery Platform to the `.env`, such as MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, etc. Also, in the observer `app/Observers/TaskObserver.php`, uncomment the line `// Mail::to($user)->send(new TaskCreated());` in the `created` method.

To send a welcome email to the user upon registration, uncomment the line `// Mail::to($user->email)->send(new AccountCreated ());` in `store` method of controller `app/Http/Controllers/Auth/RegisteredUserController.php `
