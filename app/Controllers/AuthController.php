<?php


namespace App\Controllers;


use App\Models\User;
use App\Models\Contacto;
use Config\Services;


class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function validation()
    {

        $errors = $this->validate([
            'username' => 'required|min_length[4]',
            'password' => 'required|min_length[8]|max_length[20]'
        ]);

        if ($errors) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user = new User();
            $data = $user
                ->select('users.*, roles.name as role_name')
                ->join('roles', 'roles.id = users.role_id')
                ->where('username', $username)->get()->getResult();
            if ($data) {
                if ($data[0]->status == 'active') {
                    if (password_verify($password, $data[0]->password)) {
                        $session = session();
                        $session->set('user', $data[0]);
                        return redirect()->to(base_url().'/home');
                    } else {
                        return redirect()->to(base_url().'/')->with('errors', 'Las credenciales no concuerdan.');
                    }
                } else {
                    return redirect()->to(base_url().'/')->with('errors', 'La cuenta no se encuentra activa.');
                }
            } else {
                return redirect()->to(base_url().'/')->with('errors', 'Las credenciales no concuerdan.');
            }
        } else {
            return redirect()->to(base_url().'/')->with('errors', 'Las credenciales no concuerdan.');
        }


    }

    public function register()
    {
        $validation = Services::validation();
        return view('auth/register', ['validation' => $validation]);
    }

    public function create()
    {
        if ($this->validate([
            'name' => 'required|max_length[45]',
            'username' => 'required|is_unique[users.username]|max_length[40]',
            'email' => 'required|valid_email|is_unique[users.email]|max_length[100]',
            'password' => 'required|min_length[8]|max_length[20]'
        ], [
            'name' => [
                'required' => 'El campo Nombres y Apellidos es obrigatorio.',
                'max_length' => 'El campo Nombres Y Apellidos no debe terner mas de 45 caracteres.'
            ],
            'username' => [
                'required' => 'El campo Nombre de Usuario es obligatorio',
                'is_username' => 'Lo sentimos. El nombre de usuario ya se encuntra registrado.',
                'max_length' => 'El campo Nombre de Usuario no puede superar mas de 20 caracteres.'
            ],
            'email' => [
                'required' => 'El campo Correo Electronico es obrigatorio.',
                'is_unique' => 'Lo sentimos. El correo ya se encuntra registrado.'
            ],
            'password' => [
                'required' => 'El campo Contraseña es obligatorio.',
                'min_length' => 'El campo Contraseña debe tener minimo 8 caracteres.',
                'max_length' => 'El campo Contraseña no debe tener mas de 20 caracteres.'
            ]

        ])) {
            $data = [
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'status' => 'inactive',
                'role_id' => 2
            ];

            $user = new User();
            $user->save($data);
        } else {
            return redirect()->to(base_url().'/register')->withInput();
        }


    }

    public function resetPassword()
    {
        return view('auth\reset_password');
    }

    public function forgotPassword()
    {
        $request = Services::request();
        $user = new User();
        $data = $user->where('email', $request->getPost('email'))->get()->getResult();
        if (count($data) > 0) {
            $email = new EmailController();
            $password = $this->encript();
            $user->set(['password' => password_hash($password, PASSWORD_DEFAULT)]);
            $user->where('id', $data[0]->id);
            $user->update();
            $email->send('wabox324@gmail.com', 'wabox', $request->getPost('email'), 'Recuperacion de contraseña', password($password));
            return redirect()->to('/reset_password')
                ->with('success', 'Valida el correo te enviamos una nueva contraseña');
        } else {
            return redirect()->to(base_url().'/reset_password')
                ->with('danger', 'Las credenciales no coinciden con los datos ingresados.');
        }
    }

    public function form_message(){
        $pregunta = $this->request->getPost('message');
        $contacto = $this->request->getPost('contact');
        $email = new EmailController();
        $contacto = new Contacto();
        $contacto = $contacto->get()->getResult();
        if(!empty($contacto[0])){
            $email_aux = $contacto[0]->email;
        }else{
            $email_aux = 'iplanet@iplanetcolombia.com';
        }
        $texto = "
            $pregunta
            <br>
            <h5>Responder a:</h5><b>$contacto</b>
        ";
        $algo = $email->send('wabox324@gmail.com', 'wabox', $email_aux, 'Pregunta mawi', $texto);
        return json_encode($algo);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url().'/');
    }

    public function encript($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}