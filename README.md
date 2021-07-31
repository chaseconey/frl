## FRL Portal
![CircleCI](https://img.shields.io/circleci/build/github/chaseconey/frl)
[![StyleCI](https://github.styleci.io/repos/322995461/shield?branch=main)](https://github.styleci.io/repos/322995461?branch=main)

This project is an authenticated portal for an online F1 racing league called FRL. It is a fully-featured application that offers all of the league management and driver experiences that you would expect such as:

-   Race scheduling
-   Easy race data ingestion using complimentary package - [f1-telemetry-cli](https://github.com/chaseconey/f1-telemetry-cli)
-   League sign up
-   Driver protests
-   Driver performance dashboard
-   League standings for Championship and Constructors

... and so much more.

While this has been built with our league in mind, it absolutely could be picked up by another league very easily. Most features are either configurable or optional.

## Quickstart

### Local Development

This project uses Docker for it's local environment, so the steps should be quite simple!

- `docker-composer up`
- `php artisan serve` (or use [Valet](https://laravel.com/docs/8.x/valet) for an even simpler setup)
- `cp .env.example .env` - Copy over env and fill out required values
- `php artisan migrate --seed` - Migrate and seed your database
- Open up http://localhost:8080 and login with the default credentials (`admin@admin.com` / `password`)
