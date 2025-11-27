// Auto-hide alert messages after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-success, .alert-error');
    
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });

    // Add close button to alerts
    alerts.forEach(alert => {
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '&times;';
        closeBtn.style.cssText = `
            float: right;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: inherit;
            font-weight: bold;
            margin-left: 1rem;
            line-height: 1;
        `;
        
        closeBtn.onclick = function() {
            alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 300);
        };
        
        alert.insertBefore(closeBtn, alert.firstChild);
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add animation to list items on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    entry.target.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 100);
                
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('ul li').forEach(li => {
        observer.observe(li);
    });

    // Mobile menu toggle (if needed in future)
    const createMobileMenuToggle = () => {
        if (window.innerWidth <= 768) {
            const nav = document.querySelector('nav');
            if (nav && !nav.querySelector('.menu-toggle')) {
                const toggle = document.createElement('button');
                toggle.className = 'menu-toggle';
                toggle.innerHTML = '☰';
                toggle.style.cssText = `
                    display: block;
                    margin: 0 auto 1rem;
                    background: rgba(255, 255, 255, 0.2);
                    border: none;
                    color: white;
                    font-size: 1.5rem;
                    padding: 0.5rem 1rem;
                    cursor: pointer;
                    border-radius: 5px;
                `;
                
                const links = nav.querySelectorAll('a');
                const linksContainer = document.createElement('div');
                linksContainer.className = 'nav-links';
                linksContainer.style.display = 'none';
                
                links.forEach(link => {
                    linksContainer.appendChild(link);
                });
                
                toggle.onclick = () => {
                    if (linksContainer.style.display === 'none') {
                        linksContainer.style.display = 'block';
                        toggle.innerHTML = '✕';
                    } else {
                        linksContainer.style.display = 'none';
                        toggle.innerHTML = '☰';
                    }
                };
                
                nav.insertBefore(toggle, nav.firstChild);
                nav.appendChild(linksContainer);
            }
        }
    };

    createMobileMenuToggle();
    window.addEventListener('resize', createMobileMenuToggle);

    // Form validation feedback
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#10b981';
                }
            });

            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.style.borderColor = '#e5e7eb';
                }
            });
        });
    });

    // Confirm delete actions
    const deleteButtons = document.querySelectorAll('button.danger, .btn-danger, a[href*="delete"]');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                e.preventDefault();
            }
        });
    });

    // Table search filter (if there's a search input)
    const searchInputs = document.querySelectorAll('input[type="search"]');
    searchInputs.forEach(searchInput => {
        const table = searchInput.closest('form')?.nextElementSibling?.querySelector('table') || 
                     document.querySelector('table');
        
        if (table) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });

    // Add loading state to forms on submit
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('input[type="submit"], button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                submitBtn.style.cursor = 'not-allowed';
                
                const originalText = submitBtn.value || submitBtn.textContent;
                if (submitBtn.tagName === 'INPUT') {
                    submitBtn.value = 'Memproses...';
                } else {
                    submitBtn.innerHTML = '<span class="loading"></span> Memproses...';
                }
            }
        });
    });

    // Table row click highlight
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('click', function(e) {
            // Don't highlight if clicking on a button or link
            if (e.target.tagName !== 'BUTTON' && e.target.tagName !== 'A') {
                tableRows.forEach(r => r.style.backgroundColor = '');
                this.style.backgroundColor = 'rgba(37, 99, 235, 0.1)';
            }
        });
    });

    // Auto-resize textarea
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });

    // File input - show selected file name
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            
            // Check if there's already a file name display
            let fileNameDisplay = this.parentElement.querySelector('.file-name');
            
            if (!fileNameDisplay) {
                fileNameDisplay = document.createElement('span');
                fileNameDisplay.className = 'file-name';
                this.parentElement.appendChild(fileNameDisplay);
            }
            
            if (fileName) {
                fileNameDisplay.textContent = `File dipilih: ${fileName}`;
                fileNameDisplay.style.color = '#10b981';
            } else {
                fileNameDisplay.textContent = '';
            }
        });
    });

    // Enhanced file input with custom wrapper (if using .file-input-wrapper)
    const fileWrappers = document.querySelectorAll('.file-input-wrapper');
    fileWrappers.forEach(wrapper => {
        const input = wrapper.querySelector('input[type="file"]');
        const label = wrapper.querySelector('.file-input-label');
        
        if (input && label) {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name;
                if (fileName) {
                    label.textContent = fileName;
                    label.style.borderStyle = 'solid';
                    label.style.background = 'rgba(16, 185, 129, 0.1)';
                    label.style.borderColor = '#10b981';
                    label.style.color = '#10b981';
                }
            });
        }
    });

    // Checkbox accessibility - toggle on label click
    const checkboxWrappers = document.querySelectorAll('.form-check, .checkbox-wrapper');
    checkboxWrappers.forEach(wrapper => {
        const checkbox = wrapper.querySelector('input[type="checkbox"]');
        const label = wrapper.querySelector('label');
        
        if (label && checkbox && !label.hasAttribute('for')) {
            wrapper.addEventListener('click', function(e) {
                if (e.target !== checkbox) {
                    checkbox.checked = !checkbox.checked;
                    checkbox.dispatchEvent(new Event('change'));
                }
            });
        }
    });

    // Radio button accessibility
    const radioWrappers = document.querySelectorAll('.radio-wrapper');
    radioWrappers.forEach(wrapper => {
        const radio = wrapper.querySelector('input[type="radio"]');
        const label = wrapper.querySelector('label');
        
        if (label && radio && !label.hasAttribute('for')) {
            wrapper.addEventListener('click', function(e) {
                if (e.target !== radio) {
                    radio.checked = true;
                    radio.dispatchEvent(new Event('change'));
                }
            });
        }
    });
});