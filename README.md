# Inventory Management System

This project is an inventory management system that updates the `SellIn` and `Quality` values of items in the inventory. It includes features such as importing items from an API, updating item quality, and uploading item images to Cloudinary.

## Prerequisites

- **PHP**: Ensure PHP is installed on your system.
- **Composer**: Ensure Composer is installed for dependency management.
- **SQLite**: Ensure SQLite is available for the database.

## Project Setup

1. **Clone the Repository**: Clone the project repository to your local machine.
    ```sh
    git clone <repository-url>
    cd <repository-directory>
    ```

2. **Install Dependencies**: Use Composer to install the required dependencies.
    ```sh
    composer install
    ```

3. **Database Setup**: The database will be created in-memory for testing purposes. No additional setup is required for SQLite.

## Running the Project

### Import Items from API
```
php [import_items.php]
```

###
Run the API Endpoint for Image Uploads
