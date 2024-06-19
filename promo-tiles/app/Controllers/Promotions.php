<?php

namespace App\Controllers;

use App\Models\PromotionModel;

class Promotions extends BaseController
{
    public function index(): string
    {
        $promoModel = model(PromotionModel::class);

        $data['promo_list'] = $promoModel->findAll();

        return view('templates/header')
            . view('promotions/index', $data)
            . view('templates/footer');
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
    
        return redirect()->to('/promotions')->with('success', 'Promotion created successfully.');
    }
    

    public function success() : string 
    {
        return view('templates/header')
        . view('promotions/success')
        . view('templates/footer');
    }

    public function edit($id)
    {
        $promoModel = new PromotionModel();
        $promotion = $promoModel->find($id);

        if ($promotion === null) {
            return redirect()->to('/promotions')->with('error', 'Promotion not found.');
        }

        return view('templates/header')
            . view('promotions/edit', ['promotion' => $promotion])
            . view('templates/footer');
    }

    public function update($id)
    {
        $data = $this->request->getPost(['title', 'description']);
        $image = $this->request->getFile('image');

        if (! $this->validateData($data, [
            'title' => 'required|max_length[255]|min_length[3]',
            'description' => 'required|max_length[255]|min_length[3]',
            'image' => 'uploaded[image]|is_image[image]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $promoModel = model(PromotionModel::class);
        $promotion = $promoModel->find($id);
        
        if (!$promotion) {
            return redirect()->to('/promotions')->with('error', 'Promotion not found.');
        }
        
        if ($image->isValid() && ! $image->hasMoved()) {
            $this->deleteImageIfExists($promotion['image_url']);
            
            $imageName = $image->getRandomName();
            $image->move('uploads/', $imageName);
        } else {
            $imageName = $promotion['image_url'];
        }

        $validatedData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'image_url' => $imageName 
        ];

        $promoModel->update($id, $validatedData);

        return redirect()->to('/promotions')->with('success', 'Promotion updated successfully.');
    }

    private function deleteImageIfExists($imageName)
    {
        $imagePath = 'uploads/' . $imageName;
        if (file_exists($imagePath)) {
            unlink($imagePath); 
        }
    }


    public function delete($id)
    {
        $promoModel = model(PromotionModel::class);
        $promotion = $promoModel->find($id);
        
        if ($promotion) {
            $imagePath = 'uploads/' . $promotion['image_url'];
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $promoModel->delete($id);
            return redirect()->to('/promotions')->with('success', 'Promotion deleted successfully.');
        } else {
            return redirect()->to('/promotions')->with('error', 'Promotion not found.');
        }
    }

}
