# PROGRESS.md
## Organisasi PWEB — Letter & Disposition Management System

This file tracks what has been built, what is in progress, and what remains.
Update this file after completing each phase or feature.

---

## Current Status: Phase 4 Complete

```
Phase 1 — Foundation              ✅ Complete
Phase 2 — Admin Core (Incoming)   ✅ Complete
Phase 3 — User Core (Outgoing)    ✅ Complete
Phase 4 — Admin Processing        ✅ Complete
Phase 5 — Admin Approval          ⏳ Not Started
Phase 6 — Disposisi               ⏳ Not Started
Phase 7 — Notifications           ⏳ Not Started
Phase 8 — Letter Templates        ⏳ Not Started
Phase 9 — Polish                  ⏳ Not Started
```

---

## Phase 1 — Foundation ✅

| # | Feature | Status |
|---|---|---|
| 1 | Database Migrations (all 5 tables) | ✅ Done |
| 2 | Models & Relationships | ✅ Done |
| 3 | UserSeeder (admin + pimpinan accounts) | ✅ Done |
| 4 | Authentication via Laravel Breeze | ✅ Done |
| 5 | CheckRole Middleware + post-login redirect | ✅ Done |
| 6 | Base Layouts (user, admin, pimpinan) with sidebar + navbar | ✅ Done |

