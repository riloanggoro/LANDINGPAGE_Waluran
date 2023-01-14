<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Utils\Utils;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Waluran Mandiri'
        ];

        return view('HomePage/index',$data);
    }

    public function blogList()
    {
        $artikelModel = new ArtikelModel();
        $dataArtikel  = $artikelModel->where("published_at <=",(int)time())->paginate(6,'artikel');

        $data = [
            'title'   => "Daftar Blog",
            'artikel' => Utils::modifImgPath($dataArtikel,'thumbnail','/assets/images/thumbnail-artikel/'),
            'pager'   => $artikelModel->pager,
        ];
        // base_url('assets/images/thumbnail-artikel/'.$a['thumbnail']
        return view('HomePage/blog',$data);
    }

    public function blogDetail()
    {
        $data = [
            'title' => "Baca Blog"
        ];

        return view('HomePage/blogdetil',$data);
    }
}
