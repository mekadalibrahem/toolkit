# toolkit
package provides a wide range of functionalities that are essential for various laravel projects

## download 
1. donwload package :
    ```php 
     composer require mekadalibrahem/toolkit
    ```
- install package : 
    ```php 
        php artisan toolkit:install
    ```

## Enable Verify Email
1. verify that your <code>App\Models\User </code> model implements the <code>Illuminate\Contracts\Auth\MustVerifyEmail </code> contract:
```php
<?php
 
namespace App\Models;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
 
    // ...
}
```
show more in [laravel docs verification](https://laravel.com/docs/11.x/verification)

2. add your mail driver config in <code> .env </code> file 
```php
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"
```
show more about mail in [laravel docs mail](https://laravel.com/docs/11.x/mail)
