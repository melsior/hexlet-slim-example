<?php

require __DIR__ . '/../vendor/autoload.php';

use function Stringy\create as s;

$repo = new Repository();

$configuration = [
    'settings' => [
        'displayErrorDetalis' => true,
    ],
];

$app = new \Slim\App($configuration);

$container = $app->getContainer();
$container['renderer'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');

$app->get('/', function ($request, $response) {
    return $this->renderer-render($response, 'index.phtml');
});

$app->get('/courses',function ($request, $response) use ($repo) {
    $params = [
        'courses' => $repo->all()
    ];
    return $this->renderer->render($response, 'courses/index.phtml', $params);
});


$app->post('/users', function ($request, $response) use ($repo) {
    $validator = new Validator();
    $user = $request->getParsedBodyParam('user');
    $errors = $validator->validate($user);
    if (count($errors) === 0) {
        $repo->save($user);
        return $response->withRedirect('/');
    }
    $params = [
        'user' => $user,
        'errors' => $errors
    ];
    return $this->renderer-render($response, "users/new.phtml", $params);
});
$app->get('/', function ($request, $response) {
    $response->write('Welcome to Slim!');
    return $response;
});

$app->run();
