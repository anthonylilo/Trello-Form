document.addEventListener('DOMContentLoaded', function () {
  const startDate = document.getElementById('startDate');
  const formattedDate = document.getElementById('formattedDate');
  const today = new Date().toISOString().split('T')[0];
  startDate.setAttribute('min', today);

  startDate.addEventListener('change', function () {
    const dateValue = this.value;
    const [year, month, day] = dateValue.split('-');
    formattedDate.textContent = `Fecha seleccionada: ${day}-${month}-${year}`;
  });

  const attachment = document.getElementById('attachment');
  const fileError = document.getElementById('fileError');

  attachment.addEventListener('change', function () {
    if (attachment.files[0] && attachment.files[0].size > 50000000) { // 50 MB in bytes
      fileError.classList.remove('d-none');
      fileError.classList.add('d-block');
      attachment.classList.add('is-invalid');
    } else {
      fileError.classList.remove('d-block');
      fileError.classList.add('d-none');
      attachment.classList.remove('is-invalid');
    }
  });

  document.getElementById('requestForm').addEventListener('submit', function (event) {
    let isValid = true;

    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const dueDate = document.getElementById('startDate');
    const urgency = document.getElementById('urgency');

    if (!title.value.trim()) {
      isValid = false;
      document.getElementById('titleError').classList.remove('d-none');
      title.classList.add('is-invalid');
    } else {
      document.getElementById('titleError').classList.add('d-none');
      title.classList.remove('is-invalid');
    }

    if (!description.value.trim()) {
      isValid = false;
      document.getElementById('descriptionError').classList.remove('d-none');
      description.classList.add('is-invalid');
    } else {
      document.getElementById('descriptionError').classList.add('d-none');
      description.classList.remove('is-invalid');
    }

    if (!dueDate.value) {
      isValid = false;
      document.getElementById('dueDateError').classList.remove('d-none');
      dueDate.classList.add('is-invalid');
    } else {
      const [year, month, day] = dueDate.value.split('-');
      const selectedDate = new Date(`${year}-${month}-${day}`);
      const currentDate = new Date(today);
      if (selectedDate < currentDate) {
        isValid = false;
        document.getElementById('dueDateError').classList.remove('d-none');
        dueDate.classList.add('is-invalid');
      } else {
        document.getElementById('dueDateError').classList.add('d-none');
        dueDate.classList.remove('is-invalid');
      }
    }

    if (!urgency.value) {
      isValid = false;
      document.getElementById('urgencyError').classList.remove('d-none');
      urgency.classList.add('is-invalid');
    } else {
      document.getElementById('urgencyError').classList.add('d-none');
      urgency.classList.remove('is-invalid');
    }

    if (attachment.files[0] && attachment.files[0].size > 50000000) { // 50 MB in bytes
      isValid = false;
      fileError.classList.remove('d-none');
      fileError.classList.add('d-block');
      attachment.classList.add('is-invalid');
    } else {
      fileError.classList.remove('d-block');
      fileError.classList.add('d-none');
      attachment.classList.remove('is-invalid');
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
});