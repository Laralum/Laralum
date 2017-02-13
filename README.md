# Laralum
The modular open source laravel administration panel

[![StyleCI](https://styleci.io/repos/69903606/shield?branch=master)](https://styleci.io/repos/69903606)

**UNDER ACTIVE DEVELOPMENT**

## Please use version 2.*

https://github.com/ConsoleTVs/Laralum


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
