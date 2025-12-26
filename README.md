This is a professional **README.md** tailored for your project. It reflects the SOLID architecture, the tech stack, and the installation steps we have covered so far.

---

# URL Shortener API

A high-performance, professional-grade URL Shortener API built with **PHP-Slim 4** and **Doctrine ORM**, following **SOLID** design principles and **Clean Architecture**.

## 🚀 Features

* **Clean Architecture:** Separated into Domain, Application, and Infrastructure layers.
* **SOLID Principles:** High maintainability and low coupling.
* **Modern PHP:** Built with PHP 8+ using attributes for Doctrine mapping.
* **Dependency Injection:** Fully managed by PHP-DI.
* **SQLite Ready:** Easy to set up and develop locally.

---

## 🛠️ Tech Stack

* **Framework:** [Slim 4](https://www.slimframework.com/)
* **ORM:** [Doctrine ORM](https://www.doctrine-project.org/)
* **DI Container:** [PHP-DI](https://php-di.org/)
* **Database:** SQLite (default for development)
* **Package Manager:** Composer

---

## 📁 Project Structure

```text
├── bin/                # Console scripts (Doctrine CLI)
├── config/             # Configuration and Dependency Injection
├── public/             # Web server entry point (index.php)
├── src/
│   ├── Application/    # Actions (Controllers) and Business Services
│   ├── Domain/         # Entities and Repository Interfaces
│   └── Infrastructure/ # Database persistence implementations
├── var/                # Storage for SQLite database and logs
└── composer.json       # Project dependencies and PSR-4 autoloading

```

---

## ⚙️ Installation & Setup

### 1. Clone the repository

```bash
git clone <your-repository-url>
cd url-shortener-php-slim-api

```

### 2. Install dependencies

```bash
composer install

```

### 3. Initialize the Database

Ensure the `var/` directory is writable, then run the Doctrine tool to create the SQLite database and tables:

```bash
php bin/console.php orm:schema-tool:create

```

### 4. Run the development server

```bash
php -S localhost:8080 -t public

```

---

## 🧪 Testing

The project uses **PHPUnit** for testing.

### Run all tests
```bash
./vendor/bin/phpunit
```

## 📡 API Endpoints

### Health Check

* **URL:** `/ping`
* **Method:** `GET`
* **Description:** Verifies the API is running and the database connection is active.
* **Response:**
```json
{
  "status": "ok",
  "database": "connected",
  "timestamp": 1703600000
}

```

### Shorten URL (Upcoming)

* **URL:** `/shorten`
* **Method:** `POST`
* **Body:** `{ "url": "https://example.com" }`

---

## 🛡️ SOLID Principles Applied

* **Single Responsibility (S):** Actions only handle HTTP, Services handle logic, Entities handle data.
* **Dependency Inversion (D):** The Application layer depends on Repository Interfaces, not concrete Doctrine implementations.
* **Interface Segregation (I):** Specialized interfaces for domain-specific persistence.

---

## 📄 License

This project is open-source and available under the MIT License.

---

**Would you like me to add a "Testing" section or perhaps the "How to Use" instructions for the URL shortening logic we are about to build?**