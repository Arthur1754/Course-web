# TODO List for Quest View Improvements

## 1. Update Home Page
- [ ] Modify resources/views/home.blade.php to replace "Fitur Unggulan Kami" section with single "Make a Account" card linking to /biodata

## 2. Create Biodata System
- [x] Create migration for biodata_requests table (name, email, selected_courses JSON)
- [x] Create BiodataRequest model
- [x] Create BiodataController with show() and store() methods
- [x] Add routes for /biodata (GET/POST) in routes/web.php
- [x] Create resources/views/biodata.blade.php with form (Nama, Email, course checkboxes max 2)
- [x] Add validation for form (max 2 courses, required fields)
- [x] Implement admin notification on submission

## 3. Update Dashboards
- [ ] Update Admin Dashboard: Change totalStudents to count students with courses in app/Http/Controllers/Admin/DashboardController.php
- [ ] Update Instructor Dashboard: Change "Rating Rata-rata" to "Kursus yang di Ajar" in resources/views/instructor/dashboard.blade.php and app/Http/Controllers/Instructor/DashboardController.php

## 4. Admin User Management
- [ ] Update admin user create form to include course selection for instructors
- [ ] Modify app/Http/Controllers/Admin/UserController.php to handle course assignment

## 5. Progress Update Functionality
- [ ] Add progress update feature for instructors to update student progress
- [ ] Update app/Http/Controllers/Instructor/StudentController.php

## 6. Instructor Students List
- [ ] Ensure instructor "Daftar Siswa" shows only students in their courses

## 7. Testing and Followup
- [ ] Run migration for biodata_requests
- [ ] Test biodata form submission and admin notification
- [ ] Test updated dashboards
- [ ] Test progress update functionality
- [ ] Test instructor student list
