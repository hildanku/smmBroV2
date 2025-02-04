<?php

namespace App\Controllers;

use App\Models\WebConfigModel; 
use App\Models\ProductModel;  

class Product extends BaseController
{
    protected $webconfigM;
    protected $productM;
    public function __construct()
    {
        $this->webconfigM = new WebConfigModel();
        $this->productM = new ProductModel();
    }
    public function index()
    {
   //     $model = new ProductCategoryModel();
   //     $getCategory = $model->findAll();

        $config = $this->webconfigM->first();
        $getData = $this->productM->findAll();
        return view('Admin/Products/index', [
            'getData' => $getData,
            'appTitle' => $config['app_title'],
            'appName' => $config['app_name']
            ]);

    }
    public function add()
    {
        $config = $this->webconfigM->first();

        return view('Admin/Products/add', [
            'appTitle' => $config['app_title'],
            'appName' => $config['app_name']
        ]);
    }
    public function store()
    {
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_description' => $this->request->getPost('product_description'),
            'product_price' => $this->request->getPost('product_price'),
            'product_quantity' => $this->request->getPost('product_quantity'),
            'category' => $this->request->getPost('category'),
            'product_made' => $this->request->getPost('product_made'),
            'product_expired' => $this->request->getPost('product_expired'),
        ];
        if ($this->productM->save(esc($data))) {
            session()->setFlashdata('success', 'Data berhasil diperbarui!');
            return redirect()->to('/admin/products');
        } else {
            session()->setFlashdata('error', 'Data gagal diperbarui!');
            return redirect()->to('/admin/products');
        }
    }
    public function edit($product_id)
    {
        helper('form');
        $config = $this->webconfigM->first();
        $data = $this->productM->where('product_id', $product_id)->first();
      
        return view('Admin/Products/edit', [
            'data' => $data,
            'appTitle' => $config['app_title'],
            'appName' => $config['app_name']
        ]);
    }
    public function update($product_id)
    {

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_description' => $this->request->getPost('product_description'),
            'product_price' => $this->request->getPost('product_price'),
            'product_quantity' => $this->request->getPost('product_quantity'),
            'category' => $this->request->getPost('category'),
            'product_made' => $this->request->getPost('product_made'),
            'product_expired' => $this->request->getPost('product_expired'),
        ];
        if ($this->productM->where('product_id', $product_id)->set(esc($data))->update()) {
            session()->setFlashdata('success', 'Data berhasil diperbarui!');
            return redirect()->to('/admin/products');
        } else {
            session()->setFlashdata('error', 'Data gagal diperbarui!');
            return redirect()->to('/admin/products');
        }
    }
    public function delete($product_id)
    {
        $data = $this->productM->where('product_id', $product_id)->first();
        if (!$data) {
            return $this->response->setJSON(['success' => false]);
        }
        $this->productM->where('product_id', $product_id)->delete();
        return $this->response->setJSON(['success' => true]);
    }
}