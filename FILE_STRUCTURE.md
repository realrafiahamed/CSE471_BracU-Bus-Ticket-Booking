# 📂 BRACU Transport System - File Structure

```
471 PROJECT -MODULE 1/
│
├── 📁 app/
│   ├── 📁 Http/
│   │   └── 📁 Controllers/
│   │       └── 📄 BusRouteController.php       # Main controller for routes
│   └── 📁 Models/
│       └── 📄 BusRoute.php                     # Eloquent model with search logic
│
├── 📁 database/
│   ├── 📁 migrations/
│   │   └── 📄 2024_12_02_000001_create_bus_routes_table.php  # Database schema
│   └── 📁 seeders/
│       ├── 📄 DatabaseSeeder.php               # Main seeder
│       └── 📄 BusRouteSeeder.php               # 17 demo routes
│
├── 📁 resources/
│   └── 📁 views/
│       ├── 📁 layouts/
│       │   └── 📄 app.blade.php                # Main layout (nav, footer)
│       └── 📁 bus-routes/
│           ├── 📄 index.blade.php              # Homepage with search
│           └── 📄 all.blade.php                # All routes page
│
├── 📁 routes/
│   └── 📄 web.php                              # Application routes
│
├── 📁 api/
│   └── 📄 index.php                            # Vercel entry point
│
├── 📄 .env.example                             # Environment variables template
├── 📄 vercel.json                              # Vercel deployment config
│
├── 📄 README.md                                # Complete documentation
├── 📄 QUICKSTART.md                            # 5-minute setup guide
├── 📄 DEPLOYMENT.md                            # Vercel deployment guide
├── 📄 MODULE1_SUMMARY.md                       # Implementation summary
└── 📄 FILE_STRUCTURE.md                        # This file
```

---

## 📋 File Descriptions

### Backend Files

| File | Purpose | Key Features |
|------|---------|--------------|
| `BusRoute.php` | Eloquent Model | Search methods, location getters, duration formatting |
| `BusRouteController.php` | Controller | Index, search, and allRoutes actions |
| `web.php` | Routes Definition | 3 routes: home, search, all-routes |

### Database Files

| File | Purpose | Data |
|------|---------|------|
| `create_bus_routes_table.php` | Migration | 12 columns including times, fare, seats |
| `BusRouteSeeder.php` | Demo Data | 17 realistic BRACU bus routes |
| `DatabaseSeeder.php` | Seeder Registry | Calls BusRouteSeeder |

### Frontend Files

| File | Purpose | Components |
|------|---------|-----------|
| `app.blade.php` | Main Layout | Navigation, header, footer, CDN includes |
| `index.blade.php` | Search Page | Search form, autocomplete, results display |
| `all.blade.php` | All Routes | Complete route listing |

### Configuration Files

| File | Purpose | Usage |
|------|---------|-------|
| `.env.example` | Environment Template | Copy to `.env` and configure |
| `vercel.json` | Deployment Config | Routes, builds, environment |
| `api/index.php` | Serverless Entry | Forwards requests to Laravel |

### Documentation Files

| File | Purpose | Audience |
|------|---------|----------|
| `README.md` | Main Documentation | Developers, setup instructions |
| `QUICKSTART.md` | Fast Setup | New users, quick start |
| `DEPLOYMENT.md` | Deployment Guide | DevOps, production deployment |
| `MODULE1_SUMMARY.md` | Implementation Summary | Project review, stakeholders |
| `FILE_STRUCTURE.md` | Project Structure | Developers, onboarding |

---

## 🎯 Key Directories

### `/app` - Application Core
Contains models and controllers that handle business logic

### `/database` - Database Layer
Migrations for schema and seeders for demo data

### `/resources/views` - Frontend Templates
Blade templates styled with TailwindCSS

### `/routes` - Route Definitions
Web routes connecting URLs to controller actions

### `/api` - Serverless Functions
Vercel-specific entry points for deployment

---

## 📊 File Statistics

| Type | Count | Total Lines |
|------|-------|-------------|
| Models | 1 | ~80 |
| Controllers | 1 | ~60 |
| Migrations | 1 | ~40 |
| Seeders | 2 | ~280 |
| Views | 3 | ~400 |
| Routes | 1 | ~20 |
| Config | 3 | ~100 |
| Docs | 5 | ~600 |
| **Total** | **17** | **~1,580** |

---

## 🔗 File Dependencies

```
index.blade.php
    ├── extends: app.blade.php
    ├── uses: BusRouteController@index
    └── displays: BusRoute model data

all.blade.php
    ├── extends: app.blade.php
    ├── uses: BusRouteController@allRoutes
    └── displays: BusRoute model data

web.php
    └── references: BusRouteController

BusRouteController.php
    ├── uses: BusRoute model
    └── returns: views (index, all)

BusRoute.php
    └── uses: bus_routes table

BusRouteSeeder.php
    └── creates: BusRoute records
```

---

## 🚀 Execution Flow

### 1. Homepage Visit (`/`)
```
User Request → web.php → BusRouteController@index 
→ BusRoute::getPickupLocations() 
→ BusRoute::getDropoffLocations() 
→ index.blade.php → HTML Response
```

### 2. Search Request (`/search`)
```
User Request → web.php → BusRouteController@search 
→ BusRoute::searchRoutes($pickup, $dropoff) 
→ index.blade.php (with results) → HTML Response
```

### 3. All Routes (`/all-routes`)
```
User Request → web.php → BusRouteController@allRoutes 
→ BusRoute::where('status', 'active')->get() 
→ all.blade.php → HTML Response
```

---

## 📦 Required Laravel Directories (Standard)

These directories should exist in a full Laravel installation:

```
├── bootstrap/          # Framework bootstrap files
├── config/            # Configuration files
├── public/            # Public assets (entry point)
├── storage/           # Logs, cache, uploads
├── tests/             # Test files
├── vendor/            # Composer dependencies
├── artisan            # CLI tool
├── composer.json      # PHP dependencies
└── package.json       # NPM dependencies (optional)
```

---

## 💡 Tips for Navigation

1. **Start with:** `README.md` or `QUICKSTART.md`
2. **Understand routes:** Check `routes/web.php`
3. **See database:** Review `database/migrations/` and `database/seeders/`
4. **View logic:** Look at `app/Http/Controllers/BusRouteController.php`
5. **Check UI:** Browse `resources/views/bus-routes/`
6. **Deploy:** Follow `DEPLOYMENT.md`

---

## 🔍 Quick File Finder

**Need to modify...**

| What | File Location |
|------|---------------|
| Database schema | `database/migrations/2024_12_02_000001_create_bus_routes_table.php` |
| Demo data | `database/seeders/BusRouteSeeder.php` |
| Search logic | `app/Models/BusRoute.php` |
| Controller actions | `app/Http/Controllers/BusRouteController.php` |
| Homepage design | `resources/views/bus-routes/index.blade.php` |
| Navigation/footer | `resources/views/layouts/app.blade.php` |
| URL routes | `routes/web.php` |
| Vercel config | `vercel.json` |
| Environment vars | `.env` (copy from `.env.example`) |

---

**Last Updated:** December 2, 2024
**Module:** 1 - Search & View Routes
**Status:** Complete ✅
