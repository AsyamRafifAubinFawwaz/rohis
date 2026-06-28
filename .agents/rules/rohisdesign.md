---
trigger: always_on
---

# DESIGN SYSTEM — Rohis SMKN 8 Jember
> Stack: Laravel + Blade + Tailwind CSS
> Prinsip: **Clean, elegan, tidak terlihat seperti template AI.**
> Semua halaman menggunakan `layouts/app.blade.php` sebagai layout master.

---

## 1. Palet Warna — Emerald Scale

Semua warna WAJIB lewat token Tailwind Emerald.
**Jangan hardcode hex langsung di class Blade.**

| Token Tailwind | Hex | Penggunaan |
|---|---|---|
| `emerald-900` | `#064E3B` | Footer bg, overlay gelap |
| `emerald-800` | `#065F46` | Navbar bg, heading section |
| `emerald-700` | `#047857` | Tombol hover, aksen kuat |
| `emerald-600` | `#059669` | Primary — tombol utama, badge, link aktif |
| `emerald-500` | `#10B981` | Icon, underline aksen |
| `emerald-100` | `#D1FAE5` | Card bg subtle, tag bg |
| `emerald-50`  | `#ECFDF5` | Section bg alternatif |
| `neutral-900` | `#111827` | Teks utama |
| `neutral-600` | `#4B5563` | Teks body, deskripsi |
| `neutral-400` | `#9CA3AF` | Teks muted, placeholder |
| `neutral-200` | `#E5E7EB` | Border, divider |
| `white`       | `#FFFFFF` | Background utama halaman |

### Aturan warna

- Background halaman: **putih** — bukan hijau
- Hijau hanya untuk aksen: tombol, badge, border aktif, heading accent
- Teks utama selalu `text-neutral-900` atau `text-neutral-700`
- Hindari full-section background hijau kecuali hero dan footer

---

## 2. Tipografi

Font: **Inter** (sudah di Tailwind) atau system-ui sebagai fallback.

```
H1 Hero    : text-4xl md:text-5xl lg:text-6xl font-bold text-white
H2 Section : text-2xl md:text-3xl font-bold text-neutral-900
H3 Card    : text-lg font-semibold text-neutral-900
Body       : text-base text-neutral-600 leading-relaxed
Small      : text-sm text-neutral-500
Label/Tag  : text-xs font-semibold uppercase tracking-wide
```

**Aturan tipografi:**
- Section title selalu didahului label kecil di atas (contoh: `TENTANG KAMI`, `MEDIA EDUKASI`)
- Label kecil: `text-xs font-semibold text-emerald-600 uppercase tracking-widest`
- Section heading accent: kata kunci diberi warna `text-emerald-600`

---

## 3. Komponen Blade — Spesifikasi

### 3.1 Tombol

```html
{{-- Primary --}}
<a href="#" class="inline-flex items-center gap-2 bg-emerald-600 text-white
                    font-semibold px-5 py-2.5 rounded-lg
                    hover:bg-emerald-700 transition-colors duration-200">
  Label
</a>

{{-- Secondary / Outline --}}
<a href="#" class="inline-flex items-center gap-2 border border-emerald-600
                    text-emerald-600 font-semibold px-5 py-2.5 rounded-lg
                    hover:bg-emerald-50 transition-colors duration-200">
  Label
</a>

{{-- Ghost / Text link --}}
<a href="#" class="inline-flex items-center gap-1.5 text-emerald-600
                    font-medium text-sm hover:underline transition-colors">
  Selengkapnya →
</a>
```

### 3.2 Badge / Tag Kategori

```html
{{-- Badge hijau (aktif/kategori) --}}
<span class="inline-flex items-center px-3 py-1 rounded-full
             bg-emerald-600 text-white text-xs font-semibold">
  Kajian
</span>

{{-- Badge outline (non-aktif) --}}
<span class="inline-flex items-center px-3 py-1 rounded-full
             border border-emerald-200 text-emerald-700 text-xs font-semibold
             bg-emerald-50">
  Kajian
</span>
```

### 3.3 Card Artikel

