<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Utils\Utils;

class Users extends ResourceController
{
    private $db;
    private $validation;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); 
        $this->validation = \Config\Services::validation();
    }

    /**
     * Get Data Profile
     * ============
     * - api for display user profile
     */
    public function getProfile()
    {
        global $g_user_id;

        $dbresult = (array)$this->db->table("users")
        ->select("users.id,username")
        ->getWhere(["users.id"=>$g_user_id])
        ->getFirstRow();

        $respond  = [
            "code"  => 200,
            "error" => false,
            "data"  => Utils::removeNullObjEl($dbresult)
        ];

        return $this->respond($respond,$respond['code']);
    }

    /**
     * Update Profile
     * ============
     * - api for update profile
     */
    public function updateProfile()
    {
        try {
            Utils::_methodParser("put");
            global $put;
            global $g_user_id;

            $put["id"] = $g_user_id;

            if (isset($put["new_password"])) {
                $this->validation->run($put,'newPasswordValidate');
            }
            $this->validation->run($put,'updateUsernameValidate');

            $errors = $this->validation->getErrors();
            
            if ($errors) {
                $respond = [
                    'code'    => 400,
                    'error'   => true,
                    'message' => $errors,
                ]; 
            } 
            else {
                $this->db->transBegin();

                $data_users = [
                    "username" => htmlspecialchars($put["username"]),
                ];

                if (isset($put["new_password"])) {
                    $selectedUser = $this->db->table("users")->where('id',$g_user_id)->get()->getFirstRow();
    
                    if (!password_verify($put["old_password"],$selectedUser->password)) {
                        $respond = [
                            'code'    => 400,
                            'error'   => true,
                            'message' => [
                                'old_password' => "password lama salah"
                            ],
                        ];
    
                        return $this->respond($respond,$respond['code']);
                    } 
    
                    $data_users["password"] = password_hash($put["new_password"],PASSWORD_DEFAULT); 
                }

                $this->db->table("users")
                    ->where("id",$put["id"])
                    ->update($data_users);

                $transStatus = $this->db->transStatus();
                $respond = [
                    'code'    => ($transStatus) ? 201   : 500,
                    'error'   => ($transStatus) ? false : true,
                    'message' => ($transStatus) ? "profile berhasil diupdate!" : "tidak ada yang diubah"
                ];
                
                if (!$transStatus) {
                    $this->db->transRollback();
                } 
                else {
                    $this->db->transCommit();
                }
            }
        } 
        catch (\Throwable $th) {
            $this->db->transRollback();
            $respond = [
                "error"   => true,
                "code"    => 500,
                "message" => $th->getMessage(),
                "debug"   => $th->getTraceAsString()
            ];
        }

        return $this->respond($respond,$respond['code']);
    }
}