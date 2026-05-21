# NuxGame Lucky App

---

## Step-by-Step Setup

### Step 1 — Create environment file

```bash
cp .env.example .env
```

The `.env.example` already contains all required values with correct defaults for Docker. No changes needed — the file is ready to use as-is:

```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db          # Docker service name — do not change
DB_PORT=3306
DB_DATABASE=test_nuxgame
DB_USERNAME=root
DB_PASSWORD=secret

SESSION_DRIVER=file

PAGE_TOKEN_TTL_DAYS=7   # unique link lifetime in days
```

> **Note:** `DB_HOST=db` refers to the Docker Compose service name. Do not change it to `localhost` or `127.0.0.1`.

### Step 2 — Build and start containers

```bash
docker compose up -d --build
```

Expected output:

```
✔ Container nuxgame-test-db-1     Healthy
✔ Container nuxgame-test-app-1    Started
✔ Container nuxgame-test-nginx-1  Started
```

The `app` container waits for MySQL to pass its healthcheck before starting. This may take 10–20 seconds on first run.


### Step 3 — Generate application key

```bash
docker compose exec app php artisan key:generate
```

Expected output:

```
INFO  Application key set successfully.
```

### Step 4 — Run database migrations

```bash
docker compose exec app php artisan migrate
```

Expected output:

```
INFO  Running migrations.

  0001_01_01_000000_create_users_table ............. 8ms DONE
  0001_01_01_000001_create_user_tokens_table ....... 4ms DONE
  0001_01_01_000002_create_lucky_histories_table ... 3ms DONE
```

### Step 5 — Open the application

Open in your browser:

```
http://localhost:8000
```

You should see the registration form.

---

## Running Tests

```bash
docker compose exec app php artisan test tests/Unit
```

Expected output:

```
   PASS  Tests\Unit\CalculateAmountStepTest
  ✓ calculates correct amount per range with data set '>900 → 70%'
  ✓ calculates correct amount per range with data set '>600 → 50%'
  ✓ calculates correct amount per range with data set '>300 → 30%'
  ✓ calculates correct amount per range with data set '≤300 → 10%'
  ✓ amount stays zero when not win
  ✓ passes payload to next

  Tests: 6 passed
```
