# Crawler-PHP

This project is a crawler that gets all the links and products information from https://tentreem.mywhc.ca/devtest/products , that information is crawled recursively and organized
the data structure in a tree for categories, subcategories, and products, for that structure, used the Composite design pattern.

## Project setup


#### Clone the repo

```
git clone https://github.com/Logatto/crawler-php.git
cd crawler-php
```

#### Running application with Docker

```
docker-compose up --build -d
```

```
http://localhost
```


#### Or running with Composer directly

```
cd src
composer install
```


#### Final result

[![products.jpg](https://i.postimg.cc/q7YHjsmF/products.jpg)](https://postimg.cc/mcQnrHW3)
