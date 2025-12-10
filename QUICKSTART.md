# Quick Start Guide - BRACU Transport System

Follow these steps to get the application running quickly:

## 🚀 Quick Setup (5 minutes)

### 1. Install Dependencies
```powershell
composer install
```

### 2. Setup Environment
```powershell
# Copy environment file
Copy-Item .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Configure Database
Edit `.env` file and update these lines:
```env
DB_DATABASE=bracu_transport
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Create Database
```powershell
# Open MySQL
mysql -u root -p

# In MySQL prompt:
CREATE DATABASE bracu_transport;
EXIT;
```

### 5. Run Migrations & Seed Data
```powershell
# Create tables
php artisan migrate

# Add demo bus routes
php artisan db:seed --class=BusRouteSeeder
```

### 6. Start Server
```powershell
php artisan serve
```

### 7. Open Browser
Visit: **http://localhost:8000**

---

## ✅ Test the Features

### Test Case 1: Search from Mirpur to BRACU
- **Pickup:** Mirpur 10
- **Dropoff:** BRACU Campus, Merul Badda
- **Expected:** 2 routes found

### Test Case 2: Search from Uttara
- **Pickup:** Uttara
- **Dropoff:** BRACU
- **Expected:** 2 routes found

### Test Case 3: View All Routes
- Click "All Routes" in navigation
- **Expected:** 17 total routes displayed

---

## 🔧 Troubleshooting

### Error: "Access denied for user"
- Check your MySQL username/password in `.env`
- Make sure MySQL service is running

### Error: "Base table or view not found"
```powershell
php artisan migrate:fresh
php artisan db:seed --class=BusRouteSeeder
```

### Error: "Class BusRouteSeeder not found"
```powershell
composer dump-autoload
php artisan db:seed --class=BusRouteSeeder
```

### Clear All Cache
```powershell
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

---

## 📱 Quick Feature Overview

| Feature | URL | Description |
|---------|-----|-------------|
| Homepage | `/` | Search form with autocomplete |
| Search Results | `/search?pickup_location=X&dropoff_location=Y` | Filtered routes |
| All Routes | `/all-routes` | Complete route listing |

---

## 🎯 Next Steps

After verifying the basic functionality works:

1. **Customize Routes:** Edit `database/seeders/BusRouteSeeder.php`
2. **Update Styling:** Modify Blade templates in `resources/views/`
3. **Add Features:** Implement booking, payment, user authentication
4. **Deploy:** Follow deployment guide in main README.md

---

## 📞 Need Help?

- Check main `README.md` for detailed documentation
- Review Laravel documentation: https://laravel.com/docs
- Verify all files are in correct directories

---

**Time to Complete:** ~5 minutes
**Difficulty:** Easy
**Prerequisites:** PHP, Composer, MySQL installed
