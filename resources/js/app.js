import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.store('theme', {
    isDark: localStorage.getItem('kos-theme') === 'dark' ||
        (!localStorage.getItem('kos-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),

    toggle() {
        this.isDark = !this.isDark;
        localStorage.setItem('kos-theme', this.isDark ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.isDark);
    },

    init() {
        // Apply tema saat pertama load
        document.documentElement.classList.toggle('dark', this.isDark);
    }
});

Alpine.start();