<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

#### random infos
fast alles ist auto generated, inclusive alle vorhandenen Pages und Components
Generierter Code der fehlleitend ist (meiner Meinung nach):
- Simple Dinge wie dropdowns muss man nicht per hand machen (siehe https://headlessui.com/)
- Auf Requests results muss nicht reagiert werden, man kann im backend auch die Seite rerender lassen mit updated props
- `Tailwind css` wird schon verwendet, aber größtenteils *zu viel*, siehe https://tailwindcss.com/, erleichtert arbeiten da man nicht einzelne css datein / abschnitte meintainen muss; schwöre das ist nice und lohnt sich mal anzugucken

Generel gehe ich mal nicht davon aus das Laravel bekannt ist; Wenn es keine Einwende / bessere Vorschläge gibt aber sich niemand mit nem neuen framework beschäftigen will, kann ich das auch einfach so durchziehen (wenn ich genug zeit habe) - will niemanden php aufzwingen XD

Das einzig wichtige um dann damit in vue arbeiten zu können wäre ne sammlung an api functionen, am besten mit typescript, um zu vermitteln 'was muss rein, was kommt wieder raus'; wobei meistens nur page props geupdated werden (wenn sich mehrere dinge ändern) => da bräuchte ich nur ein erm was alle funktionalitäten abdeckt (hab schon angefangen 'database/htw-multiplaner_erm.svg')

ps: an die daten können wir auch mit nem webcrawler kommen, Modulux crawler siehe branch 'feat/crawler'
wegen htw-login hab ich https://github.com/UMN-LATIS/laravel-shibboleth gefunden, habe es aber ohne dokumentation noch nicht zum laufen bekommen (theoretisch braucht man keine bestätitigung der htw, man sollte auch so SP registrieren können; dann kriegt man aber nur wenig infos zurück (sowas wie matikelnummer ist gesperrt) ), aber https://shibboleth.atlassian.net/wiki/spaces/CONCEPT/pages/948470554/SAMLKeysAndCertificates ist mir auch zu hoch


# HTW-Multiplaner

Git repo includes:
- `Laravel` as backend solution (php based); flexible, providing all needed features with understandable documentation; 
  - simple db support; in this case `pgsql` since relational database seemed like best fit for generally flat data structures (installed in docker container, so no need for any installations / system changes)
  - `Inertia` for interface between frontend (can send Inertia-Requests) and backend (responds with Inertia-Actions)
  - websocket, if live updates are needed
- `vue` frontend, all vue related things are given in 'resources/js/*'
- `vite` as development environment, for hot-refresh and building

Thanks to `sail` (a light-weight command-line interface for interacting with Laravel's default Docker development environment, [see](https://laravel.com/docs/9.x/sail)) most dependencies are abstracted away, but whenever interacting with the database / cache / anything running, all commands must be prefixed by `.vendor/bin/sail ...`!




## Usage

Requires `.env` file

1. Install `PHP` (version > 8.0.0), Install `composer` (up to date), Install `Node` (version > 16.0.0), Install `pnpm` (same as `npm` but better space management; version > 7.0.0)
2. Install all npm dependencies
```
pnpm install
```
3. Install all php dependencies
``` 
composer install
```
4. Run development server (ignore console urls, vite environment is active outside of the docker container; the true url can be specified in the `.env` and should be 'http://localhost')
```
pnpm dev
```
5. Initialize Database by running 
```
./vendor/bin/sail artisan migrate:fresh
```

### Intro

To define a new page, create a new vue component in the 'resources/js/Pages' directory and add a new route in 'routes/web', rendering the page using inertia



## References

#### About Inertia

Inertia allows you to create fully client-side rendered, single-page apps, without much of the complexity that comes with modern SPAs. It does this by leveraging existing server-side frameworks.

Inertia has no client-side routing, nor does it require an API. Simply build controllers and page views like you've always done!

See [documentation](https://inertiajs.com/) for examples


#### About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
