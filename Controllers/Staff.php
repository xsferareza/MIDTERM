<?php
namespace App\Controllers;
use App\Models\UserModel;

class Staff extends BaseController {
    public function index() {
        $model = new UserModel();
        $data['staff'] = $model->findAll();
        return view('staff/index', $data);
    }

    public function store() {
        $rules = [
            'username'  => 'required|is_unique[users.username]',
            'full_name' => 'required',
            'password'  => 'required|min_length[6]',
            'avatar'    => 'uploaded[avatar]|is_image[avatar]|max_size[avatar,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $avatar = $this->request->getFile('avatar');
        $avatarName = $avatar->getRandomName();
        $avatar->move(ROOTPATH . 'public/uploads/avatars', $avatarName);

        $model = new UserModel();
        $model->save([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'avatar'     => $avatarName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/staff')->with('success', 'Staff added successfully.');
    }
}