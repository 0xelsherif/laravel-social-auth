<p align="center">
<a href="https://github.com/0xelsherif/laravel-social-auth/actions"><img src="https://github.com/0xelsherif/laravel-social-auth/workflows/badge.svg" alt="Build Status"></a>
<a href="https://github.com/0xelsherif/laravel-social-auth/"><img src="https://img.shields.io/github/stars/0xelsherif/laravel-social-auth.svg?style=social&label=Star" alt="GitHub Stars"></a>
<a href="https://github.com/0xelsherif/laravel-social-auth/"><img src="https://img.shields.io/github/forks/0xelsherif/laravel-social-auth.svg?style=social&label=Fork" alt="GitHub Forks"></a>
<a href="https://github.com/0xelsherif/laravel-social-auth/issues"><img src="https://img.shields.io/github/issues/0xelsherif/laravel-social-auth?style=social&logo=github" alt="GitHub Issues"></a>

</p>

# Laravel Social Authentication with Google & Facebook

This project implements **social login authentication** using **Laravel Socialite**, allowing users to log in with **Google** and **Facebook**. The authentication system is designed with **security, scalability, and best practices** in mind.

---

## 🚀 Features

✅ **Social authentication using Google & Facebook**  
✅ **Automatic user account creation on first login**  
✅ **Redirects users to `/home` after login or registration**  
✅ **Handles existing and new users seamlessly**  
✅ **Uses Laravel Socialite for OAuth authentication**  
✅ **Protected routes for authenticated users**

---

## 📌 Prerequisites

Before setting up the project, ensure you have the following installed:

- PHP 8.1+
- Composer
- Laravel 10+
- MySQL or PostgreSQL (Database)
- Node.js & NPM (for frontend assets)
- Git
- A Google OAuth Client ID and Secret ([Create here](https://console.cloud.google.com/))
- A Facebook App ID and Secret ([Create here](https://developers.facebook.com/))

---

## ⚠️ Important Note About HTTPS

🔹 **Google login works in both HTTP and HTTPS** in local development.  
🔹 **Facebook login requires HTTPS** and will **not work on `http://127.0.0.1:8000`**.  
🔹 If you're testing Facebook login locally, you need to set up an **SSL certificate** (e.g., `https://localhost`).

For production, always use **HTTPS** for both Google and Facebook authentication.

---

## ⚡ Installation

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/0xelsherif/laravel-social-auth.git
cd laravel-social-auth
```

### 2️⃣ Install Dependencies

```bash
composer install
```

### 3️⃣ Set Up Environment Variables

Copy `.env.example` to `.env` and update the database and OAuth credentials.

```bash
cp .env.example .env
```

#### **Update `.env` file**

```env
APP_NAME="Laravel Social Login"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback

FACEBOOK_CLIENT_ID=your-facebook-client-id
FACEBOOK_CLIENT_SECRET=your-facebook-client-secret
FACEBOOK_REDIRECT_URI=http://127.0.0.1:8000/auth/facebook/callback
```

### 4️⃣ Generate App Key

```bash
php artisan key:generate
```

### 5️⃣ Run Migrations

```bash
php artisan migrate
```

### 6️⃣ Compile Frontend Assets

```bash
npm install && npm run dev
```

### 7️⃣ Start the Laravel Server

Run the Laravel development server:

```bash
php artisan serve
```

## 🛠️ Configuration

### 1️⃣ Install Laravel Socialite (Skip if already installed)

```bash
composer require laravel/socialite
```

### 2️⃣ Configure OAuth Providers in `config/services.php`

```php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],

'facebook' => [
    'client_id' => env('FACEBOOK_CLIENT_ID'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'redirect' => env('FACEBOOK_REDIRECT_URI'),
],
```

---

## 🚦 Usage

### 1️⃣ Define Authentication Routes in `web.php`

```php
use App\Http\Controllers\SocialAuthController;

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])
    ->where('provider', 'google|facebook');

Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->where('provider', 'google|facebook');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
```

---

## 🔧 Troubleshooting

- **Redirect URI mismatch?** Ensure the callback URL in Google & Facebook OAuth matches your `.env` file.
- **Session issues?** Run `php artisan config:clear` and `php artisan cache:clear`.
- **Database migration error?** Check if your database connection is correctly set up in `.env`.

---

## 🔐 Security Best Practices

✅ **Use `.env` for credentials** – Never hardcode OAuth keys.  
✅ **Restrict allowed social providers** – Prevent invalid `auth/{provider}` routes.  
✅ **Apply `auth` middleware** – Ensure only logged-in users access protected routes.  
✅ **Enable HTTPS in production** – Encrypt user data in transit.  
✅ **Log authentication attempts** – Track social logins for security monitoring.

---

## 📜 License

This project is licensed under the **MIT License**.

---

## 💬 Contributing

Feel free to contribute! Fork the repo, create a new branch, and submit a PR:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit (`git commit -m "Your message"`).
4. Push to your fork (`git push origin feature-branch`).
5. Open a Pull Request.

---

## 📩 Contact

For any issues or inquiries, reach out via [GitHub Issues](https://github.com/0xelsherif/laravel-social-auth/issues).

## Follow Me

Follow me on GitHub to stay updated with my latest projects and contributions:

[![Follow me on GitHub](https://img.shields.io/github/followers/0xelsherif?label=Follow&style=social)](https://github.com/0xelsherif)
<a href="https://twitter.com/intent/follow?screen_name=0xelsherif"><img alt="Follow @0xelsherif on Twitter" src="https://img.shields.io/twitter/follow/0xelsherif"></a>
[![Connect with @0xelsherif on LinkedIn](https://img.shields.io/badge/LinkedIn--blue?style=social&logo=linkedin)](https://www.linkedin.com/in/0xelsherif)
[![Follow @0xelsherif on Medium](https://img.shields.io/badge/Medium--black?style=social&logo=medium)](https://medium.com/@0xelsherif)
[![Follow @0xelsherif on Codepen](https://img.shields.io/badge/Codepen--black?style=social&logo=codepen)](https://codepen.io/0xelsherif)

### Buy Me a Coffee ☕

If you'd like to support the development of this project further or express your appreciation with a small gesture, consider buying me a coffee! Your support helps keep me fueled for more coding sessions. Thank you for your support! 

[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://www.buymeacoffee.com/0xelsherif)
