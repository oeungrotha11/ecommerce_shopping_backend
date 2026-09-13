<!-- PUBLIC: no token required -->
POST /api/register
POST /api/login

GET /api/categories
GET /api/categories/{category}
GET /api/brands
GET /api/brands/{brand}
GET /api/sizes
GET /api/sizes/{size}
GET /api/colors
GET /api/colors/{color}
GET /api/products
GET /api/products/{product}
GET /api/product-variants
GET /api/product-variants/{productVariant}

<!-- CUSTOMER: Authorization: Bearer TOKEN -->
POST   /api/logout
GET    /api/me
PUT    /api/me
GET    /api/wishlist
POST   /api/wishlist/{product}
DELETE /api/wishlist/{product}
GET    /api/cart
POST   /api/cart/items
PUT    /api/cart/items/{cartItem}
DELETE /api/cart/items/{cartItem}
DELETE /api/cart
POST   /api/checkout
GET    /api/orders
GET    /api/orders/{order}
POST   /api/orders/{order}/payment
GET    /api/orders/{order}/payment

<!-- ADMIN: Authorization: Bearer ADMIN_TOKEN; user role must be admin -->
GET    /api/admin/users
POST   /api/admin/users
PUT    /api/admin/users/{user}
DELETE /api/admin/users/{user}
POST   /api/admin/categories
PUT    /api/admin/categories/{category}
DELETE /api/admin/categories/{category}
POST   /api/admin/brands
PUT    /api/admin/brands/{brand}
DELETE /api/admin/brands/{brand}
POST   /api/admin/sizes
PUT    /api/admin/sizes/{size}
DELETE /api/admin/sizes/{size}
POST   /api/admin/colors
PUT    /api/admin/colors/{color}
DELETE /api/admin/colors/{color}
POST   /api/admin/products
PUT    /api/admin/products/{product}
DELETE /api/admin/products/{product}
POST   /api/admin/product-variants
PUT    /api/admin/product-variants/{productVariant}
DELETE /api/admin/product-variants/{productVariant}
GET    /api/admin/orders
GET    /api/admin/orders/{order}
PUT    /api/admin/orders/{order}/status
PUT    /api/admin/orders/{order}/payment-status

<!-- Product variant gallery field -->
<!-- The existing product-variant endpoint accepts an images array. -->
{
  "product_id": 1,
  "size_id": 2,
  "color_id": 4,
  "sku": "ZAN-TSH-001-BEI-M",
  "stock": 10,
  "images": [
    "products/tshirt/beige/front.jpg",
    "products/tshirt/beige/back.jpg",
    "products/tshirt/beige/side.jpg"
  ]
}
