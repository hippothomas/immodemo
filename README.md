# ImmoDemo
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Licence Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" /></a>

FICTIVE site of a real estate agency from Nantes

Demo : [immodemo.hippolyte-thomas.fr](https://immodemo.hippolyte-thomas.fr)

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

### Run in Kubernetes

```shell
$ docker compose build
```

## License
See the [LICENSE](LICENSE.md) file for license rights and limitations (CC-BY-NC-ND-4.0).
