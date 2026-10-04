<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserAccounts extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        return view('users/index', [
            'users' => $model->findAll(),
        ]);
    }

    public function new()
    {
        helper('form');

        return view('users/form', [
            'user'   => null,
            'action' => site_url('users'),
            'title'  => 'New User',
        ]);
    }

    public function create()
    {
        $data = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        $rules = [
            'username'  => 'required|alpha_dash|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[150]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        (new UserModel())->insert($this->validator->getValidated());

        return redirect()->to(site_url('users'))
            ->with('success', 'User added successfully.');
    }

    public function edit(int $id)
    {
        helper('form');

        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('users/form', [
            'user'   => $user,
            'action' => site_url("users/{$id}/edit"),
            'title'  => 'Edit User',
        ]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user  = $model->find($id);

        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        $rules = [
            'username'  => "required|alpha_dash|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[150]',
        ];

        $file = $this->request->getFile('avatar');
        $hasAvatar = $file !== null
            && $file->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasAvatar) {
            $rules['avatar'] =
                'uploaded[avatar]|is_image[avatar]|max_size[avatar,2048]'
                . '|mime_in[avatar,image/jpeg,image/png]';
        }

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $saveData = $this->validator->getValidated();
        unset($saveData['avatar']);

        if ($hasAvatar) {
            $folder = FCPATH . 'uploads/avatars';

            if (! is_dir($folder) && ! mkdir($folder, 0755, true) && ! is_dir($folder)) {
                return redirect()->back()->withInput()
                    ->with('upload_error', 'The upload folder could not be created.');
            }

            $extension = $file->getMimeType() === 'image/png' ? 'png' : 'jpg';
            $filename  = bin2hex(random_bytes(16)) . '.' . $extension;
            $path      = $folder . DIRECTORY_SEPARATOR . $filename;

            try {
                service('image')
                    ->withFile($file->getTempName())
                    ->fit(160, 160, 'center')
                    ->save($path);
            } catch (\Throwable $e) {
                if (is_file($path)) {
                    unlink($path);
                }

                log_message('error', 'Avatar processing failed: {message}', [
                    'message' => $e->getMessage(),
                ]);

                return redirect()->back()->withInput()
                    ->with(
                        'upload_error',
                        'The image could not be prepared. Try another JPG or PNG.'
                    );
            }

            $saveData['avatar'] = $filename;
        }

        $model->update($id, $saveData);

        $message = $hasAvatar
            ? 'User and profile picture updated successfully.'
            : 'User updated. No profile picture was received.';

        return redirect()->to(site_url('users'))
            ->with('success', $message);
    }
}