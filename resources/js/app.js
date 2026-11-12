import './bootstrap';

/**
 * Interacciones globales de TaskFlow.
 *
 * Todo se inicializa con guardas de existencia porque el layout de invitado
 * (login/registro) no incluye la barra lateral ni el menú de usuario.
 */

const AUTO_SUBMIT_STORAGE_KEY = 'tf:auto-submit-context';

function initSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const btnOpen = document.getElementById('sidebar-open');
    const btnClose = document.getElementById('sidebar-close');

    if (!sidebar || !overlay || !btnOpen || !btnClose) return;

    // El panel fijo aparece a partir de lg (1024 px), igual que en Tailwind.
    const isMobile = () => window.innerWidth < 1024;

    // Fuera de pantalla, el panel no debe recibir foco con Tab.
    function syncSidebarInert() {
        if (isMobile() && overlay.classList.contains('hidden')) {
            sidebar.setAttribute('inert', '');
        } else {
            sidebar.removeAttribute('inert');
        }
    }

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebar.removeAttribute('inert');
        overlay.classList.remove('hidden');
        btnOpen.setAttribute('aria-expanded', 'true');
        btnClose.focus();
    }

    function closeSidebar({ restoreFocus = true } = {}) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        btnOpen.setAttribute('aria-expanded', 'false');
        syncSidebarInert();
        if (restoreFocus && isMobile()) btnOpen.focus();
    }

    syncSidebarInert();

    btnOpen.addEventListener('click', openSidebar);
    btnClose.addEventListener('click', () => closeSidebar());
    overlay.addEventListener('click', () => closeSidebar());

    // Escape cierra el menú y devuelve el foco al disparador (WCAG 2.1.2).
    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape' || !isMobile()) return;
        if (!overlay.classList.contains('hidden')) {
            closeSidebar();
        }
    });

    window.addEventListener('resize', () => {
        if (!isMobile()) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden');
            btnOpen.setAttribute('aria-expanded', 'false');
        } else if (!overlay.classList.contains('hidden')) {
            sidebar.classList.add('-translate-x-full');
        }

        syncSidebarInert();
    });
}

function initUserDropdown() {
    const button = document.getElementById('user-dropdown-btn');
    const menu = document.getElementById('user-dropdown-menu');

    if (!button || !menu) return;

    function close() {
        menu.classList.add('hidden');
        button.setAttribute('aria-expanded', 'false');
    }

    button.addEventListener('click', () => {
        const willOpen = menu.classList.contains('hidden');
        menu.classList.toggle('hidden');
        button.setAttribute('aria-expanded', String(willOpen));

        if (willOpen) {
            menu.querySelector('button, a')?.focus();
        }
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('#user-dropdown-btn') && !event.target.closest('#user-dropdown-menu')) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape' || menu.classList.contains('hidden')) return;
        close();
        button.focus();
    });
}

function initFlashDismiss() {
    document.querySelectorAll('[data-dismiss-flash]').forEach((button) => {
        button.addEventListener('click', () => {
            const flash = button.closest('[role="status"], [role="alert"]');
            if (!flash) return;

            flash.remove();

            // El botón desaparece con el mensaje: devolver el foco al contenido.
            document.getElementById('contenido')?.focus({ preventScroll: true });
        });
    });
}

function initAutoSubmit() {
    document.querySelectorAll('[data-auto-submit]').forEach((control) => {
        control.addEventListener('change', () => {
            const form = control.closest('form');
            if (!form) return;

            // Guardar contexto para restaurar scroll y foco tras la recarga.
            try {
                sessionStorage.setItem(AUTO_SUBMIT_STORAGE_KEY, JSON.stringify({
                    id: control.id,
                    scrollY: window.scrollY,
                }));
            } catch (error) {
                // sessionStorage puede estar bloqueado; el envío sigue funcionando.
            }

            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.submit();
            }
        });
    });

    restoreAutoSubmitContext();
}

function restoreAutoSubmitContext() {
    let raw = null;

    try {
        raw = sessionStorage.getItem(AUTO_SUBMIT_STORAGE_KEY);
        sessionStorage.removeItem(AUTO_SUBMIT_STORAGE_KEY);
    } catch (error) {
        return;
    }

    if (!raw) return;

    let context;

    try {
        context = JSON.parse(raw);
    } catch (error) {
        return;
    }

    if (!context || typeof context !== 'object') return;

    // Si el envío terminó en errores, el resumen de errores debe llevar el foco
    // y permanecer visible; no restauramos la posición anterior.
    if (document.querySelector('[data-error-summary]')) return;

    const target = context.id ? document.getElementById(context.id) : null;

    if (target) {
        target.focus({ preventScroll: true });
    }

    if (typeof context.scrollY === 'number') {
        // Doble frame: espera a que fuentes y layout estén asentados.
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                window.scrollTo(0, context.scrollY);
            });
        });
    }
}

function initConfirmations() {
    document.addEventListener('submit', (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement)) return;

        const submitter = event.submitter;
        const trigger = submitter?.hasAttribute('data-confirm')
            ? submitter
            : form.querySelector('[data-confirm]');

        if (!trigger) return;

        const message = trigger.dataset.confirm;
        if (message && !window.confirm(message)) {
            event.preventDefault();
        }
    });
}

function initPendingForms() {
    document.querySelectorAll('form[data-pending-form]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            // Si otra interacción canceló el envío (p. ej. un confirm), no bloquear.
            if (event.defaultPrevented) return;

            const submitter = event.submitter ?? form.querySelector('[type="submit"]');
            if (!submitter || submitter.disabled) return;

            form.setAttribute('aria-busy', 'true');

            form.querySelectorAll('[type="submit"]').forEach((button) => {
                button.disabled = true;
            });

            if (!submitter.querySelector('.tf-spinner')) {
                const spinner = document.createElement('span');
                spinner.className = 'tf-spinner';
                spinner.setAttribute('aria-hidden', 'true');
                submitter.prepend(spinner);
            }
        });
    });

    // Al volver con el botón "atrás" desde la caché (bfcache), restaurar el formulario.
    window.addEventListener('pageshow', () => {
        document.querySelectorAll('form[data-pending-form]').forEach((form) => {
            form.removeAttribute('aria-busy');
            form.querySelectorAll('[type="submit"]').forEach((button) => {
                button.disabled = false;
            });
            form.querySelectorAll('.tf-spinner').forEach((spinner) => spinner.remove());
        });
    });
}

function initErrorSummaryFocus() {
    const summary = document.querySelector('[data-error-summary]');
    if (!summary) return;

    // El resumen es el primer elemento tras un envío fallido: llevarlo al foco
    // permite a lectores de pantalla anunciar los errores de inmediato.
    summary.focus({ preventScroll: false });
}

function initPasswordToggles() {
    document.querySelectorAll('[data-toggle-password]').forEach((button) => {
        const input = document.getElementById(button.dataset.target);
        const icon = button.querySelector('[data-toggle-icon]');

        if (!input) return;

        button.addEventListener('click', () => {
            const isVisible = input.type === 'text';

            input.type = isVisible ? 'password' : 'text';
            button.setAttribute('aria-pressed', String(!isVisible));
            button.setAttribute('aria-label', isVisible ? 'Mostrar contraseña' : 'Ocultar contraseña');

            if (icon) {
                icon.textContent = isVisible ? 'visibility' : 'visibility_off';
            }
        });
    });
}

function init() {
    initSidebar();
    initUserDropdown();
    initFlashDismiss();
    initAutoSubmit();
    initConfirmations();
    initPendingForms();
    initErrorSummaryFocus();
    initPasswordToggles();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
