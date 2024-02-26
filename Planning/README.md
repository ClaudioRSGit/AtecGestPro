# 🔧  AtecGest Pro  🔨

<div align="center">
    <img src="../Laravel/public/assets/logoWhite.png" style="max-width: 100%; height: 30%; width: 30%;" alt="Logo">
</div>

# Project Overview 💻 👀 🚨

AtecGest Pro Asset Management Application is a powerful solution for efficient ticket, user, material management and much more! Whether you're an educational institution or training center, our software streamlines administrative tasks for enhanced productivity.

# Key Features ☑️ 🔑 

## Permissions for each role: 🔓 🔒
1. <u>Administrator:</u> 
Users with this role are considered application administrators and have total permissions within the application.
2. <u>Technician:</u> 
These users have authority for most operations, except those reserved for Admins, such as creating or editing accounts with admin status and check the dashboard.
3. <u>User:</u>
Normal users or end-users have restricted access, limited to viewing tickets they've created or submitting a new ticket.

## Ticket System 🎫👷

The tickets page is accessible to all users, but those with the User role can only view their own tickets or create new ones. Admins and Technicians have a broader view, being able to manage all tickets, organized by status, with filters and sorting options.

## Dashboard 📊 📈 📉

The dashboard displays vital program statistics, presented in dynamic charts and tables, such as the number of tickets received and resolved, as well as the distribution of users by role.

## Users 👦

The users' page allows managing all accounts in the system, with filters, search, and options to create, edit, view, or delete users. A "Recycle Bin" section allows recovering or permanently deleting removed users.

## Material 🔨 

Here, all ATEC materials are listed, with filtering, searching, and organization options, including a "Recycle Bin" section for deleted materials.

## External Trainings 🏭📒

This page lists all information related to training sessions. Thus, it has three tabs: the first, "Management of market training", allows viewing, managing, and scheduling training sessions to be taught to partners; the second, "Partner Management", allows viewing all ATEC partners and creating, editing, viewing, or removing a partner; the third, "Training Management", presents the data related to each training that can be provided to ATEC partners. Here, all trainings can be viewed, edited, or deleted, and a new one can be created.

## Classes 📘

The classes page represents all existing classes at ATEC, including those no longer in progress. Here, a list of classes is displayed, and by selecting each one, it is possible to view the students belonging to that class. On this page, it is also possible to create a new class, edit, delete, or view the details of an existing class, search for the class, and filter the classes by course.

## Clothing Management 👕

The purpose of the clothing page is to allocate uniforms to people related to ATEC, whether they are trainees, teaching staff, or non-teaching staff. To do this, this page has been divided into two tabs: the one for trainees, which presents a list of trainees, grouped by class; and the "Others" tab, which includes teaching and non-teaching staff. In both tabs, there is pagination to show only five people at a time, a search bar to search for the person's name, and a search filter. This allows filtering classes by course in the trainees tab and filtering by user role in the "Others" tab. We have also added the functionality to add a new class on this page, since most of the time the allocation of uniforms is done when a new class arrives.

## Courses 📖

This page provides data related to the courses taught at ATEC. It is possible to view, edit, and delete existing courses, create a new course, search by course description, and sort alphabetically by both the course description and its code.

## Extra funcionalities ✏️ ✉️ 🔔

• Notifications: allows the user to receive real-time notifications of any changes made to a ticket associated with them;

• Profile Editing: gives the user the chance to view and edit the main data of their profile.

# Conclusion

Our management system stands as an indispensable tool for organizations, particularly in the educational and training sector, aiming to streamline their administrative workflows effectively. With its robust role-based permissions, seamless account management functionalities, and dynamic dashboard providing real-time insights, our solution is finely crafted to address the specific needs of educational entities like ATEC. From comprehensive contract oversight to user-friendly interfaces facilitating easy employee management, our system empowers administrators to navigate complexities with ease. Embrace heightened efficiency, informed decision-making, and operational excellence—all encapsulated within a single, cohesive platform.

# Installation 

`Clone the repository`
> git clone https://github.com/ClaudioRSGit/AtecGestPro.git

`Install npm + composer dependencies`
> npm install

> composer install

<i> <u>Note:</u> Ensure you have a local or web server to host the application.</i>
