# 🚀 Quick Start Guide - Toast Notifications for Laravel

Get beautiful toast notifications running in your Laravel project in 5 minutes!

## ⚡ Super Fast Installation

### 1️⃣ Copy Files (30 seconds)

Copy these 3 files to your Laravel project:

```
public/css/toast.css
public/js/toast.js
resources/views/components/toast.blade.php
```

### 2️⃣ Update Your Layout (1 minute)

Open your main layout file (usually `resources/views/layouts/app.blade.php`) and add:

**In the `<head>` section:**
```blade
<link rel="stylesheet" href="{{ asset('css/toast.css') }}">
```

**Before closing `</body>` tag:**
```blade
<x-toast />
<script src="{{ asset('js/toast.js') }}"></script>
```

### 3️⃣ Start Using! (0 seconds)

That's it! You're ready to show toast notifications.

---

## 🎯 Most Common Uses

### In Your Controllers

```php
// ✅ Success
return back()->with('success', 'User created!');

// ❌ Error  
return back()->with('error', 'Failed to save!');

// ⚠️  Warning
return back()->with('warning', 'Please verify email!');

// ℹ️  Info
return back()->with('info', 'Update available!');
```

### In JavaScript/AJAX

```javascript
// After successful AJAX
toast.success('Saved!', 'Your changes have been saved.');

// After failed request
toast.error('Failed!', 'Could not complete request.');
```

---

## 📱 Full Layout Example

Here's a complete working example:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    
    <!-- Your CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Toast CSS -->
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Your Header -->
    <header>
        <!-- Navigation, etc -->
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Your Footer -->
    <footer>
        <!-- Footer content -->
    </footer>

    <!-- Toast Component - IMPORTANT: Place this here -->
    <x-toast />

    <!-- Your JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Toast JS -->
    <script src="{{ asset('js/toast.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
```

---

## 🎨 Controller Examples

### Example 1: Simple Form Submission

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($validated);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post created successfully!');
    }
}
```

### Example 2: With Try-Catch

```php
public function update(Request $request, Post $post)
{
    try {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($validated);

        return back()->with('success', 'Post updated!');
        
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update post.');
    }
}
```

### Example 3: Delete Action

```php
public function destroy(Post $post)
{
    $post->delete();

    return redirect()
        ->route('posts.index')
        ->with('warning', 'Post has been deleted.');
}
```

---

## 🔧 JavaScript Examples

### Example 1: Fetch API

```javascript
async function saveData() {
    try {
        const response = await fetch('/api/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (response.ok) {
            toast.success('Success!', data.message);
        } else {
            toast.error('Error!', data.message);
        }
    } catch (error) {
        toast.error('Error!', 'Network error occurred.');
    }
}
```

### Example 2: Axios

```javascript
axios.post('/api/endpoint', data)
    .then(response => {
        toast.success('Success!', response.data.message);
    })
    .catch(error => {
        toast.error('Error!', error.response.data.message);
    });
```

### Example 3: jQuery AJAX

```javascript
$.ajax({
    url: '/api/save',
    method: 'POST',
    data: formData,
    success: function(response) {
        toast.success('Success!', response.message);
    },
    error: function(xhr) {
        toast.error('Error!', xhr.responseJSON.message);
    }
});
```

---

## 💡 Pro Tips

### Tip 1: Custom Duration

```php
// Controller - Store custom duration in session
return back()->with([
    'success' => 'Processing started...',
    'toast_duration' => 8000  // 8 seconds
]);
```

```javascript
// Or in JavaScript
toast.success('Title', 'Message', 6000); // 6 seconds
```

### Tip 2: Multiple Messages

```php
return back()->with([
    'success' => 'User created!',
    'info' => 'Verification email sent!',
]);
```

### Tip 3: Form Validation

Validation errors automatically show as toast notifications! No extra code needed:

```php
$request->validate([
    'email' => 'required|email',
    'password' => 'required|min:8',
]);
// If validation fails, errors show as toast automatically!
```

### Tip 4: No Auto-Dismiss

```javascript
toast.show({
    type: 'warning',
    title: 'Important!',
    message: 'Read this carefully',
    duration: 0  // Won't auto-dismiss
});
```

---

## ✅ Verification Checklist

After installation, verify everything works:

- [ ] CSS file loads (check browser dev tools → Network tab)
- [ ] JS file loads (check browser console for errors)
- [ ] `<x-toast />` component is in your layout
- [ ] Test with: `return back()->with('success', 'Test message');`
- [ ] Toast appears in top-right corner
- [ ] Animation slides in from right
- [ ] Click to dismiss works
- [ ] Auto-dismiss after 4 seconds works

---

## 🐛 Common Issues

**Toast not appearing?**
- Check if CSS and JS files are loaded
- Verify `<x-toast />` is in your layout
- Check browser console for errors

**Wrong position?**
- Open `toast.css` and adjust `.toast-container` position

**Duration too fast/slow?**
- Open `toast.js` and change default duration

---

## 🎓 Need More Examples?

Check the full `INSTALLATION_GUIDE.md` for:
- Advanced customization
- Livewire integration  
- Alpine.js integration
- API documentation
- And much more!

---

**That's it! You're ready to use beautiful toast notifications in your Laravel project! 🎉**