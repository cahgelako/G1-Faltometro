<?php   
    class Controller {
        public function model($model): object {
            require_once "app/models/{$model}.php";
            return new $model();
        }

        public function view($view, $data = []): void {
            extract($data);
            require_once "app/views/layout/header.php";
            require_once "app/views/{$view}.php";
            require_once "app/views/layout/footer.php";
        }
    }