# Laravel Blog Project with Admin Panel

This is a Laravel-based blog web application that includes a complete admin panel for managing blog posts, categories, comments, and likes. It features a public-facing blog homepage and a secure admin dashboard.

---

##  Features

###  Public Blog:
- Blogs are displayed on the homepage.
- Each blog post supports:
  - **Categories**
  - **Like Button** (tracked by user IP)
  - **Comment Section**
- Comments are **not published immediately** — they require admin approval.

###  Admin Panel:
- **Authentication Protected** (login required).
- Manage:
  - **Blog Posts**: Create, edit, delete
  - **Categories**: Create, edit, delete
  - **Comments**:
    - View all comments
    - Approve or delete user comments
  - **Likes**: View all blog likes
- Admin dashboard with breadcrumb navigation and flash messaging.

---

##  Built With

- **Laravel 12**
- Blade Templating
- Bootstrap 5
- Eloquent ORM
- IP-based Like Tracking
- Admin Authentication (via Laravel Breeze)

---

