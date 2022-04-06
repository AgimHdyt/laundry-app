<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AuthModel;
use CodeIgniter\I18n\Time;


class User extends BaseController
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
            'title' => 'Profile',
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'validation' => $this->validation
        ];
        return view('user/v_index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Profile',
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'validation' => $this->validation
        ];
        return view('user/v_edit', $data);
    }

    public function editProfile()
    {
        $data = [
            'title' => 'Edit Profile',
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'validation' => $this->validation
        ];

        if (!$this->validate([
            'name' => 'required',
            'email' => 'required|trim|valid_email',
            'image' => [
                'rules' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/edit-profile')->withInput();
        }

        $id = $this->request->getVar('id');
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');

        $fileImage = $this->request->getFile('image');

        if ($fileImage->getError() == 4) {
            $image = $data['user']['image'];
        } else {
            $image = $fileImage->getName();
            if ($fileImage->move('assets/img/profile')) {
                $old_image = $data['user']['image'];
                if ($old_image != 'avatar.png') {
                    unlink('assets/img/profile/' . $old_image);
                }
            }
        }

        $id = $id;
        $update = [
            'name' => $name,
            'email' => $email,
            'image' => $image
        ];

        $this->userModel->update($id, $update);
        $this->session->setFlashdata('success', 'Your profile has been updated!');
        return redirect()->to('/user');
    }

    public function editpassword()
    {
        $data = [
            'title' => 'Edit Password',
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'validation' => $this->validation
        ];
        return view('user/v_edit-password', $data);
    }

    public function changepassword()
    {
        $data = [
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'validation' => $this->validation
        ];
        if (!$this->validate([
            'current_password' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'The Current password is required.',
                    'matches' => 'Password don\'t match',
                    'min_length' => 'Password too short'
                ]
            ],
            'new_password1' => [
                'rules' => 'required|trim|min_length[8]|matches[new_password2]',
                'errors' => [
                    'required' => 'The New password is required.',
                    'matches' => 'Password don\'t match',
                    'min_length' => 'Password too short'
                ],
            ],
            'new_password2' => [
                'rules' => 'required|trim|min_length[8]|matches[new_password1]',
                'errors' => [
                    'required' => 'The Repeat password is required.',
                    'matches' => 'Password don\'t match',
                    'min_length' => 'Password too short'
                ],
            ]
        ])) {
            return redirect()->to('/edit-password')->withInput();
        }

        $id = $this->request->getVar('id');
        $current_password = $this->request->getVar('current_password');
        $new_password = $this->request->getVar('new_password1');

        if (!password_verify($current_password, $data['user']['password'])) {
            $this->session->setFlashdata('wrong', 'Wrong current password!');
            return redirect()->to('/edit-password');
        } else {

            //password sudah ok
            $password_has = password_hash($new_password, PASSWORD_DEFAULT);
            $update = [
                'password' => $password_has
            ];
            $this->userModel->update($id, $update);
            $this->session->setFlashdata('success', 'Password changed!');
            return redirect()->to('/user');
        }
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'users' => $this->userModel->getUser()
        ];
        return view('user/v_dashboard', $data);
    }
}
