## **Trello-Form**

### **Descripción**

Trello-Form es una solución creada para gestionar pedidos de clientes de manera eficiente a través de un formulario personalizado. La mayoría de las solicitudes llegaban a través de **WhatsApp**, lo que dificultaba su organización. Buscando opciones gratuitas, encontré que la mayoría eran **pagas y limitadas**, por lo que decidí alojar mi propio formulario en mi **hosting** y conectarlo con **Trello**.

Este formulario permite:  
✅ Seleccionar el **nivel de urgencia** de la solicitud.  
✅ Especificar una **fecha de entrega deseada**.  
✅ Ingresar un **título y descripción** detallada del pedido.  
✅ **Adjuntar archivos** relevantes a la solicitud.  
✅ Enviar la información directamente a **Trello**, creando una nueva tarjeta automáticamente.

### **Gestión en Trello**

En **Trello**, las solicitudes se organizan en 4 columnas:

1. **Pendientes** – Se reciben todas las nuevas solicitudes.
2. **En proceso** – Tareas en ejecución.
3. **Bloqueados** – Solicitudes con problemas o en espera.
4. **Finalizados** – Pedidos completados.

Este sistema simplifica la creación de tarjetas en Trello, especialmente para usuarios no familiarizados con la plataforma.

---

## **Instalación y Uso**

📌 **Requisitos**:

- PHP **v8** (sin frameworks).
- Hosting con soporte para PHP.
- [Composer](https://getcomposer.org/) para gestionar dependencias.

📌 **Configuración**:

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/anthonylilo/Trello-Form.git
   cd Trello-Form
   ```
2. Crear un archivo `.env` en la raíz del proyecto con las **API Keys de Trello** y la configuración del correo electrónico:

   ```env
   TRELLO_KEY=your_key
   TRELLO_TOKEN=your_token
   TRELLO_ID_LIST=id_column
   LOG_FILE_PATH=logs/error.log

   # Configuración del correo
   SMTP_HOST=mail.shirocompany.com
   SMTP_USER=info@shirocompany.com
   SMTP_PASS=your_password
   SMTP_PORT=465
   SMTP_FROM=no-reply@shirocompany.com
   SMTP_TO=your_email@example.com
   ```

3. Instalar las dependencias de PHP usando Composer:

   ```bash
   composer install
   ```

   Si no tienes Composer instalado, puedes seguir las instrucciones en [getcomposer.org](https://getcomposer.org/) para instalarlo.

4. Subir el proyecto a un servidor compatible con PHP.
5. Acceder al formulario desde el navegador y empezar a gestionar solicitudes.

### **Obtener las API Keys de Trello**

Para obtener las claves de API de Trello, sigue estos pasos:

1. **Crear una cuenta en Trello**: Si no tienes una cuenta, regístrate en [Trello](https://trello.com/).
2. **Obtener la API Key**:
   - Ve a [Trello API Key](https://trello.com/app-key).
   - Copia tu API Key y pégala en el archivo `.env` como `TRELLO_KEY`.
3. **Obtener el Token**:
   - En la misma página de la API Key, haz clic en el enlace para generar un token.
   - Autoriza la aplicación y copia el token generado.
   - Pégalo en el archivo `.env` como `TRELLO_TOKEN`.
4. **Obtener el ID de la Lista**:
   - Abre Trello y navega a la lista donde deseas que se creen las tarjetas.
   - En la URL del navegador, encontrarás el ID de la lista después de `/lists/`.
   - Copia este ID y pégalo en el archivo `.env` como `TRELLO_ID_LIST`.

### **Integración de SweetAlert2**

Para mejorar la experiencia del usuario, se ha integrado **SweetAlert2** para mostrar una alerta mientras se está creando la solicitud. La alerta informa al usuario que espere y no refresque el navegador para evitar perder la solicitud.

#### **Mostrar la alerta en el script de validación**

Actualiza tu archivo `validate-form.js` para mostrar la alerta cuando se envíe el formulario:

```javascript
document
  .getElementById("requestForm")
  .addEventListener("submit", function (event) {
    let isValid = true;

    // Validaciones del formulario...

    if (isValid) {
      // Mostrar la alerta de SweetAlert2
      Swal.fire({
        title: "Creando solicitud",
        text: "Por favor aguarde. No refresque el navegador para evitar perder la solicitud.",
        icon: "info",
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        },
      });
    } else {
      event.preventDefault();
    }
  });
```

### **Envío de correos electrónicos**

Se ha integrado **PHPMailer** para enviar correos electrónicos de notificación cuando se crea una nueva solicitud.

#### **Configurar PHPMailer en el controlador**

Actualiza tu controlador para enviar correos electrónicos utilizando las configuraciones del archivo `.env`:

```php
private function sendNotificationEmail($title, $description, $dueDate, $urgency)
{
  $mail = new PHPMailer(true);

  try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER'];
    $mail->Password = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $_ENV['SMTP_PORT'];

    // Remitente y destinatario
    $mail->setFrom($_ENV['SMTP_FROM'], 'Shiro Company');
    $mail->addAddress($_ENV['SMTP_TO']);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Nueva solicitud creada';
    $mail->Body    = "<p>Se ha creado una nueva solicitud con los siguientes detalles:</p>
                      <p><strong>Título:</strong> $title</p>
                      <p><strong>Descripción:</strong> $description</p>
                      <p><strong>Fecha de entrega:</strong> $dueDate</p>
                      <p><strong>Urgencia:</strong> $urgency</p>";

    // Enviar el correo
    $mail->send();
    error_log("Correo enviado exitosamente.");
  } catch (Exception $e) {
    error_log("Error al enviar el correo: {$mail->ErrorInfo}");
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
  }
}
```

---

## **Contribuciones**

🚀 Este proyecto es **de código abierto**, por lo que cualquier persona puede contribuir.

- Si deseas mejorar el código, **haz un fork** del repositorio y envía un **Pull Request**.
- Se aceptan mejoras en la funcionalidad, seguridad y usabilidad.

---

## **Licencia**

📜 **Uso libre**, con la única condición de otorgar el **debido reconocimiento** al creador. No es necesario ningún beneficio financiero.

---

### **Contacto**

📧 Para consultas o sugerencias: **anthonylilo@shirocompany.com**

---

### **English Version**

For the English version of this README, please refer to [README_EN.md](README_EN.md).
