# Running App
*Follow these steps to run the App:*

1. **Clone the Repository:**
   ```bash
    git clone git@github.com:luisleder/download-photos.git
   ```
2. **Navigate to the Project Directory:**
    ```bash
    cd download-photos
    ```
3. **Install Dependencies**
    ```bash
    composer install
    ```

4. **Create a Copy of the .env File**
    ```bash 
    cp .env.example .env
    ```

5. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6. **Configure Database**
    *Update the .env file with your database credentials.*
    <br>

7. **Run Migrations**
    ```bash
    php artisan migrate
    ```
8. **To update the photos on db**
    ```bash
    php artisan app:download-photos
    ```