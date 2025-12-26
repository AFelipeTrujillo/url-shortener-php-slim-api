# URL Shortener API

A professional-grade URL Shortener API built with **PHP-Slim 4** and **Doctrine ORM**, following **SOLID** design principles and Clean Architecture.

## 🚀 Features

* **Clean Architecture:** Clearly defined Domain, Application, and Infrastructure layers.
* **SOLID Principles:** High maintainability, loose coupling, and testability.
* **Idempotency:** Generates the same short code for a previously shortened URL.
* **Automatic Redirects:** Resolves short codes back to their original destination.
* **Visit Tracking:** Basic counter for short link usage.
* **In-Memory Testing:** Automated tests using an isolated SQLite database in RAM.

---

## 🛠️ Tech Stack

* **Framework:** [Slim 4](https://www.slimframework.com/)
* **ORM:** [Doctrine ORM](https://www.doctrine-project.org/)
* **DI Container:** [PHP-DI](https://php-di.org/)
* **Database:** SQLite
* **Testing:** [PHPUnit](https://phpunit.de/)

---

## 📁 Project Structure

```text
├── bin/                # Console scripts (Doctrine CLI)
├── config/             # Dependency Injection & DB Configuration
├── public/             # Entry point (index.php)
├── src/
│   ├── Application/    # Actions (Controllers) and Business Logic
│   ├── Domain/         # Entities, Repository Interfaces, and Generators
│   ├── Infrastructure/ # Concrete persistence (Doctrine)
│   └── Shared/         # Utilities (Base62 generator)
├── tests/              # Unit and Integration test suites
└── var/                # Local storage for SQLite files

```

---

## ⚙️ Installation & Setup

### 1. Clone & Install

```bash
git clone <your-repository-url>
cd url-shortener-php-slim-api
composer install

```

### 2. Initialize Database

Create the directory for SQLite and let Doctrine generate the tables:

```bash
mkdir var && chmod 777 var
php bin/console.php orm:schema-tool:create

```

### 3. Run Development Server

```bash
php -S localhost:8080 -t public

```

---

## 📡 API Usage

### Shorten a URL

* **URL:** `/shorten`
* **Method:** `POST`
* **Payload:** `{"url": "https://www.google.com"}`
* **Response (201):**
```json
{
  "short_url": "http://localhost:8080/aB123c",
  "original_url": "https://www.google.com"
}

```



### Redirect

* **URL:** `/{code}`
* **Method:** `GET`
* **Description:** Redirects to the original URL and increments the visit counter.

### Health Check

* **URL:** `/ping`
* **Method:** `GET`
* **Description:** Checks API and database status.

---

## 🧪 Testing

The project uses a high-speed **SQLite in-memory** setup for integration tests.

Run all tests:

```bash
./vendor/bin/phpunit

```

---

## 🛡️ SOLID Implementation Highlights

* **S (Single Responsibility):** The `ShortenerService` only manages the business logic of shortening, while `Base62Generator` only handles code generation.
* **D (Dependency Inversion):** High-level services depend on `UrlRepositoryInterface`, not on the concrete `DoctrineUrlRepository`.
* **L (Liskov Substitution):** You can swap the SQLite persistence with Redis or MySQL by simply changing the implementation in the DI container.

---

**¿Te gustaría que ahora agreguemos un manejador de errores global para que, si algo falla, la API siempre responda con un JSON limpio en lugar de un error de PHP?**