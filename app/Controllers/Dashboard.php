<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    /**
     * PAGE: Dashboard
     * - show dashboard page
     */
    public function index()
    {
        global $g_token;
        global $g_previlege;

        $data = [
            'title' => 'home',
            'token' => $g_token,
            'previlege' => $g_previlege,
        ];

        // return view("Dashboard/index",$data);
        return redirect()->to('/dashboard/artikel');
    }

    /**
     * PAGE: List Article
     * - show list article page
     */
    public function listArticle()
    {
        global $g_token;
        global $g_previlege;

        $data = [
            'title' => 'daftar artikel',
            'token' => $g_token,
            'previlege' => $g_previlege,
        ];

        return view("Dashboard/articles/index",$data);
    }

    /**
     * PAGE: Add Article
     * - show add article page
     */
    public function addArticle()
    {
        global $g_token;
        global $g_previlege;

        $data = [
            'title' => 'tambah artikel',
            'token' => $g_token,
            'previlege' => $g_previlege,
        ];

        return view("Dashboard/articles/crudArticle",$data);
    }

    /**
     * PAGE: Edit Article
     * - show edit article page
     */
    public function editArticle()
    {
        global $g_token;
        global $g_previlege;

        $data = [
            'title' => 'edit artikel',
            'token' => $g_token,
            'previlege' => $g_previlege,
        ];

        return view("Dashboard/articles/crudArticle",$data);
    }

    /**
     * PAGE: Category Article
     * - show list category article
     */
    public function categoryArticle()
    {
        global $g_token;
        global $g_previlege;

        $data = [
            'title' => 'kategori artikel',
            'token' => $g_token,
            'previlege' => $g_previlege,
        ];

        return view("Dashboard/categoryArticle/index",$data);
    }

}
