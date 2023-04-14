<?php

namespace App\Controller;

use App\Model\BookmarksManager;

class BookmarksController extends AbstractController
{
        /**
     * Display nav bar
     */
    public function bookmarks(): string
    {
        return $this->twig->render('Bookmarks/bookmarks.html.twig');
    }
}