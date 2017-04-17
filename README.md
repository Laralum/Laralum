<p align="center"><a href="https://laralum.com"><img height="300" src="https://avatars1.githubusercontent.com/u/22253051"></a></p>

<h1 align="center">Laralum</h1>

<p align="center">
<a href="https://styleci.io/repos/69903606"><img src="https://styleci.io/repos/69903606/shield?style=flat&branch=master" alt="StyleCI"></a>
<a href="https://github.com/laralum"><img src="https://img.shields.io/badge/Built%20For-Laralum-orange.svg" alt="Laralum"></a>
<a href="https://github.com/laralum/Laralum"><img src="https://poser.pugx.org/laralum/laralum/d/total.svg" alt="Downloads"></a>
<a href="https://github.com/Laralum/Laralum/releases"><img src="https://poser.pugx.org/laralum/laralum/v/stable.svg" alt="License"></a>
<a href="https://raw.githubusercontent.com/Laralum/Laralum/master/LICENSE"><img src="https://poser.pugx.org/laralum/laralum/license.svg" alt="License"></a>
</p>


## Getting started

Before starts with installation you should have done `auth`

```
php artisan make:auth
```

### Installation

Require laralum/laralum with composer

```
composer require laralum/laralum
```

### Register service provider

Include the line below to config/app.php inside providers array :

```php
Laralum\Laralum\LaralumServiceProvider::class,
```

### Migrate

Migrate database tables

```
php artisan:migrate
```

### Packages

Laralum requires basic packages such permissions, roles, users... but there are also optional packages such advertisements, tickets...

To install an optional package, you should follow the documentation of each package on the specified README

## Package Menu

The package menus can be defined creating a ```Menu.json``` file in the /src/ of your package.

Sample:

```json
{
    "items": [
        {
            "text": "Permission List",
            "url": "https://google.com"
        },
        {
            "trans": "laralum_permissions::general.create_permission",
            "route": "laralum::permissions.create",
            "permission": "laralum_permissions::permissions.access"
        }
    ]
}

```

## Injections

To inject code into diferent parts of laralum as a module, you'll need to create a folder in your package:

```
src/Injectors/
```

Inside this folder you'll need to place all the injections you want to make inside.

The list of the currently supported injectors is:

-   **style (style.php)**
    This will inject the php code inside style.php under the specified directory inside the header of
    the master template inside the administration panel.

-   **script (script.php)**
    This will inject the php code inside script.php under the specified directory before the end of the ```<body>``` tag in the master template inside the administration panel.

-   **laralum.base (laralum.base.php)**
    This will inject the php code inside laralum.base.php inside the laralum.base middleware used across
    all the administration panel.

-   **laralum.auth (laralum.auth.php)**
    This will inject the php code inside laralum.auth.php inside the laralum.auth middleware used across
    all the administration panel.

-   **user (user.php)**
    This will inject the php *array* that is returned in user.php inside the user menu on the admin panel.

    ```php
    return  [
        [
            'text'  => 'item Text',
            'url'   => 'https://google.com'
        ]
    ]
    ```

## License

```
MIT License

Copyright (c) 2017 Laralum

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```
