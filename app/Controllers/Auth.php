<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AuthModel;
use CodeIgniter\I18n\Time;


class Auth extends BaseController
{
    protected $userModel;
    protected $authModel;
    protected $time;
    protected $validation;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->authModel = new AuthModel();
        $this->time = new Time('now');
        $this->session = session();
        $this->validation =  \Config\Services::validation();
    }
    public function index()
    {
        $data = [
            'title' => 'Login',
            'validation' => $this->validation
        ];
        return view('auth/v_index', $data);
    }

    public function login()
    {

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $users = $this->userModel->getUserByEmail($email);

        if (!$this->validate([
            'email' => 'required|trim|valid_email',
            'password' => [
                'rules' => 'required|trim|min_length[8]',
                'errors' => [
                    'matches' => 'Password don\'t match',
                    'min_length' => 'Password too short'
                ],
            ]
        ])) {
            return redirect()->to('/')->withInput();
        }

        // Cek Jika ada user
        if ($users) {
            // Cek Jika User Active
            if ($users['is_active'] == 1) {
                // Cek Password
                if (password_verify($password, $users['password'])) {
                    $data = [
                        'email' => $users['email'],
                        'role_id' => $users['role_id']
                    ];
                    $this->session->set($data);
                    $this->session->setFlashdata('success', 'You have been logedin!');
                    return redirect()->to('/dashboard');
                } else {
                    $this->session->setFlashdata('wrong', 'Wrong password!');
                    return redirect()->to('/');
                }
            } else {
                $this->session->setFlashdata('wrong', 'This email has been activited!');
                return redirect()->to('/');
            }
        } else {
            $this->session->setFlashdata('wrong', 'Email is not registered!');
            return redirect()->to('/');
        }
    }
    // public function logout()
    // {

    // }

    // public function register()
    // {

    //     $data = [
    //         'title' => 'Register',
    //         'validation' => $this->validation
    //     ];
    //     return view('auth/v_register', $data);
    // }

    // public function save()
    // {

    //     // $data = [
    //     //     'users' => $this->userModel->getUser()
    //     // ];
    //     $name = $this->request->getVar('name');
    //     $email = $this->request->getVar('email');
    //     $password = $this->request->getVar('password');
    //     $current_password = $this->request->getVar('current_password');

    //     if (!$this->validate([
    //         'name' => 'required',
    //         'email' => 'required|is_unique[users.email]|trim|valid_email',
    //         'password' => [
    //             'rules' => 'required|trim|min_length[8]|matches[current_password]',
    //             'errors' => [
    //                 'matches' => 'Password don\'t match',
    //                 'min_length' => 'Password too short'
    //             ],
    //         ]
    //     ])) {
    //         return redirect()->to('/register')->withInput();
    //     }
    //     $save = [
    //         'name' => $name,
    //         'email' => $email,
    //         'password' => password_hash($password, PASSWORD_DEFAULT),
    //         'image' => 'avatar.png',
    //         'role_id' => 1,
    //         'is_active' => 0,
    //         'created_at' => time()
    //     ];
    //     //siapkan token
    //     // $token =  base64_encode(rand(1, time()));
    //     // $user_token = [
    //     //     'email' => $email,
    //     //     'token' => $token,
    //     //     'created_at' => time()
    //     // ];

    //     $this->userModel->save($save);
    //     // $this->authModel->save($user_token);

    //     // $this->_sendEmail($token, 'verify');

    //     // $this->session->setFlashdata('success', 'You have been registered. Please Login!!!');
    //     $this->session->setFlashdata('success', 'Congratulation! your account has been created. Please Activate your account!');
    //     return redirect()->to('/');
    // }

    // public function _sendEmail($token, $type)
    // {
    //     $email = \Config\Services::email();

    //     $config = [
    //         'protocol' => 'smtp',
    //         'SMTPHost' => 'smtp.googlemail.com',
    //         'SMTPUser' => 'agimhdyt@gmail.com',
    //         'SMTPPass' => 'agimhidayat',
    //         'SMTPPort' => 587,
    //         'mailType' => 'html',
    //         'charset' => 'utf-8',
    //         'newline' => "\r\n"
    //     ];

    //     $email->initialize($config);

    //     $email->setFrom('agimhdyt@gmail.com', 'Coba');
    //     if ($type == 'verify') {
    //         $email->setTo($this->request->getVar('email'));
    //         $email->setSubject('Accoun verification');
    //         $email->setMessage('Click this link to verify your account : <a href="' . base_url() . '/verify?email=' . $this->request->getVar('email') . '&token=' . $token . '">Activate</a>');
    //     } elseif ($type == 'forgot') {
    //         $email->setTo($this->request->getVar('email'));
    //         $email->setSubject('Reset Password');
    //         $email->setMessage('Click this link to reset your password : <a href="' . base_url() . '/resetpassword?email=' . $this->request->getVar('email') . '&token=' . $token . '">Reset Password</a>');
    //     }


    //     if ($email->send()) {
    //         return true;
    //     } else {
    //         // echo $email->print_debugger();
    //         // die;
    //         $this->session->setFlashdata('wrong', 'Periksa konenksi internet anda!');
    //         return redirect()->to('/');
    //     }
    // }

    // public function verify()
    // {
    //     $email = $this->request->getVar('email');
    //     $token = $this->request->getVar('token');
    //     // dd($token);
    //     $user = $this->userModel->getUserByEmail($email);

    //     if ($user) {
    //         $user_token = $this->authModel->getToken(['token' => $token]);


    //         if ($user_token) {
    //             if (time() - $user_token['created_at'] < (60 * 60 * 24)) {
    //                 $data = [
    //                     'id' => $user['id'],
    //                     'name' => $user['name'],
    //                     'email' => $user['email'],
    //                     'password' => $user['password'],
    //                     'image' => $user['image'],
    //                     'role_id' => $user['role_id'],
    //                     'is_active' => 1,
    //                     'created_at' => $user['created_at']
    //                 ];
    //                 $this->userModel->save($data);
    //                 // $this->authModel->save('users');
    //                 // dd($user_token['id']);
    //                 $this->authModel->delete($user_token['id']);

    //                 // $user_token = $this->authModel->getToken(['token' => $token]);

    //                 $this->session->setFlashdata('success',  $email . ' has been activated! Please Login.');
    //                 return redirect()->to('/');
    //             } else {
    //                 $this->userModel->delete($user['id']);
    //                 $this->authModel->delete($user_token['id']);
    //                 $this->session->setFlashdata('wrong', 'Account activatin failed! Token expired');
    //                 return redirect()->to('/');
    //             }
    //         } else {
    //             $this->session->setFlashdata('wrong', 'Account activatin failed! Wrong token.');
    //             return redirect()->to('/');
    //         }
    //     } else {
    //         $this->session->setFlashdata('wrong', 'Account activatin failed! Wrong email.');
    //         return redirect()->to('/');
    //     }
    // }

    public function logout()
    {
        $this->session->remove('email');
        $this->session->remove('role_id');
        $this->session->setFlashdata('success', 'You have been logged out!');
        return redirect()->to('/');
    }
}
