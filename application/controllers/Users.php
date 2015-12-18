<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function index()
    {
        $data['users'] = json_encode([['name' => 'Wanto', 'city' => 'Cijantung'], ['name' => 'Alfin', 'city' => 'Pamulang']]);
        $this->render($data);
    }

    private function render($data = [])
    {
        $this->load->view('layout/desktop', $data);
    }
}
