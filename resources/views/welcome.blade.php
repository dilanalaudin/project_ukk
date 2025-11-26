<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplikasi BK Sekolah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3094/3094839.png">
</head>

<body class="bg-gradient-to-br from-indigo-900 via-purple-900 to-blue-900 text-white font-sans">

  <!-- Navbar -->
  <nav class="flex justify-between items-center px-8 py-4 bg-opacity-20 backdrop-blur-md bg-gray-900/30 fixed top-0 w-full z-50 shadow-lg">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/3094/3094839.png" alt="Logo BK" class="w-8 h-8">
      <span class="text-lg font-semibold">Aplikasi BK Sekolah</span>
    </div>
    <div class="hidden md:flex space-x-6 text-gray-300">
      <a href="#fitur" class="hover:text-white">Fitur</a>
      <a href="#tentang" class="hover:text-white">Tentang</a>
      <a href="#kontak" class="hover:text-white">Kontak</a>
    </div>
    <div class="space-x-3">
      @guest
        <a href="{{ route('login') }}" class="px-4 py-2 bg-purple-600 rounded-lg hover:bg-purple-700">Login</a>
        <a href="{{ route('register') }}" class="px-4 py-2 border border-purple-400 rounded-lg hover:bg-purple-600">Registrasi</a>
      @else
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-green-600 rounded-lg hover:bg-green-700">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="px-4 py-2 border border-purple-400 rounded-lg hover:bg-purple-600">Logout</button>
        </form>
      @endguest
    </div>
  </nav>

  <!-- 🦋 Hero Section -->
  <section class="flex flex-col md:flex-row justify-center items-center pt-32 pb-20 px-8 text-center md:text-left">
    <div class="max-w-lg">
      <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
        Sistem <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">Bimbingan Konseling</span> Digital
      </h1>
      <p class="text-gray-300 text-lg mb-8">
        Platform terpadu untuk membantu guru BK dan siswa melakukan konsultasi, pelaporan, dan manajemen data secara modern dan efisien.
      </p>
      <div class="flex flex-wrap gap-4 justify-center md:justify-start">
        @guest
          <a href="{{ route('login') }}" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold transition">Mulai Sekarang</a>
        @else
          <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold transition">Buka Dashboard</a>
        @endguest
        <a href="#fitur" class="px-6 py-3 border border-purple-400 hover:bg-purple-600 rounded-xl font-semibold transition">Lihat Fitur</a>
      </div>
    </div>
    <div class="mt-12 md:mt-0 md:ml-12">
      <img src="https://cdn-icons-png.flaticon.com/512/4257/4257483.png" alt="BK Illustration" class="w-80 md:w-96 drop-shadow-lg">
    </div>
  </section>

  <!-- 💡 Fitur Section -->
  <section id="fitur" class="py-20 bg-gray-900/30 backdrop-blur-sm">
    <h2 class="text-4xl font-bold text-center mb-12">Fitur Unggulan</h2>
    <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">
      <div class="bg-gray-800 rounded-2xl p-8 hover:bg-gray-700 transition">
        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828817.png" class="w-14 mb-4" alt="">
        <h3 class="text-2xl font-semibold mb-3">Konsultasi Online</h3>
        <p class="text-gray-300">Siswa dapat melakukan konsultasi langsung dengan guru BK secara daring dan terjadwal.</p>
      </div>
      <div class="bg-gray-800 rounded-2xl p-8 hover:bg-gray-700 transition">
        <img src="https://cdn-icons-png.flaticon.com/512/744/744922.png" class="w-14 mb-4" alt="">
        <h3 class="text-2xl font-semibold mb-3">Manajemen Data Siswa</h3>
        <p class="text-gray-300">Guru BK dapat mengelola data siswa, catatan perilaku, dan hasil konseling dengan mudah.</p>
      </div>
      <div class="bg-gray-800 rounded-2xl p-8 hover:bg-gray-700 transition">
        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" class="w-14 mb-4" alt="">
        <h3 class="text-2xl font-semibold mb-3">Laporan Otomatis</h3>
        <p class="text-gray-300">Laporan kegiatan dan hasil konseling dibuat otomatis untuk administrasi sekolah.</p>
      </div>
    </div>
  </section>

  <!-- 📊 Statistik -->
  <section class="py-20 text-center bg-gradient-to-t from-gray-900/40 via-purple-900/20 to-transparent">
    <h2 class="text-4xl font-bold mb-8">Statistik Penggunaan</h2>
    <div class="grid md:grid-cols-3 gap-10 max-w-4xl mx-auto">
      <div>
        <h3 class="text-5xl font-bold text-purple-400 mb-2">120+</h3>
        <p class="text-gray-300">Sekolah Terdaftar</p>
      </div>
      <div>
        <h3 class="text-5xl font-bold text-pink-400 mb-2">5.000+</h3>
        <p class="text-gray-300">Siswa Aktif</p>
      </div>
      <div>
        <h3 class="text-5xl font-bold text-indigo-400 mb-2">450+</h3>
        <p class="text-gray-300">Guru BK</p>
      </div>
    </div>
  </section>

  <!-- 💬 Testimoni -->
  <section class="py-20 bg-gray-900/30 backdrop-blur-sm" id="tentang">
    <h2 class="text-4xl font-bold text-center mb-12">Testimoni Pengguna</h2>
    <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">
      <div class="bg-gray-800 rounded-2xl p-6">
        <p class="italic text-gray-300 mb-4">“Aplikasi ini sangat membantu dalam manajemen siswa dan laporan konseling.”</p>
        <h4 class="font-semibold text-purple-300">— Ibu Prapti, Guru BK</h4>
      </div>
      <div class="bg-gray-800 rounded-2xl p-6">
        <p class="italic text-gray-300 mb-4">“Sekarang konseling bisa dilakukan secara online tanpa harus datang ke ruang BK.”</p>
        <h4 class="font-semibold text-purple-300">— Galang, Siswa SMK</h4>
      </div>
      <div class="bg-gray-800 rounded-2xl p-6">
        <p class="italic text-gray-300 mb-4">“Dashboard-nya mudah digunakan dan tampilannya keren banget.”</p>
        <h4 class="font-semibold text-purple-300">— Pak Joko, Wakasek</h4>
      </div>
    </div>
  </section>

  <!-- 📞 Kontak -->
  <section id="kontak" class="py-20 text-center">
    <h2 class="text-4xl font-bold mb-8">Hubungi Kami</h2>
    <p class="text-gray-300 mb-8">Ada pertanyaan? Hubungi tim kami untuk dukungan teknis.</p>
    <a href="mailto:info@aplikasibk.id" class="px-8 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold transition">Email Kami</a>
  </section>

  <!-- ⚡ Footer -->
  <footer class="py-6 text-center border-t border-gray-700 text-gray-400 text-sm">
    © 2025 Aplikasi BK Sekolah
  </footer>

</body>
</html>