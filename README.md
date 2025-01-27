# Lawyer-Gpt
# Lawyer GPT

## 🚀 AI-Powered Legal Assistance Platform

Lawyer GPT is a **legal chatbot** web application designed to provide **AI-powered legal assistance** using OpenAI's API. The platform allows users to engage in **legal conversations**, store chat history, and manage their accounts securely.

## 📌 Features
- **ChatGPT AI Integration** – Interact with an AI-powered legal assistant.
- **User Authentication** – Secure sign-up, sign-in, and session management.
- **Chat History Management** – Create, edit, delete, and store chat conversations.
- **Dashboard** – Update user profile and manage account settings.
- **SEO Optimized** – Sitemap and meta tags for better search engine ranking.
- **Secure HTTPS Connection** – Ensures encrypted communication and data protection.
- **Responsive UI** – Mobile-friendly and accessible across devices.

## 🛠️ Technologies Used
### **Frontend**
- **HTML5** – Structure and content layout.
- **CSS3** – Styling and responsiveness.
- **JavaScript** – Dynamic interactivity and API calls.

### **Backend**
- **PHP** – Server-side scripting for handling requests.
- **MySQL** – Database management for user accounts and chat history.
- **XAMPP** – Local development environment (Apache, MySQL, PHP).

### **API Integration**
- **OpenAI API** – Powers the chatbot functionality.

### **Version Control & Hosting**
- **Git & GitHub** – Version control and repository management.
- **InfinityFree (or any PHP hosting)** – Live deployment.

## 📂 Project Structure
```
/lawyer-gpt-website
│── assets/           # CSS, JavaScript, Images
│── includes/         # Header, Footer, Database connection
│── pages/            # About, Sign-in, Sign-up, Dashboard, Home
│── process/          # PHP scripts for login, signup, chat functions
│── index.php         # Main landing page
│── config.php        # Configuration file (database, settings)
│── README.md         # Project documentation
│── .gitignore        # Git ignore file
```

## 🛠️ Installation & Setup
### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/ahmadm962/lawyer-gpt.git
cd lawyer-gpt-website
```

### **2️⃣ Set Up Local Environment**
1. Install **XAMPP** (Apache, PHP, MySQL)
2. Place project files inside `htdocs` (for Windows) or `/var/www/html/` (for Linux)
3. Start **Apache** and **MySQL** from XAMPP Control Panel

### **3️⃣ Configure Database**
1. Open **phpMyAdmin** and create a database named `lawyer_gpt`
2. Import `lawyer_gpt.sql` file (if available)
3. Update `config.php` with database credentials:
```php
$host = "localhost";
$user = "root";
$password = "";
$database = "lawyer_gpt";
$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
```

### **4️⃣ Running the Website**
1. Open a browser and go to:
   ```
   http://localhost/lawyer-gpt-website/index.php
   ```
2. Sign up and start chatting with the AI-powered legal assistant.

### **5️⃣ Deploying to a Live Server**
1. Upload project files to your hosting provider (`InfinityFree`, `000WebHost`, `Hostinger`, etc.)
2. Configure database connection in `config.php` with live database credentials.
3. Update `.htaccess` (if needed) for routing.

## 📜 License
This project is licensed under the **MIT License**.

## 📞 Contact & Support
For any issues or contributions:

- **Email**: 23110205@htu.edu.jo

---
🎉 **Enjoy using Lawyer GPT – The Future of Legal Assistance!** 🚀

