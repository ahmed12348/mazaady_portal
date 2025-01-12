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

Access the application at [http://localhost/Mazaady_Portal/admin/employees](http://localhost/Mazaady_Portal/admin/employees).

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

## 🚀 API Endpoints

### **Authentication Endpoints**

1. **POST** `/api/register` - Registers a new user.
2. **POST** `/api/login` - Logs in a user and returns an authentication token.
3. **POST** `/api/logout` - Logs out the user by invalidating their authentication token.

### **Folder Endpoints**

4. **POST** `/api/folders` - Creates a new folder.
5. **GET** `/api/folders` - Lists all folders.
6. **GET** `/api/folders/{id}` - Retrieves a specific folder by its ID.
7. **PUT** `/api/folders/{id}` - Updates the folder details.
8. **DELETE** `/api/folders/{id}` - Deletes a folder.

### **Note Endpoints**

9. **POST** `/api/folders/{folder_id}/notes` - Creates a note in a specified folder.
10. **GET** `/api/notes/{id}` - Retrieves a specific note by its ID.
11. **GET** `/api/notes` - Lists all notes (optionally filterable by folder).
12. **PUT** `/api/notes/{id}` - Updates a specific note by its ID.
13. **DELETE** `/api/notes/{id}` - Deletes a specific note by its ID.

---

## 📝 Tests

### **Test Cases for User and Folder Management**

#### **1. Test User Registration (`POST /api/register`)**

```php
public function test_register_user()
{
    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(201);
    $response->assertJson([
        'message' => 'User created successfully!',
    ]);
}
