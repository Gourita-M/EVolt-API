# ⚡ EV Charging Station API
### Laravel 11 + Sanctum · REST API · PHPUnit · Swagger/OpenAPI

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/API/
│   │   ├── AuthController.php           # Register, Login, Logout
│   │   ├── ChargingStationController.php # CRUD + Geo-search
│   │   ├── ConnectorController.php      # Connector management (admin)
│   │   ├── ReservationController.php    # Reserve, Modify, Cancel
│   │   ├── ChargingSessionController.php# Start, End, History
│   │   └── StatisticsController.php     # Occupancy & energy stats
│   └── Middleware/
│       └── RoleMiddleware.php           # role:admin guard
├── Models/
│   ├── User.php
│   ├── ChargingStation.php
│   ├── Connector.php
│   ├── Reservation.php
│   └── ChargingSession.php
database/
├── migrations/                          # 5 migration files
├── seeders/DatabaseSeeder.php
└── factories/                           # All model factories
routes/
└── api.php                              # All API routes
tests/Feature/                           # PHPUnit tests
```

---

## 🚀 Installation

```bash
# 1. Clone & install dependencies
composer install

# 2. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Run migrations + seed
php artisan migrate --seed

# 5. Install Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# 6. Start server
php artisan serve
```

---

## 🔐 Authentication (Sanctum)

All protected routes require:
```
Authorization: Bearer {token}
```

Get token via `POST /api/auth/login` or `POST /api/auth/register`.

---

## 📡 API Endpoints Reference

### Auth
| Method | Endpoint            | Auth | Description           |
|--------|---------------------|------|-----------------------|
| POST   | /api/auth/register  | ❌   | Register new user     |
| POST   | /api/auth/login     | ❌   | Login → get token     |
| POST   | /api/auth/logout    | ✅   | Revoke current token  |
| GET    | /api/auth/user      | ✅   | Get current user      |

### Charging Stations
| Method | Endpoint                      | Role  | Description                      |
|--------|-------------------------------|-------|----------------------------------|
| GET    | /api/stations                 | user  | List all stations                |
| GET    | /api/stations/search          | user  | Search by lat/lng/radius         |
| GET    | /api/stations/{id}            | user  | Station detail + availability    |
| POST   | /api/admin/stations           | admin | Create station                   |
| PUT    | /api/admin/stations/{id}      | admin | Update station                   |
| DELETE | /api/admin/stations/{id}      | admin | Delete station                   |

### Reservations
| Method | Endpoint                          | Role | Description              |
|--------|-----------------------------------|------|--------------------------|
| GET    | /api/reservations                 | user | List my reservations     |
| POST   | /api/reservations                 | user | Create reservation       |
| GET    | /api/reservations/{id}            | user | Get reservation detail   |
| PUT    | /api/reservations/{id}            | user | Modify time/duration     |
| PATCH  | /api/reservations/{id}/cancel     | user | Cancel reservation       |

### Charging Sessions
| Method | Endpoint                          | Role | Description           |
|--------|-----------------------------------|------|-----------------------|
| GET    | /api/sessions                     | user | Active sessions       |
| GET    | /api/sessions/history             | user | Past sessions         |
| GET    | /api/sessions/{id}                | user | Session detail        |
| POST   | /api/sessions/{id}/start          | user | Start session         |
| PATCH  | /api/sessions/{id}/end            | user | End session           |

### Admin Statistics
| Method | Endpoint                               | Role  | Description            |
|--------|----------------------------------------|-------|------------------------|
| GET    | /api/admin/statistics                  | admin | Global stats           |
| GET    | /api/admin/statistics/stations/{id}    | admin | Per-station stats      |
| GET    | /api/admin/statistics/occupancy        | admin | Real-time occupancy    |

---

## 🔍 Search Example

```http
GET /api/stations/search?lat=48.8566&lng=2.3522&radius_km=10&connector_type=CCS&min_power_kw=50
Authorization: Bearer {token}
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Paris Centre EV Hub",
      "status": "available",
      "distance_km": 0.3,
      "connectors": [
        { "type": "CCS", "power_kw": 150, "status": "available" }
      ]
    }
  ],
  "count": 1,
  "search_area": { "lat": 48.8566, "lng": 2.3522, "radius_km": 10 }
}
```

---

## 🧪 Running Tests

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/ReservationTest.php
```

**Test Coverage:**
- ✅ `AuthTest` — Register, Login, Logout, Wrong credentials
- ✅ `ChargingStationTest` — List, Search geo, Create/Delete (admin), Role guard
- ✅ `ReservationTest` — Create, Conflict detection, Cancel, Update, Isolation
- ✅ `StatisticsTest` — Admin access, Regular user blocked

---

## 📄 API Documentation (Swagger/OpenAPI)

Install L5-Swagger:
```bash
composer require darkaonline/l5-swagger
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
php artisan l5-swagger:generate
```

Then open: `http://localhost:8000/api/documentation`

---

## 🌱 Default Seeded Credentials

| Role  | Email                | Password   |
|-------|----------------------|------------|
| Admin | admin@evcharge.com   | admin1234  |
| User  | user@evcharge.com    | user1234   |

---

## 📦 Key Dependencies

```json
{
  "require": {
    "laravel/framework": "^11.0",
    "laravel/sanctum": "^4.0",
    "darkaonline/l5-swagger": "^8.6"
  },
  "require-dev": {
    "phpunit/phpunit": "^11.0"
  }
}
```