### What was built
- All 5 tables: users, incoming_letters, outgoing_letters, dispositions, notifications
- All column names in English
- Eloquent models with hasMany / belongsTo relationships
- Laravel Breeze installed (Blade stack)
- Register form hardcodes role = 'user'
- Custom CheckRole middleware registered as 'role' alias
- Post-login redirect by role using match() — user and admin only
- Two Blade layouts with dark navy sidebar (#1A2744): user.blade.php, admin.blade.php
- Placeholder dashboards for user and admin roles confirming routing works
- **pimpinan.blade.php layout and /pimpinan/dashboard placeholder were removed**

---

## Phase 2 — Admin Core (Incoming Letters) ✅

| # | Feature | Status |
|---|---|---|
| 7 | Admin Dashboard with 4 statistic cards | ✅ Done |
| 8 | Incoming Letters CRUD with file upload | ✅ Done |
| 9 | Search & Filter on incoming letters index | ✅ Done |
| 10 | Pagination on incoming letters index | ✅ Done |

### What was built
- AdminDashboardController with count queries for 4 stats
- AdminIncomingLetterController (full resource: index, create, store, show, edit, update, destroy)
- File upload to storage/app/public/incoming-letters
- Status update via PATCH /admin/incoming-letters/{id}/status
- Search by letter_number, sender, subject
- Filter by status (unassigned, assigned, completed) and type (invitation, announcement)
- Paginate at 10 records with withQueryString()
- Bootstrap 5 pagination via Paginator::useBootstrapFive() in AppServiceProvider
- Views: index, create, edit, show with status badges and action buttons

### Routes added
- GET/POST /admin/incoming-letters (resource)
- PATCH /admin/incoming-letters/{id}/status

---

## Phase 3 — User Core (Outgoing Letter Submission) ✅

| # | Feature | Status |
|---|---|---|
| 11 | User Dashboard with 4 statistic cards + recent letters | ✅ Done |
| 12 | Outgoing Letter Submission Form with dynamic fields | ✅ Done |
| 13 | My Letters list with search, filter, pagination | ✅ Done |
| 14 | Edit & Delete restricted to draft status | ✅ Done |

### What was built
- UserDashboardController with per-user count queries and 5 recent letters
- UserOutgoingLetterController (index, create, store, show, edit, update, destroy)
- Dynamic assignment fields shown/hidden via vanilla JavaScript
- StoreOutgoingLetterRequest and UpdateOutgoingLetterRequest FormRequest classes
- Status enforcement: edit and delete only allowed when status = 'draft'
- abort(403) if user tries to access another user's letter
- abort(403) if user tries to edit/delete non-draft letter via URL
- File upload to storage/app/public/outgoing-letters
- Search by purpose, addressed_to, related_name
- Filter by status and type
- Status badges with correct colors per DESIGN.md
- Views: dashboard, index, create, edit, show

### Routes added
- GET /user/dashboard
- Resource /user/outgoing-letters (index, create, store, show, edit, update, destroy)

---

## Phase 4 — Admin Processing (Outgoing Letters) ✅

| # | Feature | Status |
|---|---|---|
| 15 | Admin view all outgoing letters with tabbed layout | ✅ Done |
| 16 | Admin process letter (assign number + forward to pimpinan) | ✅ Done |
| 17 | Admin mark letter as sent after pimpinan approves | ✅ Done |

### What was built
- AdminOutgoingLetterController (index, show, edit, update, markSent)
- Tabbed index: Submissions tab (draft, pending_approval, rejected) and Archive tab (approved, sent)
- Process page: read-only letter summary + form to assign letter_number and letter_date
- Status transition enforcement via abort(403): process only on draft, markSent only on approved
- Notification created for user when letter is processed (status → pending_approval)
- Notification created for user when letter is marked sent (status → sent)
- Admin dashboard stats updated to reflect pending_approval and sent counts
- Views: index (with tabs), show, process

### Routes added
- GET /admin/outgoing-letters (index)
- GET /admin/outgoing-letters/{id} (show)
- GET /admin/outgoing-letters/{id}/process (edit)
- PUT /admin/outgoing-letters/{id}/process (update)
- PATCH /admin/outgoing-letters/{id}/sent (markSent)

---

## Phase 5 — Admin Approval (Outgoing Letters) ⏳ Not Started

| # | Feature | Status |
|---|---|---|
| 18 | Admin Approve / Reject letters with rejection note | ⏳ |

### What needs to be built
- `approve(Request $request, $id)` method on `AdminOutgoingLetterController`
- `reject(Request $request, $id)` method on `AdminOutgoingLetterController`
- Approve: status `pending_approval` → `approved`, set `approved_by` = auth()->id(), notify user
- Reject: status `pending_approval` → `rejected`, save `rejection_note`, notify user
- Approve/Reject actions surfaced on the admin outgoing letter show page (pending_approval only)
- View: `admin/outgoing-letters/approve.blade.php` — shows letter summary + reject note textarea + two action buttons
- Routes: PATCH `/admin/outgoing-letters/{id}/approve`, PATCH `/admin/outgoing-letters/{id}/reject`
- Status transition enforcement: abort(403) if letter is not `pending_approval`
- **No PimpinanDashboardController or PimpinanApprovalController needed — pimpinan role removed**

---

## Phase 6 — Disposisi ⏳ Not Started

| # | Feature | Status |
|---|---|---|
| 20 | Admin create disposition | ⏳ |
| 21 | Admin manage dispositions | ⏳ |
| 22 | User view own dispositions | ⏳ |
| 23 | User update disposition status | ⏳ |

### What needs to be built
- AdminDispositionController (index, create, store, destroy)
- UserDispositionController (index, updateStatus)
- Disposition linked to incoming_letter_id
- Admin assigns disposition to a user with instructions
- User can update status: unread → read → completed
- User can add reply_note when marking completed
- Views: admin/dispositions/index, admin/dispositions/create, user/dispositions/index
- Routes: /admin/dispositions (resource), /user/dispositions, PATCH status update

---

## Phase 7 — Notifications ⏳ Not Started

| # | Feature | Status |
|---|---|---|
| 24 | Notification records created on status changes | ⏳ |
| 25 | Navbar bell icon with unread count badge | ⏳ |
| 26 | Notification list page with mark as read | ⏳ |

### What needs to be built
- NotificationController (index, markRead)
- Notification inserts already partially done in Phase 4 (process + markSent)
- Remaining triggers: pimpinan approve, pimpinan reject, disposition assigned
- Navbar bell icon showing count of is_read = false for auth user
- Full notifications list page
- Mark as read: PATCH /notifications/{id}/read
- Routes: GET /notifications, PATCH /notifications/{id}/read

---

## Phase 8 — Letter Templates & Print ⏳ Not Started

| # | Feature | Status |
|---|---|---|
| 27 | Surat Rekomendasi Blade template | ⏳ |
| 28 | Surat Keterangan Aktif Blade template | ⏳ |
| 29 | Surat Tugas Blade template | ⏳ |
| 30 | Print button with window.print() | ⏳ |

### What needs to be built
- resources/views/templates/surat_rekomendasi.blade.php
- resources/views/templates/surat_keterangan_aktif.blade.php
- resources/views/templates/surat_tugas.blade.php
- Route: GET /admin/outgoing-letters/{id}/print
- AdminOutgoingLetterController@print method with match() for template selection
- Each template: Organisasi PWEB letterhead, auto-filled fields, pimpinan signatory
- Print button: window.print(), hidden via @media print .no-print { display: none; }

---

## Phase 9 — Polish ⏳ Not Started

| # | Feature | Status |
|---|---|---|
| 31 | FormRequest validation on all remaining forms | ⏳ |
| 32 | Status badge styling consistency audit | ⏳ |
| 33 | Responsive layout fixes | ⏳ |

### What needs to be built
- Verify all forms use FormRequest classes
- Audit all status badges across all views for color consistency per DESIGN.md
- Test and fix mobile/tablet layout on all pages
- Confirm @media print CSS is correct on all 3 templates
- Final cross-role testing: login as each role and walk through full workflows

---

## Known Decisions Made During Build

- log_surat / audit log table was skipped
- window.print() chosen over DomPDF for letter export
- Pagination uses Bootstrap 5 style via Paginator::useBootstrapFive()
- All name fields use text input, not dropdown/foreign key
- Assignment fields hidden/shown via vanilla JS, no jQuery
- Tab switching on admin outgoing letters index uses Bootstrap JS (no page reload)
- Status transitions enforced via abort(403) in controller, not just UI hiding
- **Pimpinan role was removed** — `users.role` enum is now only `user` and `admin`
- **Admin handles full outgoing letter workflow**: process → approve/reject → mark sent
- **No pimpinan layout, controller, routes, or views** — delete if already scaffolded
- **approved_by FK still exists** on `outgoing_letters` table — now records the admin who approved
- Letter template signatory is now the admin name, not a separate pimpinan account
