# Product Requirements Document (PRD)
## Organisasi PWEB — Letter & Disposition Management System

**Version:** 1.0  
**Date:** June 2026  
**Project:** Final Project — Pemrograman Web (PWEB)  
**Tech Stack:** Laravel, Bootstrap 5, Tabler UI  

---

## 1. Project Overview

### 1.1 Background
Organisasi PWEB currently manages incoming and outgoing correspondence manually, leading to inefficiencies in tracking, disposition, and archiving. This project aims to build a web-based Letter & Disposition Management System (Sistem Manajemen Surat) that digitalizes the entire correspondence workflow — from letter submission to archiving.

### 1.2 Objectives
- Digitalize the incoming and outgoing letter management process
- Provide a structured disposition workflow from admin to members
- Enable users to submit letter requests and track their status online
- Give leadership a simple approval interface for outgoing letters
- Produce printable letter documents from pre-built templates

### 1.3 Scope
This system covers three primary actors: **User** (general member), **Admin** (secretary), and **Pimpinan** (leadership). The system handles two letter directions: **Surat Masuk** (incoming) and **Surat Keluar** (outgoing), along with disposition management.

---

## 2. Stakeholders & User Roles

### 2.1 Roles

| Role | Description | Account Creation |
|---|---|---|
| **User** | General organization member. Submits letter requests and tracks their own letter status. | Self-register via public registration page |
| **Admin** | Organization secretary. Manages all letters, dispositions, and system operations. | Created via database seeder only |
| **Pimpinan** | Organization leadership. Reviews and approves outgoing letters. | Created via database seeder only |

### 2.2 Role Access Matrix

| Feature | User | Admin | Pimpinan |
|---|---|---|---|
| Register & Login | ✅ | ✅ | ✅ |
| Submit draft surat keluar | ✅ | ❌ | ❌ |
| Edit own draft (status = draft only) | ✅ | ❌ | ❌ |
| Delete own draft (status = draft only) | ✅ | ❌ | ❌ |
| View own letter status | ✅ | ❌ | ❌ |
| View own disposisi | ✅ | ❌ | ❌ |
| Update disposisi status | ✅ | ❌ | ❌ |
| Input surat masuk | ❌ | ✅ | ❌ |
| Process & number surat keluar | ❌ | ✅ | ❌ |
| Create & manage disposisi | ❌ | ✅ | ❌ |
| View all letters & archive | ❌ | ✅ | ❌ |
| Generate & print letter | ❌ | ✅ | ❌ |
| View pending approval letters | ❌ | ❌ | ✅ |
| Approve / reject surat keluar | ❌ | ❌ | ✅ |

---

## 3. Functional Requirements

### 3.1 Authentication

| ID | Requirement |
|---|---|
| AUTH-01 | Single login page for all roles with automatic redirect based on role after successful login |
| AUTH-02 | Self-registration is available only for the `user` role; role is hardcoded to `user` on registration |
| AUTH-03 | Admin and Pimpinan accounts are created exclusively via database seeder |
| AUTH-04 | After login: `user` → `/user/dashboard`, `admin` → `/admin/dashboard`, `pimpinan` → `/pimpinan/dashboard` |
| AUTH-05 | Logout available from navbar for all roles |
| AUTH-06 | Unauthenticated users are redirected to the login page via middleware |
| AUTH-07 | Role-based middleware protects all routes; accessing unauthorized routes redirects to respective dashboard |

### 3.2 User — Surat Keluar Submission

| ID | Requirement |
|---|---|
| USER-01 | User can submit a new surat keluar draft via a form with fields: `jenis_surat`, `nama_terkait`, `keperluan`, `ditujukan_ke`, `isi_surat`, and optional file attachment |
| USER-02 | `jenis_surat` is a dropdown with three options: Surat Rekomendasi, Surat Keterangan Aktif, Surat Tugas |
| USER-03 | Additional fields for Surat Tugas: `nama_kegiatan`, `tanggal_kegiatan`, `lokasi_kegiatan` |
| USER-04 | All text name fields (`nama_terkait`, `ditujukan_ke`) use text input, not dropdown |
| USER-05 | Submitted draft has initial status `draft` |
| USER-06 | User can edit their own draft only while status is `draft` |
| USER-07 | User can delete their own draft only while status is `draft` |
| USER-08 | User can view a list of all their submitted letters with current status displayed as a color-coded badge |
| USER-09 | User receives an in-app notification when their letter status changes (approved, rejected, processed) |

### 3.3 Admin — Surat Masuk

| ID | Requirement |
|---|---|
| ADM-01 | Admin can create a new surat masuk with fields: `nomor_surat`, `tanggal_surat`, `tanggal_terima`, `pengirim`, `jenis_surat`, `perihal`, optional file attachment |
| ADM-02 | `jenis_surat` for surat masuk: Surat Undangan, Surat Pemberitahuan |
| ADM-03 | Admin can view all surat masuk in a paginated, searchable, and filterable table |
| ADM-04 | Admin can edit and delete surat masuk records |
| ADM-05 | Admin can update the status of surat masuk: `belum_disposisi` → `sudah_disposisi` → `selesai` |

