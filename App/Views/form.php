<!DOCTYPE html>
<html lang="es">

<head>
  <title>Formulario de Solicitudes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../../Assets/Styles/style.css">
</head>

<body>
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
        <button type="submit" class="btn">Enviar Solicitud</button>
      </div>
    </form>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
  const dateInput = document.getElementById('startDate');
  const today = new Date().toISOString().split('T')[0];
  dateInput.setAttribute('min', today);
</script>

</html>