# TASK DETAILS

## DESCRIPTION

### PHASE 1

1. Create a database in MySQL with all the required fields. Make sure the database is a **relational database**. The **Product** will have:
   - Name
   - Price
   - Multiple Images

2. Develop the backend in **MVC framework (Laravel)**, where you can **add a product with multiple images**. The system should:
   - Allow adding product with multiple images.
   - View product details along with its images.
   - Provide **CRUD functionality** for products.
   - Create a **GET API** to display all the products with their multiple images.

### PHASE 2

1. Add the product to cart using a **POST API**. The user ID will be hardcoded to **1**.
2. Use **GET API** to display the cart list items along with the products added to the cart.
3. In **CMS** display all the products added to cart with their respective user ID.

### API JSON Structures

#### 1. Product API Response Structure
```json
{
  "status": 201,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Product 1",
        "price": 100.00,
        "images": ["image1.jpg", "image2.jpg"],
        "created_at": "2025-03-06T10:00:00.000000Z",
        "updated_at": "2025-03-06T10:00:00.000000Z"
      }
    ],
    "total": 20
  }
}
```

#### 2. Cart API Response Structure
```json
{
  "status": 201,
  "data": {
    "message": "Product has been added to cart successfully"
  }
}
```

### CMS UI Screenshot

![image](https://github.com/user-attachments/assets/652297d4-e239-4f6e-a782-7b34810d9d70)


### Instructions
1. Clone the project repository.
2. Install dependencies:
```bash
composer install
```
3. Set up **.env** file with database credentials.
4. Run migrations:
```bash
php artisan migrate
```
5. Link Storage:
```bash
php artisan storage:link
```
6. Start the application:
```bash
php artisan serve
```

