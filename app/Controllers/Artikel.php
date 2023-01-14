<?php

namespace App\Controllers;

use App\Utils\TokenUtil;
use App\Utils\Utils;
use CodeIgniter\RESTful\ResourceController;

class Artikel extends ResourceController
{
    private $db;
    private $validation;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->db = \Config\Database::connect(); 
        $this->validation = \Config\Services::validation();
    }

    /**
     * Show All Article
     * ============
     */
    public function show($id = null)
    {
        $isAdmin = false;
        $request = \Config\Services::request();

        if ($this->request->getHeader('token')) {
            $authHeader = $request->getHeader('token');
            $token      = ($authHeader != null) ? $authHeader->getValue() : null;
            $result     = TokenUtil::checkToken($token);
            $isAdmin    = (in_array($result['data']['previlege'],['admin'])) ? true : false;
        }

        $orderby = (isset($_GET['orderby']) && $_GET['orderby']=='terbaru')? 'DESC': 'ASC';

        if (isset($_GET['id']) && !isset($_GET['kategori'])) {
            $berita = $this->db->table("artikel")
            ->select("artikel.id,artikel.title,artikel.slug,artikel.id_kategori,kategori_artikel.name AS kategori,artikel.published_at,artikel.created_at,artikel.thumbnail,artikel.content")
            ->join('kategori_artikel', 'kategori_artikel.id = artikel.id_kategori')
            ->where("artikel.id",$_GET['id'])->get()->getFirstRow();
        } 
        else if (isset($_GET['slug']) && !isset($_GET['kategori'])) {
            $berita = $this->db->table("artikel")
            ->select("artikel.id,artikel.title,artikel.slug,artikel.id_kategori,kategori_artikel.name AS kategori,artikel.published_at,artikel.created_at,artikel.thumbnail,artikel.content")
            ->join('kategori_artikel', 'kategori_artikel.id = artikel.id_kategori')
            ->where("artikel.slug",$_GET['slug'])->get()->getFirstRow();
        } 
        else if (isset($_GET['kategori']) && !isset($_GET['id'])) {
            $berita = $this->db->table("artikel")->select('artikel.id,artikel.title,artikel.slug,kategori_artikel.name AS kategori,artikel.published_at,artikel.created_at,artikel.thumbnail')
            ->join('kategori_artikel', 'kategori_artikel.id = artikel.id_kategori')
            ->where("kategori_artikel.name",$_GET['kategori']);

            if (!$isAdmin) {
                $berita = $berita->where("artikel.published_at <=",(int)time());
            }

            $berita = $berita->orderBy('artikel.created_at',$orderby)->get()->getResultArray();
        } 
        else {
            $berita = $this->db->table("artikel")->select('artikel.id,artikel.title,artikel.slug,kategori_artikel.name AS kategori,artikel.published_at,artikel.created_at,artikel.thumbnail')
            ->join('kategori_artikel', 'kategori_artikel.id = artikel.id_kategori');

            if (!$isAdmin) {
                $berita = $berita->where("artikel.published_at <=",(int)time());
            }

            $berita = $berita->orderBy('artikel.created_at',$orderby);

            if (isset($_GET['limit'])) {
                $berita = $berita->limit($_GET['limit']);
            }

            $berita = $berita->get()->getResultArray();
        }

        $respond  = [
            "code"  => empty($berita) ? 404  : 200,
            "error" => empty($berita) ? true : false,
            "data"  => empty($berita) ? []   : Utils::modifImgPath($berita,'thumbnail','/assets/images/thumbnail-artikel/')
        ];

        if (empty($berita)) {
            unset($respond["data"]);
            $respond["message"] = "artikel tidak ditemukan";
        }

        return $this->respond($respond,$respond['code']);
    }

    /**
     * Show Related Article
     * ============
     */
    public function relatedArticle(): object
    {
        $this->validation->run($this->request->getGet(),'getRelatedArtikel');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'message'  => $errors['id'],
            ];
        
            return $this->respond($response,400);
        }

        $slug       = ($this->request->getGet('slug')) ? $this->request->getGet('slug') :'' ;

        $allBerita  = [];
        $target     = $this->db->table('artikel')->select("id,id_kategori")->where("slug",$slug)->get()->getResultArray();
        $id         = $target[0]['id'];
        $idKategori = $target[0]['id_kategori'];

        $firstId   = $this->db->table('artikel')->select('id')->where("id_kategori",$idKategori)->limit(1)->orderBy('id','ASC')->get()->getResultArray()[0]['id'];
        $lastId    = $this->db->table('artikel')->select('id')->where("id_kategori",$idKategori)->limit(1)->orderBy('id','DESC')->get()->getResultArray()[0]['id'];

        $limitPrev  = 2;
        $prevBerita = $this->db->query("SELECT artikel.id,artikel.title,artikel.slug,kategori_artikel.name AS kategori,artikel.created_at,artikel.thumbnail 
        FROM artikel 
        JOIN kategori_artikel ON(artikel.id_kategori = kategori_artikel.id) 
        WHERE artikel.id_kategori = '$idKategori' 
        AND artikel.id BETWEEN '$firstId' AND '$id' 
        ORDER BY artikel.id DESC LIMIT $limitPrev OFFSET 1")->getResultArray();
        
        $limitNext  = 2 + ($limitPrev-count($prevBerita));
        $nextBerita = $this->db->query("SELECT artikel.id,artikel.title,artikel.slug,kategori_artikel.name AS kategori,artikel.created_at,artikel.thumbnail 
        FROM artikel 
        JOIN kategori_artikel ON(artikel.id_kategori = kategori_artikel.id) 
        WHERE artikel.id_kategori = '$idKategori' 
        AND artikel.id BETWEEN '$id' AND '$lastId '
        ORDER BY artikel.id ASC LIMIT $limitNext OFFSET 1")->getResultArray();

        if (count($nextBerita) < 2 && count($prevBerita) == 2) {
            $limitNewNext  = 2-count($nextBerita);
            $newNextBerita = $this->db->query("SELECT artikel.id,artikel.title,artikel.slug,kategori_artikel.name AS kategori,artikel.created_at,artikel.thumbnail 
            FROM artikel 
            JOIN kategori_artikel ON(artikel.id_kategori = kategori_artikel.name)
            WHERE artikel.id_kategori = '$idKategori' 
            AND artikel.id BETWEEN '$firstId' AND '".$prevBerita[1]['id']."' ORDER BY artikel.id DESC LIMIT $limitNewNext OFFSET 1")->getResultArray();
            
            foreach ($newNextBerita as $key) {
                $nextBerita[] = $key;
            }
        }

        foreach ($prevBerita as $key) {
            $allBerita[] = $key;
        }
        foreach ($nextBerita as $key) {
            $allBerita[] = $key;
        }

        if (count($prevBerita) + count($nextBerita) < 4) {
            $limitOtherKat = 4-(count($prevBerita) + count($nextBerita));
            $otherKat = $this->db->query("SELECT artikel.id,artikel.title,artikel.slug,kategori_artikel.name AS kategori,artikel.created_at,artikel.thumbnail 
            FROM artikel 
            JOIN kategori_artikel ON(artikel.id_kategori = kategori_artikel.id)
            WHERE artikel.id_kategori != '$idKategori' 
            ORDER BY artikel.id DESC LIMIT $limitOtherKat")->getResultArray();

            foreach ($otherKat as $key) {
                $allBerita[] = $key;
            }
        }

        $respond  = [
            "code"  => empty($allBerita) ? 404  : 200,
            "error" => empty($allBerita) ? true : false,
            "data"  => empty($allBerita) ? []   : Utils::modifImgPath($allBerita,'thumbnail','/assets/images/thumbnail-artikel/')
        ];
    
        return $this->respond($respond,$respond['code']);
    }

    /**
     * Create Article
     * ============
     */
    public function create()
    {
        try {
            $post = $this->request->getPost();
            $post['thumbnail'] = $this->request->getFile('thumbnail'); 
            $this->validation->run($post,'artikelValidate');

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
                $file        = $post['thumbnail'];
                $typeFile    = explode('/',$file->getClientMimeType());
                $newFileName = uniqid().'.'.end($typeFile);

                // insert data to table
                $this->db->table("artikel")->insert([
                    "title"       => strtolower(trim($post['title'])),
                    "slug"        => preg_replace('/ /i', '-',strtolower(trim($post['title']))),
                    "thumbnail"   => $newFileName,
                    "content"     => $post['content'],
                    "id_kategori" => trim($post['id_kategori']),
                    "created_at"  => (int)time(),
                    "published_at"=> (int)strtotime($post['published_at']." 00:00"),
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
                    if ($file->move('assets/images/thumbnail-artikel/',$newFileName)) {
                        $this->db->transCommit();
                    } 
                    else {
                        $respond = [
                            "error"   => true,
                            "code"    => 500,
                            "message" => "thumbnail gagal disimpan",
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
     * Update Article
     * ============
     */
    public function update($id = null)
    {
        try {
            Utils::_methodParser("put");
            global $put;

            $this->validation->run($put,'editArtikelValidate');
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
                    "id"          => trim($put['id']),
                    "title"       => strtolower(trim($put['title'])),
                    "slug"        => preg_replace('/ /i', '-',strtolower(trim($put['title']))),
                    "content"     => trim($put['content']),
                    "id_kategori" => trim($put['id_kategori']),
                    "published_at"=> (int)strtotime($put['published_at']." 00:00")
                ];

                // if new thumbnail uploaded
                $newThumbnail = false;
                $file         = $this->request->getFile('thumbnail');
                $newFileName  = "";
                $oldThumbnail = "";

                if ($file) {
                    $newThumbnail = true;
                    $xx['thumbnail']   = $file;
    
                    $this->validation->run($xx,'newArtikelThumbnail');
                    $errors = $this->validation->getErrors();
    
                    if($errors) {
                        $response = [
                            'code'    => 400,
                            'error'   => true,
                            'message' => $errors,
                        ];
                
                        return $this->respond($response,400);
                    }  
    
                    $file          = $xx['thumbnail'];
                    $typeFile      = explode('/',$file->getClientMimeType());
                    $newFileName   = uniqid().'.'.end($typeFile);
                    $dbFileName    = $newFileName;
                    $data['thumbnail'] = $dbFileName;

                    // get old icon
                    $selectedArticle = $this->db->table("artikel")->where('id',$put['id'])->get()->getFirstRow();
                    $oldThumbnail    = $selectedArticle->thumbnail;
                }

                $this->db->table("artikel")->where("id",$put['id'])->update($data);

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
                        if ($newThumbnail) {
                            rename($file->getRealPath(),'./assets/images/thumbnail-artikel/'.$newFileName);
                            chmod("./assets/images/thumbnail-artikel/".$newFileName, 777);
                            unlink('./assets/images/thumbnail-artikel/'.$oldThumbnail);
                        }
                        $this->db->transCommit();
                    } 
                    catch (\Throwable $th) {
                        $respond = [
                            "error"   => true,
                            "code"    => 500,
                            "message" => "thumbnail gagal disimpan",
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
            $this->validation->run($data,'deleteArticle');
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
                
                $selectedCat = $this->db->table("artikel")->where('id',$id)->get()->getFirstRow();

                $this->db->table("artikel")->delete(["id" => $id]);

                $transStatus = $this->db->transStatus();
                $respond = [
                    'code'  => ($transStatus) ? 200   : 500,
                    'error' => ($transStatus) ? false : true,
                ];

                if (unlink('./assets/images/thumbnail-artikel/'.$selectedCat->thumbnail)) {
                    $respond['message'] = "artikel dengan id (".$id.") berhasil didelete";
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
