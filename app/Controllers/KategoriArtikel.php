<?php

namespace App\Controllers;

use App\Utils\Utils;
use CodeIgniter\RESTful\ResourceController;

class KategoriArtikel extends ResourceController
{
    private $db;
    private $validation;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); 
        $this->validation = \Config\Services::validation();
    }

    /**
     * Show All Categories
     * ============
     */
    public function show($id = null)
    {
        $rows = $this->db->table("kategori_artikel")->get()->getResultArray();

        $respond  = [
            "code"  => count($rows) == 0 ? 404  : 200,
            "error" => count($rows) == 0 ? true : false,
            "data"  => count($rows) == 0 ? []   : Utils::modifImgPath($rows,'icon','/assets/images/icon-kategori-artikel/')
        ];

        if (count($rows) == 0) {
            unset($respond["data"]);
            $respond["message"] = "kategori belum ditambah";
        }

        return $this->respond($respond,$respond['code']);
    }

    /**
     * Create Category
     * ============
     */
    public function create()
    {
        try {
            $post = $this->request->getPost();
            $post['icon'] = $this->request->getFile('icon'); 
            $this->validation->run($post,'kategoriArtikelValidate');

            $errors  = $this->validation->getErrors();

            if ($errors) {
                $respond = [
                    'code'    => 400,
                    'error'   => true,
                    'message' => $errors,
                ]; 
            } 
            else {
                $this->db->transBegin();

                // make file name
                $file        = $post['icon'];
                $typeFile    = explode('/',$file->getClientMimeType());
                $newFileName = uniqid().'.'.end($typeFile);
                $dbFileName  = $newFileName;

                // insert data to table
                $this->db->table("kategori_artikel")->insert([
                    "icon"           => $dbFileName,
                    "name"           => trim($post['kategori_name']),
                    "description"    => trim($post['description']),
                    "kategori_utama" => (trim($post['kategori_utama']) == '1') ? true : false,
                    "created_at"     => (int)time(),
                ]);

                $transStatus = $this->db->transStatus();
                $respond = [
                    'code'  => ($transStatus) ? 201   : 500,
                    'error' => ($transStatus) ? false : true,
                ];
                
                if (!$transStatus) {
                    $this->db->transRollback();
                } 
                else {
                    if ($file->move('assets/images/icon-kategori-artikel/',$newFileName)) {
                        $this->db->transCommit();
                    } 
                    else {
                        $respond = [
                            "error"   => true,
                            "code"    => 500,
                            "message" => "icon gagal disimpan",
                        ];
                    }
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

    /**
     * Update Category
     * ============
     */
    public function update($id = null)
    {
        try {
            Utils::_methodParser("put");
            global $put;

            $this->validation->run($put,'editKategoriArtikelValidate');
            $errors  = $this->validation->getErrors();

            if ($errors) {
                $respond = [
                    'code'    => 400,
                    'error'   => true,
                    'message' => $errors,
                ]; 
            } 
            else {
                $this->db->transBegin();

                $data = [
                    "name"           => trim($put['kategori_name']),
                    "description"    => trim($put['description']),
                    "kategori_utama" => (trim($put['kategori_utama']) == '1') ? true : false,
                ];

                // if new icon uploaded
                $newIcon = false;
                $file    = $this->request->getFile('icon');
                $newFileName = "";
                $oldIcon     = "";

                if ($file) {
                    $newIcon = true;
                    $xx['icon'] = $file;
    
                    $this->validation->run($xx,'newIconKategoriArtikel');
                    $errors = $this->validation->getErrors();
    
                    if($errors) {
                        $response = [
                            'code'    => 400,
                            'error'   => true,
                            'message' => $errors,
                        ];
                
                        return $this->respond($response,400);
                    }  
    
                    $file          = $xx['icon'];
                    $typeFile      = explode('/',$file->getClientMimeType());
                    $newFileName   = uniqid().'.'.end($typeFile);
                    $dbFileName    = $newFileName;
                    $data['icon']  = $dbFileName;

                    // get old icon
                    $selectedCat = $this->db->table("kategori_artikel")->where('id',$put['id'])->get()->getFirstRow();
                    $oldIcon     = $selectedCat->icon;
                }

                $this->db->table("kategori_artikel")->where("id",$put['id'])->update($data);

                $transStatus = $this->db->transStatus();
                $respond = [
                    'code'  => ($transStatus) ? 201   : 500,
                    'error' => ($transStatus) ? false : true,
                ];
                
                if (!$transStatus) {
                    $this->db->transRollback();
                } 
                else {
                    try {
                        if ($newIcon) {
                            rename($file->getRealPath(),'./assets/images/icon-kategori-artikel/'.$newFileName);
                            chmod("./assets/images/icon-kategori-artikel/".$newFileName, 777);
                            unlink('./assets/images/icon-kategori-artikel/'.$oldIcon);
                        }
                        $this->db->transCommit();
                    } 
                    catch (\Throwable $th) {
                        $respond = [
                            "error"   => true,
                            "code"    => 500,
                            "message" => "icon gagal disimpan",
                        ];
                        $this->db->transRollback();
                    }
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

    /**
     * Delete Category
     * ============
     */
    public function delete($id = null)
    {
        try {
            $data["id"] = $id;
            $this->validation->run($data,'deleteCatArticle');
            $errors     = $this->validation->getErrors();

            if ($errors) {
                $respond = [
                    'code'    => 400,
                    'error'   => true,
                    'message' => $errors["id"],
                ]; 
            } 
            else {
                $this->db->transBegin();
                
                $selectedCat = $this->db->table("kategori_artikel")->where('id',$id)->get()->getFirstRow();

                $this->db->table("kategori_artikel")->delete(["id" => $id]);

                $transStatus = $this->db->transStatus();
                $respond = [
                    'code'  => ($transStatus) ? 200   : 500,
                    'error' => ($transStatus) ? false : true,
                ];

                if (unlink('./assets/images/icon-kategori-artikel/'.$selectedCat->icon)) {
                    $respond['message'] = "kategori dengan id (".$id.") berhasil didelete";
                    $this->db->transCommit();
                }
                else {
                    $respond['message'] = "Rollback: terjadi kesalahan saat delete data";
                    $this->db->transRollback();
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
