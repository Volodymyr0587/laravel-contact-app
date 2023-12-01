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