```html
<article class="bg-white rounded-2xl overflow-hidden border border-neutral-200
                hover:shadow-lg hover:-translate-y-1
                transition-all duration-300 group">

  {{-- Gambar --}}
  <div class="aspect-video bg-neutral-100 overflow-hidden">
    @if($artikel->thumbnail)
      <img src="{{ $artikel->thumbnail }}" alt="{{ $artikel->judul }}"
           class="w-full h-full object-cover
                  group-hover:scale-105 transition-transform duration-500">
    @else
      <div class="w-full h-full flex items-center justify-center">
        <svg class="w-10 h-10 text-neutral-300" .../>
      </div>
    @endif
  </div>

  {{-- Konten --}}
  <div class="p-5">
    {{-- Badge kategori --}}
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full
                 bg-emerald-600 text-white text-xs font-semibold mb-3">
      {{ $artikel->kategori }}
    </span>

    <h3 class="text-base font-semibold text-neutral-900 mb-1.5
               group-hover:text-emerald-700 transition-colors line-clamp-2">
      {{ $artikel->judul }}
    </h3>

    <p class="text-sm text-neutral-500 mb-4 line-clamp-2">
      {{ $artikel->excerpt }}
    </p>

    <div class="flex items-center gap-4 text-xs text-neutral-400">
      <span class="flex items-center gap-1">
        <svg class="w-3.5 h-3.5" .../>
        {{ $artikel->created_at->format('d M Y') }}
      </span>
      <span class="flex items-center gap-1">
        <svg class="w-3.5 h-3.5" .../>
        Dilihat {{ $artikel->views }}x
      </span>
    </div>
  </div>
</article>
```

### 3.4 Section Wrapper

```html
{{-- Section standar --}}
<section class="py-16 md:py-24">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    ...
  </div>
</section>

{{-- Section dengan bg tint --}}
<section class="py-16 md:py-24 bg-emerald-50">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    ...
  </div>
</section>

{{-- Section label + heading standar --}}
<div class="mb-12">
  <p class="text-xs font-semibold text-emerald-600 uppercase tracking-widest mb-2">
    Label Kecil
  </p>
  <h2 class="text-2xl md:text-3xl font-bold text-neutral-900">
    Heading <span class="text-emerald-600">Aksen</span>
  </h2>
</div>
```

---

## 4. Navbar — Spesifikasi

Kondisi saat ini: navbar sudah pakai bg hijau tua. **Pertahankan**, hanya perbaiki detail.

```html
<nav class="bg-emerald-800 sticky top-0 z-50 shadow-sm">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      {{-- Logo --}}
      <a href="/" class="flex items-center gap-2.5">
        <img src="{{ asset('logo.png') }}" alt="Rohis" class="h-9 w-auto">
        <span class="font-bold text-white text-lg tracking-tight">ROHIS</span>
      </a>

      {{-- Desktop nav --}}
      <ul class="hidden md:flex items-center gap-1">
        @foreach($navLinks as $link)
          <li>
            <a href="{{ $link['url'] }}"
               class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                      {{ request()->is($link['active'])
                         ? 'bg-emerald-600 text-white'
                         : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' }}">
              {{ $link['label'] }}
            </a>
          </li>
        @endforeach
      </ul>

      {{-- Mobile hamburger --}}
      <button id="nav-toggle"
              class="md:hidden p-2 rounded-lg text-emerald-100 hover:bg-emerald-700">
        <svg .../>
      </button>
    </div>
  </div>

  {{-- Mobile menu --}}
  <div id="nav-menu" class="hidden md:hidden border-t border-emerald-700">
    <div class="px-4 py-3 flex flex-col gap-1">
      @foreach($navLinks as $link)
        <a href="{{ $link['url'] }}"
           class="px-3 py-2 rounded-lg text-sm font-medium text-emerald-100
                  hover:bg-emerald-700 hover:text-white transition-colors">
          {{ $link['label'] }}
        </a>
      @endforeach
    </div>
  </div>
</nav>
```

---

## 5. Hero Section — Perbaikan (BUKAN rombak total)

Yang diperbaiki: proporsi teks, padding, kontras tombol, posisi gambar.

