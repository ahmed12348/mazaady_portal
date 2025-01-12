# User and Folder Management System

A web-based application to manage users, folders, and notes with a permission-based system. This application allows users to manage their notes in different folders, while adhering to the rules of shared or private visibility for notes.

---

## 🌟 Features

- User authentication and role management
- Folder and note CRUD operations
- Notes can be either private or shared with other users
- Text and PDF note types

---

## 🛠️ Tech Stack

- **Backend**: Laravel
- **Frontend**: Blade Templates, Bootstrap
- **Database**: MySQL
- **Other Tools**: Laravel Sanctum for API authentication

---

## 🚀 Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/ahmed12348/mazaady_portalm.git
    cd mazaady_portal
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    ```

3. Set up the environment:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Run migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```

5. Start the server:
    ```bash
    php artisan serve
    npm run dev
    ```

Access the application at `http://localhost/Mazaady_Portal/admin/employees`.


---

## 📑 How to Contribute

1. Fork the repository.
2. Create a feature branch:
    ```bash
    git checkout -b feature-name
    ```
3. Commit your changes:
    ```bash
    git commit -m "Add some feature"
    ```
4. Push to the branch:
    ```bash
    git push origin feature-name
    ```
5. Open a pull request.

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 📬 Contact

If you have any questions or feedback, feel free to contact:

- **Email**: ahmed.elbatal954@gmail.com
- **GitHub**: [ahmed12348](https://github.com/ahmed12348)

---

Thank you for using this system! Your contributions are always welcome! 🚀
