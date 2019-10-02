# Laravel 5 and 6 Domain / APP_URL Enforcement

An automatic piece of middleware for Laravel 5.x, which will force users to access your application via what is defined in the APP_URL - especially useful for SEO forcing non-www users to www etc, unless specified in the ignore list


## Usage

1. Install via composer `composer require owenmelbz/domain-enforcement`

2. Register the service provider - typically done inside the `app.php` providers array e.g `OwenMelbz\DomainEnforcement\DomainEnforcementServiceProvider::class`

3. Add `ENFORCE_DOMAIN=true` to your application environment config e.g `.env`

4. Enjoy your stress free architecture agnostic redirects

## Configuration

If you publish the config via `php artisan vendor:publish --provider="OwenMelbz\DomainEnforcement\DomainEnforcementServiceProvider"` you can exclude urls from getting enforced.


## Why?

Too often we've wasted time configuring redirections, with proxy systems like CloudFlare, with apache development machines and nginx production, this removes all the headache and can simply be turned off and on at a whim.
