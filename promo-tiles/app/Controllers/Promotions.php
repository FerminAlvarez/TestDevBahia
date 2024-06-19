<?php

namespace App\Controllers;

use App\Models\PromotionModel;

class Promotions extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    
    public function new(): string
    {
        return view('templates/header')
        . view('promotions/new', ['title' => 'Create a new Promotion'])
        . view('templates/footer');

    }

    public function create()
    {
        $data = $this->request->getPost(['title', 'description']);
        $image = $this->request->getFile('image');
    
        if (! $this->validateData($data, [
            'title' => 'required|max_length[255]|min_length[3]',
            'description' => 'required|max_length[255]|min_length[3]',
            'image' => 'uploaded[image]|is_image[image]',
        ])) {
            // The validation fails, so returns the form.
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        if ($image->isValid() && ! $image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/', $imageName);
        }else {
            return redirect()->back()->withInput()->with('error', 'Failed to upload image.');
        }
    
        $post = $this->validator->getValidated();
        $validatedData = [
            'title' => $post['title'],
            'description' => $post['description'],
            'image_url' => $imageName 
        ];
    
        $promoModel = model(PromotionModel::class);
        $promoModel->insert($validatedData);
    
        return redirect()->to('/promotions/success');
    }
    

    public function success() : string 
    {
        return view('templates/header')
        . view('promotions/success')
        . view('templates/footer');
    }


    public function edit($id): string
    {
        // return view('welcome_message');
    }

    public function delete($id): string
    {
        // return view('welcome_message');
    }
}
