@extends('layouts.app')

@section('title', 'SIAD - Sistem Absensi Digital')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <span class="hero-badge">Solusi Absensi Modern</span>
                <h1>Sistem Absensi Digital <span class="highlight">Karyawan</span></h1>
                <p class="hero-description">Kelola kehadiran karyawan dengan mudah, rekap lembur secara otomatis, dan hasilkan laporan bulanan dalam format PDF & Excel. Semua data tersaji lengkap dalam dashboard HR yang informatif.</p>

                <div class="features-list">
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> 100% Absensi Online</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Akurat</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Otomatis</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Aman</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Data Akurat</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Perhitungan Otomatis</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Data Aman & Terbackup</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Tercatat Real-time</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Tanpa Human Error</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Hemat Waktu HR</span>
                    <span class="feature-badge"><i class="fas fa-check-circle"></i> Berbasis Cloud</span>
                </div>

                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login Sekarang
                    </a>
                    <a href="#features" class="btn btn-secondary">
                        <i class="fas fa-play-circle"></i> Pelajari Fitur
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">10K+</span>
                        <span class="stat-label">Pengguna Aktif</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Perusahaan</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-number">99.9%</span>
                        <span class="stat-label">Akurasi Data</span>
                    </div>
                </div>
            </div>
            <div class="hero-image" data-aos="fade-left">
                <div class="image-wrapper">
                    <img src="{{ asset('images/perusahaan.jpg') }}" alt="Perusahaan SIAD">
                    <div class="floating-card card-1">
                        <i class="fas fa-users"></i>
                        <span>200+ Karyawan</span>
                    </div>
                    <div class="floating-card card-2">
                        <i class="fas fa-clock"></i>
                        <span>Real-time</span>
                    </div>
                    <div class="floating-card card-3">
                        <i class="fas fa-chart-line"></i>
                        <span>+45% Efisiensi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">Fitur Unggulan</span>
            <h2 class="section-title">Solusi Lengkap <span class="highlight">Manajemen Absensi</span></h2>
            <p class="section-subtitle">Dilengkapi fitur canggih untuk memudahkan pengelolaan kehadiran karyawan</p>
        </div>
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon">
                        <i class="fas fa-fingerprint"></i>
                    </div>
                </div>
                <h3>Absensi Masuk & Pulang</h3>
                <p>Catat waktu masuk dan pulang karyawan secara real-time dan akurat dari berbagai perangkat.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
                <h3>Dashboard HR</h3>
                <p>Pantau ringkasan kehadiran, keterlambatan, izin, dan alpa dalam dashboard yang informatif dan mudah dipahami.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                </div>
                <h3>Rekap Lembur</h3>
                <p>Hitung lembur otomatis sesuai kebijakan perusahaan dan rekap dengan mudah.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon">
                        <i class="fas fa-file-export"></i>
                    </div>
                </div>
                <h3>Export PDF</h3>
                <p>Hasilkan laporan bulanan dalam format PDF untuk kebutuhan dokumentasi dan analisis.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Section / Tentang -->
<section id="about" class="why-choose-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">Keunggulan</span>
            <h2 class="section-title">Mengapa Memilih <span class="highlight">SIAD?</span></h2>
        </div>
        <div class="why-grid">
            <div class="why-card" data-aos="flip-up" data-aos-delay="100">
                <div class="why-icon-wrapper">
                    <div class="why-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                </div>
                <h3>Mudah Digunakan</h3>
                <p>Antarmuka sederhana dan intuitif sehingga mudah digunakan oleh semua karyawan dan tim HR.</p>
            </div>
            <div class="why-card" data-aos="flip-up" data-aos-delay="200">
                <div class="why-icon-wrapper">
                    <div class="why-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                </div>
                <h3>Laporan Otomatis</h3>
                <p>Laporan absensi dan lembur dihasilkan otomatis, akurat, dan siap digunakan kapan saja.</p>
            </div>
            <div class="why-card" data-aos="flip-up" data-aos-delay="300">
                <div class="why-icon-wrapper">
                    <div class="why-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                </div>
                <h3>Data Aman</h3>
                <p>Keamanan data terjamin dengan sistem yang andal, backup berkala, dan akses berbasis peran.</p>
            </div>
        </div>
    </div>
</section>

<!-- Cara Penggunaan -->
<section class="how-it-works">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">Alur Kerja</span>
            <h2 class="section-title">Cara <span class="highlight">Penggunaan</span></h2>
        </div>
        <div class="steps">
            <div class="step" data-aos="fade-up" data-aos-delay="100">
                <div class="step-number">
                    <span>01</span>
                </div>
                <div class="step-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Check In</h3>
                <p>Karyawan melakukan check in saat mulai bekerja dengan satu klik</p>
            </div>
            <div class="step-arrow" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-arrow-right"></i>
            </div>
            <div class="step" data-aos="fade-up" data-aos-delay="300">
                <div class="step-number">
                    <span>02</span>
                </div>
                <div class="step-icon">
                    <i class="fas fa-check-double"></i>
                </div>
                <h3>Check Out</h3>
                <p>Karyawan melakukan check out setelah selesai bekerja secara otomatis</p>
            </div>
            <div class="step-arrow" data-aos="fade-up" data-aos-delay="400">
                <i class="fas fa-arrow-right"></i>
            </div>
            <div class="step" data-aos="fade-up" data-aos-delay="500">
                <div class="step-number">
                    <span>03</span>
                </div>
                <div class="step-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>Laporan</h3>
                <p>HR mendapatkan laporan absensi dan rekap lembur otomatis setiap bulan</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content" data-aos="zoom-in">
            <div class="cta-text">
                <span class="cta-badge">Mulai Sekarang</span>
                <h2>Siap Meningkatkan <span class="highlight">Produktivitas</span> Perusahaan Anda?</h2>
                <p>Bergabunglah dengan ribuan perusahaan yang telah mempercayakan manajemen absensinya kepada SIAD</p>
                <div class="cta-buttons">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-large">
                        <i class="fas fa-rocket"></i> Mulai Sekarang
                    </a>
                </div>
            </div>
            <div class="cta-image">
                <img src="{{ asset('images/perusahaan.jpg') }}" alt="CTA">
            </div>
        </div>
    </div>
</section>

<!-- Footer / Kontak -->
<footer id="contact" class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">
                    <h2>SIAD</h2>
                    <span>Sistem Absensi Digital</span>
                </div>
                <p>Solusi modern untuk manajemen absensi dan rekap lembur karyawan yang lebih mudah, akurat, dan efisien.</p>
                <div class="social-links">
                    <a href="https://www.facebook.com/teknologiinformasipnp/?locale=id_ID"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://x.com/humas_pnp"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/politekniknegeripadang_pnp/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/@pnpbroadcast"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-menu">
                <h3>Menu</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-features">
                <h3>Fitur</h3>
                <ul>
                    <li><a href="#">Absensi Masuk & Pulang</a></li>
                    <li><a href="#">Dashboard HR</a></li>
                    <li><a href="#">Rekap Lembur</a></li>
                    <li><a href="#">Laporan Bulanan</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Kontak</h3>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Kampus Politeknik Negeri Padang Limau Manis Kecamatan Pauh Kota Padang 25164
                        Provinsi Sumatera Barat</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <p>0751-72590</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <p>info@pnp.ac.id</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 SIAD - Sistem Absensi Digital, All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
@endsection