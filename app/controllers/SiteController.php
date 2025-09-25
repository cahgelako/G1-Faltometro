<?php
    class SiteController extends Controller {

        public function index(): void {
            $this->view('site/home');
        }

        public function sobre(): void {
            $this->view('site/sobre');
        }

        public function contato(): void {
            $this->view('site/contato');
        }

        public function dashboard(): void {
            $this->view('site/dashboard');
        }
    }