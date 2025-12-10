# 🛠️ Laravel Commands Reference - BRACU Transport System

Quick reference guide for common Laravel Artisan commands used in this project.

---

## 🚀 Initial Setup Commands

### 1. Install Dependencies
```powershell
composer install
```

### 2. Environment Setup
```powershell
# Copy environment file
Copy-Item .env.example .env

# Generate application key (REQUIRED)
php artisan key:generate
```

### 3. Database Setup
```powershell
# Create database first in MySQL:
mysql -u root -p
CREATE DATABASE bracu_transport;
EXIT;

# Run migrations (create tables)
php artisan migrate

# Seed demo data (add bus routes)
php artisan db:seed --class=BusRouteSeeder

# Or run migration + seed together
php artisan migrate --seed
```

---

## 🗄️ Database Commands

### Migrations
```powershell
# Run all pending migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Drop all tables and re-run migrations
php artisan migrate:fresh

# Fresh migration + seed data
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status
```

### Seeders
```powershell
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=BusRouteSeeder

# Reseed database (with fresh migration)
php artisan migrate:fresh --seed
```

### Database Info
```powershell
# Show database connection info
php artisan db:show

# Show table information
php artisan db:table bus_routes
```

---

## 🏃 Running the Application

### Development Server
```powershell
# Start server (default: http://localhost:8000)
php artisan serve

# Start on specific port
php artisan serve --port=8080

# Start on specific host and port
php artisan serve --host=0.0.0.0 --port=8000
```

### Access URLs
- Homepage: `http://localhost:8000`
- Search: `http://localhost:8000/search`
- All Routes: `http://localhost:8000/all-routes`

---

## 🧹 Cache & Optimization Commands

### Clear Caches
```powershell
# Clear configuration cache
php artisan config:clear

# Clear application cache
php artisan cache:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Clear all caches at once
php artisan optimize:clear
```

### Create Caches (Production)
```powershell
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize for production (all caches)
php artisan optimize
```

---

## 🔍 Inspection & Debugging Commands

### Routes
```powershell
# List all routes
php artisan route:list

# Filter routes by name
php artisan route:list --name=bus

# Filter routes by method
php artisan route:list --method=GET
```

### Application Info
```powershell
# Show application info
php artisan about

# Show environment info
php artisan env

# Check Laravel version
php artisan --version
```

### Tinker (Interactive Shell)
```powershell
# Start Tinker REPL
php artisan tinker

# Inside Tinker, test your models:
>>> App\Models\BusRoute::count()
>>> App\Models\BusRoute::first()
>>> App\Models\BusRoute::searchRoutes('Mirpur', 'BRACU')
>>> exit
```

---

## 🔧 Code Generation Commands

### Create Model
```powershell
# Create model only
php artisan make:model BusRoute

# Create model + migration
php artisan make:model BusRoute -m

# Create model + migration + controller
php artisan make:model BusRoute -mc

# Create model + migration + controller + resource controller
php artisan make:model BusRoute -mcr
```

### Create Controller
```powershell
# Create basic controller
php artisan make:controller BusRouteController

# Create resource controller
php artisan make:controller BusRouteController --resource
```

### Create Migration
```powershell
# Create migration
php artisan make:migration create_bus_routes_table

# Create migration for adding columns
php artisan make:migration add_status_to_bus_routes_table
```

### Create Seeder
```powershell
# Create seeder
php artisan make:seeder BusRouteSeeder
```

---

## 📝 Project-Specific Commands

### Fresh Start (Reset Everything)
```powershell
# Complete reset with fresh data
php artisan migrate:fresh --seed

# If you get errors, try:
composer dump-autoload
php artisan migrate:fresh --seed
```

### Quick Test Database
```powershell
# Count routes in database
php artisan tinker
>>> App\Models\BusRoute::count()
>>> exit

# Or use database query
php artisan tinker
>>> DB::table('bus_routes')->count()
>>> exit
```

### View All Routes Data
```powershell
php artisan tinker
>>> App\Models\BusRoute::all()->pluck('route_name', 'bus_number')
>>> exit
```

---

## 🐛 Troubleshooting Commands

### Permission Issues
```powershell
# Fix storage permissions (if needed on Linux/Mac)
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Windows typically doesn't need this
```

### Autoload Issues
```powershell
# Regenerate autoload files
composer dump-autoload

# Clear and recreate all caches
php artisan optimize:clear
php artisan optimize
```

