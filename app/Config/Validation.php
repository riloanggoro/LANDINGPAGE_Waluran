<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $loginValidate = [
		'username' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'username harus diisi',
            ],
		],
        'password' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'password harus diisi',
            ],
		],
    ];

    public $updateUsernameValidate = [
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[users.username,users.id,{id}]',
            'errors' => [
                'required'    => 'username harus diisi',
                'min_length'  => 'username minimal 8 character',
                'max_length'  => 'username maximal 20 character',
                'is_unique'   => 'username sudah terdaftar',
            ],
		],
    ];

    public $newPasswordValidate = [
		'new_password' => [
            'rules'  => 'min_length[8]|max_length[20]',
            'errors' => [
                'min_length'  => 'password minimal 8 character',
                'max_length'  => 'password maximal 20 character',
            ],
		],
		'old_password' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'old password harus diisi',
            ],
		],
    ];

    /**
     * Category Article
     * ============================
     */
	public $kategoriArtikelValidate = [
        'icon' => [
            'rules'  => 'uploaded[icon]|max_size[icon,2000]|mime_in[icon,image/png,image/jpg,image/jpeg,image/webp]',
            'errors' => [
                'uploaded' => 'icon is required',
                'max_size' => 'max size is 2mb',
                // 'is_image' => 'your file is not image',
                'mime_in'  => 'your file is not in format(png/jpg/jpeg/webp)',
            ],
        ],
		'kategori_name' => [
            'rules'  => 'required|max_length[100]|is_unique[kategori_artikel.name]',
            'errors' => [
                'required'    => 'kategori name is required',
                'max_length'  => 'max 100 character',
                'is_unique'   => 'kategori name is exist',
            ],
		],
        'description' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'description is required',
            ],
		],
		'kategori_utama' => [
            'rules'  => 'required|in_list[1,0]',
            'errors' => [
                'required'    => 'kategori_utama is required',
                'in_list'     => "value must be '1' or '0'",
            ],
		]
	];

	public $editKategoriArtikelValidate = [
        'id' => [
            'rules'  => 'required|is_not_unique[kategori_artikel.id]',
            'errors' => [
                'required'      => 'id is required',
                'is_not_unique' => 'kategori with id ({value}) is not found',
            ],
		],
		'kategori_name' => [
            'rules'  => 'required|max_length[100]|is_unique[kategori_artikel.name,kategori_artikel.id,{id}]',
            'errors' => [
                'required'    => 'kategori name is required',
                'max_length'  => 'max 100 character',
                'is_unique'   => 'kategori name is exist',
            ],
		],
        'description' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'description is required',
            ],
		],
		'kategori_utama' => [
            'rules'  => 'required|in_list[1,0]',
            'errors' => [
                'required'    => 'kategori_utama is required',
                'in_list'     => "value must be '1' or '0'",
            ],
		]
	];

	public $newIconKategoriArtikel = [
        'icon' => [
            'rules'  => 'max_size[icon,200]|mime_in[icon,image/png,image/jpg,image/jpeg,image/webp]',
            'errors' => [
                'max_size' => 'max size is 200kb',
                'mime_in'  => 'your file is not in format(png/jpg/jpeg/webp)',
            ],
        ],
	];

    public $deleteCatArticle = [
		'id' => [
            'rules'  => 'is_not_unique[kategori_artikel.id]',
            'errors' => [
                'is_not_unique' => 'id kategori ({value}) tidak terdaftar',
            ],
		],
    ];

    /**
     * Article
     * ============================
     */
    public $getRelatedArtikel = [
		'slug' => [
            'rules'  => 'required|is_not_unique[artikel.slug]',
            'errors' => [
                'required'      => 'slug is required',
                'is_not_unique' => 'artikel with id ({slug}) is not found',
            ],
		]
	];
    
    public $artikelValidate = [
		'title' => [
            'rules'  => 'required|max_length[250]|is_unique[artikel.title]',
            'errors' => [
                'required'    => 'title is required',
                'max_length'  => 'max 250 character',
                'is_unique'   => 'judul ({value}) sudah ada',
            ],
		],
		'thumbnail' => [
            'rules'  => 'uploaded[thumbnail]|max_size[thumbnail,2000]|mime_in[thumbnail,image/avif,image/png,image/jpg,image/jpeg,image/webp]',
            'errors' => [
                'uploaded' => 'thumbnail is required',
                'max_size' => 'max size is 2mb',
                // 'is_image' => 'your file is not image',
                'mime_in'  => 'your file is not in format(png/jpg/jpeg/webp)',
            ],
		],
		'content' => [
            'rules'  => 'required',
            'errors' => [
                'required'    => 'content is required',
            ],
		],
		'id_kategori' => [
            'rules'  => 'required|is_not_unique[kategori_artikel.id]',
            'errors' => [
                'required'      => 'id_kategori is required',
                'is_not_unique' => 'id_kategori with value ({value}) is not found',
            ],
		]
	];

    // edit artikel
	public $editArtikelValidate = [
		'id' => [
            'rules'  => 'required|is_not_unique[artikel.id]',
            'errors' => [
                'required'      => 'id is required',
                'is_not_unique' => 'berita with id ({value}) is not found',
            ],
		],
		'title' => [
            'rules'  => 'required|max_length[250]|is_unique[artikel.title,artikel.id,{id}]',
            'errors' => [
                'required'    => 'title is required',
                'max_length'  => 'max 250 character',
                'is_unique'   => 'judul ({value}) sudah ada',
            ],
		],
		'content' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'content is required',
            ],
		],
		'id_kategori' => [
            'rules'  => 'required|is_not_unique[kategori_artikel.id]',
            'errors' => [
                'required'      => 'id_kategori is required',
                'is_not_unique' => 'id_kategori with value ({value}) is not found',
            ],
		]
	];

    // new thumbnail
	public $newArtikelThumbnail = [
        'new_thumbnail' => [
            'rules'  => 'max_size[new_thumbnail,2000]|mime_in[new_thumbnail,image/png,image/jpg,image/jpeg,image/webp]',
            'errors' => [
                'max_size' => 'max size is 2mb',
                // 'is_image' => 'your file is not image',
                'mime_in'  => 'your file is not in format(png/jpg/jpeg/webp)',
            ],
        ],
	];

    public $deleteArticle = [
		'id' => [
            'rules'  => 'is_not_unique[artikel.id]',
            'errors' => [
                'is_not_unique' => 'id artikel ({value}) tidak terdaftar',
            ],
		],
    ];
}
