# BRACU Transport System - Complete Project Flow & Structure Documentation

**Project Name:** BRACU Transport Ticket Booking System  
**Module:** 1 - Search & View Bus Routes  
**Date:** December 3, 2025  
**Course:** CSE 471 - System Analysis and Design

---

## Table of Contents

1. [Project Overview](#project-overview)
2. [Application Flow](#application-flow)
3. [Folder Structure Explained](#folder-structure-explained)
4. [How the System Works](#how-the-system-works)
5. [Database Flow](#database-flow)
6. [File-by-File Explanation](#file-by-file-explanation)
7. [Request-Response Cycle](#request-response-cycle)
8. [Technology Stack Details](#technology-stack-details)

---

## 1. Project Overview

### What is This System?

The **BRACU Transport Ticket Booking System** is a web application that helps BRAC University students search for and view available bus routes from various locations in Dhaka to the BRACU campus in Merul Badda.

### Key Features

✅ **Search Bus Routes:** Students enter pickup and dropoff locations  
✅ **View Route Details:** See schedules, fares, seats, and timings  
✅ **Browse All Routes:** View complete list of 17 available routes  
✅ **Autocomplete Suggestions:** Easy location selection  
✅ **Responsive Design:** Works on mobile, tablet, and desktop

---

## 2. Application Flow

### High-Level Flow Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                         STUDENT/USER                         │
│                    (Opens Browser)                           │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                    HOMEPAGE (index.blade.php)                │
│   ┌──────────────────────────────────────────────────┐      │
│   │  🚌 BRACU Transport                              │      │
│   │                                                   │      │
│   │  📍 Pickup Location:  [_____________]            │      │
│   │  📍 Dropoff Location: [_____________]            │      │
│   │                                                   │      │
│   │           [🔍 Search Routes Button]              │      │
│   └──────────────────────────────────────────────────┘      │
└────────────────────────────┬────────────────────────────────┘
                             │ User clicks "Search Routes"
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                    WEB ROUTE (web.php)                       │
│   Route::get('/search', [BusRouteController, 'search'])     │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│              CONTROLLER (BusRouteController.php)             │
│                                                              │
│   public function search(Request $request) {                │
│       $pickup = $request->input('pickup_location');         │
│       $dropoff = $request->input('dropoff_location');       │
│       $routes = BusRoute::searchRoutes($pickup, $dropoff);  │
│       return view('bus-routes.index', compact('routes'));   │
│   }                                                          │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                    MODEL (BusRoute.php)                      │
│                                                              │
│   public static function searchRoutes($pickup, $dropoff) {  │
│       return self::where('pickup_location', 'LIKE', ...)    │
│                   ->where('dropoff_location', 'LIKE', ...)  │
│                   ->where('status', 'active')               │
│                   ->orderBy('departure_time')               │
│                   ->get();                                  │
│   }                                                          │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                   DATABASE (MySQL)                           │
│                                                              │
│   SELECT * FROM bus_routes                                  │
│   WHERE pickup_location LIKE '%Mirpur%'                     │
│   AND dropoff_location LIKE '%BRACU%'                       │
│   AND status = 'active'                                     │
│   ORDER BY departure_time                                   │
└────────────────────────────┬────────────────────────────────┘
                             │ Returns matching routes
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                   VIEW (index.blade.php)                     │
│                                                              │
│   @foreach($routes as $route)                               │
│       <div class="route-card">                              │
│           <h4>{{ $route->route_name }}</h4>                 │
│           <p>From: {{ $route->pickup_location }}</p>        │
│           <p>To: {{ $route->dropoff_location }}</p>         │
│           <p>Fare: ৳{{ $route->fare }}</p>                   │
│       </div>                                                 │
│   @endforeach                                                │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                    BROWSER (User Sees Results)               │
│                                                              │
│   ✅ BRACU-101: Mirpur 10 → BRACU Campus (৳50)              │
│   ✅ BRACU-102: Mirpur 1 → BRACU Campus (৳45)               │
└─────────────────────────────────────────────────────────────┘
```

---

## 3. Folder Structure Explained

### Complete Directory Tree

```
471 PROJECT -MODULE 1/
│
├── app/                          # Application Core Logic
│   ├── Http/
│   │   └── Controllers/
│   │       └── BusRouteController.php    # Handles search requests
│   └── Models/
│       └── BusRoute.php                  # Database model for bus routes
│
├── bootstrap/                    # Laravel Bootstrap Files
│   └── app.php                   # Application bootstrapping
│
├── config/                       # Configuration Files
│   ├── app.php                   # App settings (name, timezone, etc.)
│   ├── database.php              # Database connection settings
│   └── ...                       # Other config files
│
├── database/                     # Database Related Files
│   ├── migrations/
│   │   └── 2024_12_02_000001_create_bus_routes_table.php
│   │                             # Creates bus_routes table schema
│   └── seeders/
│       ├── DatabaseSeeder.php    # Main seeder file
│       └── BusRouteSeeder.php    # Seeds 17 demo bus routes
│
├── public/                       # Publicly Accessible Files
│   ├── index.php                 # Application entry point
│   └── ...                       # CSS, JS, images (if any)
│
├── resources/                    # Frontend Resources
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php     # Main layout template (header, footer)
│       └── bus-routes/
│           ├── index.blade.php   # Homepage with search form
│           └── all.blade.php     # All routes listing page
│
├── routes/                       # Route Definitions
│   └── web.php                   # Web routes (homepage, search, etc.)
│
├── storage/                      # Storage for logs, cache, uploads
│   ├── app/                      # Application storage
│   ├── framework/                # Framework cache, sessions
│   └── logs/                     # Application logs
│
├── vendor/                       # Composer Dependencies (Laravel, packages)
│
├── .env                          # Environment Configuration (DB credentials)
├── .env.example                  # Example environment file
├── artisan                       # Laravel command-line tool
├── composer.json                 # PHP dependencies definition
├── composer.lock                 # Locked dependency versions
├── package.json                  # NPM dependencies (if any)
│
├── README.md                     # Main documentation
├── QUICKSTART.md                 # Quick setup guide
├── DEPLOYMENT.md                 # Vercel deployment guide
├── COMMANDS.md                   # Laravel commands reference
├── OVERVIEW.md                   # Visual overview
└── vercel.json                   # Vercel deployment configuration
```

---

## 4. How the System Works

### Step-by-Step Execution Flow

#### **Step 1: User Opens Homepage**

1. User types `http://localhost:8000` in browser
2. Browser sends GET request to Laravel server
3. Server receives request at `public/index.php`
4. Laravel routes the request to `routes/web.php`

**Code in `routes/web.php`:**
```php
Route::get('/', [BusRouteController::class, 'index'])->name('home');
```

5. Laravel calls `BusRouteController@index` method

---

#### **Step 2: Controller Prepares Data**

**Code in `app/Http/Controllers/BusRouteController.php`:**
```php
public function index()
{
    // Get all unique pickup locations from database
    $pickupLocations = BusRoute::getPickupLocations();
    
    // Get all unique dropoff locations from database
    $dropoffLocations = BusRoute::getDropoffLocations();
    
    // Send data to view
    return view('bus-routes.index', compact('pickupLocations', 'dropoffLocations'));
}
```

**What happens:**
- Controller asks the BusRoute model for all pickup locations
- Controller asks for all dropoff locations
- Controller passes this data to the view

---

#### **Step 3: Model Fetches Data from Database**

**Code in `app/Models/BusRoute.php`:**
```php
public static function getPickupLocations()
{
    return self::where('status', 'active')
        ->distinct()
        ->pluck('pickup_location')
        ->sort()
        ->values();
}
```

**SQL Query Generated:**
```sql
SELECT DISTINCT pickup_location 
FROM bus_routes 
WHERE status = 'active' 
ORDER BY pickup_location ASC;
```

**Returns:**
- Mirpur 10
- Mirpur 1
- Uttara Sector 7
- Uttara Sector 3
- Mohakhali Bus Stand
- ... (and more)

---

#### **Step 4: View Renders HTML**

**Code in `resources/views/bus-routes/index.blade.php`:**
```blade
<form action="{{ route('bus-routes.search') }}" method="GET">
    <input 
        type="text" 
        name="pickup_location" 
        list="pickup-suggestions"
    >
    <datalist id="pickup-suggestions">
        @foreach($pickupLocations as $location)
            <option value="{{ $location }}">
        @endforeach
    </datalist>
    
    <button type="submit">Search Routes</button>
</form>
```

**What happens:**
- Blade template loops through pickup locations
- Creates autocomplete suggestions
- Generates HTML form
- Sends HTML to browser

---

#### **Step 5: User Searches for Routes**

1. User enters "Mirpur 10" in pickup field
2. User enters "BRACU Campus" in dropoff field
3. User clicks "Search Routes" button
4. Browser submits form to `/search?pickup_location=Mirpur 10&dropoff_location=BRACU Campus`

---

#### **Step 6: Search Request Processing**

**Route in `routes/web.php`:**
```php
Route::get('/search', [BusRouteController::class, 'search'])->name('bus-routes.search');
```

**Controller Method:**
```php
public function search(Request $request)
{
    // Get user input
    $pickup = $request->input('pickup_location');   // "Mirpur 10"
    $dropoff = $request->input('dropoff_location'); // "BRACU Campus"
    
    // Search database
    $routes = BusRoute::searchRoutes($pickup, $dropoff);
    
    // Return view with results
    return view('bus-routes.index', compact('routes', 'pickup', 'dropoff', ...));
}
```

---

#### **Step 7: Model Searches Database**

**Code in `app/Models/BusRoute.php`:**
```php
public static function searchRoutes($pickup, $dropoff)
{
    $query = self::where('status', 'active');

    if (!empty($pickup)) {
        $query->where('pickup_location', 'LIKE', '%' . $pickup . '%');
    }

    if (!empty($dropoff)) {
        $query->where('dropoff_location', 'LIKE', '%' . $dropoff . '%');
    }

    return $query->orderBy('departure_time')->get();
}
```

**SQL Query Generated:**
```sql
SELECT * FROM bus_routes 
WHERE status = 'active' 
AND pickup_location LIKE '%Mirpur 10%' 
AND dropoff_location LIKE '%BRACU Campus%' 
ORDER BY departure_time ASC;
```

**Database Returns:**
```
[
    {
        id: 1,
        route_name: "Mirpur-BRACU Direct",
        bus_number: "BRACU-101",
        pickup_location: "Mirpur 10",
        dropoff_location: "BRACU Campus, Merul Badda",
        departure_time: "07:00:00",
        arrival_time: "08:15:00",
        duration_minutes: 75,
        fare: 50.00,
        available_seats: 40,
        status: "active",
        days_operating: "Monday-Saturday"
    },
    {
        id: 2,
        route_name: "Mirpur-BRACU Morning",
        bus_number: "BRACU-102",
        ...
    }
]
```

---

#### **Step 8: View Displays Results**

**Code in `resources/views/bus-routes/index.blade.php`:**
```blade
@if(isset($routes))
    @if($routes->isEmpty())
        <p>No routes found</p>
    @else
        @foreach($routes as $route)
            <div class="route-card">
                <span class="bus-number">{{ $route->bus_number }}</span>
                <h4>{{ $route->route_name }}</h4>
                
                <p>From: {{ $route->pickup_location }}</p>
                <p>To: {{ $route->dropoff_location }}</p>
                
                <p>Departs: {{ date('g:i A', strtotime($route->departure_time)) }}</p>
                <p>Arrives: {{ date('g:i A', strtotime($route->arrival_time)) }}</p>
                
                <p>Fare: ৳{{ number_format($route->fare, 0) }}</p>
                <p>Seats: {{ $route->available_seats }}</p>
            </div>
        @endforeach
    @endif
@endif
```

**Browser Displays:**
- Beautiful cards with route information
- TailwindCSS styling
- Icons and colors
- Responsive layout

---

## 5. Database Flow

### Database Schema

**Table Name:** `bus_routes`

| Column Name | Data Type | Description |
|-------------|-----------|-------------|
| id | BIGINT (Primary Key) | Auto-incrementing ID |
| route_name | VARCHAR(255) | Route name (e.g., "Mirpur-BRACU Direct") |
| bus_number | VARCHAR(255) | Bus identifier (e.g., "BRACU-101") |
| pickup_location | VARCHAR(255) | Starting point (e.g., "Mirpur 10") |
| dropoff_location | VARCHAR(255) | Destination (e.g., "BRACU Campus") |
| departure_time | TIME | Departure time (e.g., "07:00:00") |
| arrival_time | TIME | Arrival time (e.g., "08:15:00") |
| duration_minutes | INTEGER | Journey duration in minutes |
| fare | DECIMAL(8,2) | Ticket price (e.g., 50.00) |
| available_seats | INTEGER | Number of available seats |
| status | ENUM('active','inactive') | Route status |
| days_operating | VARCHAR(255) | Operating days (e.g., "Monday-Saturday") |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |

---

### Database Operations

#### **1. Creating the Table (Migration)**

**File:** `database/migrations/2024_12_02_000001_create_bus_routes_table.php`

```php
Schema::create('bus_routes', function (Blueprint $table) {
    $table->id();
    $table->string('route_name');
    $table->string('bus_number');
    $table->string('pickup_location');
    $table->string('dropoff_location');
    $table->time('departure_time');
    $table->time('arrival_time');
    $table->integer('duration_minutes');
    $table->decimal('fare', 8, 2);
    $table->integer('available_seats');
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->string('days_operating')->default('Monday-Friday');
    $table->timestamps();
});
```

**Command to Run:**
```bash
php artisan migrate
```

**What Happens:**
- Laravel reads the migration file
- Generates SQL CREATE TABLE statement
- Executes it on MySQL database
- Table `bus_routes` is created

---

#### **2. Seeding Demo Data**

**File:** `database/seeders/BusRouteSeeder.php`

```php
public function run(): void
{
    $routes = [
        [
            'route_name' => 'Mirpur-BRACU Direct',
            'bus_number' => 'BRACU-101',
            'pickup_location' => 'Mirpur 10',
            'dropoff_location' => 'BRACU Campus, Merul Badda',
            'departure_time' => '07:00:00',
            'arrival_time' => '08:15:00',
            'duration_minutes' => 75,
            'fare' => 50.00,
            'available_seats' => 40,
            'status' => 'active',
            'days_operating' => 'Monday-Saturday'
        ],
        // ... 16 more routes
    ];

    foreach ($routes as $route) {
        BusRoute::create($route);
    }
}
```

**Command to Run:**
```bash
php artisan db:seed --class=BusRouteSeeder
```

**What Happens:**
- Laravel loops through the routes array
- For each route, executes INSERT SQL statement
- 17 routes are added to the database

---

#### **3. Querying Data (Model)**

**Eloquent ORM Examples:**

```php
// Get all active routes
BusRoute::where('status', 'active')->get();

// Search by pickup location
BusRoute::where('pickup_location', 'LIKE', '%Mirpur%')->get();

// Get routes with fare less than 40 taka
BusRoute::where('fare', '<', 40)->get();

// Get morning routes (before 8 AM)
BusRoute::where('departure_time', '<', '08:00:00')->get();

// Count total routes
BusRoute::count();

// Get first route
BusRoute::first();
```

---

## 6. File-by-File Explanation

### **A. Backend Files**

#### **1. `app/Models/BusRoute.php`** ⭐

**Purpose:** Represents the bus_routes table in code. Handles all database operations related to bus routes.

**Key Features:**
```php
class BusRoute extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'route_name', 'bus_number', 'pickup_location', 
        'dropoff_location', 'departure_time', 'arrival_time', 
        'duration_minutes', 'fare', 'available_seats', 
        'status', 'days_operating'
    ];

    // Search routes by pickup/dropoff
    public static function searchRoutes($pickup, $dropoff) { ... }

    // Get all unique pickup locations
    public static function getPickupLocations() { ... }

    // Get all unique dropoff locations
    public static function getDropoffLocations() { ... }

    // Format duration as "1h 15m"
    public function getFormattedDurationAttribute() { ... }
}
```

**Real-World Usage:**
```php
// In controller:
$routes = BusRoute::searchRoutes('Mirpur', 'BRACU');

// In view:
foreach($routes as $route) {
    echo $route->route_name;
    echo $route->formatted_duration; // Uses accessor
}
```

---

#### **2. `app/Http/Controllers/BusRouteController.php`** ⭐

**Purpose:** Handles HTTP requests related to bus routes. Acts as the middleman between user requests and the database.

**Methods:**

**a) `index()` - Homepage**
```php
public function index()
{
    // Get location lists for autocomplete
    $pickupLocations = BusRoute::getPickupLocations();
    $dropoffLocations = BusRoute::getDropoffLocations();
    
    // Show homepage with search form
    return view('bus-routes.index', compact('pickupLocations', 'dropoffLocations'));
}
```
**Handles:** `GET /`

---

**b) `search()` - Search Results**
```php
public function search(Request $request)
{
    // Validate input (optional but good practice)
    $request->validate([
        'pickup_location' => 'nullable|string|max:255',
        'dropoff_location' => 'nullable|string|max:255',
    ]);

    // Get search parameters
    $pickup = $request->input('pickup_location');
    $dropoff = $request->input('dropoff_location');

    // Search database
    $routes = BusRoute::searchRoutes($pickup, $dropoff);

    // Get location lists for form
    $pickupLocations = BusRoute::getPickupLocations();
    $dropoffLocations = BusRoute::getDropoffLocations();

    // Show results
    return view('bus-routes.index', compact('routes', 'pickup', 'dropoff', 'pickupLocations', 'dropoffLocations'));
}
```
**Handles:** `GET /search?pickup_location=X&dropoff_location=Y`

---

**c) `allRoutes()` - All Routes Page**
```php
public function allRoutes()
{
    // Get all active routes, sorted
    $routes = BusRoute::where('status', 'active')
        ->orderBy('pickup_location')
        ->orderBy('departure_time')
        ->get();

    // Show all routes page
    return view('bus-routes.all', compact('routes'));
}
```
**Handles:** `GET /all-routes`

---

#### **3. `routes/web.php`** ⭐

**Purpose:** Defines all web URLs and maps them to controller methods.

```php
use App\Http\Controllers\BusRouteController;
use Illuminate\Support\Facades\Route;

// Homepage - search form
Route::get('/', [BusRouteController::class, 'index'])->name('home');

// Search results
Route::get('/search', [BusRouteController::class, 'search'])->name('bus-routes.search');

// All routes page
Route::get('/all-routes', [BusRouteController::class, 'allRoutes'])->name('bus-routes.all');
```

**How It Works:**
- User visits `/` → Calls `BusRouteController@index`
- User visits `/search?...` → Calls `BusRouteController@search`
- User visits `/all-routes` → Calls `BusRouteController@allRoutes`

---

#### **4. `database/migrations/2024_12_02_000001_create_bus_routes_table.php`**

**Purpose:** Database schema definition. Creates the bus_routes table structure.

```php
public function up(): void
{
    Schema::create('bus_routes', function (Blueprint $table) {
        $table->id();                              // Primary key
        $table->string('route_name');              // Route name
        $table->string('bus_number');              // Bus number
        $table->string('pickup_location');         // Pickup point
        $table->string('dropoff_location');        // Dropoff point
        $table->time('departure_time');            // Departure time
        $table->time('arrival_time');              // Arrival time
        $table->integer('duration_minutes');       // Duration
        $table->decimal('fare', 8, 2);            // Fare amount
        $table->integer('available_seats');        // Available seats
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->string('days_operating')->default('Monday-Friday');
        $table->timestamps();                      // created_at, updated_at
    });
}

public function down(): void
{
    Schema::dropIfExists('bus_routes');           // Rollback
}
```

**Commands:**
- `php artisan migrate` - Creates table
- `php artisan migrate:rollback` - Drops table

---

#### **5. `database/seeders/BusRouteSeeder.php`**

**Purpose:** Populates database with 17 demo BRACU bus routes.

**Structure:**
```php
public function run(): void
{
    $routes = [
        // 17 route arrays with realistic Dhaka data
    ];

    foreach ($routes as $route) {
        BusRoute::create($route);
    }
}
```

**Demo Data Includes:**
- Routes from Mirpur (1, 10) to BRACU
- Routes from Uttara (Sector 3, 7) to BRACU
- Routes from Mohakhali, Dhanmondi, Gulshan, Banani
- Return routes from BRACU to various locations

**Command:**
```bash
php artisan db:seed --class=BusRouteSeeder
```

---

### **B. Frontend Files**

#### **6. `resources/views/layouts/app.blade.php`** ⭐

**Purpose:** Main layout template. Contains header, navigation, and footer that appear on all pages.

**Structure:**
```blade
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'BRACU Transport')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="font-awesome.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <a href="{{ route('home') }}">BRACU Transport</a>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('bus-routes.all') }}">All Routes</a>
    </nav>

    <!-- Main Content Area (changes per page) -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        © 2024 BRACU Transport System
    </footer>
</body>
</html>
```

**How Child Views Use It:**
```blade
@extends('layouts.app')

@section('content')
    <h1>My Page Content</h1>
@endsection
```

---

#### **7. `resources/views/bus-routes/index.blade.php`** ⭐⭐⭐

**Purpose:** Homepage with search form and results display. This is the main user-facing page.

**Key Sections:**

**A. Hero Section:**
```blade
<div class="hero">
    <h2>🗺️ Find Your Bus Route</h2>
    <p>Search for available bus routes to BRAC University</p>
</div>
```

**B. Search Form:**
```blade
<form action="{{ route('bus-routes.search') }}" method="GET">
    <!-- Pickup Location Input -->
    <input 
        type="text" 
        name="pickup_location" 
        value="{{ old('pickup_location', $pickup ?? '') }}"
        list="pickup-suggestions"
        placeholder="e.g., Mirpur 10, Uttara"
    >
    <datalist id="pickup-suggestions">
        @foreach($pickupLocations as $location)
            <option value="{{ $location }}">
        @endforeach
    </datalist>

    <!-- Dropoff Location Input -->
    <input 
        type="text" 
        name="dropoff_location" 
        value="{{ old('dropoff_location', $dropoff ?? '') }}"
        list="dropoff-suggestions"
        placeholder="e.g., BRACU Campus"
    >
    <datalist id="dropoff-suggestions">
        @foreach($dropoffLocations as $location)
            <option value="{{ $location }}">
        @endforeach
    </datalist>

    <!-- Search Button -->
    <button type="submit">🔍 Search Routes</button>
</form>
```

**C. Search Results:**
```blade
@if(isset($routes))
    <h3>Available Routes ({{ $routes->count() }} found)</h3>

    @if($routes->isEmpty())
        <p>No routes found. Try different locations.</p>
    @else
        @foreach($routes as $route)
            <div class="route-card">
                <!-- Bus Number Badge -->
                <span class="bus-number">{{ $route->bus_number }}</span>
                
                <!-- Route Name -->
                <h4>{{ $route->route_name }}</h4>
                
                <!-- Route Details -->
                <p>📍 From: {{ $route->pickup_location }}</p>
                <p>📍 To: {{ $route->dropoff_location }}</p>
                
                <p>🕐 Departs: {{ date('g:i A', strtotime($route->departure_time)) }}</p>
                <p>🕐 Arrives: {{ date('g:i A', strtotime($route->arrival_time)) }}</p>
                <p>⏱️ Duration: {{ $route->formatted_duration }}</p>
                
                <p>💰 Fare: ৳{{ number_format($route->fare, 0) }}</p>
                <p>🪑 Seats: {{ $route->available_seats }} available</p>
                
                <p>📅 {{ $route->days_operating }}</p>
            </div>
        @endforeach
    @endif
@endif
```

**D. Quick Info Cards:**
```blade
<div class="info-cards">
    <div class="card">
        <i class="fas fa-route"></i>
        <h4>Multiple Routes</h4>
        <p>Choose from various pickup points</p>
    </div>
    
    <div class="card">
        <i class="fas fa-clock"></i>
        <h4>Timely Service</h4>
        <p>Punctual buses Monday to Saturday</p>
    </div>
    
    <div class="card">
        <i class="fas fa-money-bill-wave"></i>
        <h4>Affordable Fares</h4>
        <p>Budget-friendly pricing</p>
    </div>
</div>
```

---

#### **8. `resources/views/bus-routes/all.blade.php`**

**Purpose:** Displays all available routes in one page.

**Structure:**
```blade
@extends('layouts.app')

@section('title', 'All Bus Routes')

@section('content')
    <h2>All Bus Routes ({{ $routes->count() }} total)</h2>

    @foreach($routes as $route)
        <div class="route-card">
            <!-- Same card structure as index.blade.php -->
        </div>
    @endforeach
    
    <a href="{{ route('home') }}">← Back to Search</a>
@endsection
```

---

### **C. Configuration Files**

#### **9. `.env`** ⭐⭐⭐

**Purpose:** Environment-specific configuration. Contains sensitive data like database credentials.

**Important Settings:**
```env
APP_NAME="BRACU Transport"
APP_ENV=local
APP_KEY=base64:generated-encryption-key
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bracu_transport
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

**⚠️ Security Note:** Never commit `.env` to Git! Use `.env.example` as a template.

---

#### **10. `composer.json`**

**Purpose:** Defines PHP dependencies (Laravel, packages).

```json
{
    "require": {
        "php": "^8.1",
        "laravel/framework": "^10.0",
        "laravel/sanctum": "^3.3",
        "laravel/tinker": "^2.8"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Seeders\\": "database/seeders/"
        }
    }
}
```

**Command:** `composer install` downloads all packages.

---

#### **11. `vercel.json`**

**Purpose:** Configuration for deploying to Vercel (cloud hosting).

```json
{
    "version": 2,
    "builds": [
        {
            "src": "api/index.php",
            "use": "vercel-php@0.6.0"
        }
    ],
    "routes": [
        {
            "src": "/(.*)",
            "dest": "/api/index.php"
        }
    ]
}
```

---

## 7. Request-Response Cycle

### Complete Flow with Examples

#### **Example 1: Homepage Load**

**User Action:** Types `http://localhost:8000` in browser

**1. Browser → Server:**
```
GET / HTTP/1.1
Host: localhost:8000
```

**2. Laravel Routing (`routes/web.php`):**
```php
Route::get('/', [BusRouteController::class, 'index']);
```

**3. Controller (`BusRouteController@index`):**
```php
$pickupLocations = BusRoute::getPickupLocations();
$dropoffLocations = BusRoute::getDropoffLocations();
return view('bus-routes.index', compact(...));
```

**4. Model Queries Database:**
```sql
SELECT DISTINCT pickup_location FROM bus_routes WHERE status='active';
SELECT DISTINCT dropoff_location FROM bus_routes WHERE status='active';
```

**5. View Renders:**
```blade
<form>
    <input name="pickup_location" list="pickup-suggestions">
    <datalist>
        <option>Mirpur 10</option>
        <option>Uttara Sector 7</option>
        ...
    </datalist>
</form>
```

**6. Server → Browser:**
```
HTTP/1.1 200 OK
Content-Type: text/html

<!DOCTYPE html>
<html>
    <body>
        <form>...</form>
    </body>
</html>
```

**7. Browser Displays:** Beautiful homepage with search form

---

#### **Example 2: Search Request**

**User Action:** Enters "Mirpur 10" and "BRACU", clicks Search

**1. Browser → Server:**
```
GET /search?pickup_location=Mirpur+10&dropoff_location=BRACU HTTP/1.1
```

**2. Laravel Routing:**
```php
Route::get('/search', [BusRouteController::class, 'search']);
```

**3. Controller:**
```php
$pickup = 'Mirpur 10';
$dropoff = 'BRACU';
$routes = BusRoute::searchRoutes($pickup, $dropoff);
```

**4. Model Queries:**
```sql
SELECT * FROM bus_routes 
WHERE status = 'active' 
AND pickup_location LIKE '%Mirpur 10%' 
AND dropoff_location LIKE '%BRACU%' 
ORDER BY departure_time;
```

**5. Database Returns:** 2 matching routes (BRACU-101, BRACU-102)

**6. View Renders:**
```blade
@foreach($routes as $route)
    <div>{{ $route->route_name }}</div>
@endforeach
```

**7. Browser Displays:** 2 route cards with full details

---

## 8. Technology Stack Details

### **A. Backend Technologies**

#### **1. PHP (Version 8.1+)**
- **Purpose:** Server-side programming language
- **Usage:** Powers Laravel framework, handles business logic
- **File Locations:** All `.php` files

#### **2. Laravel (Version 10.x)**
- **Purpose:** PHP web application framework
- **Features Used:**
  - **Routing:** `routes/web.php`
  - **MVC Pattern:** Models, Views, Controllers
  - **Eloquent ORM:** Database queries without SQL
  - **Blade Templating:** Dynamic HTML generation
  - **Artisan CLI:** Command-line tools
  - **Migrations:** Database version control

#### **3. Composer**
- **Purpose:** PHP package manager
- **Usage:** Installs Laravel and dependencies
- **File:** `composer.json`

---

### **B. Frontend Technologies**

#### **1. Blade Templates**
- **Purpose:** Laravel's templating engine
- **Features:**
  - `@extends`, `@section`: Template inheritance
  - `@if`, `@foreach`: Control structures
  - `{{ }}`: Output variables safely
  - `{!! !!}`: Output raw HTML
- **File Extension:** `.blade.php`

#### **2. TailwindCSS (Version 3.x)**
- **Purpose:** Utility-first CSS framework
- **Usage:** Loaded via CDN in `app.blade.php`
- **Example Classes:**
  ```html
  <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg">
  ```

#### **3. Font Awesome (Version 6.4.0)**
- **Purpose:** Icon library
- **Icons Used:** `fa-bus`, `fa-map-marker-alt`, `fa-clock`, `fa-search`

---

### **C. Database Technologies**

#### **1. MySQL (Version 8.0+)**
- **Purpose:** Relational database management system
- **Usage:** Stores bus routes data
- **Table:** `bus_routes`

#### **2. Eloquent ORM**
- **Purpose:** Laravel's database abstraction layer
- **Features:**
  - Write PHP instead of SQL
  - Model relationships
  - Query builder
  - Soft deletes, timestamps

**Example:**
```php
// Eloquent (PHP)
BusRoute::where('fare', '<', 40)->get();

// Equivalent SQL
SELECT * FROM bus_routes WHERE fare < 40;
```

---

### **D. Development Tools**

#### **1. Artisan CLI**
- **Purpose:** Laravel command-line interface
- **Common Commands:**
  - `php artisan serve` - Start dev server
  - `php artisan migrate` - Run migrations
  - `php artisan db:seed` - Seed database
  - `php artisan tinker` - Interactive shell
  - `php artisan make:model` - Generate model
  - `php artisan make:controller` - Generate controller

#### **2. XAMPP**
- **Purpose:** Local development environment
- **Includes:**
  - Apache web server (not used, using `artisan serve` instead)
  - MySQL database
  - PHP interpreter
  - phpMyAdmin (database GUI)

---

## 9. Data Flow Examples

### **Example 1: Creating a New Route (Manual)**

**Step 1:** Open Tinker
```bash
php artisan tinker
```

**Step 2:** Create route
```php
>>> BusRoute::create([
    'route_name' => 'New Route',
    'bus_number' => 'BRACU-999',
    'pickup_location' => 'Test Location',
    'dropoff_location' => 'BRACU Campus',
    'departure_time' => '09:00:00',
    'arrival_time' => '10:00:00',
    'duration_minutes' => 60,
    'fare' => 45.00,
    'available_seats' => 35,
    'status' => 'active',
    'days_operating' => 'Monday-Friday'
]);
```

**What Happens:**
1. Eloquent validates data
2. Generates INSERT SQL
3. Executes on database
4. Returns created object

---

### **Example 2: Searching Routes (User Flow)**

**Step 1:** User enters search
- Pickup: "Uttara"
- Dropoff: "BRACU"

**Step 2:** Form submits to `/search`

**Step 3:** Controller receives request
```php
$pickup = $request->input('pickup_location'); // "Uttara"
$dropoff = $request->input('dropoff_location'); // "BRACU"
```

**Step 4:** Model searches database
```php
BusRoute::where('pickup_location', 'LIKE', '%Uttara%')
        ->where('dropoff_location', 'LIKE', '%BRACU%')
        ->where('status', 'active')
        ->get();
```

**Step 5:** Database executes query

**Step 6:** Returns matching routes:
- BRACU-201: Uttara Sector 7 → BRACU
- BRACU-202: Uttara Sector 3 → BRACU

**Step 7:** View loops and displays both routes

---

## 10. Summary

### What You've Built

✅ **Full-Stack Web Application**  
✅ **MVC Architecture**  
✅ **Database-Driven System**  
✅ **Responsive User Interface**  
✅ **Search Functionality**  
✅ **Production-Ready Code**

### File Count
- **Backend:** 6 files (Model, Controller, Routes, Migrations, Seeders)
- **Frontend:** 3 files (Layout, 2 Views)
- **Config:** 7 files (Environment, Composer, Vercel, Docs)
- **Total:** 16+ core files

### Technologies Mastered
1. ✅ PHP 8.1
2. ✅ Laravel 10.x Framework
3. ✅ MySQL Database
4. ✅ Eloquent ORM
5. ✅ Blade Templating
6. ✅ TailwindCSS
7. ✅ MVC Design Pattern
8. ✅ RESTful Routing

### Skills Gained
- Database design & migrations
- Model relationships & queries
- Controller logic
- View rendering
- Form handling
- Search implementation
- Responsive design
- Deployment configuration

---

## 11. Quick Reference

### Key Commands
```bash
# Start server
php artisan serve

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed --class=BusRouteSeeder

# Fresh start
php artisan migrate:fresh --seed

# Clear cache
php artisan optimize:clear

# Open Tinker (test code)
php artisan tinker
```

### Key URLs
- Homepage: `http://localhost:8000`
- Search: `http://localhost:8000/search?pickup_location=X&dropoff_location=Y`
- All Routes: `http://localhost:8000/all-routes`

### Important Files
- Model: `app/Models/BusRoute.php`
- Controller: `app/Http/Controllers/BusRouteController.php`
- Routes: `routes/web.php`
- Main View: `resources/views/bus-routes/index.blade.php`
- Environment: `.env`

---

**End of Documentation**

**Date Created:** December 3, 2025  
**Project:** BRACU Transport Ticket Booking System  
**Module:** 1 - Search & View Routes  
**Status:** ✅ Complete & Operational
