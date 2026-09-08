<!-- PUBLIC  -->
<!-- Anyone can browse the store. -->
POST /api/register
POST /api/login

GET  /api/categories
GET  /api/categories/{category}

GET  /api/brands
GET  /api/brands/{brand}

GET  /api/sizes
GET  /api/sizes/{size}

GET  /api/colors
GET  /api/colors/{color}

GET  /api/products
GET  /api/products/{product}

GET  /api/product-variants
GET  /api/product-variants/{productVariant}

<!-- CUSTOMER -->
<!-- REQUIRES -->
<!-- Authorization: Bearer TOKEN -->
POST   /api/logout
GET    /api/me

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

<!-- ADMIN -->
<!-- Authorization: Bearer ADMIN_TOKEN -->
<!-- role = admin -->
/api/admin/categories
/api/admin/brands
/api/admin/sizes
/api/admin/colors
/api/admin/products
/api/admin/product-variants
/api/admin/orders

<!-- For example -->
POST   /api/admin/products
PUT    /api/admin/products/1
DELETE /api/admin/products/1

GET /api/admin/orders
GET /api/admin/orders/1

PUT /api/admin/orders/1/status

PUT /api/admin/orders/1/payment-status