export default class Search {
  constructor() {
    this.searchToggle = document.querySelector('.js-search-toggle');
    this.searchOverlay = null;
    this.searchInput = null;
    this.closeButton = null;
    this.resultsDiv = null;
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue = '';
    this.typingTimer = null;
    this.currentPage = 1;
    this.totalPages = 1;
    this.currentResults = {};
    this.hasSearched = false; // Track if user has performed a search
    
    if (this.searchToggle) {
      this.init();
    }
  }

  init() {
    this.createOverlay();
    
    // Event listeners
    this.searchToggle.addEventListener('click', () => {
      this.openOverlay();
      if (!this.hasSearched) {
        this.getDefaultContent();
      }
    });
    
    this.closeButton.addEventListener('click', this.closeOverlay.bind(this));
    
    // Close when clicking outside or pressing Escape
    this.searchOverlay.addEventListener('click', (e) => {
      if (e.target === this.searchOverlay) {
        this.closeOverlay();
      }
    });
    
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isOverlayOpen) {
        this.closeOverlay();
      }
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'q' && !this.isOverlayOpen) {
        e.preventDefault();
        this.openOverlay();
        if (!this.hasSearched) {
          this.getDefaultContent();
        }
      }
    });
    
    // Typing logic
    this.searchInput.addEventListener('input', this.typingLogic.bind(this));
  }

  // Add new method to get default content
  getDefaultContent() {
    this.resultsDiv.innerHTML = '<div class="flex justify-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#2e7a56]"></div></div>';
    this.isSpinnerVisible = true;
    
    fetch(`${wpvars.home}/wp-json/custom/v1/search/default`)
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
      })
      .then(data => {
        this.currentResults = data.results;
        this.displayResults();
        this.paginationDiv.classList.add('hidden');
      })
      .catch(error => {
        console.error('Error loading default content:', error);
        this.resultsDiv.innerHTML = `
          <div class="text-center py-8">
            <h3 class="text-lg font-medium text-gray-900">Browse Latest Content</h3>
            <p class="mt-2 text-gray-500">Start typing to search the site</p>
          </div>
        `;
      })
      .finally(() => {
        this.isSpinnerVisible = false;
      });
  }

  // Modify typingLogic to track searches
  typingLogic() {
    if (this.searchInput.value !== this.previousValue) {
      clearTimeout(this.typingTimer);
      
      if (this.searchInput.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="flex justify-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#2e7a56]"></div></div>';
          this.isSpinnerVisible = true;
        }
        this.currentPage = 1;
        this.typingTimer = setTimeout(() => {
          this.hasSearched = true;
          this.getResults();
        }, 300);
      } else {
        // When clearing search, show default content again if not already searching
        if (this.hasSearched) {
          this.resultsDiv.innerHTML = '';
          this.paginationDiv.classList.add('hidden');
          this.isSpinnerVisible = false;
          this.hasSearched = false;
          this.getDefaultContent();
        }
      }
      
      this.previousValue = this.searchInput.value;
    }
  }


  createOverlay() {
    const homeUrl = (typeof wpvars !== 'undefined' && wpvars.home) ? wpvars.home : '/';
    
    const overlayHTML = `
      <div class="search-overlay fixed inset-0 z-[9999] bg-white bg-opacity-95 invisible opacity-0 scale-[1.09] transition-all duration-300 overflow-y-auto overflow-x-hidden pointer-events-none">
        <div class="container mx-auto px-4 py-8 relative pointer-events-auto">
          <!-- Search Header -->
          <div class="flex justify-between items-center mb-8 bg-gray-100 p-4 rounded-lg">
            <div class="flex items-center w-full">
              <svg class="search-overlay__icon w-8 h-8 mr-4 text-[#2e7a56]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <input type="text" id="search-term" class="search-term flex-grow bg-transparent border-none focus:outline-none text-gray-800 text-xl placeholder-gray-400" placeholder="What are you looking for?" autocomplete="off">
            </div>
            <button class="search-overlay__close text-3xl text-[#2e7a56] hover:text-[#1e5a3e] transition-colors">
              &times;
            </button>
          </div>
          
          <!-- Results Container -->
          <div id="search-overlay__results" class="advanced-search__result"></div>
          
          <!-- Pagination -->
          <div id="search-pagination" class="mt-8 flex justify-center items-center hidden">
            <button id="prev-page" class="px-4 py-2 bg-[#2e7a56] text-white rounded-l-md hover:bg-[#1e5a3e] disabled:opacity-50 disabled:cursor-not-allowed" disabled>
              Previous
            </button>
            <span class="px-4 py-2 bg-gray-100">
              Page <span id="current-page">1</span> of <span id="total-pages">1</span>
            </span>
            <button id="next-page" class="px-4 py-2 bg-[#2e7a56] text-white rounded-r-md hover:bg-[#1e5a3e] disabled:opacity-50 disabled:cursor-not-allowed" disabled>
              Next
            </button>
          </div>
        </div>
      </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', overlayHTML);
    
    // Cache elements
    this.searchOverlay = document.querySelector('.search-overlay');
    this.searchInput = document.getElementById('search-term');
    this.closeButton = document.querySelector('.search-overlay__close');
    this.resultsDiv = document.getElementById('search-overlay__results');
    this.paginationDiv = document.getElementById('search-pagination');
    this.prevButton = document.getElementById('prev-page');
    this.nextButton = document.getElementById('next-page');
    this.currentPageEl = document.getElementById('current-page');
    this.totalPagesEl = document.getElementById('total-pages');
    
    // Pagination event listeners
    this.prevButton.addEventListener('click', () => {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.getResults();
      }
    });
    
    this.nextButton.addEventListener('click', () => {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.getResults();
      }
    });
  }

  typingLogic() {
    if (this.searchInput.value !== this.previousValue) {
      clearTimeout(this.typingTimer);
      
      if (this.searchInput.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="flex justify-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#2e7a56]"></div></div>';
          this.isSpinnerVisible = true;
        }
        this.currentPage = 1; // Reset to first page on new search
        this.typingTimer = setTimeout(this.getResults.bind(this), 300); // 300ms debounce
      } else {
        this.resultsDiv.innerHTML = '';
        this.paginationDiv.classList.add('hidden');
        this.isSpinnerVisible = false;
      }
      
      this.previousValue = this.searchInput.value;
    }
  }

  getResults() {
    const searchTerm = this.searchInput.value.trim();
    
    if (!searchTerm) {
      this.resultsDiv.innerHTML = '';
      this.paginationDiv.classList.add('hidden');
      return;
    }
    
    fetch(`${wpvars.home}/wp-json/custom/v1/search?term=${encodeURIComponent(searchTerm)}&page=${this.currentPage}`)
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
      })
      .then(data => {
        this.currentResults = data.results;
        this.totalPages = Math.max(
          Math.ceil(data.total.general / 10),
          Math.ceil(data.total.news / 10),
          Math.ceil(data.total.documents / 10)
        );
        
        this.displayResults();
        this.updatePagination();
      })
      .catch(error => {
        console.error('Search error:', error);
        this.resultsDiv.innerHTML = `
          <div class="text-center py-8 text-red-600">
            Error loading search results. Please try again.
          </div>
        `;
      })
      .finally(() => {
        this.isSpinnerVisible = false;
      });
  }

displayResults() {
    let html = `
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Site Search -->
        <div class="advanced-search__column">
          <section id="siteSearch" class="advanced-search__section">
            <h2 class="advanced-search__heading text-2xl font-semibold text-[#2e7a56] mb-4 pb-2 border-b border-gray-200">Site Search</h2>
            <ul class="advanced-search__list space-y-3">
    `;

    // General Results (Left Column)
    if (this.currentResults.general?.length) {
      this.currentResults.general.forEach(item => {
        html += `
          <li class="advanced-search__list-item">
            <a href="${item.link}" class="advanced-search__list-link group block p-3 hover:bg-gray-50 rounded-lg transition-colors">
              <h3 class="advanced-search__list-title text-lg font-medium text-gray-900 group-hover:text-[#2e7a56]">${item.title}</h3>
              <div class="advanced-search__list-subtitle text-gray-600 text-sm mt-1 line-clamp-2">${item.excerpt}</div>
              <div class="advanced-search__list-meta text-xs text-gray-500 mt-1">${item.post_type}</div>
            </a>
          </li>
        `;
      });
    } else {
      html += `
        <li class="text-gray-500 py-4">
          No general results found
        </li>
      `;
    }

    html += `
            </ul>
          </section>
        </div>
        
        <!-- Middle Column - News -->
        <div class="advanced-search__column">
          <section id="newsroom" class="advanced-search__section">
            <h2 class="advanced-search__heading text-2xl font-semibold text-[#2e7a56] mb-4 pb-2 border-b border-gray-200">Newsroom</h2>
            <div class="space-y-4">
    `;

    // News Results (Middle Column)
    if (this.currentResults.news?.length) {
      this.currentResults.news.forEach(item => {
        html += `
          <article class="advanced-search__news-item">
            <a href="${item.link}" class="group block">
              ${item.image ? `
                <figure class="advanced-search__news-figure overflow-hidden rounded-lg mb-2">
                  <img src="${item.image}" 
                       class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300"
                       alt="${item.title}">
                </figure>
              ` : ''}
              <h3 class="advanced-search__news-title text-lg font-medium text-gray-900 group-hover:text-[#2e7a56] mb-1">${item.title}</h3>
              <div class="advanced-search__news-excerpt text-gray-600 text-sm line-clamp-2">${item.excerpt}</div>
            </a>
          </article>
        `;
      });
    } else {
      html += `
        <div class="text-gray-500 py-4">
          No news results found
        </div>
      `;
    }

    html += `
            </div>
          </section>
        </div>
        
        <!-- Right Column - Documents -->
        <div class="advanced-search__column">
          <section id="documents" class="advanced-search__section">
            <h2 class="advanced-search__heading text-2xl font-semibold text-[#2e7a56] mb-4 pb-2 border-b border-gray-200">Documents</h2>
            <ul class="advanced-search__list space-y-3">
    `;

    // Documents Results (Right Column)
if (this.currentResults.documents?.length) {
  // Group documents by type (assuming type is available in the results)
  const groupedDocuments = {};
  this.currentResults.documents.forEach(doc => {
    if (!groupedDocuments[doc.type]) {
      groupedDocuments[doc.type] = [];
    }
    groupedDocuments[doc.type].push(doc);
  });

  // Render each document group
  for (const [type, docs] of Object.entries(groupedDocuments)) {
    html += `
      <div class="document-group">
        <h3 class="text-lg font-medium text-gray-800 mb-3">${type}</h3>
        <ul class="space-y-3">
    `;
    
    docs.forEach(item => {
      html += `
        <li class="document-item bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
          <a href="${item.link}" 
             target="_blank"
             rel="noopener noreferrer"
             class="block p-4 group">
            <div class="flex justify-between items-start">
              <div class="flex-1">
                <h4 class="text-lg font-medium text-gray-900 group-hover:text-[#2e7a56] mb-1">${item.title}</h4>
                <div class="flex items-center gap-3 text-sm">
                  <span class="text-gray-500">${item.date}</span>
                  <span class="text-gray-400">•</span>
                  <span class="text-gray-500">${item.file_size || 'PDF'}</span>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2e7a56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
            </div>
          </a>
        </li>
      `;
    });
    
    html += `
        </ul>
      </div>
    `;
  }

  html += `
      </div>
    </section>
  `;
}

    html += `
            </ul>
          </section>
        </div>
      </div>
    `;

    // No results message (fallback)
    if (!this.currentResults.general?.length && 
        !this.currentResults.news?.length && 
        !this.currentResults.documents?.length) {
      html = `
        <div class="text-center py-12 col-span-3">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <h3 class="mt-2 text-lg font-medium text-gray-900">No results found</h3>
          <p class="mt-1 text-gray-500">Try different search terms</p>
        </div>
      `;
    }
    
    this.resultsDiv.innerHTML = html;
}

  updatePagination() {
    this.currentPageEl.textContent = this.currentPage;
    this.totalPagesEl.textContent = this.totalPages;
    
    this.prevButton.disabled = this.currentPage <= 1;
    this.nextButton.disabled = this.currentPage >= this.totalPages;
    
    if (this.totalPages > 1) {
      this.paginationDiv.classList.remove('hidden');
    } else {
      this.paginationDiv.classList.add('hidden');
    }
  }

  openOverlay() {
    this.searchOverlay.classList.remove('invisible', 'pointer-events-none');
    this.searchOverlay.classList.add('visible', 'pointer-events-auto');
    this.searchOverlay.style.opacity = '1';
    this.searchOverlay.style.transform = 'scale(1)';
    document.body.classList.add('overflow-hidden');
    setTimeout(() => this.searchInput.focus(), 350);
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.style.opacity = '0';
    this.searchOverlay.style.transform = 'scale(1.09)';
    setTimeout(() => {
      this.searchOverlay.classList.remove('visible', 'pointer-events-auto');
      this.searchOverlay.classList.add('invisible', 'pointer-events-none');
      document.body.classList.remove('overflow-hidden');
    }, 300);
    this.isOverlayOpen = false;
  }
}