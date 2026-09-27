<script>
    // 1. Animated Counter Ticker for Stats
    document.addEventListener('DOMContentLoaded', () => {

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
        initDirectoryCarousel();
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

    // 5. Client-Side Live Multi-Filtering & Instant Search with 2-Row 4-Col Carousel
    let selectedCategory = 'all';
    let currentModalSlug = '';
    let dirCurrentSlide = 0;
    let dirTotalSlides = 1;
    const DIR_ITEMS_PER_SLIDE = 8;
    let dirAllCards = [];

    function initDirectoryCarousel() {
        dirAllCards = Array.from(document.querySelectorAll('.achievement-card'));
        const track = document.getElementById('dir-carousel-track');
        if (track) {
            const slides = track.querySelectorAll('.dir-slide');
            dirTotalSlides = Math.max(1, slides.length);
        }
        dirUpdateSlide();

        // Touch swipe support for mobile
        const viewport = document.getElementById('dir-carousel-viewport');
        if (viewport) {
            let startX = 0;
            let startY = 0;
            viewport.addEventListener('touchstart', (e) => {
                if (e.touches.length === 1) {
                    startX = e.touches[0].clientX;
                    startY = e.touches[0].clientY;
                }
            }, { passive: true });

            viewport.addEventListener('touchend', (e) => {
                if (e.changedTouches.length === 1) {
                    const diffX = e.changedTouches[0].clientX - startX;
                    const diffY = e.changedTouches[0].clientY - startY;
                    if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
                        if (diffX < 0) {
                            dirNextSlide();
                        } else {
                            dirPrevSlide();
                        }
                    }
                }
            }, { passive: true });
        }

        window.addEventListener('resize', debounce(() => {
            dirUpdateSlide();
        }, 150));
        window.addEventListener('load', () => {
            dirUpdateSlide();
        });
    }

    function dirGoToSlide(index) {
        if (dirTotalSlides <= 0) return;
        dirCurrentSlide = Math.max(0, Math.min(index, dirTotalSlides - 1));
        dirUpdateSlide();
    }

    function dirNextSlide() {
        if (dirTotalSlides <= 1) return;
        dirCurrentSlide = (dirCurrentSlide + 1) % dirTotalSlides;
        dirUpdateSlide();
    }

    function dirPrevSlide() {
        if (dirTotalSlides <= 1) return;
        dirCurrentSlide = (dirCurrentSlide - 1 + dirTotalSlides) % dirTotalSlides;
        dirUpdateSlide();
    }

    function dirUpdateSlide() {
        const track = document.getElementById('dir-carousel-track');
        const viewport = document.getElementById('dir-carousel-viewport');
        const slides = track ? track.querySelectorAll('.dir-slide') : [];

        if (track) {
            track.style.transform = `translateX(-${dirCurrentSlide * 100}%)`;
        }

        // Adjust viewport height dynamically to current slide
        if (viewport && slides[dirCurrentSlide]) {
            const currentSlideEl = slides[dirCurrentSlide];
            requestAnimationFrame(() => {
                viewport.style.height = `${currentSlideEl.scrollHeight}px`;
            });
        }

        const pageSpan = document.getElementById('dir-current-page');
        const totalSpan = document.getElementById('dir-total-pages');
        if (pageSpan) pageSpan.innerText = dirCurrentSlide + 1;
        if (totalSpan) totalSpan.innerText = dirTotalSlides;

        // Update dots
        const dotsContainer = document.getElementById('dir-carousel-dots');
        if (dotsContainer) {
            const existingDots = dotsContainer.querySelectorAll('.dir-dot');
            if (existingDots.length !== dirTotalSlides) {
                dotsContainer.innerHTML = '';
                for (let i = 0; i < dirTotalSlides; i++) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.setAttribute('aria-label', `Ke slide ${i + 1}`);
                    dot.className = `dir-dot h-2 rounded-full transition-all duration-300 ${i === dirCurrentSlide ? 'w-6 bg-brand-600' : 'w-2 bg-slate-300 hover:bg-slate-400'}`;
                    dot.onclick = () => dirGoToSlide(i);
                    dotsContainer.appendChild(dot);
                }
            } else {
                existingDots.forEach((dot, idx) => {
                    if (idx === dirCurrentSlide) {
                        dot.className = 'dir-dot h-2 rounded-full transition-all duration-300 w-6 bg-brand-600';
                    } else {
                        dot.className = 'dir-dot h-2 rounded-full transition-all duration-300 w-2 bg-slate-300 hover:bg-slate-400';
                    }
                });
            }
        }

        // Disable/enable arrows
        const hasMultiple = dirTotalSlides > 1;
        ['dir-footer-prev', 'dir-footer-next'].forEach(id => {
            const btn = document.getElementById(id);
            if (btn) btn.disabled = !hasMultiple;
        });
    }

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
        const query = document.getElementById('dir-search')?.value.toLowerCase().trim() || '';
        const level = document.getElementById('filter-level')?.value || 'all';
        const year  = document.getElementById('filter-year')?.value || 'all';
        const emptyState = document.getElementById('empty-state');
        const countSpan = document.getElementById('results-count');
        const track = document.getElementById('dir-carousel-track');
        const viewport = document.getElementById('dir-carousel-viewport');
        const pagination = document.getElementById('dir-pagination-container');

        if (!dirAllCards.length) {
            dirAllCards = Array.from(document.querySelectorAll('.achievement-card'));
        }

        const matchingCards = dirAllCards.filter(card => {
            const cardTitle     = card.getAttribute('data-title') || '';
            const cardOrganizer = card.getAttribute('data-organizer') || '';
            const cardLevel     = card.getAttribute('data-level') || '';
            const cardCategory  = card.getAttribute('data-category') || '';
            const cardYear      = card.getAttribute('data-year') || '';
            const cardStudents  = card.getAttribute('data-students') || '';
            const cardMentor    = card.getAttribute('data-mentor') || '';

            const matchCat = (selectedCategory === 'all' || selectedCategory === cardCategory);
            const matchLevel = (level === 'all' || level === cardLevel);
            const matchYear = (year === 'all' || year === cardYear);
            const matchQuery = !query || 
                cardTitle.includes(query) || 
                cardOrganizer.includes(query) || 
                cardStudents.includes(query) || 
                cardMentor.includes(query);

            return matchCat && matchLevel && matchYear && matchQuery;
        });

        if (countSpan) countSpan.innerText = matchingCards.length;

        if (matchingCards.length === 0) {
            if (emptyState) emptyState.classList.remove('hidden');
            if (viewport) viewport.classList.add('hidden');
            if (pagination) pagination.classList.add('hidden');
            dirTotalSlides = 0;
            dirCurrentSlide = 0;
            return;
        }

        if (emptyState) emptyState.classList.add('hidden');
        if (viewport) viewport.classList.remove('hidden');
        if (pagination) pagination.classList.remove('hidden');

        // Re-chunk matching cards into slides of 8 (2 rows x 4 columns)
        dirTotalSlides = Math.ceil(matchingCards.length / DIR_ITEMS_PER_SLIDE);
        if (track) {
            track.innerHTML = '';
            for (let s = 0; s < dirTotalSlides; s++) {
                const slideDiv = document.createElement('div');
                slideDiv.className = 'dir-slide w-full flex-shrink-0 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 p-1 content-start';
                slideDiv.setAttribute('data-slide', s);

                const chunk = matchingCards.slice(s * DIR_ITEMS_PER_SLIDE, (s + 1) * DIR_ITEMS_PER_SLIDE);
                chunk.forEach(card => {
                    card.style.display = '';
                    slideDiv.appendChild(card);
                });

                track.appendChild(slideDiv);
            }
        }

        dirCurrentSlide = 0;
        dirUpdateSlide();
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

    const navSearchModal = document.getElementById('nav-search-modal');
    if (navSearchModal) {
        navSearchModal.addEventListener('click', (event) => {
            const rect = navSearchModal.getBoundingClientRect();
            const isInDialog = (
                rect.top <= event.clientY &&
                event.clientY <= rect.top + rect.height &&
                rect.left <= event.clientX &&
                event.clientX <= rect.left + rect.width
            );
            if (!isInDialog) {
                navSearchModal.close();
            }
        });
    }

    function openNavSearchModal() {
        const modal = document.getElementById('nav-search-modal');
        if (modal) {
            modal.showModal();
            const input = document.getElementById('nav-modal-search-input');
            if (input) {
                input.value = '';
                handleNavModalSearch('');
                setTimeout(() => input.focus(), 60);
            }
        }
    }

    function closeNavSearchModal() {
        const modal = document.getElementById('nav-search-modal');
        if (modal) modal.close();
    }

    function handleNavModalSearch(query) {
        const resultsEl = document.getElementById('nav-modal-results');
        if (!resultsEl) return;
        const q = (query || '').toLowerCase().trim();

        if (!dirAllCards.length) {
            dirAllCards = Array.from(document.querySelectorAll('.achievement-card'));
        }

        if (q.length < 2) {
            resultsEl.innerHTML = `
                <div class="text-center py-8 text-slate-400">
                    <svg class="w-8 h-8 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <p class="text-xs">Ketik minimal 2 karakter untuk mencari data prestasi siswa...</p>
                </div>
            `;
            return;
        }

        const matches = dirAllCards.filter(card => {
            const title = card.getAttribute('data-title') || '';
            const org = card.getAttribute('data-organizer') || '';
            const std = card.getAttribute('data-students') || '';
            const mtr = card.getAttribute('data-mentor') || '';
            return title.includes(q) || org.includes(q) || std.includes(q) || mtr.includes(q);
        });

        if (matches.length === 0) {
            const safeQuery = q.replace(/</g, '&lt;').replace(/>/g, '&gt;');
            resultsEl.innerHTML = `
                <div class="text-center py-8 text-slate-400">
                    <p class="text-xs">Tidak ditemukan prestasi yang cocok dengan "<strong>${safeQuery}</strong>".</p>
                </div>
            `;
            return;
        }

        let html = '';
        matches.slice(0, 10).forEach(card => {
            const title = card.querySelector('h3')?.innerText.trim() || 'Prestasi Siswa';
            const img = card.querySelector('img')?.src || '';
            const level = card.getAttribute('data-level') || '';
            const year = card.getAttribute('data-year') || '';
            const btn = card.querySelector('button[onclick*="openDetailModal"]');
            const onclickAttr = btn ? btn.getAttribute('onclick') : '';

            html += `
                <div class="p-3 rounded-2xl border border-slate-100 hover:border-brand-200 hover:bg-brand-50/30 transition-all flex items-center justify-between gap-3 group">
                    <div class="flex items-center gap-3 min-w-0">
                        <img src="${img}" alt="" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shrink-0">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold text-white bg-brand-600">${level}</span>
                                <span class="text-[11px] text-slate-400">${year}</span>
                            </div>
                            <h4 class="text-xs font-bold text-slate-900 truncate group-hover:text-brand-600">${title}</h4>
                        </div>
                    </div>
                    <button type="button" onclick="closeNavSearchModal(); ${onclickAttr}" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-brand-600 hover:text-white text-slate-700 text-xs font-semibold shrink-0 transition-all">
                        Lihat Detail
                    </button>
                </div>
            `;
        });

        resultsEl.innerHTML = html;
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