### 3.4 Admin — Surat Keluar Processing

| ID | Requirement |
|---|---|
| ADM-06 | Admin can view all incoming surat keluar drafts from users in a paginated table |
| ADM-07 | Admin can assign an official letter number (`nomor_surat`) and `tanggal_surat` to a draft |
| ADM-08 | Admin forwards the letter to Pimpinan by changing status to `menunggu_approval` |
| ADM-09 | After Pimpinan approves, Admin marks the letter as `terkirim` after sending |
| ADM-10 | If Pimpinan rejects, Admin can view the rejection note; status reverts to `draft` for user to revise |
| ADM-11 | Admin can generate and print a letter using a pre-built Blade template via `window.print()` |

### 3.5 Admin — Disposisi

| ID | Requirement |
|---|---|
| ADM-12 | Admin can create a disposition for a surat masuk, assigning it to one or more users |
| ADM-13 | Disposition fields: `surat_masuk_id`, `kepada` (user), `instruksi` |
| ADM-14 | Admin can view all dispositions and their current status |
| ADM-15 | Admin can delete a disposition if it was incorrectly directed |

### 3.6 Pimpinan — Approval

| ID | Requirement |
|---|---|
| PIM-01 | Pimpinan can view a list of surat keluar with status `menunggu_approval` |
| PIM-02 | Pimpinan can approve a letter, changing status to `disetujui` |
| PIM-03 | Pimpinan can reject a letter with a mandatory rejection note (`catatan_tolak`), changing status to `ditolak` |
| PIM-04 | Pimpinan receives an in-app notification when a new letter is awaiting approval |

### 3.7 Letter Templates & Print

| ID | Requirement |
|---|---|
| TPL-01 | Three separate Blade templates for: Surat Rekomendasi, Surat Keterangan Aktif, Surat Tugas |
| TPL-02 | Each template auto-populates: organization letterhead (Organisasi PWEB), `nomor_surat`, `tanggal_surat`, recipient, body content from DB fields, and Pimpinan name as signatory |
| TPL-03 | Print is triggered via `window.print()`; print button is hidden in `@media print` CSS |
| TPL-04 | Template selection is automatic based on `jenis_surat` field using a `match()` expression |

---

## 4. Dynamic Features

The following 8 dynamic features are implemented in this system, satisfying the minimum requirement of 4:

| # | Feature | Implementation |
|---|---|---|
| 1 | Login/logout authentication | Laravel Breeze with session-based auth |
| 2 | Role-based access control | Laravel Middleware per role, 3 roles |
| 3 | Dashboard summary & statistics | Card metrics: total surat, pending, approved, active disposisi |
| 4 | Form validation (client + server) | Laravel validation rules + HTML5 required attributes |
| 5 | In-app notification / alert | Notification model stored in DB, bell icon in navbar |
| 6 | File upload | Letter attachments stored in `storage/app/public` |
| 7 | Search & filter | Search by keyword, filter by status and jenis_surat |
| 8 | Pagination | Laravel `->paginate(10)` on all letter listing pages |

---

## 5. Database Design

### 5.1 Tables

#### `users`
| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | Auto increment |
| `name` | varchar(100) | Full name |
| `email` | varchar(100) | Unique |
| `password` | varchar | Hashed via bcrypt |
| `role` | enum | `user`, `admin`, `pimpinan` |
| `created_at` | timestamp | Auto Laravel |
| `updated_at` | timestamp | Auto Laravel |

#### `surat_masuk`
| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | Auto increment |
| `nomor_surat` | varchar(50) | Letter number from sender |
| `tanggal_surat` | date | Date on the letter |
| `tanggal_terima` | date | Date received by organization |
| `pengirim` | varchar(100) | Sender name or institution |
| `jenis_surat` | enum | `undangan`, `pemberitahuan` |
| `perihal` | varchar(255) | Letter subject |
| `file_surat` | varchar | File path, nullable |
| `status` | enum | `belum_disposisi`, `sudah_disposisi`, `selesai` |
| `created_by` | bigint FK | Admin who input the record |
| `created_at` | timestamp | Auto Laravel |
| `updated_at` | timestamp | Auto Laravel |

