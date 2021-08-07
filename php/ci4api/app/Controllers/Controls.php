<?php namespace App\Controllers;
 
 use CodeIgniter\RESTful\ResourceController;
 use CodeIgniter\API\ResponseTrait;
 use App\Models\ControlModel;
  
 class Controls extends ResourceController
 {
     use ResponseTrait;
     // get all Control
     public function index()
     {
         $model = new ControlModel();
         $data = $model->findAll();
         return $this->respond($data, 200);
     }
  
     // get single Control
     public function show($id = null)
     {
         $model = new ControlModel();
         $data = $model->getWhere(['id' => $id])->getResult();
         if($data){
             return $this->respond($data);
         }else{
             return $this->failNotFound('No Data Found with id '.$id);
         }
     }
  
     // create a Control
     public function create()
     {
         $model = new ControlModel();
         $data = [
             'control1' => $this->request->getPost('control1'),
             'control2' => $this->request->getPost('control2'),
             'control3' => $this->request->getPost('control3'),
             'control4' => $this->request->getPost('control4'),
             'control5' => $this->request->getPost('control5'),
         ];
         $data = json_decode(file_get_contents("php://input"));
         //$data = $this->request->getPost();
         $model->insert($data);
         $response = [
             'status'   => 201,
             'error'    => null,
             'messages' => [
                 'success' => 'Data Saved'
             ]
         ];
          
         return $this->respondCreated($data, 201);
     }
  
     // update Control
     public function update($id = null)
     {
         $model = new ControlModel();
         $json = $this->request->getJSON();
         if($json){
             $data = [
                 'control1' => $json->control1,
                 'control2' => $json->control2,
                 'control3' => $json->control3,
                 'control4' => $json->control4,
                 'control5' => $json->control5
             ];
         }else{
             $input = $this->request->getRawInput();
             $data = [
                 'control1' => $input['control1'],
                 'control2' => $input['control2'],
                 'control3' => $input['control3'],
                 'control4' => $input['control4'],
                 'control5' => $input['control5'],
             ];
         }
         // Insert to Database
         $model->update($id, $data);
         $response = [
             'status'   => 200,
             'error'    => null,
             'messages' => [
                 'success' => 'Data Updated'
             ]
         ];
         return $this->respond($response);
     }
  
     // delete Control
     public function delete($id = null)
     {
         $model = new ControlModel();
         $data = $model->find($id);
         if($data){
             $model->delete($id);
             $response = [
                 'status'   => 200,
                 'error'    => null,
                 'messages' => [
                     'success' => 'Data Deleted'
                 ]
             ];
              
             return $this->respondDeleted($response);
         }else{
             return $this->failNotFound('No Data Found with id '.$id);
         }
          
     }
  
 }