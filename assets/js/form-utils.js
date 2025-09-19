// Shared Form Utilities - Optimized Version
class FormUtils {
    static validateEmail(value) {
        if (!value?.trim()) {
            return { isValid: false, message: 'Email address is required' };
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(value)
            ? { isValid: true }
            : { isValid: false, message: 'Please enter a valid email address' };
    }
    
    // static validatePassword(value) {
    //     if (!value) return { isValid: false, message: 'Password is required' };
    //     if (value.length < 8)
    //         return { isValid: false, message: 'Password must be at least 8 characters long' };
    //     if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(value))
    //         return { isValid: false, message: 'Password must contain uppercase, lowercase, and number' };
    //     return { isValid: true };
    // }
    static validatePassword(value) {
        if (!value) {
            return { isValid: false, message: 'Password is required' };
        }
        return { isValid: true };
    }
    static showError(fieldName, message) {
        const field = document.getElementById(fieldName);
        if (!field) return;
        
        const formGroup = field.closest('.form-group');
        const errorElement = document.getElementById(fieldName + 'Error');
        
        if (formGroup && errorElement) {
            formGroup.classList.add('error');
            errorElement.textContent = message;
            errorElement.classList.add('show');

            field.style.animation = 'shake 0.5s ease-in-out';
            field.addEventListener('animationend', () => field.style.animation = '', { once: true });
        }
    }
    
    static clearError(fieldName) {
        const field = document.getElementById(fieldName);
        if (!field) return;
        
        const formGroup = field.closest('.form-group');
        const errorElement = document.getElementById(fieldName + 'Error');
        
        if (formGroup && errorElement) {
            formGroup.classList.remove('error');
            errorElement.classList.remove('show');
            setTimeout(() => errorElement.textContent = '', 300);
        }
    }
    
    static showSuccess(fieldName) {
        const field = document.getElementById(fieldName);
        const wrapper = field?.closest('.input-wrapper');
        if (wrapper) {
            wrapper.style.borderColor = '#22c55e';
            setTimeout(() => wrapper.style.borderColor = '', 2000);
        }
    }
    
    static simulateLogin(email, password) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                (email === 'admin@demo.com' && password === 'wrongpassword')
                    ? reject(new Error('Invalid email or password'))
                    : resolve({ success: true, user: { email } });
            }, 2000);
        });
    }
    
    static showNotification(message, type, container) {
        type = typeof type !== 'undefined' ? type : 'info';
        container = typeof container !== 'undefined' ? container : document.body;
        // Evita duplicados (si ya existe, la actualiza)
        let notification = container.querySelector('.form-notification');
        if (!notification) {
            notification = document.createElement('div');
            notification.className = 'form-notification';
            container.prepend(notification);
        }

        notification.textContent = message;
        notification.className = `form-notification ${type}`;

        // Opcional: que desaparezca solo después de unos segundos
        setTimeout(() => {
            notification.remove();
        }, 4000);
    }
    
    static setupFloatingLabels(form) {
        form.querySelectorAll('input').forEach(input => {
            if (input.value.trim()) input.classList.add('has-value');
            input.addEventListener('input', () =>
                input.classList.toggle('has-value', input.value.trim() !== '')
            );
        });
    }
    
    static setupPasswordToggle(passwordInput, toggleButton) {
        if (!passwordInput || !toggleButton) return;

        const eyeIcon = toggleButton.querySelector('.eye-icon');

        function togglePassword() {
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
            if (eyeIcon) {
                eyeIcon.classList.toggle('show-password', passwordInput.type === 'text');
            }
            toggleButton.classList.add('pressed');
            setTimeout(() => toggleButton.classList.remove('pressed'), 150);
        }
        toggleButton.addEventListener('click', togglePassword);
    }

    static addEntranceAnimation(element, delay = 100) {
        if (!element) return;
        element.style.opacity = 0;
        setTimeout(() => {
            element.style.transition = "all 0.3s ease";
            element.style.opacity = 1;
            element.style.transform = "translateY(0)";
        }, delay);
    }
    
    static addSharedAnimations() {
        if (document.getElementById('shared-animations')) return;
        const style = document.createElement('style');
        style.id = 'shared-animations';
        style.textContent = `
            @keyframes slideIn { from{opacity:0;transform:translateY(-10px);} to{opacity:1;transform:translateY(0);} }
            @keyframes slideOut { from{opacity:1;transform:translateY(0);} to{opacity:0;transform:translateY(-10px);} }
            @keyframes shake { 0%,100%{transform:translateX(0);} 25%{transform:translateX(-5px);} 75%{transform:translateX(5px);} }
            @keyframes checkmarkPop { 0%{transform:scale(0);} 50%{transform:scale(1.3);} 100%{transform:scale(1);} }
            @keyframes successPulse { 0%{transform:scale(0);} 50%{transform:scale(1.1);} 100%{transform:scale(1);} }
            @keyframes spin { 0%{transform:translate(-50%, -50%) rotate(0deg);} 100%{transform:translate(-50%, -50%) rotate(360deg);} }
        `;
        document.head.appendChild(style);
    }
}
