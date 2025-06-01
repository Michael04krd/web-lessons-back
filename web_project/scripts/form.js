document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('myform');
    const messagesContainer = document.querySelector('.form-messages');
    const submitBtn = form.querySelector('#submit-btn');

    if (document.querySelector('.auth-btn') && document.querySelector('.auth-btn').textContent === 'Выйти') {
      submitBtn.value = 'Обновить данные';
  }
  
    if (!form || !messagesContainer) {
      console.error('Форма или контейнер сообщений не найдены.');
      return;
    }
  
    form.addEventListener('submit', async function (e) {
      e.preventDefault();
  
      const submitBtn = form.querySelector('#submit-btn');
      const originalText = submitBtn.value;
      submitBtn.disabled = true;
      submitBtn.value = 'Отправка...';
  
      try {
        const errors = validateForm();
        if (Object.keys(errors).length > 0) {
          showErrors(errors);
          return;
        }

        const formData = new FormData();
        for (const element of form.elements) {
          if (!element.name || element.type === 'submit') continue;
  
          if (element.type === 'select-multiple') {
            for (const option of element.selectedOptions) {
              formData.append(element.name, option.value);
            }
          } else if ((element.type === 'checkbox' || element.type === 'radio') && !element.checked) {
            continue;
          } else {
            formData.append(element.name, element.value);
          }
        }
  
        formData.append('is_ajax', '1');
  
        const formAction = form.getAttribute('action') || window.location.pathname;
        const response = await fetch(formAction, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });
  
        const result = await response.json();
  
        if (result.success) {
          clearErrors();
          showSuccess(result);

          if (document.querySelector('.auth-btn') && document.querySelector('.auth-btn').textContent === 'Выйти') {
            messagesContainer.innerHTML = `
                <div class="success-message">
                    Данные успешно обновлены!
                </div>
            `;
        }
        } else {
          showErrors(result.errors || {});
        }
      } catch (error) {
        console.error('Ошибка:', error);
        messagesContainer.innerHTML = `<div class="error-message">Ошибка: ${error.message}</div>`;
      } finally {
        submitBtn.disabled = false;
        submitBtn.value = originalText;
      }
    });
  
    function validateForm() {
      const errors = {};
      const fio = form.querySelector('[name="fio"]');
      const phone = form.querySelector('[name="phone"]');
      const email = form.querySelector('[name="email"]');
      const birth_day = form.querySelector('[name="birth_day"]');
      const birth_month = form.querySelector('[name="birth_month"]');
      const birth_year = form.querySelector('[name="birth_year"]');
      const gender = form.querySelector('[name="gender"]:checked');
      const biography = form.querySelector('[name="biography"]');
      const agreement = form.querySelector('[name="agreement"]');
      const langSelect = form.querySelector('[name="languages[]"]');
      const selectedLangs = langSelect ? Array.from(langSelect.selectedOptions).map(opt => opt.value) : [];
  
      if (!fio.value.trim()) errors.fio = 'Укажите ФИО';
      if (!phone.value.trim()) errors.phone = 'Укажите телефон';
      if (!email.value.trim()) errors.email = 'Укажите Email';
      if (!birth_day.value || !birth_month.value || !birth_year.value)
        errors.birth_date = 'Укажите полную дату рождения';
      if (!gender) errors.gender = 'Выберите пол';
      if (selectedLangs.length === 0) errors.lang = 'Выберите хотя бы один язык';
      if (!biography.value.trim()) errors.biography = 'Расскажите о себе';
      if (!agreement.checked) errors.agreement = 'Необходимо согласие';
  
      return errors;
    }
  
    function clearErrors() {
      messagesContainer.innerHTML = '';
      document.querySelectorAll('.error-text').forEach(el => el.remove());
      document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
    }
  
    function showErrors(errors) {
      clearErrors();
  
      for (const [field, message] of Object.entries(errors)) {
        let elements = [];
  
        if (field === 'birth_date') {
          elements = [
            form.querySelector('[name="birth_day"]'),
            form.querySelector('[name="birth_month"]'),
            form.querySelector('[name="birth_year"]')
          ];
        } else if (field === 'gender') {
          elements = Array.from(form.querySelectorAll('[name="gender"]'));
        } else if (field === 'lang') {
          elements = [form.querySelector('[name="languages[]"]')];
        } else if (field === 'agreement') {
          elements = [form.querySelector('[name="agreement"]')];
        } else {
          elements = [form.querySelector(`[name="${field}"]`)];
        }
  
        elements.forEach(el => {
          if (!el) return;
          el.classList.add('error');
          const container = el.closest('label') || el.closest('.checkbox-block') || el.parentElement;
          const errorEl = document.createElement('div');
          errorEl.className = 'error-text';
          errorEl.textContent = message;
          container.appendChild(errorEl);
        });
      }
    }
  
    function showSuccess(result) {
      messagesContainer.innerHTML = `
        <div class="success-message">
          ${result.login && result.password
            ? `Данные сохранены!<br>Логин: ${result.login}<br>Пароль: ${result.password}`
            : 'Данные успешно обновлены!'}
        </div>
      `;
    }
  });