```html
<section class="relative bg-emerald-800 overflow-hidden">
  {{-- Background pattern tipis (opsional, buat tidak flat) --}}
  <div class="absolute inset-0 opacity-5"
       style="background-image: url('/img/pattern.svg')"></div>

  <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8
              min-h-[520px] md:min-h-[580px]
              flex items-center
              py-16 md:py-0">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center w-full">

      {{-- Teks --}}
      <div>
        <p class="text-emerald-300 text-sm font-semibold uppercase tracking-widest mb-3">
          Rohis SMKN 8 Jember
        </p>
        <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
          Bersama Membangun<br>
          <span class="text-emerald-300">Generasi Islami</span>
        </h1>
        <p class="text-emerald-100 text-base md:text-lg leading-relaxed mb-8 max-w-md">
          Rohis adalah wadah bagi siswa untuk memperdalam nilai agama Islam,
          membangun akhlak karimah, dan memperekat ukhuwah islamiyah.
        </p>
        <div class="flex flex-wrap gap-3">
          <a href="/pengumuman"
             class="bg-white text-emerald-800 font-semibold px-6 py-3 rounded-lg
                    hover:bg-emerald-50 transition-colors duration-200">
            Pengumuman
          </a>
          <a href="/aktivitas"
             class="border border-white/60 text-white font-semibold px-6 py-3 rounded-lg
                    hover:bg-white/10 transition-colors duration-200">
            Aktivitas
          </a>
        </div>
      </div>

      {{-- Gambar --}}
      <div class="hidden md:flex justify-end items-end">
        <img src="{{ asset('img/hero-students.png') }}"
             alt="Siswa Rohis"
             class="h-[480px] w-auto object-contain drop-shadow-xl">
      </div>
    </div>
  </div>
</section>
```

---

## 6. Halaman Artikel

### 6.1 Header Halaman

```html
<section class="bg-neutral-900 py-16 md:py-20">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <p class="text-emerald-400 text-sm font-semibold uppercase tracking-widest mb-3">
      Media Edukasi
    </p>
    <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Artikel Kami</h1>
    <p class="text-neutral-400 text-base">
      Temukan berita-berita terbaru mengenai organisasi kami
    </p>
  </div>
</section>
```

### 6.2 Filter Kategori + Sort

```html
<div class="max-w-6xl mx-auto px-4 py-8">
  <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">

    {{-- Filter Kategori --}}
    <div class="flex flex-wrap gap-2">
      {{-- Tab "Semua" --}}
      <a href="{{ route('artikel.index') }}"
         class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                {{ !request('kategori')
                   ? 'bg-emerald-600 text-white'
                   : 'bg-white border border-neutral-200 text-neutral-600 hover:border-emerald-400' }}">
        Semua Artikel
      </a>

      {{-- Tab per kategori --}}
      @foreach($kategori as $kat)
        <a href="{{ route('artikel.index', ['kategori' => $kat->slug]) }}"
           class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                  {{ request('kategori') === $kat->slug
                     ? 'bg-emerald-600 text-white'
                     : 'bg-white border border-neutral-200 text-neutral-600 hover:border-emerald-400' }}">
          {{ $kat->nama }}
        </a>
      @endforeach
    </div>

    {{-- Sort --}}
    <div class="flex items-center gap-2">
      <span class="text-sm text-neutral-500">Urutkan:</span>
      <select name="sort"
              onchange="window.location.href=this.value"
              class="text-sm border border-neutral-200 rounded-lg px-3 py-2
                     text-neutral-700 bg-white focus:ring-2 focus:ring-emerald-500
                     focus:border-transparent outline-none cursor-pointer">
        <option value="{{ route('artikel.index', array_merge(request()->all(), ['sort'=>'terbaru'])) }}"
                {{ request('sort','terbaru')==='terbaru' ? 'selected' : '' }}>
          Terbaru
        </option>
        <option value="{{ route('artikel.index', array_merge(request()->all(), ['sort'=>'terpopuler'])) }}"
                {{ request('sort')==='terpopuler' ? 'selected' : '' }}>
          Terpopuler
        </option>
      </select>
    </div>
  </div>
</div>
```

### 6.3 Grid Artikel

```html
<div class="max-w-6xl mx-auto px-4 pb-16">
  @if($artikels->isEmpty())
    {{-- Emp