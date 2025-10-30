# 🪶 Laravel 11 Blog System

A full-stack Laravel 11 project featuring:

- ✅ Authentication (default Laravel Breeze / Sanctum)
- ✅ CRUD for posts (Web + REST API)
- ✅ Real-time notifications using **Pusher + Laravel Echo**
- ✅ Social login via **Google / Socialite**
- ✅ Admin & regular users

---

## ⚙️ Requirements

- PHP ≥ 8.2  
- Composer ≥ 2.6  
- Node.js ≥ 18 + npm / yarn  
- MySQL / SQLite / MongoDB (choose one)  
- Pusher account (for real-time events)  
- Google Cloud OAuth credentials (for social login)

---

## 🚀 Installation

### 1️⃣  Clone & Install
```bash
git clone https://github.com/your-repo/blog_system.git
cd blog_system
composer install
npm install
```

### 2️⃣  Environment
Copy and edit your `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Set these keys:
```env
APP_NAME="Blog System"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_DATABASE=blog_system
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your-pusher-id
PUSHER_APP_KEY=your-pusher-key
PUSHER_APP_SECRET=your-pusher-secret
PUSHER_APP_CLUSTER=ap2
PUSHER_HOST=mix.pusher.com
PUSHER_PORT=443
PUSHER_SCHEME=https

# Social Login (Google)
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback

# Vite (front-end)
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

---

## 🧰  Database & Auth

```bash
php artisan migrate
php artisan db:seed   # optional
php artisan serve
```

Visit 👉 `http://127.0.0.1:8000`

---

## 🌐 Web Routes
| Route | Description |
|-------|--------------|
| `/` | Welcome page |
| `/dashboard` | Authenticated home |
| `/posts` | CRUD for posts |
| `/admin/users` | Admin user management |

---

## 🔌 API Routes (`routes/api.php`)
```php
Route::apiResource('posts', App\Http\Controllers\Api\PostApiController::class);
```

**Endpoints**

| Method | URL | Description |
|---------|-----|-------------|
| GET | `/api/posts` | List posts |
| GET | `/api/posts/{id}` | Show post |
| POST | `/api/posts` | Create |
| PUT/PATCH | `/api/posts/{id}` | Update |
| DELETE | `/api/posts/{id}` | Delete |

Test with Postman — no token required (public).

---

## 🔔 Real-time Notifications

### Backend
```bash
composer require pusher/pusher-php-server
php artisan make:event PostCreated
```
Fire event on post creation:
```php
broadcast(new PostCreated($post))->toOthers();
```

### Frontend (`resources/js/bootstrap.js`)
```js
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});
```

Listen:
```js
window.Echo.channel('posts')
    .listen('.post.created', e => {
        console.log('New post created:', e.post);
    });
```

Run:
```bash
npm run dev
```

---

## 🔐  Social Login (Google / Multi-provider)

Install:
```bash
composer require laravel/socialite
```

### Routes (`routes/web.php`)
```php
Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect']);
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback']);
```

### Controller (`app/Http/Controllers/Auth/SocialLoginController.php`)
```php
public function redirect($provider) {
    return Socialite::driver($provider)->redirect();
}

public function callback($provider) {
    $socialUser = Socialite::driver($provider)->user();
    $user = User::updateOrCreate(
        ['email' => $socialUser->getEmail()],
        ['name' => $socialUser->getName()]
    );
    Auth::login($user);
    return redirect('/dashboard');
}
```

---

## 🧮  Common Commands
```bash
php artisan optimize:clear
php artisan migrate:fresh --seed
php artisan make:model Post -mcr
php artisan queue:work
npm run build
```

---

## 🧪  Test API
```bash
curl http://127.0.0.1:8000/api/posts
```

Expected JSON response:
```json
[
  {
    "id": 1,
    "title": "My First Post",
    "content": "Hello World!"
  }
]
```

---

## 🛡️  Notes

- Laravel Echo + Pusher require valid HTTPS in production.
- Use **queues** for heavy broadcast events (`php artisan queue:work`).
- Sanctum can be added later for secure write endpoints.

---

## 📄  License
MIT © 2025 Your Name
