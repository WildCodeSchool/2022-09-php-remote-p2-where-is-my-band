<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'createband' => ['AdminBandController', 'createBand'],
    'results' => ['BandController', 'results'],
    'aboutus' => ['HomeController', 'aboutus'],
    'contact' => ['MessageContactController', 'insertMessageContact'],
    'validation' => ['HomeController', 'validation'],
    'mentions' => ['HomeController', 'mentions',],
    'index' => ['HomeController', 'index',],
    'band/delete' => ['AdminBandController', 'delete'],
    'band/edit' => ['AdminBandController', 'edit',['id']],
    'band/create-annonce' => ['AdminBandController', 'addAnnonce',['id']],
    'listband' => ['AdminBandController', 'listBand'],
    'contactband' => ['MessageBandController', 'insertMessageBand',['id']],
    'validationband' => ['BandController', 'validationband'],
    'listmessage' => ['MessageContactController', 'listMessageContact'],
    'message/delete' => ['MessageContactController', 'delete'],
];
