<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../src/Contact.php';
    require_once __DIR__ . '/../src/Address.php';

    session_start();
    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__ . '/../views/'
    ));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('contacts.html.twig', array(
            'contacts' => Contact::getAll()
        ));
    });

    $app->post('/create_contact', function() use ($app) {
        $address = new Address($_POST['address-line-1'], $_POST['address-line-2']);
        $contact = new Contact($_POST['name'], $_POST['phone'], $address);
        $contact->save();

        return $app['twig']->render('create_contact.html.twig', array(
            'contact' => $contact
        ));
    });

    $app->post('/delete_contacts', function() use ($app) {
        Contact::deleteAll();

        return $app['twig']->render('delete_contacts.html.twig');
    });

    return $app;
?>
