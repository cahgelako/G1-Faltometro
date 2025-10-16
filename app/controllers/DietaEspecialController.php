<?php
class DietaEspecialController extends Controller {

    public function listar() {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEspecial');
        $dietas = $model->listar();
        $this->view('dieta/listDieta', ['dietas' => $dietas]);
    }

    public function registrar() {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEspecial');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listDieta');
        } else {
            $this->view('dieta/registerDieta');
        }
    }

    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEspecial');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            var_dump($_POST);

            $model->editar($_POST);
            header('Location: ./listDieta');
        } else if (isset($_GET['id'])) {
            $dietas = $model->dieta_por_id($_GET['id']);

            //var_dump($dietas);

            $this->view('dieta/editDieta', ['dietas' => $dietas]);
        }
    }

    public function deletar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('DietaEspecial');
            $model->deletar($_GET['id']);
        }
        header('Location: ./listDieta');
        exit;
    }
}