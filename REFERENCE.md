# REFERENCE.md
## Organisasi PWEB — Letter & Disposition Management System

Quick lookup reference for database tables, enums, routes, controllers, and views.
Use this during coding to avoid guessing column names, route names, or enum values.

---

## 1. Database Tables & Columns

### `users`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | Auto increment |
| name | varchar(100) | |
| email | varchar(100) | Unique |
| email_verified_at | timestamp | Nullable |
| password | varchar | Bcrypt |
| role | enum | `user`, `admin` — default `user` |
| remember_token | varchar | |
| created_at | timestamp | |
| updated_at | timestamp | |

### `incoming_letters`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| letter_number | varchar(50) | From sender |
| letter_date | date | Date on letter |
| received_date | date | Date received |
| sender | varchar(100) | |
| letter_type | enum | `invitation`, `announcement` |
| subject | varchar(255) | |
| file_path | varchar | Nullable |
| status | enum | `unassigned`, `assigned`, `completed` — default `unassigned` |
| created_by | bigint FK | → users.id |
| created_at | timestamp | |
| updated_at | timestamp | |

### `outgoing_letters`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| letter_number | varchar(50) | Nullable — assigned by admin |
| letter_date | date | Nullable — assigned by admin |
| letter_type | enum | `recommendation`, `active_certificate`, `assignment` |
| related_name | varchar(100) | Name of person in letter |
| purpose | varchar(255) | |
| addressed_to | varchar(100) | |
| letter_body | text | |
| event_name | varchar(100) | Nullable — assignment type only |
| event_date | date | Nullable — assignment type only |
| event_location | varchar(100) | Nullable — assignment type only |
| file_path | varchar | Nullable |
| status | enum | `draft`, `pending_approval`, `approved`, `rejected`, `sent` — default `draft` |
| rejection_note | text | Nullable — filled by pimpinan on reject |
| created_by | bigint FK | → users.id (submitting user) |
| approved_by | bigint FK | Nullable → users.id (pimpinan) |
| created_at | timestamp | |
| updated_at | timestamp | |

### `dispositions`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| incoming_letter_id | bigint FK | → incoming_letters.id |
| assigned_to | bigint FK | → users.id (recipient) |
| assigned_by | bigint FK | → users.id (admin) |
| instructions | text | |
| status | enum | `unread`, `read`, `completed` — default `unread` |
| reply_note | text | Nullable — from recipient |
| created_at | timestamp | |
| updated_at | timestamp | |

### `notifications`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| user_id | bigint FK | → users.id |
| title | varchar(100) | |
| message | text | |
| is_read | boolean | Default false |
| created_at | timestamp | |
| updated_at | timestamp | |

---

## 2. All Enum Values

```php
// users.role
'user' | 'admin'

// incoming_letters.letter_type
'invitation' | 'announcement'

// incoming_letters.status
'unassigned' | 'assigned' | 'completed'

// outgoing_letters.letter_type
'recommendation' | 'active_certificate' | 'assignment'

// outgoing_letters.status
'draft' | 'pending_approval' | 'approved' | 'rejected' | 'sent'

// dispositions.status
'unread' | 'read' | 'completed'
```

---

## 3. Status Badge Colors

### Outgoing Letters
| Status | Background | Text |
|---|---|---|
| draft | `#F1F3F8` | `#4E5967` |
| pending_approval | `#FEF3C7` | `#D97706` |
| approved | `#D1FAE5` | `#059669` |
| rejected | `#FEE2E2` | `#DC2626` |
| sent | `#DBEAFE` | `#2563EB` |

### Incoming Letters
| Status | Background | Text |
|---|---|---|
| unassigned | `#FEF3C7` | `#D97706` |
| assigned | `#DBEAFE` | `#2563EB` |
| completed | `#D1FAE5` | `#059669` |

### Dispositions
| Status | Background | Text |
|---|---|---|
| unread | `#FEF3C7` | `#D97706` |
| read | `#DBEAFE` | `#2563EB` |
| completed | `#D1FAE5` | `#059669` |

