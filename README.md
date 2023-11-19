## Project Setup

```sh
composer install
```

### ENV 

```sh
create new file (.env)
copy env.example to env.
```

#### Generate APP_KEY if not yet generated.

```sh
php artisan key:generate
```

##### API_KEY (edit .env file)
##### Create account and project in Foursquare and OpenWeatherAPI.
##### Use the api keys provided after creation.
```sh
FOURSQUARE_PLACES_URI=
OPENWEATHER_URI=

FOURSQUARE_PLACES_API_KEY=
OPENWEATHER_API=
```

###### RUN THE SERVER
```sh
php artisan serve
```