<?php

namespace App\Controller;

use App\Model\SharedManager;

class SharedController extends AbstractController
{
        /**
     * Display nav bar
     */
    public function nav(): string
    {
        return $this->twig->render('Shared/nav.html.twig');
    }
}
