<?php


namespace App\Controllers;


use App\Traits\Grocery;
use App\Models\Head;
use App\Models\Menu;
use App\Models\Header;
use App\Models\Nosotros;
use App\Models\Contacto;
use CodeIgniter\Exceptions\PageNotFoundException;

class TableController extends BaseController
{
    use Grocery;

    private $crud;

    public function __construct()
    {
        $this->crud = $this->_getGroceryCrudEnterprise();
        $this->crud->setSkin('bootstrap-v3');
        $this->crud->setLanguage('Spanish');
    }

    public function index($data)
    {
        $menu = new Menu();
        $component = $menu->where(['table' => $data, 'component' => 'table'])->get()->getResult();
        if($component) {
            $this->crud->setTable($component[0]->table);
            switch($component[0]->table){
                case 'menu_pagina':
                    $this->crud->displayAs([
                        'icon' => 'Icono'
                    ]);
                    $this->crud->callbackColumn('icon', function($icono, $row){
                        if(strpos($row->icon, '<i>')){
                            $icon = $row->icon;
                        }else{
                            $icon = '<i class="material-icons">'.$row->icon.'</i>';
                        }
                        $icono = '<div>'.$icon.'</div>';
                        return $icono;
                    });
                    break;
                case 'head':
                    $uploadValidations = [
                        'maxUploadSize' => '20M', // 20 Mega Bytes
                        'minUploadSize' => '1K', // 1 Kilo Byte
                        'allowedFileTypes' => [
                            'jpeg', 'jpg', 'png'
                        ]
                    ];
                    $this->crud->displayAs([
                        'title' => 'Titulo',
                        'icon' => 'Icono',
                        'description' => 'Descripción',
                        'keywords' => 'Palabras claves'
                    ]);
                    $this->crud->setFieldUpload('icon', 'assets/img/pag/icon', '/assets/img/pag/icon', $uploadValidations);
                    $this->crud->setFieldUpload('logo', 'assets/img/pag/logo', '/assets/img/pag/logo', $uploadValidations);
                    $head = new Head();
                    $data = $head->findAll();
                    if (count($data)  > 0) {
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    break;
                case 'header':
                    $uploadValidations = [
                        'maxUploadSize' => '20M', // 20 Mega Bytes
                        'minUploadSize' => '1K', // 1 Kilo Byte
                        'allowedFileTypes' => [
                            'jpeg', 'jpg', 'png'
                        ]
                    ];
                    $this->crud->setFieldUpload('imagen', 'assets/img/pag', '/assets/img/pag', $uploadValidations);
                    $header = new Header();
                    $data = $header->findAll();
                    if (count($data)  > 0) {
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    break;
                case 'productos':
                    $uploadValidations = [
                        'maxUploadSize' => '20M', // 20 Mega Bytes
                        'minUploadSize' => '1K', // 1 Kilo Byte
                        'allowedFileTypes' => [
                            'jpeg', 'jpg', 'png'
                        ]
                    ];
                    $this->crud->setFieldUpload('img', 'assets/img/pag/productos', '/assets/img/pag/productos', $uploadValidations);
                    $this->crud->displayAs(['img' => 'Producto']);
                    break;
                case 'preguntas':
                    $uploadValidations = [
                        'maxUploadSize' => '20M', // 20 Mega Bytes
                        'minUploadSize' => '1K', // 1 Kilo Byte
                        'allowedFileTypes' => [
                            'jpeg', 'jpg', 'png'
                        ]
                    ];
                    $this->crud->setFieldUpload('img', 'assets/img/pag/productos', '/assets/img/pag/productos', $uploadValidations);
                    $this->crud->displayAs(['texto' => 'Respuesta', 'titulo' => 'Pregunta', 'icon' => 'Icono']);
                    $this->crud->callbackColumn('icon', function($icono, $row){
                        if(strpos($row->icon, '<i>')){
                            $icon = $row->icon;
                        }else{
                            $icon = '<i class="material-icons">'.$row->icon.'</i>';
                        }
                        $icono = '<div>'.$icon.'</div>';
                        return $icono;
                    });
                    break;
                case 'nosotros':
                    $this->crud->displayAs(['texto' => 'Descripción']);
                    $this->crud->setTexteditor(['texto']);
                    $uploadValidations = [
                        'maxUploadSize' => '20M', // 20 Mega Bytes
                        'minUploadSize' => '1K', // 1 Kilo Byte
                        'allowedFileTypes' => [
                            'jpeg', 'jpg', 'png', 'mp4'
                        ]
                    ];
                    $this->crud->setFieldUpload('video', 'assets/img/pag/nosotros', '/assets/img/pag/nosotros', $uploadValidations);
                    $nosotros = new Nosotros();
                    $data = $nosotros->findAll();
                    if (count($data)  > 0) {
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    break;
                case 'contacto':
                    $this->crud->displayAs(['texto' => 'Descripción']);
                    $contacto = new Contacto();
                    $data = $contacto->findAll();
                    if (count($data)  > 0) {
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    break;
            }
            $output = $this->crud->render();
            if (isset($output->isJSONResponse) && $output->isJSONResponse) {
                header('Content-Type: application/json; charset=utf-8');
                echo $output->output;
                exit;
            }

            $this->viewTable($output, $component[0]->title, $component[0]->description);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }
}