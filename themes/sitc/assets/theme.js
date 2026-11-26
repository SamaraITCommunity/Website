(() => {
    const button = document.querySelector('.theme-toggle');
    const media = window.matchMedia('(prefers-color-scheme: dark)');
    const isDark = () => document.documentElement.dataset.theme === 'dark'
        || (!document.documentElement.dataset.theme && media.matches);
    const update = () => {
        const dark = isDark();
        button.textContent = dark ? 'Светлая тема' : 'Тёмная тема';
        button.setAttribute('aria-pressed', String(dark));
    };
    button.addEventListener('click', () => {
        const theme = isDark() ? 'light' : 'dark';
        document.documentElement.dataset.theme = theme;
        try { localStorage.setItem('sitc-theme', theme); } catch (error) {}
        update();
    });
    media.addEventListener('change', update);
    update();
})();
