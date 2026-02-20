

# Order Management API (MongoDB)

## Base URL

```
http://localhost:8000/api/v1
```

## Headers

```http
Accept: application/json
```

---

## API Endpoints

| Route                                         | Method | Description                                 |
|-----------------------------------------------|--------|---------------------------------------------|
| `/orders`                                     | POST   | [Create Order](#createorder)                |
| `/orders`                                     | GET    | [List Orders](#listorders)                  |
| `/orders/{orderId}`                           | PATCH  | [Update Order](#updateorder)                |
| `/orders/{orderId}/items/{itemId}`            | PATCH  | [Update Order Item](#updateorderitem)       |
| `/orders/{orderId}`                           | DELETE | [Delete Order](#deleteorder)                |

---

## <a name="createorder"></a> Create Order

**Request URL:**
```
POST /orders
```

**Sample Request:**
```json
{
  "user_id": 1,
  "items": [
    {
      "product_id": 101,
      "product_name": "Sample Product",
      "quantity": 2,
      "price": 19.99
    }
  ],
  "total_amount": 39.98,
  "shipping_address": {
    "street": "123 Main St",
    "city": "Sample City",
    "zip": "12345"
  }
}
```

**Success Response:**
```json
{
  "success": true,
  "message": "Order created successfully",
  "payload": {
    "id": "699876a09faa79bb130c309d",
    "user_id": 14,
    "items": [
      {
        "id": "699876a09faa79bb130c309b",
        "product_name": "MAC M4",
        "product_id": 108,
        "quantity": 2,
        "price": 19.99
      },
      {
        "id": "699876a09faa79bb130c309c",
        "product_name": "Dell",
        "product_id": 351,
        "quantity": 2,
        "price": 10.99
      }
    ],
    "total_amount": 34.98,
    "shipping_address": {
      "street": "123 Main St",
      "city": "Matariya City",
      "zip": "12345"
    },
    "status": "pending"
  }
}
```

---

## <a name="listorders"></a> List Orders

**Request URL:**
```
GET /orders?search=sample
```

**Success Response:**
```json
{
  "success": true,
  "message": "Orders retrieved successfully",
  "payload": {
    "orders": [
      {
        "id": "699841c59faa79bb130c3079",
        "user_id": 1,
        "items": [
          {
            "id": "699841c59faa79bb130c3077",
            "product_id": 101,
            "quantity": 2,
            "price": 19.99
          },
          {
            "id": "699841c59faa79bb130c3078",
            "product_id": 101,
            "quantity": 2,
            "price": 10.99
          }
        ],
        "total_amount": 39.98,
        "shipping_address": {
          "street": "123 Main St",
          "city": "Sample City",
          "zip": "12345"
        }
      }
    ],
    "pagination": {
      "current_page": 1,
      "per_page": 10,
      "total": 5,
      "last_page": 1
    }
  }
}
```

---

## <a name="updateorder"></a> Update Order

**Request URL:**
```
PATCH /orders/{orderId}
```

**Sample Request:**
```json
{
  "shipping_address": {
    "street": "456 New St",
    "city": "Matariya City",
    "zip": "54321"
  },
  "status": "shipped"
}
```

**Success Response:**
```json
{
  "success": true,
  "message": "Order updated successfully",
  "payload": {
    "id": "699876a09faa79bb130c309d",
    "user_id": 14,
    "items": [
      {
        "id": "699876a09faa79bb130c309b",
        "product_name": "MAC M4",
        "product_id": 108,
        "quantity": 2,
        "price": 19.99
      },
      {
        "id": "699876a09faa79bb130c309c",
        "product_name": "Dell",
        "product_id": 351,
        "quantity": 2,
        "price": 10.99
      }
    ],
    "total_amount": 34.98,
    "shipping_address": {
      "street": "456 New St",
      "city": "Matariya City",
      "zip": "54321"
    },
    "status": "shipped"
  }
}
```

---

## <a name="updateorderitem"></a> Update Order Item

**Request URL:**
```
PATCH /orders/{orderId}/items/{itemId}
```

**Sample Request:**
```json
{
  "product_name": "HP",
  "quantity": 5,
  "price": 199.99
}
```

**Success Response:**
```json
{
  "success": true,
  "message": "Order item updated successfully",
  "payload": {
    "id": "6998b3169faa79bb130c30a0",
    "user_id": 15,
    "items": [
      {
        "id": "6998b3169faa79bb130c309e",
        "product_name": "MAC M3",
        "product_id": 108,
        "quantity": 2,
        "price": 19.99
      },
      {
        "id": "6998b3169faa79bb130c309f",
        "product_name": "HP",
        "product_id": 351,
        "quantity": 5,
        "price": 199.99
      }
    ],
    "total_amount": 34.98,
    "shipping_address": {
      "street": "123 Main St",
      "city": "Matariya City",
      "zip": "12345"
    },
    "status": "pending"
  }
}
```

---

## <a name="deleteorder"></a> Delete Order

**Request URL:**
```
DELETE /orders/{orderId}
```

**Success Response:**
```json
{
  "success": true,
  "message": "Order deleted successfully",
  "payload": null
}
```

**Error Response:**
```json
{
  "success": false,
  "message": "Failed to delete order: No query results for model [App\\Models\\Order] 699847339faa79bb130c3088",
  "payload": null
}
```