### Badge CSS (reusable inline style pattern)
```html
<span style="
  background: {BG};
  color: {TEXT};
  font-size: 12px;
  font-weight: 500;
  padding: 4px 10px;
  border-radius: 6px;
  display: inline-block;
">
  {Label}
</span>
```

---

## 4. Controllers & Their Locations

### Admin Controllers — app/Http/Controllers/Admin/
| Controller | Responsibility |
|---|---|
| AdminDashboardController | Admin dashboard stats |
| AdminIncomingLetterController | Full CRUD for incoming_letters |
| AdminOutgoingLetterController | View + process + approve + reject + markSent for outgoing_letters |
| AdminDispositionController | Create + manage dispositions |
| AdminUserController | View-only user list |

### User Controllers — app/Http/Controllers/User/
| Controller | Responsibility |
|---|---|
| UserDashboardController | User dashboard stats + recent letters |
| UserOutgoingLetterController | Submit + manage own outgoing letters |
| UserDispositionController | View + update status of own dispositions |

### Shared Controllers — app/Http/Controllers/
| Controller | Responsibility |
|---|---|
| NotificationController | View + mark as read notifications |

---

## 5. All Routes

### Auth Routes (public)
```
GET  /login           → login form
POST /login           → authenticate
GET  /register        → register form
POST /register        → create user (role hardcoded to 'user')
POST /logout          → destroy session
```

### User Routes (auth + role:user)
```
GET    /user/dashboard                      → UserDashboardController@index
GET    /user/outgoing-letters               → UserOutgoingLetterController@index
GET    /user/outgoing-letters/create        → UserOutgoingLetterController@create
POST   /user/outgoing-letters               → UserOutgoingLetterController@store
GET    /user/outgoing-letters/{id}          → UserOutgoingLetterController@show
GET    /user/outgoing-letters/{id}/edit     → UserOutgoingLetterController@edit
PUT    /user/outgoing-letters/{id}          → UserOutgoingLetterController@update
DELETE /user/outgoing-letters/{id}          → UserOutgoingLetterController@destroy
GET    /user/dispositions                   → UserDispositionController@index
PATCH  /user/dispositions/{id}/status       → UserDispositionController@updateStatus
```

### Admin Routes (auth + role:admin)
```
GET    /admin/dashboard                             → AdminDashboardController@index
GET    /admin/incoming-letters                      → AdminIncomingLetterController@index
GET    /admin/incoming-letters/create               → AdminIncomingLetterController@create
POST   /admin/incoming-letters                      → AdminIncomingLetterController@store
GET    /admin/incoming-letters/{id}                 → AdminIncomingLetterController@show
GET    /admin/incoming-letters/{id}/edit            → AdminIncomingLetterController@edit
PUT    /admin/incoming-letters/{id}                 → AdminIncomingLetterController@update
DELETE /admin/incoming-letters/{id}                 → AdminIncomingLetterController@destroy
PATCH  /admin/incoming-letters/{id}/status          → AdminIncomingLetterController@updateStatus
GET    /admin/outgoing-letters                      → AdminOutgoingLetterController@index
GET    /admin/outgoing-letters/{id}                 → AdminOutgoingLetterController@show
GET    /admin/outgoing-letters/{id}/process         → AdminOutgoingLetterController@edit
PUT    /admin/outgoing-letters/{id}/process         → AdminOutgoingLetterController@update
PATCH  /admin/outgoing-letters/{id}/approve         → AdminOutgoingLetterController@approve
PATCH  /admin/outgoing-letters/{id}/reject          → AdminOutgoingLetterController@reject
PATCH  /admin/outgoing-letters/{id}/sent            → AdminOutgoingLetterController@markSent
GET    /admin/outgoing-letters/{id}/print           → AdminOutgoingLetterController@print
GET    /admin/dispositions                          → AdminDispositionController@index
GET    /admin/dispositions/create                   → AdminDispositionController@create
POST   /admin/dispositions                          → AdminDispositionController@store
DELETE /admin/dispositions/{id}                     → AdminDispositionController@destroy
GET    /admin/users                                 → AdminUserController@index
```

