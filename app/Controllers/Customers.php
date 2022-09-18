<?php 

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CustomersModel;

class Customers extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index(){
      $model = new CustomersModel();
      $data['customers'] = $model->where('status',1)->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }
    // create
    public function create() {

        $model = new CustomersModel();
        $name=$this->request->getVar('name');
        $email=$this->request->getVar('email');
        $mobile=$this->request->getVar('mobile');
        $isexist = $model->where('email', $email)->where('mobile',$mobile)->first();
        if($isexist){
            $response = [
                'status'   => 409,
                'messages' => [
                    'error' => 'Customer is already exist with same email and mobile number'
                ]
            ];
            return $this->respond($response);
        }
        $data = [
            'name' => $name,
            'email'  =>$email ,
            'mobile'  => $mobile
        ];
        $model->insert($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Customer created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }
    // single user
    public function show($id = null){
        $model = new CustomersModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No customer found');
        }
    }
    // update
    public function update($id = null){
        $model = new CustomersModel();
        
        $name=$this->request->getVar('name');
        $email=$this->request->getVar('email');
        $mobile=$this->request->getVar('mobile');
        $status=$this->request->getVar('status');
        $isexist = $model->where('email', $email)->where('mobile',$mobile)->where('id','!=',$id)->first();
        if($isexist){
            $response = [
                'status'   => 409,
                'messages' => [
                    'error' => 'Customer is already exist with same email and mobile number'
                ]
            ];
            return $this->respond($response);
        }
        
        $data = [
            'name' => $name,
            'email'  =>$email ,
            'mobile'  => $mobile,
            'status'=>$status
        ];
        $model->update($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Cusomter updated successfully'
          ]
      ];
      return $this->respond($response);
    }
    // delete
    public function delete($id = null){
        $model = new CustomersModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Customer successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No customer found');
        }
    }

    public function search($keyword=null){
        $model = new CustomersModel();
        $search = $model->where('status',1);
        if($keyword != ""){
            $search->like('name', $keyword);
            $search->orLike('email', $keyword);
            $search->orLike('mobile', $keyword);
        }
        $data=$search->orderBy('id', 'DESC')->findAll();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No customer found');
        }
    }
}