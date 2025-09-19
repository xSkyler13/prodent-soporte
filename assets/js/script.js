// script.js — controla el formulario usando FormUtils (form-utils.js)
class BasicLoginForm {
    constructor() {
        this.form = document.getElementById('loginForm');
        this.emailInput = document.getElementById('email');
        this.passwordInput = document.getElementById('password');
        this.passwordToggle = document.getElementById('passwordToggle');
        this.rememberCheckbox = document.getElementById('remember');
        this.successMessage = document.getElementById('successMessage');

        this.init();
    }

    init() {
        if (!this.form) return;

        // Animaciones compartidas (inserta keyframes si hace falta)
        if (typeof FormUtils?.addSharedAnimations === 'function') {
            FormUtils.addSharedAnimations();
        }

        // Floating labels & password toggle (desde form-utils)
        if (typeof FormUtils?.setupFloatingLabels === 'function') {
            FormUtils.setupFloatingLabels(this.form);
        }
        if (typeof FormUtils?.setupPasswordToggle === 'function') {
            FormUtils.setupPasswordToggle(this.passwordInput, this.passwordToggle);
        }

        // Pre-cargar email guardado (remember me)
        const saved = localStorage.getItem('savedEmail');
        if (saved) {
            this.emailInput.value = saved;
            this.emailInput.classList.add('has-value');
            this.rememberCheckbox.checked = true;
        }

        // Event listeners
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
        this.emailInput.addEventListener('input', () => this.validateField('email'));
        this.passwordInput.addEventListener('input', () => this.validateField('password'));
        this.emailInput.addEventListener('blur', () => this.validateField('email'));
        this.passwordInput.addEventListener('blur', () => this.validateField('password'));

        // small entrance animation for the card
        FormUtils.addEntranceAnimation(this.form.closest('.login-card'), 100);
    }

    validateField(fieldName) {
        const input = document.getElementById(fieldName);
        if (!input) return false;

        let validation;
        if (fieldName === 'email') {
            validation = FormUtils.validateEmail(input.value.trim());
        } else if (fieldName === 'password') {
            validation = input.value.trim()
                ? { isValid: true }
                : { isValid: false, message: 'Password is required' };
        } else {
            return true;
        }

        if (!validation.isValid) {
            if (typeof FormUtils?.showError === 'function') {
                FormUtils.showError(fieldName, validation.message);
            }
            return false;
        }

        if (typeof FormUtils?.clearError === 'function') {
            FormUtils.clearError(fieldName);
        }

        if (typeof FormUtils?.showSuccess === 'function') {
            FormUtils.showSuccess(fieldName);
        }
        return true;
    }

    async handleSubmit(e) {
        e.preventDefault();

        const emailValid = this.validateField('email');
        const passwordValid = this.validateField('password');
        if (!emailValid || !passwordValid) return;

        const email = this.emailInput.value.trim();
        const password = this.passwordInput.value;

        const submitBtn = this.form.querySelector('.login-btn');
        submitBtn.classList.add('loading');

        try {
            const response = await fetch("http://localhost/PRODENT-SOPORTE/api/login_api.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ email, password }),
            });

            const data = await response.json();

            if (!data.success) {
                FormUtils.showNotification(data.message, 'error', this.form);
                return;
            }

            // ✅ Mostrar animación de éxito
            this.form.style.display = 'none';
            const successBox = document.getElementById('successMessage');
            successBox.style.display = 'block';
            successBox.classList.add('fade-in');

            setTimeout(() => {
                window.location.href = data.redirect || 'http://localhost/prodent-soporte/index.php';
            }, 2000);

        } catch (err) {
            console.error('Error en login:', err);
            FormUtils.showNotification('Error de conexión.', 'error', this.form);
        } finally {
            submitBtn.classList.remove('loading');
        }
    }

    showSuccess() {
        this.form.reset();
        this.form.querySelectorAll('input').forEach(i => i.classList.remove('has-value'));
        this.form.style.display = 'none';
        this.successMessage.classList.add('show');
        this.successMessage.focus?.();

        if (typeof FormUtils?.showNotification === 'function') {
            FormUtils.showNotification('Login successful. Redirecting...', 'success', this.successMessage);
        }

        setTimeout(() => {
            window.location.href = 'http://localhost/prodent-soporte/index.php';
        }, 2000);
    }
}

// Inicializa al cargar DOM
document.addEventListener('DOMContentLoaded', () => {
    new BasicLoginForm();
});
