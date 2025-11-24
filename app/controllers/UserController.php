<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->library('session');
        $this->call->model('UserModel');
    }

    public function login()
    {
        if ($this->io->method() === 'post') {
            $email = $this->io->post('email');
            $password = $this->io->post('password');

            $user = $this->UserModel->getByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $this->session->set_userdata([
                    'user_id'   => $user['id'],
                    'user_name' => $user['first_name'] . ' ' . $user['last_name'],
                    'role'      => $user['role']
                ]);
                redirect('lushcamp/bookings');
            } else {
                $data['error'] = "Invalid credentials!";
                $this->call->view('lushcamp/login', $data);
            }
        } else {
            $this->call->view('lushcamp/login');
        }
    }

    public function register()
    {
        if ($this->io->method() === 'post') {
            $fname = $this->io->post('first_name');
            $lname = $this->io->post('last_name');
            $email = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_DEFAULT);
            $role = $this->io->post('role') ?? 'user';

            $this->UserModel->insert([
                'first_name' => $fname,
                'last_name'  => $lname,
                'email'      => $email,
                'password'   => $password,
                'role'       => $role
            ]);

            echo "<p>✅ Registered successfully! <a href='" . site_url('lushcamp/login') . "'>Login</a></p>";
        } else {
            $this->call->view('lushcamp/register');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('lushcamp/login');
    }
}
?>
