document.getElementById('compatibilityForm').addEventListener('submit', function(e) {
            const name1 = document.querySelector('input[name="name1"]').value.trim();
            const name2 = document.querySelector('input[name="name2"]').value.trim();
            const consent = document.getElementById('consentData').checked;
            const errorDiv = document.querySelector('.error');
            
            errorDiv.innerHTML = '';
            errorDiv.style.display = 'none';
            
            let errors = [];
            
            if (!name1) {
                errors.push('• укажите имя первого партнёра');
                document.querySelector('input[name="name1"]').style.borderColor = '#e74c3c';
            } else if (name1.length < 2) {
                errors.push('• первое имя должно содержать минимум 2 буквы');
                document.querySelector('input[name="name1"]').style.borderColor = '#e74c3c';
            } else if (name1.length > 20) {
                errors.push('• первое имя не должно быть длиннее 20 символов');
                document.querySelector('input[name="name1"]').style.borderColor = '#e74c3c';
            } else if (!/^[а-яёА-ЯЁ]+$/u.test(name1)) {
                errors.push('• первое имя может содержать только русские буквы');
                document.querySelector('input[name="name1"]').style.borderColor = '#e74c3c';
            }
            
            if (!name2) {
                errors.push('• укажите имя второго партнёра');
                document.querySelector('input[name="name2"]').style.borderColor = '#e74c3c';
            } else if (name2.length < 2) {
                errors.push('• второе имя должно содержать минимум 2 буквы');
                document.querySelector('input[name="name2"]').style.borderColor = '#e74c3c';
            } else if (name2.length > 20) {
                errors.push('• второе имя не должно быть длиннее 20 символов');
                document.querySelector('input[name="name2"]').style.borderColor = '#e74c3c';
            } else if (!/^[а-яёА-ЯЁ]+$/u.test(name2)) {
                errors.push('• второе имя может содержать только русские буквы');
                document.querySelector('input[name="name2"]').style.borderColor = '#e74c3c';
            }
            
            if (!consent) {
                errors.push('• дайте согласие на обработку персональных данных');
                document.querySelector('.consent-text').style.color = '#e74c3c';
            }
            
            if (errors.length > 0) {
                e.preventDefault();
                errorDiv.innerHTML = '⚠️ Пожалуйста, исправьте ошибки:<br>' + errors.join('<br>');
                errorDiv.style.display = 'block';
                errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
