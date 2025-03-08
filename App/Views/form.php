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
  <div class="container-lg">
    <div class="row">
      <div class="d-flex align-items-center align-content-between flex-column mt-5">
        <img src="../../Assets/Images/shiro.png" class="img-fluid" alt="Shiro Company" />
        <h1 class="text-center">Formulario de Solicitud</h1>
      </div>
      <form method="POST" enctype="multipart/form-data" action="/submit-request">
        <div class="row mb-3">
          <div class="col-lg-6"><label for="name">Título:</label>
            <input required class="form-control" type="text" placeholder="Default input" aria-label="Título" id="title" name="title">
          </div>
          <div class="col-lg-3"><label for="urgency">Urgencia:</label>
            <select required class="form-select" name="urgency" aria-label="Default select example">
              <option disabled>Selecciona el nivel de urgencia:</option>
              <option value="AYER">Ayer</option>
              <option value="Urgente">Urgente</option>
              <option value="Medio">Medio</option>
              <option selected value="Baja">Baja</option>
            </select>
          </div>
          <div class="col-lg-3">
            <label for="startDate">Fecha de entrega:</label>
            <input id="startDate" class="form-control" type="date" name="due_date" />
          </div>
          <div class="mb-3">
            <label for="description">Descripción:</label>
            <textarea required class="form-control" id="description" name="description" required></textarea>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Archivo adjunto (opcional):</label>
            <input class="form-control" id="attachment" name="attachment" type="file">
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Primary</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
  const dateInput = document.getElementById('startDate');
  const today = new Date().toISOString().split('T')[0];
  dateInput.setAttribute('min', today);
</script>

</html>