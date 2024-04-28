<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        helper('form');
        $links = $this->getLinks();
        return view('pages/dashboard', ['links' => $links]);
    }

    protected function getLinks()
    {
        $db = db_connect();
        $query = "SELECT * FROM links ORDER BY link ASC";
        $result = $db->query($query);
        $links = $result->getResultArray();
        return $links;
    }
}