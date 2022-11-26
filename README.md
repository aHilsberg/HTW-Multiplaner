<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# HTW-Multiplaner

Git repo includes:

- `Laravel` as backend solution (php based); flexible, providing all needed features with understandable documentation;
    - simple db support; in this case `pgsql` since relational database seemed like best fit for generally flat data
      structures (installed in docker container, so no need for any installations / system changes)
    - `Inertia` for interface between frontend (can send Inertia-Requests) and backend (responds with Inertia-Actions)
    - websocket, if live updates are needed
- `vue` frontend, all vue related things are given in 'resources/js/*'
- `vite` as development environment, for hot-refresh and building

Thanks to `sail` (a light-weight command-line interface for interacting with Laravel's default Docker development
environment, [see](https://laravel.com/docs/9.x/sail)) most dependencies are abstracted away, but whenever interacting
with the database / cache / anything running, all commands must be prefixed by `.vendor/bin/sail ...`!

Helpful tools:

- `Tailwind CSS` for better/faster styling
- `vueuse` simplifying hooks and offering more functionality
- `v-calendar` for date inputs
- `dayjs` for working with dates
- `headless ui` to create more complex common ui elements

## Usage

Requires `.env` file

1. Install `PHP` (version > 8.0.0), Install `composer` (up to date), Install `Node` (version > 16.0.0), Install `pnpm` (
   same as `npm` but better space management; version > 7.0.0)
2. Install all npm dependencies

```
pnpm install
```

3. Install all php dependencies

``` 
composer install
```

4. Run development server (ignore console urls, vite environment is active outside of the docker container; the true url
   can be specified in the `.env` and should be 'http://localhost')

```
pnpm dev
```

5. Initialize Database by running

```
./vendor/bin/sail artisan migrate:fresh
```

> Run steps 2-5. after a update (git pull) to refresh all dependency and migration changes

### Intro

All vue related things can be found under **'resources/views'**

The **'/pages'** directory contains all page components, defining there layout and page props

The **'/layouts'** directory contains all page layouts and the global provider of user and plugin information

Other vue components can be found under **'/components'**


> Helper functions and plugins can be found under **'resources/scripts'**

## References

#### About Tailwind CSS

A utility-first CSS framework packed with classes like `flex, pt-4`, `text-center` and `rotate-90` that can be composed
to build any design, directly in your markup
([see more](https://tailwindcss.com/))

#### About Vueuse

Collection of Essential Vue Composition Utilities ([see more](https://vueuse.org/))

#### V-Calendar

An elegant calendar and datepicker plugin for Vuejs ([see more](https://vcalendar.io/))

#### Dayjs

Day.js is a minimalist JavaScript library that parses, validates, manipulates, and displays dates and times for modern
browsers with a largely Moment.js-compatible API.
([see more](https://day.js.org/))

#### Headless UI

Completely unstyled, fully accessible UI components, designed to integrate beautifully with Tailwind CSS.

Offering simple components used to build dropdowns, combo boxes, popovers and more
([see more](https://headlessui.com/))

#### About Inertia

Inertia allows you to create fully client-side rendered, single-page apps, without much of the complexity that comes
with modern SPAs. It does this by leveraging existing server-side frameworks.

Inertia has no client-side routing, nor does it require an API. Simply build controllers and page views like you've
always done!

See [documentation](https://inertiajs.com/) for examples

#### About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and
creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in
many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache)
  storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all
modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a
modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video
tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging
into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
