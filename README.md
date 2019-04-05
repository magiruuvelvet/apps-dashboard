# Simply Application Dashboard

The simplest application dashboard ever.
Perfect for new tab pages in all your browsers.

Works best for private internal networks. Not recommended
for public dashboards, because the config file is
loaded and parsed with every request. There is no caching
at all.

## Requirements

 - PHP
 - PHP Composer
 - any PHP compatible web server

## Setup

 - run `composer install` to install dependencies

 - point the document root to the `public` directory
   and enjoy your new dashboard

#### Sample configuration for Caddy

```caddyfile
http://dashboard,
http://dashboard.local {
    bind 127.0.0.1
    bind ::1
    root /caddy/dashboard/public
    fastcgi / unix:/run/php-fpm/php-fpm.sock php
    errors /caddy/dashboard/error.log
    index index.php
    header / -Server
    header / -X-Powered-By
}
```

## Configuration

Copy `config.json5.sample` to `config.json5` and adjust
all settings to your preferences. Apps are also added
there. The format is in [JSON5](https://json5.org/) and
supports more freedom than traditional JSON.

Documentation can be found within the sample configuration
file, thanks to JSON5 instead of regular JSON.

## Styling

Create a `public/user-style.css` file and put all your
CSS overwrites there.

## TODO

Add memory caching and don't parse the config file with
every request. Should heavily improve the performance
when opening a new tab in the browser.
