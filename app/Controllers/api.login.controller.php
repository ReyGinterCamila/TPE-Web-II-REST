<?php
    require_once 'app/Controllers/api.controller.php';
    require_once(__DIR__ . '/../helpers/api.auth.helper.php');
    require_once 'app/Models/api.login.model.php';

    class LoginApiController extends ApiController {
        private $model;
        private $authHelper;

        function __construct() {
            parent::__construct();
            $this->authHelper = new AuthHelper();
            $this->model = new userModel();
        }

        // Obtener un TOKEN de autenticación
        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders();

            if(empty($basic)) {
                $this->view->response('No se enviaron encabezados de autenticación.', 401);
                return;
            }

            $basic = explode(" ", $basic);

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
                return;
            }

            $loginpass = base64_decode($basic[1]);
            $loginpass = explode(":", $loginpass); 

            $username = $loginpass[0];
            $password = $loginpass[1];

            $user = $this->model->getByUsername($username);

            $userdata = [ "name" => $user];
       
            if($user && password_verify($password, $user->password)) {
                            
                $token = $this->authHelper->createToken($userdata);
                $this->view->response($token, 200);
                return;
            } else {
                $this->view->response('El usuario o la contraseña son incorrectos.', 401);
                return;
            }
        }
    }