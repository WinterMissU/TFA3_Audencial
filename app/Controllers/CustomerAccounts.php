<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerAccounts extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();

        return view('customers/index', [
            'customers' => $model->findAll(),
        ]);
    }

    public function new()
    {
        helper('form');

        return view('customers/form', [
            'customer' => null,
            'action'   => site_url('customers'),
            'title'    => 'New Customer',
        ]);
    }

    public function create()
    {
        $data = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];

        $rules = [
            'full_name' => 'required|max_length[150]',
            'email'     => 'required|valid_email|max_length[254]',
            'phone'     => 'permit_empty|max_length[30]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        (new CustomerModel())->insert($this->validator->getValidated());

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer added successfully.');
    }

    public function edit(int $id)
    {
        helper('form');

        $customer = (new CustomerModel())->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('customers/form', [
            'customer' => $customer,
            'action'   => site_url("customers/{$id}/edit"),
            'title'    => 'Edit Customer',
        ]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();

        if ($model->find($id) === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];

        $rules = [
            'full_name' => 'required|max_length[150]',
            'email'     => 'required|valid_email|max_length[254]',
            'phone'     => 'permit_empty|max_length[30]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $model->update($id, $this->validator->getValidated());

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer updated successfully.');
    }
}