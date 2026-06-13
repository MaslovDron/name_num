document.getElementById('yearForm').addEventListener('submit', function(e) {
    const birthdateInput = document.getElementById('birthdate');
    const consentCheckbox = document.getElementById('consentData');
    const errorDiv = document.querySelector('.error');
    
    errorDiv.innerHTML = '';
    errorDiv.style.display = 'none';
    
    let errors = [];
    
    // Валидация даты рождения
    if (!birthdateInput.value) {
        errors.push('• укажите дату рождения');
        birthdateInput.style.borderColor = '#e74c3c';
    } else {
        birthdateInput.style.borderColor = '#f0e4d6';
        
        const birthDate = new Date(birthdateInput.value);
        const today = new Date();
        if (birthDate > today) {
            errors.push('• дата рождения не может быть в будущем');
            birthdateInput.style.borderColor = '#e74c3c';
        }
        
        // Проверка на разумный возраст (не старше 120 лет)
        const age = today.getFullYear() - birthDate.getFullYear();
        if (age > 120) {
            errors.push('• проверьте дату рождения (возраст не может быть больше 120 лет)');
            birthdateInput.style.borderColor = '#e74c3c';
        }
    }
    
    // Валидация согласия
    if (!consentCheckbox.checked) {
        errors.push('• дайте согласие на обработку персональных данных');
        document.querySelector('.consent-text').style.color = '#e74c3c';
    } else {
        document.querySelector('.consent-text').style.color = '#4a4a4a';
    }
    
    if (errors.length > 0) {
        e.preventDefault();
        errorDiv.innerHTML = '⚠️ Пожалуйста, завершите заполнение формы:<br>' + errors.join('<br>');
        errorDiv.style.display = 'block';
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else {
        // Добавляем анимацию загрузки
        const submitBtn = document.querySelector('.calc-btn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span>🔮</span> Рассчитываем...';
        submitBtn.disabled = true;
        
        // Форма отправится, восстанавливаем кнопку через 3 секунды
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
    }
});

// Валидация в реальном времени
document.getElementById('birthdate').addEventListener('change', function() {
    const birthDate = new Date(this.value);
    const today = new Date();
    if (birthDate > today) {
        this.style.borderColor = '#e74c3c';
    } else {
        this.style.borderColor = '#f0e4d6';
    }
});

document.getElementById('consentData').addEventListener('change', function() {
    if (this.checked) {
        document.querySelector('.consent-text').style.color = '#4a4a4a';
    } else {
        document.querySelector('.consent-text').style.color = '#e74c3c';
    }
});
