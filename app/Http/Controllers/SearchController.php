<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Testimony;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Menangani permintaan pencarian dan menampilkan hasilnya.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari query parameter 'q'
        $query = $request->input('q');

        // Pastikan query tidak kosong
        if (empty($query)) {
            return view('search_results', [
                'query' => '',
                'articles' => collect([]),
                'products' => collect([]),
                'testimonies' => collect([]),
                'pages' => collect([]),
            ]);
        }

        // 1. Pencarian Artikel
        $articles = Article::query()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('deskripsi', 'like', '%' . $query . '%');
            })
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // 2. Pencarian Produk
        $products = Product::query()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('category', 'like', '%' . $query . '%');
            })
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // 3. Pencarian Testimoni
        $testimonies = Testimony::query()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('testimony', 'like', '%' . $query . '%')
                  ->orWhere('job', 'like', '%' . $query . '%');
            })
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // 4. Pencarian Halaman Statis (Manual Index)
        $pages = $this->searchStaticPages($query);

        // Tampilkan view search_results.blade.php dengan data hasil
        return view('search_results', [
            'query' => $query,
            'articles' => $articles,
            'products' => $products,
            'testimonies' => $testimonies,
            'pages' => collect($pages),
        ]);
    }

    /**
     * Mencari di halaman statis (About, Portfolio, dll)
     * * @param string $query
     * @return array
     */
    private function searchStaticPages($query)
    {
        $query = strtolower($query);
        $results = [];

        // Daftar halaman statis dengan konten yang bisa dicari
        $staticPages = [
            [
                'title' => 'Artikel & Berita', // <-- Entri baru
                'url' => route('artikel'), // <-- Pastikan rute ini ada
                'keywords' => ['artikel', 'berita', 'wawasan', 'panduan kemasan', 'blog', 'informasi', 'packaging tips'], // <-- Kata kunci terkait
                'description' => 'Wawasan terkini dan panduan praktis tentang kemasan yang visioner dari SIKEMAS.',
                'type' => 'Halaman'
            ],
            [
                'title' => 'Tentang Kami',
                'url' => route('about'),
                'keywords' => ['tentang', 'about', 'profil perusahaan', 'sejarah', 'nilai perusahaan', 'visi misi', 'kontak', 'lokasi', 'alamat'],
                'description' => 'Informasi lengkap tentang SIKEMAS, profil perusahaan, sejarah, dan nilai-nilai kami.',
                'type' => 'Halaman'
            ],
            [
                'title' => 'Portofolio',
                'url' => route('portofolio'),
                'keywords' => ['portofolio', 'portfolio', 'hasil kerja', 'testimoni', 'klien', 'proyek'],
                'description' => 'Lihat hasil kerja kami dan testimoni dari klien-klien SIKEMAS.',
                'type' => 'Halaman'
            ],
            [
                'title' => 'Beranda',
                'url' => route('home'),
                'keywords' => ['beranda', 'home', 'sikemas', 'kemasan', 'karton', 'protect your value'],
                'description' => 'Halaman utama SIKEMAS - solusi kemasan karton berkualitas untuk bisnis Anda.',
                'type' => 'Halaman'
            ],
            [
                'title' => 'Konsultasi Desain Gratis',
                'url' => route('home') . '#konsul',
                'keywords' => ['konsultasi', 'desain gratis', 'free design', 'konsul'],
                'description' => 'Dapatkan konsultasi desain kemasan gratis dari tim profesional SIKEMAS.',
                'type' => 'Layanan'
            ],
            [
                'title' => 'Custom Design',
                'url' => route('edit.design'),
                'keywords' => ['custom design', 'edit design', 'desain sendiri', 'buat desain'],
                'description' => 'Buat desain kemasan custom Anda sendiri dengan tool online kami.',
                'type' => 'Layanan'
            ],
        ];

        // Cari yang cocok dengan query
        foreach ($staticPages as $page) {
            // Cek apakah query cocok dengan title
            if (stripos($page['title'], $query) !== false) {
                $results[] = $page;
                continue;
            }

            // Cek apakah query cocok dengan keywords
            foreach ($page['keywords'] as $keyword) {
                if (stripos($keyword, $query) !== false || stripos($query, $keyword) !== false) {
                    $results[] = $page;
                    break;
                }
            }
        }

        return $results;
    }
}