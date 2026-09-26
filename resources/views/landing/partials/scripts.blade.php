<script>
    // 1. Hero Carousel Controller
    let currentSlide = 0;
    const totalSlides = 3;
    let slideInterval = null;

    function showSlide(index) {
        currentSlide = (index + totalSlides) % totalSlides;
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.carousel-dot');

        slides.forEach((slide, i) => {
            if (i === currentSlide) {
                slide.classList.remove('opacity-0', 'pointer-events-none', 'z-0');
                slide.classList.add('opacity-100', 'z-10');
            } else {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'pointer-events-none', 'z-0');
            }
        });

        dots.forEach((dot, i) => {
            if (i === currentSlide) {
                dot.classList.remove('w-2', 'bg-white/40');
                dot.classList.add('w-7', 'bg-brand-500');
            } else {
                dot.classList.remove('w-7', 'bg-brand-500');
                dot.classList.add('w-2', 'bg-white/40');
            }
        });
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function setSlide(i) {
        showSlide(i);
        restartSlideTimer();
    }

    function startSlideTimer() {
        slideInterval = setInterval(nextSlide, 7000);
    }

    function restartSlideTimer() {
        if (slideInterval) clearInterval(slideInterval);
        startSlideTimer();
    }

    // 2. Animated Counter Ticker for Stats
    document.addEventListener('DOMContentLoaded', () => {
        startSlideTimer();
        const heroSection = document.getElementById('hero');
        if (heroSection) {
            heroSection.addEventListener('mouseenter', () => clearInterval(slideInterval));
            heroSection.addEventListener('mouseleave', () => startSlideTimer());
        }

        const counters = document.querySelectorAll('.counter-ticker');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            let count = 0;
            const inc = Math.max(1, Math.ceil(target / 40));

            const updateCount = () => {
                count += inc;
                if (count < target) {
                    counter.innerText = count;
                    setTimeout(updateCount, 25);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });

        initLiveFilters();
    });

    // 3. Tab Switcher for News vs Announcements
    function switchNewsTab(tab) {
        const btnBerita = document.getElementById('tab-btn-berita');
        const btnPengumuman = document.getElementById('tab-btn-pengumuman');
        const panelBerita = document.getElementById('panel-berita');
        const panelPengumuman = document.getElementById('panel-pengumuman');

        if (tab === 'berita') {
            btnBerita.classList.add('bg-white', 'text-slate-900', 'shadow-sm');
            btnBerita.classList.remove('text-slate-600');
            btnPengumuman.classList.remove('bg-white', 'text-slate-900', 'shadow-sm');
            btnPengumuman.classList.add('text-slate-600');

            panelBerita.classList.remove('hidden');
            panelPengumuman.classList.add('hidden');
        } else {
            btnPengumuman.classList.add('bg-white', 'text-slate-900', 'shadow-sm');
            btnPengumuman.classList.remove('text-slate-600');
            btnBerita.classList.remove('bg-white', 'text-slate-900', 'shadow-sm');
            btnBerita.classList.add('text-slate-600');

            panelPengumuman.classList.remove('hidden');
            panelBerita.classList.add('hidden');
        }
    }

    // 4. Facility Filter
    function filterFacilities(category, btn) {
        const tabs = document.querySelectorAll('.facility-tab');
        tabs.forEach(t => {
            t.classList.remove('bg-brand-600', 'text-white', 'shadow-sm');
            t.classList.add('bg-slate-100', 'text-slate-700');
        });
        btn.classList.remove('bg-slate-100', 'text-slate-700');
        btn.classList.add('bg-brand-600', 'text-white', 'shadow-sm');

        const items = document.querySelectorAll('.facility-item');
        items.forEach(item => {
            const cat = item.getAttribute('data-category');
            if (category === 'all' || cat === category) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // 5. Client-Side Live Multi-Filtering & Instant Search
    let selectedCategory = 'all';
    let currentModalSlug = '';

    function initLiveFilters() {
        const searchInput = document.getElementById('dir-search');
        const levelSelect = document.getElementById('filter-level');
        const yearSelect  = document.getElementById('filter-year');
        const catButtons  = document.querySelectorAll('.cat-pill');

        catButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                catButtons.forEach(b => {
                    b.classList.remove('bg-brand-600', 'text-white', 'shadow-sm');
                    b.classList.add('bg-slate-100', 'text-slate-700');
                });
                btn.classList.remove('bg-slate-100', 'text-slate-700');
                btn.classList.add('bg-brand-600', 'text-white', 'shadow-sm');
                selectedCategory = btn.getAttribute('data-cat');
                applyFilters();
            });
        });

        if (searchInput) searchInput.addEventListener('input', debounce(applyFilters, 150));
        if (levelSelect) levelSelect.addEventListener('change', applyFilters);
        if (yearSelect) yearSelect.addEventListener('change', applyFilters);
    }

    function applyFilters() {
        const query = document.getElementById('dir-search').value.toLowerCase().trim();
        const level = document.getElementById('filter-level').value;
        const year  = document.getElementById('filter-year').value;
        const cards = document.querySelectorAll('.achievement-card');
        const emptyState = document.getElementById('empty-state');
        const countSpan = document.getElementById('results-count');

        let visibleCount = 0;

        cards.forEach(card => {
            const cardTitle     = card.getAttribute('data-title');
            const cardOrganizer = card.getAttribute('data-organizer');
            const cardLevel     = card.getAttribute('data-level');
            const cardCategory  = card.getAttribute('data-category');
            const cardYear      = card.getAttribute('data-year');
            const cardStudents  = card.getAttribute('data-students');
            const cardMentor    = card.getAttribute('data-mentor');

            const matchCat = (selectedCategory === 'all' || selectedCategory === cardCategory);
            const matchLevel = (level === 'all' || level === cardLevel);
            const matchYear = (year === 'all' || year === cardYear);
            const matchQuery = !query || 
                cardTitle.includes(query) || 
                cardOrganizer.includes(query) || 
                cardStudents.includes(query) || 
                cardMentor.includes(query);

            if (matchCat && matchLevel && matchYear && matchQuery) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (countSpan) countSpan.innerText = visibleCount;
        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    }

    function resetFilters() {
        const searchInput = document.getElementById('dir-search');
        if (searchInput) searchInput.value = '';
        const levelSelect = document.getElementById('filter-level');
        if (levelSelect) levelSelect.value = 'all';
        const yearSelect = document.getElementById('filter-year');
        if (yearSelect) yearSelect.value = 'all';

        const allCatBtn = document.querySelector('.cat-pill[data-cat="all"]');
        if (allCatBtn) allCatBtn.click();
        applyFilters();
    }

    function scrollToDirectoryWithSearch() {
        const heroInput = document.getElementById('hero-search-input');
        const dirInput  = document.getElementById('dir-search');
        if (heroInput && dirInput) {
            dirInput.value = heroInput.value;
            applyFilters();
        }
        const dirSection = document.getElementById('direktori');
        if (dirSection) {
            dirSection.scrollIntoView({ behavior: 'smooth' });
        }
    }

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // 6. Native Dialog Modals with Light-Dismiss
    const modal = document.getElementById('prestasi-modal');
    if (modal) {
        modal.addEventListener('click', (event) => {
            const rect = modal.getBoundingClientRect();
            const isInDialog = (
                rect.top <= event.clientY &&
                event.clientY <= rect.top + rect.height &&
                rect.left <= event.clientX &&
                event.clientX <= rect.left + rect.width
            );
            if (!isInDialog) {
                modal.close();
            }
        });
    }

    function openDetailModal(item) {
        currentModalSlug = item.slug;
        document.getElementById('modal-title').innerText = item.title;
        document.getElementById('modal-rank').innerText = '★ ' + item.rank_grade;
        document.getElementById('modal-badge-level').innerText = item.competition_level;
        document.getElementById('modal-badge-cat').innerText = item.category?.name || 'Prestasi';
        document.getElementById('modal-date').innerText = new Date(item.event_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        document.getElementById('modal-organizer').innerText = item.organizer;
        document.getElementById('modal-mentor').innerText = item.mentor_name || 'Tim Pembina Sekolah';
        document.getElementById('modal-description').innerText = item.description || 'Tidak ada catatan deskripsi tambahan.';

        const coverMedia = item.cover_media?.file_url || (item.media && item.media[0]?.file_url) || 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=1200&q=80';
        document.getElementById('modal-cover-img').src = coverMedia;

        const partList = document.getElementById('modal-participants-list');
        partList.innerHTML = '';
        if (item.participants && item.participants.length > 0) {
            item.participants.forEach(p => {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 p-2 bg-slate-50 border border-slate-200/60 rounded-xl';
                div.innerHTML = `
                    <div class="w-7 h-7 rounded-full bg-brand-500/10 text-brand-600 font-bold flex items-center justify-center text-xs">
                        ${p.full_name.charAt(0)}
                    </div>
                    <div>
                        <strong class="text-xs text-slate-800 block">${p.full_name}</strong>
                        <span class="text-[11px] text-slate-400">NISN: ${p.nisn} | Kelas: ${p.class_grade}</span>
                    </div>
                `;
                partList.appendChild(div);
            });
        }

        const mediaList = document.getElementById('modal-media-list');
        mediaList.innerHTML = '';
        if (item.media && item.media.length > 0) {
            item.media.forEach(m => {
                const a = document.createElement('a');
                a.href = m.file_url;
                a.target = '_blank';
                a.className = 'relative group block w-24 h-24 rounded-xl overflow-hidden border border-slate-200 shadow-sm';
                a.innerHTML = `
                    <img src="${m.file_url}" alt="Berkas" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                    <span class="absolute bottom-1 left-1 right-1 text-center bg-black/60 backdrop-blur-sm text-[10px] text-white py-0.5 rounded uppercase font-semibold">
                        ${m.file_type}
                    </span>
                `;
                mediaList.appendChild(a);
            });
        }

        modal.showModal();
    }

    function closeDetailModal() {
        if (modal) modal.close();
    }

    function openNewsModal(news) {
        document.getElementById('news-modal-img').src = news.image;
        document.getElementById('news-modal-cat').innerText = news.category;
        document.getElementById('news-modal-date').innerText = news.date + ' | ' + news.author;
        document.getElementById('news-modal-title').innerText = news.title;
        document.getElementById('news-modal-body').innerText = news.excerpt + ' Kegiatan ini merupakan bagian dari agenda rutin pembinaan kesiswaan dan penguatan keunggulan komparatif sekolah. Informasi tindak lanjut dan partisipasi kegiatan dapat dikoordinasikan langsung melalui sekretariat kesiswaan.';
        document.getElementById('news-modal').showModal();
    }

    function openFacilityModal(fac) {
        document.getElementById('facility-modal-img').src = fac.image;
        document.getElementById('facility-modal-cat').innerText = fac.category_label;
        document.getElementById('facility-modal-name').innerText = fac.name;
        document.getElementById('facility-modal-desc').innerText = fac.description;
        document.getElementById('facility-modal').showModal();
    }

    // 7. Social Sharing Handlers
    function getShareUrl() {
        return window.location.origin + '/prestasi/' + currentModalSlug;
    }

    function shareWhatsApp() {
        const text = encodeURIComponent(`Lihat capaian prestasi membanggakan siswa SMA: ${document.getElementById('modal-title').innerText} - ` + getShareUrl());
        window.open(`https://api.whatsapp.com/send?text=${text}`, '_blank');
    }

    function shareTwitter() {
        const text = encodeURIComponent(`Prestasi Siswa SMA: ${document.getElementById('modal-title').innerText}`);
        window.open(`https://twitter.com/intent/tweet?text=${text}&url=${encodeURIComponent(getShareUrl())}`, '_blank');
    }

    function shareFacebook() {
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(getShareUrl())}`, '_blank');
    }

    function copyShareLink() {
        navigator.clipboard.writeText(getShareUrl()).then(() => {
            const btn = document.getElementById('copy-btn-text');
            const original = btn.innerText;
            btn.innerText = 'Tersalin!';
            setTimeout(() => { btn.innerText = original; }, 2000);
        });
    }
</script>