### Shared Routes (auth, any role)
```
GET    /notifications                       → NotificationController@index
PATCH  /notifications/{id}/read             → NotificationController@markRead
```

---

## 6. Views Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php
│   ├── user.blade.php
│   └── admin.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── user/
│   ├── dashboard.blade.php
│   ├── outgoing-letters/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   └── dispositions/
│       └── index.blade.php
├── admin/
│   ├── dashboard.blade.php
│   ├── incoming-letters/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   ├── outgoing-letters/
│   │   ├── index.blade.php
│   │   ├── show.blade.php
│   │   ├── process.blade.php
│   │   └── approve.blade.php
│   ├── dispositions/
│   │   ├── index.blade.php
│   │   └── create.blade.php
│   └── users/
│       └── index.blade.php
├── templates/
│   ├── surat_rekomendasi.blade.php
│   ├── surat_keterangan_aktif.blade.php
│   └── surat_tugas.blade.php
└── notifications/
    └── index.blade.php
```

---

## 7. Model Relationships Summary

```php
// User
hasMany OutgoingLetter (FK: created_by)
hasMany OutgoingLetter as approvedLetters (FK: approved_by)
hasMany IncomingLetter (FK: created_by)
hasMany Disposition as receivedDispositions (FK: assigned_to)
hasMany Disposition as createdDispositions (FK: assigned_by)
hasMany Notification (FK: user_id)

// IncomingLetter
hasMany Disposition (FK: incoming_letter_id)
belongsTo User as createdBy (FK: created_by)

// OutgoingLetter
belongsTo User as submittedBy (FK: created_by)
belongsTo User as approvedBy (FK: approved_by)  // now filled by admin

// Disposition
belongsTo IncomingLetter (FK: incoming_letter_id)
belongsTo User as assignedTo (FK: assigned_to)
belongsTo User as assignedBy (FK: assigned_by)

// Notification
belongsTo User (FK: user_id)
```

---

## 8. Seeder Credentials

| Role | Email | Password |
|---|---|---|
| Admin | admin@organisasipweb.com | admin123 |
| User | Register via /register | set by user |

---

## 9. Design Quick Reference

### Colors
| Token | Hex | Usage |
|---|---|---|
| Primary Blue | `#066FD1` | Buttons, links, active nav |
| Sidebar Background | `#1A2744` | Left nav panel |
| Sidebar Text Active | `#FFFFFF` | Active nav item |
| Sidebar Text Idle | `#A8B5C8` | Inactive nav items |
| Sidebar Hover | `rgba(255,255,255,0.08)` | Nav item hover |
| Sidebar Active Accent | `#066FD1` | 3px left border on active item |
| Page Background | `#F8FAFC` | Main content area |
| Card Background | `#FFFFFF` | Cards and surfaces |
| Card Border | `rgba(1,61,209,0.12)` | Card and input borders |
| Success | `#059669` | Approved, completed |
| Warning | `#D97706` | Pending, unread |
| Error | `#DC2626` | Rejected, errors |
| Info | `#2563EB` | Read, sent, info states |

### Spacing
Base unit: 4px — use multiples: 8, 12, 16, 20, 24, 32, 48px

### Typography
| Role | Size | Weight |
|---|---|---|
| H1 | 48px | 700 |
| H2 | 20px | 600 |
| H3 | 16px | 600 |
| Body | 14px | 400 |
| Button | 14px | 500 |
| Caption/Badge | 12px | 400–500 |

### Components
- Button height: 40px, border radius: 6px
- Card padding: 32px, border radius: 12px
- Input height: 38px, padding: 6px 12px, border radius: 6px

### CDN Links
```html
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
```
