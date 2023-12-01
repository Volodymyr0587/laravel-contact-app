An application for storing contacts with the ability to add categories to a contact, associate a contact with a business (which can also be added as a contact category), add tags (keywords) to a contact, by which you can filter contacts. It is possible to create notes (also with keywords and filters). A system of links by keywords is implemented between the notes. There is a system for searching contacts, business and notes. For contacts and businesses, it is possible to add tasks, which can then be given the status "completed" (when a task is created, a message is sent to the e-mail).

```git clone https://github.com/Volodymyr0587/laravel-contact-app```

```cd laravel-contact-app```

```composer install```

```cp .env.example .env```

```php artisan key:generate```

```create mysql db contact_app```

```php artisan migrate```

```npm install```

```npm run dev```

```php artisan storage:link```

```php artisan serve```

Register new users.

To enable the functionality of sending a message to mail when a new task is created for a contact, add the details of your Email Delivery Platform to the .env, such as MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, etc.