#### `surat_keluar`
| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | Auto increment |
| `nomor_surat` | varchar(50) | Assigned by admin, nullable |
| `tanggal_surat` | date | Assigned by admin, nullable |
| `jenis_surat` | enum | `rekomendasi`, `keterangan_aktif`, `tugas` |
| `nama_terkait` | varchar(100) | Name of person referenced in letter |
| `keperluan` | varchar(255) | Purpose of the letter |
| `ditujukan_ke` | varchar(100) | Recipient name or institution |
| `isi_surat` | text | Letter body content |
| `nama_kegiatan` | varchar(100) | For surat tugas only, nullable |
| `tanggal_kegiatan` | date | For surat tugas only, nullable |
| `lokasi_kegiatan` | varchar(100) | For surat tugas only, nullable |
| `file_surat` | varchar | Attachment file path, nullable |
| `status` | enum | `draft`, `menunggu_approval`, `disetujui`, `ditolak`, `terkirim` |
| `catatan_tolak` | text | Rejection note from Pimpinan, nullable |
| `created_by` | bigint FK | User who submitted the draft |
| `approved_by` | bigint FK | Pimpinan who approved, nullable |
| `created_at` | timestamp | Auto Laravel |
| `updated_at` | timestamp | Auto Laravel |

#### `disposisi`
| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | Auto increment |
| `surat_masuk_id` | bigint FK | Related surat masuk |
| `kepada` | bigint FK | User assigned to this disposition |
| `dari` | bigint FK | Admin who created the disposition |
| `instruksi` | text | Instructions from admin |
| `status` | enum | `belum_dibaca`, `dibaca`, `selesai` |
| `catatan_balasan` | text | Follow-up note from recipient, nullable |
| `created_at` | timestamp | Auto Laravel |
| `updated_at` | timestamp | Auto Laravel |

#### `notifications`
| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | Auto increment |
| `user_id` | bigint FK | Notification recipient |
| `judul` | varchar(100) | Notification title |
| `pesan` | text | Notification message body |
| `is_read` | boolean | Default false |
| `created_at` | timestamp | Auto Laravel |
| `updated_at` | timestamp | Auto Laravel |

### 5.2 Table Relationships

```
users           →  surat_keluar     one to many  (via created_by)
users           →  surat_keluar     one to many  (via approved_by)
users           →  surat_masuk      one to many  (via created_by)
users           →  disposisi        one to many  (via kepada)
users           →  disposisi        one to many  (via dari)
users           →  notifications    one to many
surat_masuk     →  disposisi        one to many
```

### 5.3 Status Flow

```
Surat Keluar:
draft → menunggu_approval → disetujui → terkirim
                          ↘ ditolak → (user revises) → menunggu_approval

Surat Masuk:
belum_disposisi → sudah_disposisi → selesai

Disposisi:
belum_dibaca → dibaca → selesai
```

---

## 6. Navigation Structure

### User Sidebar
```
├── Dashboard
├── Submit Letter         (new surat keluar form)
├── My Letters            (list of own submitted letters)
└── My Dispositions       (list of dispositions assigned to this user)
```

### Admin Sidebar
```
├── Dashboard             (statistics summary)
├── Surat Masuk
│   ├── All Incoming Letters
│   └── Add Incoming Letter
├── Surat Keluar
│   ├── Letter Submissions   (drafts from users)
│   └── Letter Archive       (all processed letters)
├── Disposisi
│   └── Manage Dispositions
└── Users                 (view-only user list)
```

### Pimpinan Sidebar
```
├── Dashboard             (pending approvals summary)
└── Letter Approval       (letters awaiting signature)
```

### Navbar (all roles)
```
Right side: Notification bell (with unread count badge) | Username | Logout
```

---

## 7. Non-Functional Requirements

| Category | Requirement |
|---|---|
| **Security** | All routes protected by auth middleware; role middleware prevents unauthorized access |
| **Validation** | All forms validated server-side via Laravel `FormRequest`; client-side via HTML5 attributes |
| **File Storage** | Uploaded files stored in `storage/app/public`, symlinked via `php artisan storage:link` |
| **Print** | Letter templates use `@media print` CSS to hide UI elements during printing |
| **Pagination** | All listing pages paginate at 10 records per page |
| **Responsiveness** | Layout responsive across mobile (320px), tablet (768px), desktop (1024px+) |

---

## 8. Out of Scope

The following are explicitly excluded from this project:

- Email notifications (in-app notifications only)
- Forgot password / email verification
- Admin UI for creating new admin or pimpinan accounts (seeder only)
- Export to PDF via package (print via browser only)
- Real-time updates (no WebSocket or polling)
- Multi-level disposition chains
- Letter revision history / audit log

---

## 9. Project Seeder Data

The following accounts will be created via `DatabaseSeeder.php`:

```php
// Admin account
[
    'name'     => 'Admin',
    'email'    => 'admin@organisasipweb.com',
    'password' => bcrypt('admin'),
    'role'     => 'admin',
]

// Pimpinan account
[
    'name'     => 'Ketua',
    'email'    => 'Ketua@organisasipweb.com',
    'password' => bcrypt('Ketua'),
    'role'     => 'pimpinan',
]
```