### Database Connection Issues
```powershell
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo()
>>> exit

# Show database info
php artisan db:show
```

### Class Not Found Errors
```powershell
# Clear config and regenerate
php artisan config:clear
composer dump-autoload
php artisan optimize:clear
```

---

## 📦 Composer Commands

### Install/Update
```powershell
# Install dependencies
composer install

# Update dependencies
composer update

# Update specific package
composer update laravel/framework

# Install new package
composer require package/name
```

### Autoload
```powershell
# Regenerate autoload files
composer dump-autoload

# Optimize autoload (production)
composer dump-autoload --optimize
```

---

## 🚀 Deployment Commands

### Prepare for Production
```powershell
# Set environment to production in .env
# APP_ENV=production
# APP_DEBUG=false

# Optimize application
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear logs (optional)
# Manually delete: storage/logs/laravel.log
```

### Vercel Deployment
```powershell
# Install Vercel CLI
npm i -g vercel

# Login to Vercel
vercel login

# Deploy to production
vercel --prod
```

---

## 🧪 Testing Commands

### Manual Testing Routes
```powershell
# Start server
php artisan serve

# Test in browser:
# http://localhost:8000
# http://localhost:8000/search?pickup_location=Mirpur&dropoff_location=BRACU
# http://localhost:8000/all-routes
```

### Database Testing
```powershell
# Check routes count
php artisan tinker
>>> App\Models\BusRoute::where('status', 'active')->count()

# Test search function
>>> App\Models\BusRoute::searchRoutes('Mirpur', 'BRACU')->count()

# Get pickup locations
>>> App\Models\BusRoute::getPickupLocations()

# Exit tinker
>>> exit
```

---

## 📊 Useful Query Commands

### Via Tinker
```powershell
php artisan tinker

# Get all active routes
>>> App\Models\BusRoute::where('status', 'active')->get()

# Count routes by pickup location
>>> App\Models\BusRoute::groupBy('pickup_location')->selectRaw('pickup_location, count(*) as count')->get()

# Find routes with low fares
>>> App\Models\BusRoute::where('fare', '<', 40)->get()

# Find routes departing before 8 AM
>>> App\Models\BusRoute::where('departure_time', '<', '08:00:00')->get()

# Exit
>>> exit
```

---

## 🔄 Daily Development Workflow

### Morning Routine
```powershell
# Pull latest changes (if using Git)
git pull

# Update dependencies (if composer.json changed)
composer install

# Run any new migrations
php artisan migrate

# Clear caches
php artisan optimize:clear

# Start server
php artisan serve
```

### Before Committing
```powershell
# Clear all caches
php artisan optimize:clear

# Test application
php artisan serve

# Run migrations on fresh database
php artisan migrate:fresh --seed
```

---

## 📝 Quick Reference Table

| Task | Command |
|------|---------|
| Start server | `php artisan serve` |
| Run migrations | `php artisan migrate` |
| Seed database | `php artisan db:seed --class=BusRouteSeeder` |
| Fresh start | `php artisan migrate:fresh --seed` |
| Clear all cache | `php artisan optimize:clear` |
| List routes | `php artisan route:list` |
| Open Tinker | `php artisan tinker` |
| Generate key | `php artisan key:generate` |
| Show DB info | `php artisan db:show` |
| View about | `php artisan about` |

---

## 💡 Pro Tips

1. **Always clear cache after .env changes:**
   ```powershell
   php artisan config:clear
   ```

2. **Use Tinker to test models:**
   ```powershell
   php artisan tinker
   >>> App\Models\BusRoute::searchRoutes('Mirpur', 'BRACU')
   ```

3. **Fresh start when things break:**
   ```powershell
   composer dump-autoload
   php artisan optimize:clear
   php artisan migrate:fresh --seed
   ```

4. **Check logs for errors:**
   ```
   storage/logs/laravel.log
   ```

5. **Use route names in views:**
   ```blade
   <a href="{{ route('home') }}">Home</a>
   ```

---

## 🆘 Emergency Commands

When everything breaks:

```powershell
# Nuclear option - reset everything
composer dump-autoload
php artisan optimize:clear
php artisan migrate:fresh --seed
php artisan optimize
php artisan serve
```

---

## 📚 Learn More

- Laravel Artisan: `php artisan list`
- Help for command: `php artisan help migrate`
- Laravel Docs: https://laravel.com/docs/artisan

---

**Last Updated:** December 2, 2024  
**Project:** BRACU Transport System  
**Module:** 1
