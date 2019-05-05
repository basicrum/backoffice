# Basic RUM - backoffice
## (open source Real User Web Performance Monitoring System)

Backoffice of Basic RUM. A system written on Symfony 4 that aims to help performance enthusiasts look at performance metrics and identify performance bottlenecks. Hooray!

![alt Basic RUM dashboard](https://user-images.githubusercontent.com/1024001/56588192-2daffa80-65e3-11e9-9246-cf9ddefbcb03.png)

## Installation:
The instruction below are applicable only for development but still incomplete for production. This installation will be automatically initialized with demo database.
```
 git clone git@github.com:basicrum/backoffice.git
 cd backoffice
 docker-compose up -d
 docker exec basicrum_bo_php composer update symfony/flex --no-plugins --no-scripts && composer install --optimize-autoloader --no-interaction
```
Linux:  Load http://127.0.0.1:8086 in your browser

Mac OS with docker machine: Run `docker-machine ip` and load http://(put docker ip here):8086

## Key features:
 - Performance over time by Mobile, Tablet and Desktop devices.
 - Diagram Generator by metrics like **time to first paing**, **time to first byte**, **document ready** and etc.
 - Waterfall visualization of loaded page resources
 - Device distribution diagram.
 - Boomerang JS agent builder.
 - Adding release dates in order to track performance changes before and after releases.
 - and more...

## Performance over time:
![alt Perofrmance over time by devices](https://user-images.githubusercontent.com/1024001/56199386-1dc17500-603d-11e9-9127-ae4b29f4edc7.png)

## Diagram Generator
![alt Diagram Generator - Time To First Paint](https://user-images.githubusercontent.com/1024001/56456455-07812500-636d-11e9-8264-08fe39347047.png)

## Waterfall visualization
![alt Page Resouces waterfall diagram](https://user-images.githubusercontent.com/1024001/56456506-dc4b0580-636d-11e9-9702-99174e8449d0.png)

## Boomerang JS - Agent Builder
![alt Boomerang JS - Agent Builder](https://user-images.githubusercontent.com/1024001/56383429-0d1a2600-621a-11e9-985c-765f1ee3609d.png)
