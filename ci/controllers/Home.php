<?php

class Home extends CI_Controller {
    public function index($nama = "Mukti") {

       $data["title"] = "Home Page";
       $data["nama"] = $nama;
       $this->load->view('templates/header', $data);
    //    Difolder view, folder templates. header.php
       $this->load->view('home/index', $data);
       $this->load->view('templates/footer');
    }
}