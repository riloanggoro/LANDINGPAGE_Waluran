<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AppSeed extends Seeder
{
    public function run()
    {
        /**
         * Table user_type
         */
        $dataUserType = [
            [
                "type" => "admin"
            ],
        ];

        foreach ($dataUserType as $d) {
            $this->db->table('user_type')->insert($d);
        }

        /**
         * Table users
         */
        $dataUsers = [
            [
                "id"        => uniqid(),
                "username"  => "superadmin",
                "password"  => password_hash(trim("superadmin"), PASSWORD_DEFAULT),
                "id_previlege" => 1,
                "status"       => "active",
                "created_At"   => time(),
            ],
        ];

        foreach ($dataUsers as $d) {
            $this->db->table('users')->insert($d);
        }

        /**
         * Table Kategori Article
         */
        $dataKategoriArticle = [
            [
                "icon"           => "1.png",
                "name"           => "kategori 1",
                "description"    => "ini kategori 1",
                "kategori_utama" => "1",
                "created_At"     => time(),
            ],
            [
                "icon"           => "2.png",
                "name"           => "kategori 2",
                "description"    => "ini kategori 2",
                "kategori_utama" => "1",
                "created_At"     => time(),
            ],
            [
                "icon"           => "3.png",
                "name"           => "kategori 3",
                "description"    => "ini kategori 3",
                "kategori_utama" => "1",
                "created_At"     => time(),
            ],
        ];

        foreach ($dataKategoriArticle as $d) {
            // $this->db->table('kategori_artikel')->insert($d);
        }
    }
}
