<div class="container">
  <div class="text-center mb-4">
    <img src="../../Assets/Images/shiro.png" class="img-fluid" alt="Shiro Company" width="180" />
    <h1>Formulario de Solicitud</h1>
  </div>

  <form method="POST" enctype="multipart/form-data" action="/submit-request">
    <div class="mb-3">
      <label for="title">Título:</label>
      <input required class="form-control" type="text" placeholder="Ingrese un título" id="title" name="title">
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="urgency">Urgencia:</label>
        <select required class="form-select" name="urgency">
          <option disabled>Selecciona el nivel de urgencia:</option>
          <option value="AYER">Ayer</option>
          <option value="Urgente">Urgente</option>
          <option value="Medio">Medio</option>
          <option selected value="Baja">Baja</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="startDate">Fecha de entrega:</label>
        <input id="startDate" class="form-control" type="date" name="due_date">
      </div>
    </div>
    <div class="mb-3">
      <label for="description">Descripción:</label>
      <textarea required class="form-control" id="description" name="description" rows="3" placeholder="Describe tu solicitud"></textarea>
    </div>
    <div class="mb-3">
      <label for="attachment" class="form-label">Archivo adjunto (opcional):</label>
      <input class="form-control" id="attachment" name="attachment" type="file">
    </div>
    <div class="mb-3 text-center">
      <button type="submit" class="btn btn__style">Enviar Solicitud</button>
    </div>
  </form>
</div>