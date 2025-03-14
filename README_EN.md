## **Trello-Form**

### **Description**

Trello-Form is a solution created to efficiently manage customer requests through a customized form. Most requests were coming through **WhatsApp**, making it difficult to organize them. Looking for free options, I found that most were **paid and limited**, so I decided to host my own form on my **hosting** and connect it with **Trello**.

This form allows you to:  
✅ Select the **urgency level** of the request.  
✅ Specify a **desired delivery date**.  
✅ Enter a **detailed title and description** of the request.  
✅ **Attach relevant files** to the request.  
✅ Send the information directly to **Trello**, automatically creating a new card and notifying you via email that a new task has been created.

### **Management in Trello**

In **Trello**, requests are organized into 4 columns:

1. **Pending** – All new requests are received.
2. **In Progress** – Tasks in execution.
3. **Blocked** – Requests with issues or on hold.
4. **Completed** – Completed requests.

This system simplifies the creation of cards in Trello, especially for users unfamiliar with the platform.

---

## **Installation and Usage**

📌 **Requirements**:

- PHP **v8** (without frameworks).
- Hosting with PHP support.
- [Composer](https://getcomposer.org/) to manage dependencies.

📌 **Configuration**:

1. Clone the repository:
   ```bash
   git clone https://github.com/anthonylilo/Trello-Form.git
   cd Trello-Form
   ```
2. Create a `.env` file in the root of the project with the **Trello API Keys** and email configuration:

   ```env
   TRELLO_KEY=your_key
   TRELLO_TOKEN=your_token
   TRELLO_ID_LIST=id_column
   LOG_FILE_PATH=logs/error.log

   # Email configuration
   SMTP_HOST=mail.shirocompany.com
   SMTP_USER=info@shirocompany.com
   SMTP_PASS=your_password
   SMTP_PORT=465
   SMTP_FROM=no-reply@shirocompany.com
   SMTP_TO=your_email@example.com
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```

   If you don't have Composer installed, you can follow the instructions at [getcomposer.org](https://getcomposer.org/) to install it.

4. Upload the project to a PHP-compatible server.
5. Access the form from the browser and start managing requests.

### **Getting Trello API Keys**

To obtain the Trello API keys, follow these steps:

1. **Create a Trello account**: If you don't have an account, sign up at [Trello](https://trello.com/).
2. **Get the API Key**:
   - Go to [Trello API Key](https://trello.com/app-key).
   - Copy your API Key and paste it into the `.env` file as `TRELLO_KEY`.
3. **Get the Token**:
   - On the same API Key page, click the link to generate a token.
   - Authorize the application and copy the generated token.
   - Paste it into the `.env` file as `TRELLO_TOKEN`.
4. **Get the List ID**:
   - Open Trello and navigate to the list where you want the cards to be created.
   - In the browser URL, you will find the list ID after `/lists/`.
   - Copy this ID and paste it into the `.env` file as `TRELLO_ID_LIST`.

### **SweetAlert2 Integration**

To enhance the user experience, **SweetAlert2** has been integrated to show an alert while the request is being created. The alert informs the user to wait and not refresh the browser to avoid losing the request.

#### **Show the alert in the validation script**

Update your `validate-form.js` file to show the alert when the form is submitted:

```javascript
document
  .getElementById("requestForm")
  .addEventListener("submit", function (event) {
    let isValid = true;

    // Form validations...

    if (isValid) {
      // Show SweetAlert2 alert
      Swal.fire({
        title: "Creating request",
        text: "Please wait. Do not refresh the browser to avoid losing the request.",
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

### **Email Notifications**

**PHPMailer** has been integrated to send email notifications when a new request is created.

#### **Configure PHPMailer in the controller**

Update your controller to send emails using the configurations from the `.env` file:

```php
private function sendNotificationEmail($title, $description, $dueDate, $urgency)
{
  $mail = new PHPMailer(true);

  try {
    // SMTP server configuration
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER'];
    $mail->Password = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $_ENV['SMTP_PORT'];

    // Sender and recipient
    $mail->setFrom($_ENV['SMTP_FROM'], 'Shiro Company');
    $mail->addAddress($_ENV['SMTP_TO']);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'New request created';
    $mail->Body    = "<p>A new request has been created with the following details:</p>
                      <p><strong>Title:</strong> $title</p>
                      <p><strong>Description:</strong> $description</p>
                      <p><strong>Due Date:</strong> $dueDate</p>
                      <p><strong>Urgency:</strong> $urgency</p>";

    // Send the email
    $mail->send();
    error_log("Email sent successfully.");
  } catch (Exception $e) {
    error_log("Error sending email: {$mail->ErrorInfo}");
    echo "Error sending email: {$mail->ErrorInfo}";
  }
}
```

---

## **Contributions**

🚀 This project is **open source**, so anyone can contribute.

- If you want to improve the code, **fork** the repository and send a **Pull Request**.
- Improvements in functionality, security, and usability are welcome.

---

## **License**

📜 **Free to use**, with the only condition of giving **proper credit** to the creator. No financial benefit is required.

---

### **Contact**

📧 For inquiries or suggestions: **anthonylilo@shirocompany.com**
