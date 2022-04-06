<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\MasterModel;
use App\Models\UserModel;

class Master extends BaseController
{
    protected $menuModel;
    protected $userModel;
    protected $validation;
    protected $time;
    protected $db;
    public function __construct()
    {
        $this->menuModel    = new MasterModel();
        $this->userModel    = new UserModel();
        $this->db           = \Config\Database::connect();
        $this->time         = new Time('now');
        $this->session      = session();
        $this->validation =  \Config\Services::validation();
    }
    public function index()
    {
        $data = [
            'title' => 'Menu Management',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'menu' => $this->db->table('user_menu')->get()->getResultArray()
        ];
        return view('master/v_index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'menu' => 'required|trim',
        ])) {
            return redirect()->to('/menu')->withInput();
        }
        $menu = $this->request->getVar('menu');
        $this->db->table('user_menu')->insert(['menu' => $menu]);
        $this->session->setFlashdata('success', 'New menu added');
        return redirect()->to('/menu');
    }

    public function subMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu` .`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";

        $submenu = $this->db->query($query)->getResultArray();
        $data = [
            'title' => 'Submenu Management',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'menu' => $this->db->table('user_menu')->get()->getResultArray(),
            'submenu' => $submenu
        ];
        return view('master/v_sub-menu', $data);
    }

    public function saveSubmenu()
    {
        $data = [
            'menu_id'   => $this->request->getVar('menu'),
            'title'     => $this->request->getVar('title'),
            'url'       => $this->request->getVar('url'),
            'icon'      => $this->request->getVar('icon'),
            'is_active' => $this->request->getVar('is_active')
        ];

        $this->db->table('user_sub_menu')->insert($data);
        $this->session->setFlashdata('success', 'New menu added');
        return redirect()->to('/submenu');
    }

    public function getSubmenu()
    {
        $id = $this->request->getVar('id');

        echo json_encode($this->db->table('user_sub_menu')->getWhere(['id' => $id])->getRowArray());
    }

    public function editSubmenu()
    {
        $id = $this->request->getVar('id');
        $update = [
            'menu_id'   => $this->request->getVar('menu'),
            'title'     => $this->request->getVar('title'),
            'url'       => $this->request->getVar('url'),
            'icon'      => $this->request->getVar('icon'),
            'is_active' => $this->request->getVar('is_active')
        ];

        $this->db->table('user_sub_menu')->where(['id' => $id])->update($update);
        $this->session->setFlashdata('success', 'Menu updated');
        return redirect()->to('/submenu');
    }
    public function member()
    {
        $data = [
            'title' => 'Data Member',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'member' => $this->db->table('tb_member')->get()->getResultArray()

        ];
        return view('admin/v_member', $data);
    }

    public function getMember()
    {
        $id = $this->request->getVar('id');
        echo json_encode($this->db->table('tb_member')->getWhere(['id' => $id])->getRowArray());
    }

    public function addMember()
    {
        if (!$this->validate([
            'nama' => 'required|trim',
            'alamat' => 'required|trim',
            'tlp' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'require' => 'Nomor telephone harus di isi.',
                    'numeric' => 'Nomor telephone harus berupa angka.'
                ]
            ],
            'tlp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'require' => 'Pilih Salah Satu Jenis Kelamin.'
                ]
            ],
        ])) {
            return redirect()->to('/member')->withInput();
        }

        $save = [
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tlp' => $this->request->getVar('tlp')
        ];
        $this->db->table('tb_member')->insert($save);
        $this->session->setFlashdata('success', 'Data Member baru berhasil di tambahkan!');
        return redirect()->to('/member');
    }

    public function editMember()
    {
        $id =  $this->request->getVar('id');

        if (!$this->validate([
            'nama' => 'required|trim',
            'alamat' => 'required|trim',
            'tlp' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'require' => 'Nomor telephone harus di isi.',
                    'numeric' => 'Nomor telephone harus berupa angka.'
                ]
            ],
            'tlp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'require' => 'Pilih Salah Satu Jenis Kelamin.'
                ]
            ],
        ])) {
            return redirect()->to('/member')->withInput();
        }
        $data = [
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tlp' => $this->request->getVar('tlp')
        ];
        $this->db->table('tb_member')->where(['id' => $id])->update($data);
        $this->session->setFlashdata('success', 'Data Member baru berhasil di ubah!');
        return redirect()->to('/member');
    }

    public function delMember($id)
    {
        $this->db->table('tb_member')->where(['id' => $id])->delete();
        $this->session->setFlashdata('success', 'Data Member baru berhasil di hapus!');
        return redirect()->to('/member');
    }

    public function layanan()
    {
        $data = [
            'title' => 'Layanan',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'layanan' => $this->db->table('tb_layanan')->get()->getResultArray(),
        ];
        return view('master/v_layanan', $data);
    }

    public function getLayanan()
    {
        $id = $this->request->getVar('id');
        echo json_encode($this->db->table('tb_layanan')->getWhere(['id' => $id])->getRowArray());
    }


    public function saveLayanan()
    {
        if (!$this->validate([
            'layanan' => 'required|trim',
            'img' => [
                'rules' => 'uploaded[img]|max_size[img,2048]|is_image[img]|mime_in[img,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/layanan')->withInput();
        }
        $data = [
            'layanan' => $this->db->table('tb_layanan')->get()->getResultArray()
        ];

        $fileImg = $this->request->getFile('img');

        $fileImg->move('assets/img');

        $save = [
            'nama_layanan' => $this->request->getVar('layanan'),
            'img' => $fileImg->getName()
        ];
        $this->db->table('tb_layanan')->insert($save);
        $this->session->setFlashdata('success', 'Layanan baru berhasil di tambahkan!');
        return redirect()->to('/layanan');
    }

    public function editLayanan()
    {

        if (!$this->validate([
            'layanan' => 'required|trim',
            'img' => [
                'rules' => 'max_size[img,2048]|is_image[img]|mime_in[img,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/layanan')->withInput();
        }
        $fileImg = $this->request->getFile('img');
        $id = $this->request->getVar('id');

        $data = [
            'layanan' => $this->db->table('tb_layanan')->getWhere(['id' => $id])->getRowArray()
        ];
        if ($fileImg->getError() == 4) {
            $img = $data['layanan']['img'];
        } else {
            $img = $fileImg->getName();
            if ($fileImg->move('assets/img')) {
                $old_image = $data['layanan']['img'];
                unlink('assets/img/' . $old_image);
            }
        }


        $update = [
            'nama_layanan' => $this->request->getVar('layanan'),
            'img' => $img
        ];

        $this->db->table('tb_layanan')->where(['id' => $id])->update($update);
        $this->session->setFlashdata('success', 'Layanan berhasil di edit!');
        return redirect()->to('/layanan');
    }

    public function deleteLayanan()
    {
        $id = $this->request->getVar('id');
        $data['layanan'] = $this->db->table('tb_layanan')->getWhere(['id' => $id])->getRowArray();
        $old_image = $data['layanan']['img'];
        unlink('assets/img/' . $old_image);
        $this->db->table('tb_layanan')->where(['id' => $id])->delete();
        $this->session->setFlashdata('success', 'Layanan berhasil di hapus!');
        return redirect()->to('/layanan');
    }

    public function getDetailLayanan()
    {
        $id = $this->request->getVar('id');
        echo json_encode($this->db->table('tb_d_layanan')->getWhere(['id' => $id])->getRowArray());
    }

    public function detailLayanan($id)
    {
        $detail = $this->db->table('tb_d_layanan')->getWhere(['id_layanan' => $id])->getResultArray();
        $data = [
            'title' => 'Layanan',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'layanan' => $this->db->table('tb_layanan')->get()->getResultArray(),
            'detail' => $detail
        ];
        return view('master/v_d_layanan', $data);
    }

    public function saveJenisLayanan()
    {
        if (!$this->validate([
            'jenislayanan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'The jenis layanan field is required.',
                    'trim' => 'Tidak boleh ada spasi diawal kalimat.'
                ]
            ],
            'estimasi_waktu' => 'required|trim|numeric',
            'harga' => 'required|trim|numeric',
        ])) {
            return redirect()->to('/layanan')->withInput();
        }

        $save = [
            'id_layanan' => $this->request->getVar('id_layanan'),
            'layanan' => $this->request->getVar('jenislayanan'),
            'estimasi_waktu' => $this->request->getVar('estimasi_waktu'),
            'harga' => $this->request->getVar('harga')
        ];
        $this->db->table('tb_d_layanan')->insert($save);
        $this->session->setFlashdata('success', 'Jenis layanan baru berhasil di tambahkan!');
        return redirect()->to('/layanan');
    }

    public function editJenisLayanan()
    {
        if (!$this->validate([
            'jenislayanan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'The jenis layanan field is required.',
                    'trim' => 'Tidak boleh ada spasi diawal kalimat.'
                ]
            ],
            'estimasi_waktu' => 'required|trim|numeric',
            'harga' => 'required|trim|numeric',
        ])) {
            return redirect()->to('/layanan')->withInput();
        }
        $id = $this->request->getVar('id');
        $upddate = [
            'layanan' => $this->request->getVar('jenislayanan'),
            'estimasi_waktu' => $this->request->getVar('estimasi_waktu'),
            'harga' => $this->request->getVar('harga')
        ];
        $this->db->table('tb_d_layanan')->where(['id' => $id])->update($upddate);
        $this->session->setFlashdata('success', 'Jenis layanan baru berhasil di ubah!');
        return redirect()->to('/layanan');
    }

    public function deleteDetailLayanan()
    {
        $id = $this->request->getVar('id');
        $this->db->table('tb_d_layanan')->where(['id' => $id])->delete();
        $this->session->setFlashdata('success', 'Data Jenis Layanan berhasil di hapus!');
        return redirect()->to('/layanan');
    }
}
