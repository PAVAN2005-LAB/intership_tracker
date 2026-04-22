<div align="center">
  <img src="image.png" alt="Institution Logo" height="80">
  <h1>Student Internship Tracking System</h1>
  <p><strong>Government Engineering College (GEC) Dahod • Computer Science Department</strong></p>
  <p>A completely customized, centralized web platform connecting ambitious students with industry-leading internship opportunities instantly.</p>

  [![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net/)
  [![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com/)
  [![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
  [![jQuery](https://img.shields.io/badge/jQuery-AJAX-0769AD?style=for-the-badge&logo=jquery&logoColor=white)](https://jquery.com/)
</div>

<br>

## 🚀 Key Features

### 👨‍🎓 For Students
* **Advanced Profile Engineering:** Build a technical profile linking directly to your GitHub, LeetCode, CodeForces, HackerRank, GeeksForGeeks, and LinkedIn.
* **Intelligent File Uploads:** Upload your PDF, DOC, or DOCX resumes securely. The engine validates the MIME type and safely caches it externally from the active database.
* **Asynchronous Appplications (AJAX):** Search and apply for active internships in real-time. The page never reloads!

### 🛡️ For Administrators
* **CRUD Metrics Dashboard:** Full control over Internship Postings, User Access, and Live Applications status changes.
* **Instant Resume Access:** Download student PDF uploads directly from the dashboard matrix.
* **Dynamic Table Routing:** Approving or rejecting a candidate instantly fires status sweeps throughout the entire framework.

---

## 🏗️ Technical Architecture
This project drops traditional monolithic PHP scripts in favor of a highly modular, readable **Component-Based Architecture**:

```text
📦 intership_tracker
 ┣ 📂 assets
 ┃ ┣ 📂 css        (Global Styles & Glassmorphism UI)
 ┃ ┗ 📂 js         (AJAX and jQuery interaction scripts)
 ┣ 📂 config
 ┃ ┗ 📜 db.php     (Global secure PDO MySQL connector)
 ┣ 📂 includes
 ┃ ┣ 📂 admin      (Isolated CRUD operations and table rendering)
 ┃ ┣ 📂 home       (GEC Dahod modular landing page layouts)
 ┃ ┣ 📂 layouts    (Global repetitive headers, footers, & tracker)
 ┃ ┗ 📂 profile    (Complex form processing arrays)
 ┣ 📂 uploads      (Sandbox for user Resumes & PDFs)
 ┣ 📜 admin.php    (Administrative application router)
 ┣ 📜 index.php    (Public facing college web route)
 ┗ 📜 student.php  (Secured user environment)
```

---

## ⚙️ Installation & Setup Deployment

1. **Clone the Repository**
   ```bash
   git clone https://github.com/PAVAN2005-LAB/intership_tracker.git
   cd intership_tracker
   ```

2. **Configure Global Server Environment**
   * Download and install [XAMPP](https://www.apachefriends.org/).
   * Move the repository file into your `htdocs` directory (or run locally using PHP's internal server).

3. **Database Injection**
   * Open XAMPP Control Panel and start **Apache** and **MySQL**.
   * Open `http://localhost/phpmyadmin` in your browser.
   * Create a blank database manually if needed, or simply let the system auto-generate it.
   * Import the `database.sql` script to instantly construct the architecture & tables!

4. **Launch Application**
   ```bash
   # Run the local server engine
   php -S localhost:8000
   ```
   Navigate to `http://localhost:8000/index.php`.

> **Admin Access Credentials Tracker**
> **Email:** `admin@example.com`
> **Password:** `admin123`

---

## 🌟 Upcoming Pipeline Concepts
- [ ] **PHPMailer Status Sweeps:** Send live automatic application acceptance/rejection notification emails natively.
- [ ] **CSV Data Extracting:** Allow admins to pull `.csv` Excel downloads of specific student application clusters.
- [ ] **CSRF Security Layer:** Injecting Cross-Site Request Forgery tokens into profile updates.

<br>
<div align="center">
    <i>Engineered specifically out of the Government Engineering College Dahod Web Programming Department.</i>
</div>
