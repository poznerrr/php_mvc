<?php

namespace controllers;

class RoutingController
{

    public function __construct()
    {
    }

    public function route($url)
    {
        switch ($url) {
            case '/':
                if (isset($_POST['delete']) && isset($_POST['id'])) {
                    (new IndexController)->delete();
                } else {
                    (new IndexController)->render();
                }
                break;
            default:
                (new NotFoundController)->render();
                break;
        }
    }


}