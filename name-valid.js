document.getElementById('nameForm').addEventListener('submit', function(e) {
            const nameInput = document.querySelector('input[name="firstname"]');
            const consentCheckbox = document.getElementById('consentData');
            const errorDiv = document.querySelector('.error');
            
            errorDiv.innerHTML = '';
            errorDiv.style.display = 'none';
            
            let errors = [];
            
            if (!nameInput.value.trim()) {
                errors.push('• укажите ваше имя');
                nameInput.style.borderColor = '#e74c3c';
            } else if (nameInput.value.trim().length < 2) {
                errors.push('• имя должно содержать минимум 2 буквы');
                nameInput.style.borderColor = '#e74c3c';
            }
            
            if (!consentCheckbox.checked) {
                errors.push('• дайте согласие на обработку персональных данных');
                document.querySelector('.consent-text').style.color = '#e74c3c';
            }
            
            if (errors.length > 0) {
                e.preventDefault();
                errorDiv.innerHTML = '⚠️ Пожалуйста, завершите заполнение формы:<br>' + errors.join('<br>');
                errorDiv.style.display = 'block';
                errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
