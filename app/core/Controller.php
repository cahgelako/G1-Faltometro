<?php 
    class Controller {
        public function model($model): object {
            require_once "app/models/{$model}.php";
            return new $model();
        }

        // Adicione o parâmetro $layout, com valor padrão true
        public function view($view, $data = [], $layout = true): void {
            extract($data);
            
            // Inclua o cabeçalho e o rodapé SOMENTE se $layout for true
            if ($layout) {
                require_once "app/views/layout/header.php";
            }
            
            require_once "app/views/{$view}.php";
            
            if ($layout) {
                require_once "app/views/layout/footer.php";
            }
        }
    }