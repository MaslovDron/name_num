const dateInput = document.getElementById('daterozd');
const checkbox = document.getElementById('chdate');
const submitBtn = document.querySelector('.btn1');
const form = document.querySelector('form');
const errorElement = document.querySelector('.error');

// Очищаем ошибки при загрузке
errorElement.textContent = '';

// Обработчик отправки формы
form.addEventListener('submit', function(event) {
  event.preventDefault();

  let hasErrors = false;
  errorElement.innerHTML = '';
  
  // Сбрасываем стили полей
  dateInput.style.borderColor = '';
  checkbox.parentElement.style.border = '';

  // Проверка даты
  if (!dateInput.value) {
    errorElement.innerHTML += '<span style="color: red; font-weight: 600">Пожалуйста, введите дату рождения</span><br>';
    dateInput.style.borderColor = 'red';
    hasErrors = true;
  }

  // Проверка чекбокса
  if (!checkbox.checked) {
    errorElement.innerHTML += '<span style="color: red; font-weight: 600">Пожалуйста, дайте согласие на обработку персональных данных</span><br>';
    //checkbox.style.border = '1px solid red';
    checkbox.style.outline = '1px solid red';
    //checkbox.style.outlineOffset = '1px'; 
    hasErrors = true;
  }

  if (hasErrors) return;

  handleFormSubmit();
});

function handleFormSubmit() {
  const formData = new FormData(form);
  const data = Object.fromEntries(formData.entries());

  errorElement.textContent = 'Форма отправлена успешно!';
  errorElement.style.color = 'green';
  
  // Сбрасываем стили полей после успешной отправки
  dateInput.style.borderColor = '';
  checkbox.parentElement.style.border = '';
}

// Валидация даты при изменении
dateInput.addEventListener('change', function() {
  const dateValue = new Date(dateInput.value);
  
  if (isNaN(dateValue)) {
    errorElement.innerHTML = '<span style="color: red; font-weight: 600">Пожалуйста, введите корректную дату</span>';
    dateInput.style.borderColor = 'red';
  } else {
    errorElement.textContent = '';
    dateInput.style.borderColor = ''; // Сбрасываем рамку
  }
});

// Визуальная обратная связь для чекбокса
checkbox.addEventListener('change', function() {
  if (this.checked) {
    this.parentNode.style.color = 'green';
    this.parentNode.style.border = ''; // Убираем красную рамку при выборе
    ////////////////////////////
    checkbox.style.outline = '';
    checkbox.style.outlineOffset = ''
  } else {
    this.parentNode.style.color = '';
  }
});
