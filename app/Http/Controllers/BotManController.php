<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    /**
     * Handle incoming BotMan requests
     */
    public function handle(Request $request)
    {
        try {
            // Get message from request
            $messageText = $request->input('message.text', '');
            
            if (empty($messageText)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Message text is required',
                    'messages' => []
                ], 400);
            }

            // Process message and get responses
            $responses = $this->processMessage($messageText);

            return response()->json([
                'status' => 'success',
                'messages' => $responses
            ]);

        } catch (\Exception $e) {
            Log::error('BotMan Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server',
                'messages' => [
                    [
                        'text' => '⚠️ Maaf, terjadi kesalahan. Silakan coba lagi.',
                        'type' => 'text'
                    ]
                ]
            ], 500);
        }
    }

    /**
     * Process incoming message and return responses
     */
    private function processMessage($message)
    {
        $message = strtolower(trim($message));
        $responses = [];

        // ===== GREETING & START =====
        if (preg_match('/(start|halo|hi|hello|hai|bantuan|help)/i', $message)) {
            $responses[] = ['text' => "👋 Halo! Selamat datang di SIKEMAS Assistant.", 'type' => 'text'];
            $responses[] = ['text' => "Ketik 'menu' untuk melihat semua halaman yang tersedia.", 'type' => 'text'];
        }
        // ===== MENU UTAMA =====
        elseif (preg_match('/(menu)/i', $message)) {
            $responses[] = ['text' => $this->getMainMenuText(), 'type' => 'text'];
        }
        // ===== BERANDA =====
        elseif (preg_match('/(beranda|home|homepage)/i', $message)) {
            $responses[] = ['text' => $this->getBerandaText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== PRODUK =====
        elseif (preg_match('/(produk|product|products)/i', $message)) {
            $responses[] = ['text' => $this->getProdukText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== ARTIKEL =====
        elseif (preg_match('/(artikel|article|berita|news)/i', $message)) {
            $responses[] = ['text' => $this->getArtikelText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== PORTOFOLIO =====
        elseif (preg_match('/(portofolio|portfolio|porto)/i', $message)) {
            $responses[] = ['text' => $this->getPortofolioText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== ABOUT US =====
        elseif (preg_match('/(about|about us|tentang|tentang kami)/i', $message)) {
            $responses[] = ['text' => $this->getAboutText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== PROFILE =====
        elseif (preg_match('/(profile|profil|akun|account)/i', $message)) {
            $responses[] = ['text' => $this->getProfileText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== KONSULTASI =====
        elseif (preg_match('/(konsultasi|consultation|consult)/i', $message)) {
            $responses[] = ['text' => $this->getKonsultasiText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== KONTAK =====
        elseif (preg_match('/(kontak|contact|hubungi)/i', $message)) {
            $responses[] = ['text' => $this->getKontakText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== TUTORIAL PEMESANAN =====
        elseif (preg_match('/(tutorial|cara pesan|cara order|panduan|how to order)/i', $message)) {
            $responses[] = ['text' => $this->getTutorialText(), 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== TERIMA KASIH =====
        elseif (preg_match('/(terima kasih|thanks|thank you|makasih|thx)/i', $message)) {
            $responses[] = ['text' => '✨ Sama-sama! Senang bisa membantu Anda. 😊', 'type' => 'text'];
            $responses[] = ['text' => "\n💡 Ada yang bisa saya bantu lagi? Ketik 'menu' untuk melihat semua halaman.", 'type' => 'text'];
        }
        // ===== FALLBACK =====
        else {
            $responses[] = ['text' => "🤔 Maaf, saya tidak mengerti perintah tersebut.\n\nKetik 'menu' untuk melihat semua halaman yang tersedia.", 'type' => 'text'];
        }

        return $responses;
    }

    /**
     * Get main menu text
     */
    private function getMainMenuText()
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
        $message .= "📞 **kontak** - Hubungi kami\n";
        $message .= "📖 **tutorial** - Tutorial cara pemesanan";
        return $message;
    }

    /**
     * Get beranda text
     */
    private function getBerandaText()
    {
        $url = route('beranda');
        
        $message = "🏠 **HALAMAN BERANDA**\n\n";
        $message .= "Halaman utama SIKEMAS dengan informasi terkini:\n";
        $message .= "• Produk unggulan kami\n";
        $message .= "• Komitmen keberlanjutan\n";
        $message .= "• Artikel & berita terbaru\n";
        $message .= "• Testimoni pelanggan\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Kunjungi Beranda</a>";
        
        return $message;
    }

    /**
     * Get produk text
     */
    private function getProdukText()
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
        
        return $message;
    }

    /**
     * Get artikel text
     */
    private function getArtikelText()
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
        
        return $message;
    }

    /**
     * Get portofolio text
     */
    private function getPortofolioText()
    {
        $url = route('portofolio');
        
        $message = "🎨 **HALAMAN PORTOFOLIO**\n\n";
        $message .= "Lihat hasil karya dan testimoni pelanggan kami:\n\n";
        $message .= "⭐ Testimoni klien\n";
        $message .= "📸 Dokumentasi proyek\n";
        $message .= "🏆 Proyek unggulan\n";
        $message .= "💼 Berbagai kategori kemasan\n\n";
        $message .= "👉 <a href='{$url}' target='_blank'>Lihat Portfolio</a>";
        
        return $message;
    }

    /**
     * Get about text
     */
    private function getAboutText()
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
        
        return $message;
    }

    /**
     * Get profile text
     */
    private function getProfileText()
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
        
        return $message;
    }

    /**
     * Get konsultasi text
     */
    private function getKonsultasiText()
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
        
        return $message;
    }

    /**
     * Get kontak text
     */
    private function getKontakText()
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
        
        return $message;
    }

    /**
     * Get tutorial pemesanan text
     */
    private function getTutorialText()
    {
        $loginUrl = route('login');
        $produkUrl = route('produk');
        
        $message = "📖 **TUTORIAL CARA PEMESANAN**\n\n";
        $message .= "Ikuti langkah-langkah berikut untuk memesan produk:\n\n";
        $message .= "**1️⃣ Pilih Produk**\n";
        $message .= "   • Kunjungi halaman <a href='{$produkUrl}' target='_blank'>Produk</a>\n";
        $message .= "   • Browse produk yang tersedia\n";
        $message .= "   • Klik produk yang Anda inginkan\n\n";
        $message .= "**2️⃣ Kustomisasi Desain**\n";
        $message .= "   • Pilih ukuran dan jumlah\n";
        $message .= "   • Upload desain Anda sendiri, atau\n";
        $message .= "   • Gunakan fitur edit desain kami\n\n";
        $message .= "**3️⃣ Tambah ke Keranjang**\n";
        $message .= "   • Klik tombol 'Tambah ke Keranjang'\n";
        $message .= "   • Lanjutkan belanja atau checkout\n\n";
        $message .= "**4️⃣ Checkout**\n";
        $message .= "   • Review produk di keranjang\n";
        $message .= "   • Isi alamat pengiriman\n";
        $message .= "   • Pilih metode pembayaran\n\n";
        $message .= "**5️⃣ Konfirmasi & Pembayaran**\n";
        $message .= "   • Konfirmasi pesanan Anda\n";
        $message .= "   • Lakukan pembayaran\n";
        $message .= "   • Pesanan akan diproses!\n\n";
        $message .= "⚠️ **PENTING:** <a href='{$loginUrl}' target='_blank'>Login terlebih dahulu</a> sebelum melakukan checkout untuk melanjutkan pesanan Anda.\n\n";
        $message .= "💡 **Tips:** Hubungi kami untuk konsultasi GRATIS sebelum memesan!";
        
        return $message;
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