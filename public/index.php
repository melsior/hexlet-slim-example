<?php

require __DIR__ . '/../vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetalis' => true,
    ],
];

$app = new \Slim\App($configuration);
$repo = new Repository();

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
