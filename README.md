<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

</p>

# Chirper with Blade

Welcome to Chirper! 🐦

Chirper is a social media platform built using Laravel and Blade templating engine. This project follows the concepts taught in the Laravel bootcamp available at [bootcamp.laravel.com](https://bootcamp.laravel.com).

## Features

- **User Authentication:** Users can securely register, log in, and log out.

- **Post Management:**
  - Create new chirps.
  - Edit existing chirps to update content.
  - Delete chirps that are no longer needed.

- **Events and Notifications:**
  - Implemented events to handle various actions.
  - Notifications are triggered for users based on specific events.
  - Notifications can be viewed in the Laravel log.

- **Welcome Page Enhancement:**
  - Modified the welcome page to provide a more personalized "Welcome to Chirper" experience.

- **Role-based Access Control:**
  - Integrated gates and policy for enhanced security.
  - Three roles: Users, Admin, and Editor.
  - Admins can edit and delete any chirp.
  - Editors (Moderators) can edit chirps but not delete. (WORK IN PROGRESS 🚧)
  - Users have basic access.

- **Dynamic Timezone:**
  - In progress: Implementing dynamic timezones based on users' preferences.
  - the local timezone of the currently logged in user must show.

## Getting Started

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/chirper.git
