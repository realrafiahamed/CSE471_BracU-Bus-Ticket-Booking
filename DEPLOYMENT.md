# Vercel Deployment Guide - BRACU Transport System

This guide will help you deploy your Laravel application to Vercel.

## 📋 Prerequisites

- [Vercel Account](https://vercel.com/signup) (free)
- [Vercel CLI](https://vercel.com/download) installed
- Cloud MySQL database (PlanetScale, Railway, or AWS RDS)

## 🗄️ Step 1: Setup Cloud Database

### Option A: PlanetScale (Recommended)

1. Sign up at [planetscale.com](https://planetscale.com)
2. Create a new database named `bracu_transport`
3. Get connection details (host, username, password, database name)
4. Note down the connection string

### Option B: Railway

1. Sign up at [railway.app](https://railway.app)
2. Create new project → Add MySQL
3. Copy the connection details from the Connect tab

### Option C: AWS RDS

1. Create a MySQL instance on AWS RDS
2. Configure security groups to allow connections
3. Note down endpoint and credentials

## 🚀 Step 2: Deploy to Vercel

### Using Vercel CLI

```powershell
# Install Vercel CLI globally
npm i -g vercel

# Login to Vercel
vercel login

# Deploy from project directory
cd "C:\Users\nidhi\Documents\cse 471\471 PROJECT -MODULE 1"
vercel --prod
```

### Using Vercel Dashboard

1. Go to [vercel.com/new](https://vercel.com/new)
2. Import your Git repository (GitHub, GitLab, or Bitbucket)
3. Configure project settings:
   - **Framework Preset:** Other
   - **Build Command:** (leave empty)
   - **Output Directory:** public

## ⚙️ Step 3: Configure Environment Variables

In Vercel dashboard → Settings → Environment Variables, add:

```env
APP_NAME=BRACU Transport
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.vercel.app

DB_CONNECTION=mysql
DB_HOST=your-database-host.com
DB_PORT=3306
DB_DATABASE=bracu_transport
DB_USERNAME=your-db-username
DB_PASSWORD=your-db-password

CACHE_DRIVER=array
SESSION_DRIVER=cookie
LOG_CHANNEL=stderr
VIEW_COMPILED_PATH=/tmp
```

### Generate APP_KEY

```powershell
# Run locally to generate a key
php artisan key:generate --show
```

Copy the generated key (including `base64:` prefix) to Vercel environment variables.

## 📊 Step 4: Run Migrations on Cloud Database

### Method 1: Using Local Laravel with Cloud DB

1. Update your local `.env` with cloud database credentials:

```env
DB_HOST=your-cloud-database-host.com
DB_PORT=3306
DB_DATABASE=bracu_transport
DB_USERNAME=your-db-username
DB_PASSWORD=your-db-password
```

2. Run migrations:

```powershell
php artisan migrate
php artisan db:seed --class=BusRouteSeeder
```

### Method 2: Using SQL Import

1. Export your local database:

```powershell
# Export database schema and data
mysqldump -u root -p bracu_transport > bracu_transport.sql
```

2. Import to cloud database using their CLI or dashboard

### Method 3: Using Vercel Serverless Function

Create `api/migrate.php`:

```php
<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->call('migrate', ['--force' => true]);
$kernel->call('db:seed', ['--class' => 'BusRouteSeeder', '--force' => true]);

echo "Migration completed!";
```

Visit: `https://your-app.vercel.app/api/migrate.php` (once only, then delete the file)

## ✅ Step 5: Verify Deployment

1. Visit your Vercel URL: `https://your-app.vercel.app`
2. Test the search functionality
3. Check all routes page
4. Verify database connections work

## 🔍 Testing Your Deployment

### Test Search Functionality
```
https://your-app.vercel.app/search?pickup_location=Mirpur&dropoff_location=BRACU
```

### Test All Routes Page
```
https://your-app.vercel.app/all-routes
```

## 🐛 Troubleshooting

### Issue: "500 Internal Server Error"

**Check Vercel Logs:**
```powershell
vercel logs your-deployment-url
```

**Common fixes:**
- Verify `APP_KEY` is set in environment variables
- Check database credentials are correct
- Ensure `vercel.json` is in project root

### Issue: "SQLSTATE[HY000] [2002] Connection refused"

**Solution:**
- Double-check database host, port, username, and password
- Ensure cloud database allows connections from Vercel IPs
- For PlanetScale, use the correct connection string format

### Issue: "View not found"

**Solution:**
- Clear all caches: `php artisan optimize:clear`
- Redeploy: `vercel --prod`

### Issue: CSS/JS not loading

**Solution:**
- Check `vercel.json` routes configuration
- Ensure TailwindCSS CDN link is in layout file
- Verify public assets are accessible

## 📝 Post-Deployment Checklist

- [ ] Homepage loads correctly
- [ ] Search functionality works
- [ ] All routes page displays data
- [ ] Database connections are stable
- [ ] No console errors in browser
- [ ] Mobile responsive design works
- [ ] All environment variables are set
- [ ] APP_DEBUG is set to `false`

## 🔄 Redeployment

To deploy updates:

```powershell
# Make your changes, then:
vercel --prod
```

Or push to your Git repository if connected.

## 🌐 Custom Domain (Optional)

1. Go to Project Settings → Domains
2. Add your custom domain
3. Update DNS records as instructed
4. Update `APP_URL` in environment variables

## 🔐 Security Best Practices

- ✅ Set `APP_DEBUG=false` in production
- ✅ Use strong database passwords
- ✅ Keep `APP_KEY` secret
- ✅ Enable database SSL if available
- ✅ Regularly update dependencies: `composer update`

## 📚 Additional Resources

- [Vercel Documentation](https://vercel.com/docs)
- [Laravel Deployment Docs](https://laravel.com/docs/deployment)
- [PlanetScale Laravel Guide](https://planetscale.com/docs/tutorials/connect-laravel-app)

## 💡 Tips

- Vercel has a **generous free tier** for hobby projects
- Use **PlanetScale's free tier** for the database (5GB storage)
- Monitor your deployment with Vercel's analytics
- Set up **preview deployments** for testing before production

---

**Deployment Time:** ~15-20 minutes
**Cost:** Free (with free tier services)
**Difficulty:** Intermediate

🎉 **Congratulations!** Your BRACU Transport System is now live on Vercel!
