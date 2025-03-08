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

📌 **Configuración**:  
1. Clonar el repositorio:  
   ```bash
   git clone https://github.com/anthonylilo/Trello-Form.git
   cd Trello-Form
   ```  
2. Crear un archivo `.env` en la raíz del proyecto con las **API Keys de Trello**:  
   ```env
   TRELLO_API_KEY=your_api_key
   TRELLO_TOKEN=your_trello_token
   TRELLO_BOARD_ID=your_board_id
   ```  
3. Subir el proyecto a un servidor compatible con PHP.  
4. Acceder al formulario desde el navegador y empezar a gestionar solicitudes.  

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
