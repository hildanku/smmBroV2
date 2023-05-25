<?php

namespace App\Controllers;
use App\Models\WebConfigModel; 
use App\Models\DriverModel;

class Driver extends BaseController
{
    public function index()
    {

        $model = new WebConfigModel();
        $config = $model->first();

        $model = new DriverModel();
        $getData = $model->findAll();
        return view('Admin/Driver/index', [
          'getData' => $getData,
          'config' => $config,
          'appTitle' => $config['app_title'],
          'appName' => $config['app_name']
        ]);
      // return view('users/index');
    }
}
