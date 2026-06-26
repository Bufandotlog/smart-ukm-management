<main class="flex-1 p-8 min-h-[calc(100vh-64px-112px)] bg-surface-container-low">
    <div class="mb-8 flex items-center gap-4">
        <a href="index.php?page=ukm" class="w-10 h-10 rounded-full flex items-center justify-center bg-white border border-outline-variant hover:bg-surface transition-colors">
            <span class="material-symbols-outlined text-outline">arrow_back</span>
        </a>
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-on-surface">Daftarkan <?= h($ENTITY) ?> Baru</h2>
            <p class="text-on-surface-variant body-md">Buat entitas organisasi baru yang akan berdiri sendiri di portal IoT.</p>
        </div>
    </div>

    <div class="max-w-4xl bg-surface-container-lowest rounded-2xl shadow-[0_12px_40px_rgba(25,28,30,0.04)] p-8">
        <form action="index.php?action=ukm_store" method="POST" enctype="multipart/form-data" class="space-y-6">
    <?= csrf_field() ?>
            
            <!-- Branding -->
            <div class="flex flex-col md:flex-row gap-8 items-start mb-8 pb-8 border-b border-outline-variant/20">
                <div class="space-y-3">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant block">Logo Resmi <?= h($ENTITY) ?></label>
                    <div class="relative w-32 h-32 group">
                        <!-- Container Utama -->
                        <div id="logo-container" class="w-32 h-32 rounded-3xl border-2 border-dashed border-outline-variant bg-surface-container-lowest hover:bg-surface-container-low flex flex-col items-center justify-center cursor-pointer transition-all overflow-hidden relative" onclick="document.getElementById('logo-input').click()">
                            <input type="file" name="logo" id="logo-input" accept="image/*" class="hidden"/>
                            
                            <!-- Default Placeholder -->
                            <div id="logo-placeholder" class="flex flex-col items-center justify-center transition-all duration-300">
                                <span class="material-symbols-outlined text-3xl text-outline mb-1 group-hover:scale-110 transition-transform">add_photo_alternate</span>
                                <span class="text-[10px] font-bold text-slate-500">Upload Logo</span>
                            </div>
                            
                            <!-- Loading Indicator -->
                            <div id="logo-loader" class="hidden absolute inset-0 bg-surface-container-lowest/80 flex flex-col items-center justify-center transition-all duration-300">
                                <div class="w-8 h-8 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                                <span class="text-[9px] font-bold text-primary mt-2">Memproses...</span>
                            </div>
                            
                            <!-- Preview Image -->
                            <img id="logo-preview" class="hidden w-full h-full object-cover absolute inset-0 transition-all duration-300" src="" alt="Preview Logo" />
                            
                            <!-- Hover Overlay (untuk ganti gambar) -->
                            <div id="logo-hover-overlay" class="hidden absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-white opacity-0 hover:opacity-100 transition-opacity duration-200">
                                <span class="material-symbols-outlined text-2xl mb-1">cached</span>
                                <span class="text-[9px] font-bold">Ganti Logo</span>
                            </div>
                        </div>
                        
                        <!-- Button Hapus -->
                        <button type="button" id="logo-remove-btn" class="hidden absolute -top-2 -right-2 w-7 h-7 rounded-full bg-error text-white flex items-center justify-center shadow-md hover:bg-red-600 hover:scale-105 active:scale-95 transition-all z-20" title="Hapus Logo">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
                <div class="flex-1 space-y-6 w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant">Nama Lengkap <?= h($ENTITY) ?></label>
                            <input name="nama" class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm text-slate-800" placeholder="Contoh: Unit Kegiatan Mahasiswa Robotika" type="text" required/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant">Singkatan / Akronim</label>
                            <input name="singkatan" class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm text-slate-800" placeholder="Contoh: UKM Robotika" type="text" required/>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant">Kategori Organisasi</label>
                        <select name="kategori" class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 transition-all text-sm text-slate-800 cursor-pointer">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Seni & Olahraga">Seni & Olahraga</option>
                            <option value="Teknologi & Sains">Teknologi & Sains</option>
                            <option value="Keagamaan">Keagamaan</option>
                            <option value="Sosial Kreatif">Sosial Kreatif</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Detail Info -->
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant">Slogan / Visi Singkat</label>
                    <input name="slogan" class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 transition-all text-sm text-slate-800" placeholder="Maju Terus Pantang Mundur" type="text"/>
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant">Deskripsi Profil <?= h($ENTITY) ?></label>
                    <textarea name="deskripsi" class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 transition-all text-sm text-slate-800" rows="5" placeholder="Tuliskan latar belakang dan kegiatan utama UKM disini..." required></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-8 mt-8 border-t border-outline-variant/20">
                <a href="index.php?page=ukm" class="px-8 py-3 bg-surface-container-high text-on-surface font-bold rounded-xl hover:bg-surface-container-highest transition-colors">Batal</a>
                <button type="submit" class="px-8 py-3 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-container active:scale-95 transition-all">Daftarkan <?= h($ENTITY) ?></button>
            </div>
        </form>
    </div>
</main>

<style>
@keyframes custom-spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.animate-spin-custom {
    animation: custom-spin 0.8s linear infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoInput = document.getElementById('logo-input');
    const logoContainer = document.getElementById('logo-container');
    const logoPlaceholder = document.getElementById('logo-placeholder');
    const logoLoader = document.getElementById('logo-loader');
    const logoPreview = document.getElementById('logo-preview');
    const logoHoverOverlay = document.getElementById('logo-hover-overlay');
    const logoRemoveBtn = document.getElementById('logo-remove-btn');

    if (logoInput) {
        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Tampilkan loader, sembunyikan placeholder & preview lama
                logoPlaceholder.classList.add('hidden');
                logoPreview.classList.add('hidden');
                logoHoverOverlay.classList.add('hidden');
                logoLoader.classList.remove('hidden');
                logoContainer.classList.add('border-primary/50');
                logoContainer.classList.remove('border-outline-variant');
                logoContainer.classList.add('border-solid');
                logoContainer.classList.remove('border-dashed');

                // Tambahkan class custom spin jika class bawaan tidak berjalan
                const spinner = logoLoader.querySelector('.animate-spin');
                if (spinner) {
                    spinner.classList.add('animate-spin-custom');
                }

                // Simulasi loading 500ms agar visual buffer kerasa dan solid
                setTimeout(() => {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        logoPreview.src = event.target.result;
                        logoPreview.classList.remove('hidden');
                        logoLoader.classList.add('hidden');
                        logoHoverOverlay.classList.remove('hidden');
                        logoRemoveBtn.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }, 500);
            }
        });
    }

    if (logoRemoveBtn) {
        logoRemoveBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah memicu click pada container
            logoInput.value = ''; // Reset file input
            logoPreview.src = '';
            logoPreview.classList.add('hidden');
            logoHoverOverlay.classList.add('hidden');
            logoRemoveBtn.classList.add('hidden');
            logoPlaceholder.classList.remove('hidden');
            logoContainer.classList.remove('border-primary/50');
            logoContainer.classList.add('border-outline-variant');
            logoContainer.classList.remove('border-solid');
            logoContainer.classList.add('border-dashed');
        });
    }
});
</script>
