# Project Management App

Laravel 11 + Inertia.js (React) project management app. The recommended local setup is Docker Compose.

## Prerequisites

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/) (included with Docker Desktop)

## Run with Docker

### 1. Start the stack

From the project root:

```bash
docker compose up --build
```

First start installs Composer/NPM dependencies, waits for MySQL, runs migrations, and seeds the database. That can take a few minutes.

### 2. Open the app

| Service | URL |
|---------|-----|
| App | http://localhost:8000 |
| Vite (HMR) | http://localhost:5173 |
| MySQL | `localhost:3306` |

## Log in (seeded users)

| Email | Password | Notes |
|-------|----------|-------|
| `ashutosh@example.com` | `Ashu@123` | Primary admin |
| `priya.sharma@example.com` | `password` | Team member |
| `rahul.mehta@example.com` | `password` | Team member |
| `ananya.iyer@example.com` | `password` | Team member |
| `vikram.singh@example.com` | `password` | Team member |

Seeded data includes realistic projects such as Customer Portal Redesign, Mobile App Launch, and API Performance Hardening, with related tasks assigned across the team.


## Useful commands

```bash
# Start in background
docker compose up --build -d

# View logs
docker compose logs -f

# Stop
docker compose down

# Stop and remove MySQL data (fresh database next start)
docker compose down -v

# Run Artisan inside the app container
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
docker compose exec app php artisan tinker

# Open a shell in the app container
docker compose exec app bash
```

## Services

| Service | Image / build | Role |
|---------|---------------|------|
| `app` | Custom PHP 8.2 image | Laravel (`php artisan serve`) |
| `mysql` | `mysql:8.0` | Database |
| `vite` | `node:20-alpine` | Frontend Vite dev server |

## Environment

On first boot the entrypoint copies `.env.example` → `.env` (if missing), generates `APP_KEY`, and points the database at the `mysql` service.

Default database credentials:

- **Database:** `project_management`
- **Username:** `sail`
- **Password:** `password`

Override ports or credentials via a `.env` file in the project root (Compose reads `APP_PORT`, `VITE_PORT`, `FORWARD_DB_PORT`, `DB_*`).

## Re-seed the database

Seeding runs once (tracked by `storage/app/.docker_seeded`). To seed again:

```bash
docker compose exec app rm -f storage/app/.docker_seeded
docker compose exec app php artisan migrate:fresh --seed
```

## Troubleshooting

**Port already in use** — change ports in `.env`:

```env
APP_PORT=8080
VITE_PORT=5174
FORWARD_DB_PORT=3307
APP_URL=http://localhost:8080
VITE_DEV_SERVER_URL=http://localhost:5174
```

**Assets not loading** — confirm the `vite` container is healthy: `docker compose logs vite`.

**Permission errors on `storage/`** — from the host:

```bash
chmod -R ug+rwx storage bootstrap/cache
```
