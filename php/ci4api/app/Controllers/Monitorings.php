<?php namespace App\Controllers;
 
 use CodeIgniter\RESTful\ResourceController;
 use CodeIgniter\API\ResponseTrait;
 use App\Models\MonitoringModel;
  
 class Monitorings extends ResourceController
 {
    protected $format       = 'json';
     use ResponseTrait;
     // get all Monitoring
     public function index()
     {
         $model = new MonitoringModel();
         $data = $model->findAll();
         return $this->respond($data, 200);
     }
  
     // get single Monitoring
     public function show($id = null)
     {
         $model = new MonitoringModel();
         $data = $model->getWhere(['id' => $id])->getResult();
         if($data){
             return $this->respond($data);
         }else{
             return $this->failNotFound('No Data Found with id '.$id);
         }
     }
  
     // create a Monitoring
     public function create()
     {
         $model = new MonitoringModel();
         $data = [
             'sensor1' => $this->request->getPost('sensor1'),
             'sensor2' => $this->request->getPost('sensor2'),
             'sensor3' => $this->request->getPost('sensor3'),
             'sensor4' => $this->request->getPost('sensor4'),
             'sensor5' => $this->request->getPost('sensor5'),
             'sensor6' => $this->request->getPost('sensor6'),
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
  
     // update Monitoring
     public function update($id = null)
     {
         $model = new MonitoringModel();
         $json = $this->request->getJSON();
         if($json){
             $data = [
                 'sensor1' => $json->sensor1,
                 'sensor2' => $json->sensor2,
                 'sensor3' => $json->sensor3,
                 'sensor4' => $json->sensor4,
                 'sensor5' => $json->sensor5,
                 'sensor6' => $json->sensor6,
             ];
         }else{
             $input = $this->request->getRawInput();
             $data = [
                 'sensor1' => $input['sensor1'],
                 'sensor2' => $input['sensor2'],
                 'sensor3' => $input['sensor3'],
                 'sensor4' => $input['sensor4'],
                 'sensor5' => $input['sensor5'],
                 'sensor6' => $input['sensor6'],
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
  
     // delete Monitoring
     public function delete($id = null)
     {
         $model = new MonitoringModel();
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