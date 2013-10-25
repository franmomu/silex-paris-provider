## ParisServiceProvider

Provider for integrate [Idiorm and Paris](http://j4mie.github.io/idiormandparis/) with [Silex](https://github.com/fabpot/Silex)

#### Registering

```
$app->register(new FranMoreno\Silex\Provider\ParisServiceProvider());
```

#### Parameters

```
$app['idiorm.config'] = array(
    'connection_string' => 'mysql:host=localhost;dbname=my_database',
    'username' => 'database_user',
    'password' => 'top_secret'
);

$app['paris.model.prefix'] = '\\My\\Model\\';
```

#### Use in controllers

    $app->get('/index', function (Request $request) use ($app) {

        $userFactory = $app['paris']->getModel('User');
        $results = $userFactory->find_many();

        return $app['twig']->render('index.html', array(
            'results' => $results
        ));
    })
