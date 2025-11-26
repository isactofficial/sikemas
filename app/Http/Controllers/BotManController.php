<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Web\WebDriver;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    /**
     * Handle incoming BotMan requests
     */
    public function handle()
    {
        // Load Web Driver
        DriverManager::loadDriver(WebDriver::class);
        
        $botman = app('botman');

        // ===== GREETING & START =====
        $botman->hears('(start|halo|hi|hello|hai|bantuan|help)', function (BotMan $bot) {
            $this->startConversation($bot);
        });

        // ===== MENU UTAMA =====
        $botman->hears('(menu)', function (BotMan $bot) {
            $this->showMainMenu($bot);
        });

        // ===== BERANDA =====
        $botman->hears('(beranda|home|homepage)', function (BotMan $bot) {
            $this->showBeranda($bot);
        });

        // ===== PRODUK =====
        $botman->hears('(produk|product|products)', function (BotMan $bot) {
            $this->showProduk($bot);
        });

        // ===== ARTIKEL =====
        $botman->hears('(artikel|article|berita|news)', function (BotMan $bot) {
            $this->showArtikel($bot);
        });

        // ===== PORTOFOLIO =====
        $botman->hears('(portofolio|portfolio|porto)', function (BotMan $bot) {
            $this->showPortofolio($bot);
        });

        // ===== ABOUT US =====
        $botman->hears('(about|about us|tentang|tentang kami)', function (BotMan $bot) {
            $this->showAbout($bot);
        });

        // ===== PROFILE =====
        $botman->hears('(profile|profil|akun|account)', function (BotMan $bot) {
            $this->showProfile($bot);
        });

        // ===== KONSULTASI =====
        $botman->hears('(konsultasi|consultation|consult)', function (BotMan $bot) {
            $this->showKonsultasi($bot);
        });

        // ===== KONTAK =====
        $botman->hears('(kontak|contact|hubungi)', function (BotMan $bot) {
            $this->showKontak($bot);
        });

        // ===== TERIMA KASIH =====
        $botman->hears('(terima kasih|thanks|thank you|makasih|thx)', function (BotMan $bot) {
            $bot->reply('✨ Sama-sama! Senang bisa membantu Anda. 😊');
            $this->askForMore($bot);
        });

        // ===== FALLBACK =====
        $botman->fallback(function (BotMan $bot) {
            $this->fallbackResponse($bot);
        });

        $botman->listen();
    }

    /**
     * Start conversation with greeting
     */
    private function startConversation(BotMan $bot)
    {
        $bot->reply("👋 Halo! Selamat datang di SIKEMAS Assistant.");
        $bot->reply("Ketik 'menu' untuk melihat semua halaman yang tersedia.");
    }

    /**
     * Show main menu with all pages
     */
    private function showMainMenu(BotMan $bot)
    {
        $message = "📋 **MENU HALAMAN SIKEMAS**\n\n";
        $message .= "Ketik salah satu untuk mengakses halaman:\n\n";
        $message .= "🏠 **beranda** - Halaman utama\n";
        $message .= "📦 **produk** - Lihat produk kemasan\n";
        $message .= "📰 **artikel** - Baca artikel terbaru\n";
        $message .= "🎨 **portofolio** - Lihat portfolio\n";
        $message .= "ℹ️ **about** - Tentang kami\n";
        $message .= "👤 **profile** - Kelola profil (perlu login)\n\n";
        $message .= "💬 **konsultasi** - Konsultasi gratis\n";
        $message .= "📞 **kontak** - Hubungi kami";
        
        $bot->reply($message);
    }

    /**
     * Show Beranda page
     */
    private function showBeranda(BotMan $bot)
    {
        $url = route('beranda');
        
        $message = "🏠 **HALAMAN BERANDA**\n\n";
        $message .= "Halaman utama SIKEMAS dengan informasi terkini:\n";
        $message .= "• Produk unggulan kami\n";
        $message .= "• Komitmen keberlanjutan\n";
        $message .= "• Artikel & berita terbaru\n";
        $message .= "• Testimoni pelanggan\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Kunjungi Beranda</a>";
        
        $bot->reply($message);
        $this->askForMore($bot);
    }

    /**
     * Show Produk page
     */
    private function showProduk(BotMan $bot)
    {
        $url = route('produk');
        
        $message = "📦 **HALAMAN PRODUK**\n\n";
        $message .= "Temukan berbagai produk kemasan berkualitas:\n\n";
        $message .= "📌 Karton\n";
        $message .= "📌 Plastik\n";
        $message .= "📌 Kertas\n";
        $message .= "📌 Aluminium\n";
        $message .= "📌 Dan lainnya\n\n";
        $message .= "✨ **Fitur:**\n";
        $message .= "• Kustomisasi desain\n";
        $message .= "• Upload desain sendiri\n";
        $message .= "• Tambah ke keranjang\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Lihat Semua Produk</a>";
        
        $bot->reply($message);
        $this->askForMore($bot);
    }

    /**
     * Show Artikel page
     */
    private function showArtikel(BotMan $bot)
    {
        $url = route('artikel');
        
        $message = "📰 **HALAMAN ARTIKEL**\n\n";
        $message .= "Dapatkan wawasan dan informasi terkini:\n\n";
        $message .= "📚 **Kategori:**\n";
        $message .= "• Keberlanjutan\n";
        $message .= "• Desain\n";
        $message .= "• Teknologi\n";
        $message .= "• Bisnis\n\n";
        $message .= "🔍 Filter artikel berdasarkan:\n";
        $message .= "• Terbaru\n";
        $message .= "• Terpopuler\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Baca Artikel</a>";
        
        $bot->reply($message);
        $this->askForMore($bot);
    }

    /**
     * Show Portofolio page
     */
    private function showPortofolio(BotMan $bot)
    {
        $url = route('portofolio');
        
        $message = "🎨 **HALAMAN PORTOFOLIO**\n\n";
        $message .= "Lihat hasil karya dan testimoni pelanggan kami:\n\n";
        $message .= "⭐ Testimoni klien\n";
        $message .= "📸 Dokumentasi proyek\n";
        $message .= "🏆 Proyek unggulan\n";
        $message .= "💼 Berbagai kategori kemasan\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Lihat Portfolio</a>";
        
        $bot->reply($message);
        $this->askForMore($bot);
    }

    /**
     * Show About Us page
     */
    private function showAbout(BotMan $bot)
    {
        $url = route('about');
        
        $message = "ℹ️ **TENTANG SIKEMAS**\n\n";
        $message .= "Pelajari lebih lanjut tentang kami:\n\n";
        $message .= "🎯 Profil Perusahaan\n";
        $message .= "📜 Sejarah Kami\n";
        $message .= "💼 Lini Bisnis\n";
        $message .= "💡 Nilai Perusahaan\n";
        $message .= "❓ FAQ\n";
        $message .= "📞 Kontak Kami\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Tentang Kami</a>";
        
        $bot->reply($message);
        $this->askForMore($bot);
    }

    /**
     * Show Profile page
     */
    private function showProfile(BotMan $bot)
    {
        $url = route('profile.index');
        
        $message = "👤 **HALAMAN PROFILE**\n\n";
        $message .= "Kelola akun dan informasi pribadi Anda:\n\n";
        $message .= "✏️ Edit Profil\n";
        $message .= "📍 Kelola Alamat\n";
        $message .= "📦 Riwayat Pesanan\n";
        $message .= "⚙️ Pengaturan Akun\n\n";
        $message .= "⚠️ **Catatan:** Anda harus login terlebih dahulu\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Buka Profil</a>";
        
        $bot->reply($message);
        $this->askForMore($bot);
    }

    /**
     * Show Konsultasi info
     */
    private function showKonsultasi(BotMan $bot)
    {
        $url = route('home') . '#konsul';
        
        $message = "💬 **KONSULTASI DESAIN GRATIS**\n\n";
        $message .= "Ajukan konsultasi desain kemasan GRATIS dengan tim ahli kami!\n\n";
        $message .= "✅ **Keuntungan:**\n";
        $message .= "• Konsultasi langsung dengan expert\n";
        $message .= "• Solusi sesuai kebutuhan Anda\n";
        $message .= "• Estimasi biaya transparan\n";
        $message .= "• 100% GRATIS!\n\n";
        $message .= "⚠️ **Syarat:** Harus login & isi nomor telepon\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Konsultasi Sekarang</a>";
        
        $bot->reply($message);
        $this->askForMore($bot);
    }

    /**
     * Show Kontak info
     */
    private function showKontak(BotMan $bot)
    {
        $url = route('about') . '#kontak-kami';
        
        $message = "📞 **HUBUNGI KAMI**\n\n";
        $message .= "Punya pertanyaan? Kami siap membantu!\n\n";
        $message .= "📍 **Lokasi:**\n";
        $message .= "Jl. Kartini, Rempoa, No. 121\n";
        $message .= "Jakarta, Indonesia 12345\n\n";
        $message .= "☎️ **Telepon:** +62 21 8765 4321\n";
        $message .= "📧 **Email:** info@sikemas.com\n";
        $message .= "📱 **Instagram:** @sikemas_official\n";
        $message .= "💼 **LinkedIn:** Sikemas Official\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Kirim Pesan</a>";
        
        $bot->reply($message);
        $this->askForMore($bot);
    }

    /**
     * Ask if user needs more help
     */
    private function askForMore(BotMan $bot)
    {
        $bot->reply("\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.");
    }

    /**
     * Fallback response
     */
    private function fallbackResponse(BotMan $bot)
    {
        $message = "🤔 Maaf, saya tidak mengerti perintah tersebut.\n\n";
        $message .= "Ketik 'menu' untuk melihat semua halaman yang tersedia.";
        
        $bot->reply($message);
    }

    /**
     * Test endpoint
     */
    public function test()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'BotMan is working! Chatbot SIKEMAS siap digunakan.',
            'timestamp' => now()->toDateTimeString()
        ]);
    }
}