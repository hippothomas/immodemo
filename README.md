# ImmoDemo

FICTIVE site of a real estate agency from Nantes

## Stack
- **Frameworks**: [Symfony](https://symfony.com/), [Vue.js](https://vuejs.org/)
- **Database**: [PostgreSQL](https://www.postgresql.org/)

## Running Locally
```shell
$ git clone https://github.com/hippothomas/immodemo.git immodemo
$ cd immodemo
# Create the .env.local file
$ composer i
$ npm i
$ npm run watch
$ symfony server:start
```

Create a `.env.local` file similar to [.env](.env)

### Create the db structure
```shell
$ symfony console doctrine:database:create
$ symfony console doctrine:migrations:migrate
```

### Load fixtures to populate the db
```shell
$ symfony console doctrine:fixtures:load
```
