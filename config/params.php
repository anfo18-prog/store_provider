<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'baseURL' => 'https://api.provider.com',
    'mockOffers' => '{
        "sku": "xxx",
        "offers": [
            {
                "id": 1,
                "price": 0.00,
                "stock": 0,
                "shipping_price": 0.00,
                "delivery_date": "2023-05-27",
                "can_be_refunded": true,
                "status": "new",
                "guarantee": true,
                "seller": {
                    "name": "xxxx",
                    "qualification": 0,
                    "reviews_quantity": 0
                }
            },
            {
                "id": 2,
                "price": 45.00,
                "stock": 3,
                "shipping_price": 5.00,
                "delivery_date": "2023-05-27",
                "can_be_refunded": true,
                "status": "new",
                "guarantee": true,
                "seller": {
                    "name": "xxx2",
                    "qualification": 3,
                    "reviews_quantity": 1
                }
            },
            {
                "id": 3,
                "price": 25.00,
                "stock": 1,
                "shipping_price": 5.00,
                "delivery_date": "2023-04-27",
                "can_be_refunded": false,
                "status": "used",
                "guarantee": false,
                "seller": {
                    "name": "xxx3",
                    "qualification": 2,
                    "reviews_quantity": 5
                }
            },
            {
                "id": 4,
                "price": 25.00,
                "stock": 3,
                "shipping_price": 4.50,
                "delivery_date": "2023-04-26",
                "can_be_refunded": true,
                "status": "renew",
                "guarantee": false,
                "seller": {
                    "name": "xxx4",
                    "qualification": 5,
                    "reviews_quantity": 1
                }
            }
        ]
    }',
];
