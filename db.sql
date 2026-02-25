-- ============================================================
--  🍕 TASTYBITE - Restaurant & Food Delivery Practice Database
--  Paste this entire file into phpMyAdmin > SQL tab > click Go
-- ============================================================

CREATE DATABASE IF NOT EXISTS tastybite;
USE tastybite;

-- Drop tables if they exist (safe re-run)
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS menu_items;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS drivers;
DROP TABLE IF EXISTS restaurants;

-- ============================================================
-- TABLE 1: restaurants
-- ============================================================
CREATE TABLE restaurants (
    restaurant_id   INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(100) NOT NULL,
    cuisine_type    VARCHAR(50),
    city            VARCHAR(50),
    address         VARCHAR(150),
    phone           VARCHAR(20),
    rating          DECIMAL(2,1),
    is_open         TINYINT(1) DEFAULT 1,
    opened_date     DATE
);

INSERT INTO restaurants VALUES
(1,  'Pizza Palace',        'Italian',    'New York',    '12 Mozzarella Ave',      '212-555-0101', 4.5, 1, '2018-03-15'),
(2,  'Burger Barn',         'American',   'New York',    '88 Beef Street',         '212-555-0202', 4.2, 1, '2019-07-22'),
(3,  'Sushi Sakura',        'Japanese',   'Los Angeles', '5 Cherry Blossom Blvd',  '310-555-0303', 4.8, 1, '2017-11-01'),
(4,  'Taco Fiesta',         'Mexican',    'Los Angeles', '77 Salsa Road',          '310-555-0404', 4.1, 1, '2020-02-14'),
(5,  'Curry House',         'Indian',     'Chicago',     '33 Spice Lane',          '773-555-0505', 4.6, 1, '2016-08-30'),
(6,  'Dragon Wok',          'Chinese',    'Chicago',     '9 Noodle Street',        '773-555-0606', 3.9, 1, '2021-05-10'),
(7,  'The Greek Corner',    'Greek',      'New York',    '21 Olive Street',        '212-555-0707', 4.3, 1, '2019-01-18'),
(8,  'BBQ Bros',            'American',   'Chicago',     '55 Smokey Road',         '773-555-0808', 4.7, 1, '2015-06-04'),
(9,  'Green Bowl',          'Vegan',      'Los Angeles', '14 Kale Avenue',         '310-555-0909', 4.4, 1, '2022-03-21'),
(10, 'Pasta Pronto',        'Italian',    'New York',    '6 Fettuccine Blvd',      '212-555-1010', 3.8, 0, '2018-09-12');

-- ============================================================
-- TABLE 2: categories
-- ============================================================
CREATE TABLE categories (
    category_id   INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(50) NOT NULL,
    description   VARCHAR(150)
);

INSERT INTO categories VALUES
(1, 'Starters',   'Appetizers and small bites to kick things off'),
(2, 'Mains',      'Full-sized main course dishes'),
(3, 'Sides',      'Accompaniments and extras'),
(4, 'Desserts',   'Sweet endings to your meal'),
(5, 'Drinks',     'Beverages hot and cold'),
(6, 'Specials',   'Chef specials and limited-time offers');

-- ============================================================
-- TABLE 3: menu_items
-- ============================================================
CREATE TABLE menu_items (
    item_id          INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id    INT NOT NULL,
    category_id      INT NOT NULL,
    name             VARCHAR(100) NOT NULL,
    description      VARCHAR(200),
    price            DECIMAL(6,2) NOT NULL,
    is_vegetarian    TINYINT(1) DEFAULT 0,
    is_available     TINYINT(1) DEFAULT 1,
    FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id),
    FOREIGN KEY (category_id)   REFERENCES categories(category_id)
);

INSERT INTO menu_items VALUES
-- Pizza Palace (restaurant_id = 1)
(1,  1, 1, 'Garlic Bread',           'Toasted with herb butter',              5.99,  1, 1),
(2,  1, 2, 'Margherita Pizza',       'Classic tomato, mozzarella, basil',    13.99,  1, 1),
(3,  1, 2, 'Pepperoni Pizza',        'Loaded with spicy pepperoni',          15.99,  0, 1),
(4,  1, 2, 'BBQ Chicken Pizza',      'Smoky BBQ sauce with grilled chicken', 16.99,  0, 1),
(5,  1, 4, 'Tiramisu',               'Classic Italian dessert',               7.99,  1, 1),
(6,  1, 5, 'Sparkling Water',        '500ml bottle',                          2.49,  1, 1),

-- Burger Barn (restaurant_id = 2)
(7,  2, 1, 'Mozzarella Sticks',      'Crispy fried with marinara dip',        6.99,  1, 1),
(8,  2, 2, 'Classic Cheeseburger',   'Beef patty, cheddar, lettuce, tomato', 12.99,  0, 1),
(9,  2, 2, 'Double Smash Burger',    'Two smashed patties, special sauce',   16.99,  0, 1),
(10, 2, 2, 'Veggie Burger',          'Black bean patty with avocado',        12.49,  1, 1),
(11, 2, 3, 'Loaded Fries',           'Cheese sauce, bacon bits, jalapeños',   5.99,  0, 1),
(12, 2, 5, 'Milkshake',              'Vanilla, chocolate, or strawberry',     6.49,  1, 1),

-- Sushi Sakura (restaurant_id = 3)
(13, 3, 1, 'Edamame',                'Salted steamed soybeans',               4.99,  1, 1),
(14, 3, 1, 'Gyoza (6 pcs)',          'Pan-fried pork dumplings',              7.99,  0, 1),
(15, 3, 2, 'Salmon Nigiri (2 pcs)',  'Fresh salmon over sushi rice',          8.99,  0, 1),
(16, 3, 2, 'Dragon Roll',            'Shrimp tempura, avocado, eel sauce',   14.99,  0, 1),
(17, 3, 2, 'Veggie Roll',            'Cucumber, avocado, pickled radish',     9.99,  1, 1),
(18, 3, 5, 'Green Tea',              'Hot or iced',                           3.49,  1, 1),

-- Taco Fiesta (restaurant_id = 4)
(19, 4, 1, 'Guacamole & Chips',      'Fresh made guacamole',                  6.49,  1, 1),
(20, 4, 2, 'Chicken Tacos (3 pcs)', 'Grilled chicken, salsa, sour cream',   11.99,  0, 1),
(21, 4, 2, 'Beef Burrito',           'Stuffed with rice, beans, beef',       13.49,  0, 1),
(22, 4, 2, 'Veggie Quesadilla',      'Peppers, onions, cheese',              10.99,  1, 1),
(23, 4, 3, 'Mexican Rice',           'Seasoned tomato rice',                  3.99,  1, 1),
(24, 4, 5, 'Horchata',               'Sweet rice milk drink',                 3.99,  1, 1),

-- Curry House (restaurant_id = 5)
(25, 5, 1, 'Samosas (2 pcs)',        'Crispy pastry with spiced potato',      5.49,  1, 1),
(26, 5, 1, 'Onion Bhaji',            'Spiced onion fritters',                 5.99,  1, 1),
(27, 5, 2, 'Butter Chicken',         'Creamy tomato-based chicken curry',    15.99,  0, 1),
(28, 5, 2, 'Palak Paneer',           'Spinach and cottage cheese curry',     13.99,  1, 1),
(29, 5, 3, 'Garlic Naan',            'Soft leavened bread with garlic',       3.49,  1, 1),
(30, 5, 3, 'Basmati Rice',           'Steamed long-grain rice',               2.99,  1, 1),
(31, 5, 4, 'Mango Lassi',            'Chilled yogurt mango drink',            4.49,  1, 1),

-- Dragon Wok (restaurant_id = 6)
(32, 6, 1, 'Spring Rolls (4 pcs)',   'Crispy vegetable rolls',                5.99,  1, 1),
(33, 6, 2, 'Kung Pao Chicken',       'Spicy stir-fry with peanuts',          13.99,  0, 1),
(34, 6, 2, 'Vegetable Fried Rice',   'Wok-tossed rice with seasonal veg',    10.99,  1, 1),
(35, 6, 2, 'Beef Chow Mein',         'Stir-fried noodles with beef',         14.49,  0, 1),
(36, 6, 4, 'Fortune Cookie',         'Classic dessert with surprise inside',  1.49,  1, 1),

-- The Greek Corner (restaurant_id = 7)
(37, 7, 1, 'Hummus & Pita',          'Creamy hummus with warm pita bread',    7.49,  1, 1),
(38, 7, 1, 'Spanakopita',            'Spinach and feta phyllo pastry',        8.99,  1, 1),
(39, 7, 2, 'Chicken Souvlaki',       'Grilled skewers with tzatziki',        15.99,  0, 1),
(40, 7, 2, 'Moussaka',               'Layered eggplant and beef bake',       16.49,  0, 1),
(41, 7, 4, 'Baklava',                'Sweet walnut and honey pastry',         5.99,  1, 1),

-- BBQ Bros (restaurant_id = 8)
(42, 8, 1, 'BBQ Wings (6 pcs)',      'Smoky slow-cooked wings',               9.99,  0, 1),
(43, 8, 2, 'Beef Brisket Plate',     '8oz smoked brisket with sides',        22.99,  0, 1),
(44, 8, 2, 'Pulled Pork Sandwich',   'Slow-smoked, served on brioche',       14.99,  0, 1),
(45, 8, 3, 'Coleslaw',               'Creamy house coleslaw',                 3.49,  1, 1),
(46, 8, 3, 'Mac & Cheese',           'Creamy baked macaroni',                 4.99,  1, 1),
(47, 8, 5, 'Lemonade',               'Fresh squeezed, sweetened',             3.49,  1, 1),

-- Green Bowl (restaurant_id = 9)
(48, 9, 2, 'Buddha Bowl',            'Quinoa, roasted veg, tahini dressing', 14.99,  1, 1),
(49, 9, 2, 'Avocado Toast',          'Sourdough, smashed avo, chilli flakes', 10.99, 1, 1),
(50, 9, 2, 'Acai Bowl',              'Blended acai with granola and berries', 12.99,  1, 1),
(51, 9, 3, 'Sweet Potato Fries',     'Oven-baked with chipotle dip',          5.99,  1, 1),
(52, 9, 5, 'Cold Brew Coffee',       'Smooth 12-hour brewed coffee',          4.99,  1, 1),

-- Pasta Pronto (restaurant_id = 10, currently closed)
(53, 10, 2, 'Spaghetti Carbonara',   'Egg, pancetta, pecorino, black pepper', 14.99, 0, 0),
(54, 10, 2, 'Penne Arrabbiata',      'Spicy tomato and garlic sauce',        12.99,  1, 0),
(55, 10, 4, 'Panna Cotta',           'Vanilla cream with berry coulis',       6.99,  1, 0);

-- ============================================================
-- TABLE 4: customers
-- ============================================================
CREATE TABLE customers (
    customer_id    INT AUTO_INCREMENT PRIMARY KEY,
    first_name     VARCHAR(50) NOT NULL,
    last_name      VARCHAR(50) NOT NULL,
    email          VARCHAR(100) UNIQUE NOT NULL,
    phone          VARCHAR(20),
    city           VARCHAR(50),
    loyalty_points INT DEFAULT 0,
    joined_date    DATE
);

INSERT INTO customers VALUES
(1,  'James',   'Carter',    'james.carter@email.com',    '917-555-1001', 'New York',    320,  '2021-01-15'),
(2,  'Sophia',  'Nguyen',    'sophia.nguyen@email.com',   '310-555-1002', 'Los Angeles', 850,  '2020-06-22'),
(3,  'Marcus',  'Robinson',  'marcus.rob@email.com',      '773-555-1003', 'Chicago',     0,    '2023-11-03'),
(4,  'Aisha',   'Patel',     'aisha.patel@email.com',     '917-555-1004', 'New York',    1200, '2019-03-10'),
(5,  'Liam',    'O\'Brien',  'liam.obrien@email.com',     '773-555-1005', 'Chicago',     540,  '2022-07-18'),
(6,  'Emma',    'Schmidt',   'emma.schmidt@email.com',    '310-555-1006', 'Los Angeles', 90,   '2023-04-29'),
(7,  'Noah',    'Kim',       'noah.kim@email.com',        '917-555-1007', 'New York',    2100, '2018-12-05'),
(8,  'Olivia',  'Martinez',  'olivia.m@email.com',        '310-555-1008', 'Los Angeles', 410,  '2021-09-14'),
(9,  'Ethan',   'Williams',  'ethan.w@email.com',         '773-555-1009', 'Chicago',     760,  '2020-02-28'),
(10, 'Ava',     'Johnson',   'ava.johnson@email.com',     '917-555-1010', 'New York',    150,  '2023-01-07'),
(11, 'Lucas',   'Brown',     'lucas.brown@email.com',     '310-555-1011', 'Los Angeles', 990,  '2019-08-19'),
(12, 'Mia',     'Davis',     'mia.davis@email.com',       '773-555-1012', 'Chicago',     30,   '2024-02-01'),
(13, 'Logan',   'Wilson',    'logan.w@email.com',         '917-555-1013', 'New York',    670,  '2022-03-22'),
(14, 'Chloe',   'Moore',     'chloe.moore@email.com',     '310-555-1014', 'Los Angeles', 280,  '2021-11-30'),
(15, 'Ryan',    'Taylor',    'ryan.taylor@email.com',     '773-555-1015', 'Chicago',     0,    '2024-06-10');

-- ============================================================
-- TABLE 5: drivers
-- ============================================================
CREATE TABLE drivers (
    driver_id      INT AUTO_INCREMENT PRIMARY KEY,
    first_name     VARCHAR(50) NOT NULL,
    last_name      VARCHAR(50) NOT NULL,
    phone          VARCHAR(20),
    city           VARCHAR(50),
    vehicle_type   VARCHAR(30),
    rating         DECIMAL(2,1),
    is_active      TINYINT(1) DEFAULT 1,
    joined_date    DATE
);

INSERT INTO drivers VALUES
(1,  'Carlos',  'Mendez',    '917-555-2001', 'New York',    'Bicycle',    4.9, 1, '2020-05-11'),
(2,  'Sara',    'Blake',     '310-555-2002', 'Los Angeles', 'Scooter',    4.7, 1, '2021-02-14'),
(3,  'Derek',   'Fox',       '773-555-2003', 'Chicago',     'Car',        4.5, 1, '2019-09-03'),
(4,  'Yuki',    'Tanaka',    '310-555-2004', 'Los Angeles', 'Bicycle',    4.8, 1, '2022-01-20'),
(5,  'Priya',   'Sharma',    '773-555-2005', 'Chicago',     'Scooter',    4.6, 1, '2021-07-15'),
(6,  'Mike',    'Foster',    '917-555-2006', 'New York',    'Car',        4.3, 1, '2020-11-08'),
(7,  'Layla',   'Hassan',    '310-555-2007', 'Los Angeles', 'Car',        4.9, 0, '2019-04-22'),
(8,  'Tom',     'Grant',     '773-555-2008', 'Chicago',     'Bicycle',    4.2, 1, '2023-03-17');

-- ============================================================
-- TABLE 6: orders
-- ============================================================
CREATE TABLE orders (
    order_id       INT AUTO_INCREMENT PRIMARY KEY,
    customer_id    INT NOT NULL,
    restaurant_id  INT NOT NULL,
    driver_id      INT,
    status         ENUM('pending','confirmed','preparing','out_for_delivery','delivered','cancelled') DEFAULT 'pending',
    order_date     DATETIME NOT NULL,
    delivery_date  DATETIME,
    delivery_address VARCHAR(150),
    delivery_fee   DECIMAL(5,2) DEFAULT 2.99,
    total_amount   DECIMAL(8,2),
    payment_method ENUM('card','cash','wallet') DEFAULT 'card',
    notes          VARCHAR(200),
    FOREIGN KEY (customer_id)   REFERENCES customers(customer_id),
    FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id),
    FOREIGN KEY (driver_id)     REFERENCES drivers(driver_id)
);

INSERT INTO orders VALUES
(1,  1,  1, 1, 'delivered',         '2024-11-01 12:10:00', '2024-11-01 12:45:00', '12 Oak St, New York',     2.99,  32.96, 'card',   NULL),
(2,  4,  2, 6, 'delivered',         '2024-11-02 18:30:00', '2024-11-02 19:05:00', '88 Park Ave, New York',   2.99,  30.97, 'card',   'No onions please'),
(3,  7,  7, 1, 'delivered',         '2024-11-02 19:15:00', '2024-11-02 19:50:00', '5 River Rd, New York',    2.99,  40.45, 'wallet', NULL),
(4,  2,  3, 2, 'delivered',         '2024-11-03 13:00:00', '2024-11-03 13:35:00', '99 Sunset Blvd, LA',      2.99,  36.96, 'card',   'Extra soy sauce'),
(5,  8,  4, 4, 'delivered',         '2024-11-04 20:00:00', '2024-11-04 20:30:00', '44 Palm Dr, LA',          2.99,  27.46, 'cash',   NULL),
(6,  11, 9, 2, 'delivered',         '2024-11-05 11:30:00', '2024-11-05 12:00:00', '77 Venice Blvd, LA',      2.99,  33.97, 'card',   'Oat milk please'),
(7,  3,  5, 3, 'delivered',         '2024-11-05 18:45:00', '2024-11-05 19:20:00', '33 Maple Ave, Chicago',   2.99,  39.45, 'wallet', NULL),
(8,  9,  8, 5, 'delivered',         '2024-11-06 17:00:00', '2024-11-06 17:50:00', '22 Lake St, Chicago',     2.99,  46.46, 'card',   'Extra napkins'),
(9,  5,  6, 8, 'delivered',         '2024-11-07 12:30:00', '2024-11-07 13:10:00', '11 Michigan Ave, Chicago',2.99,  25.97, 'card',   NULL),
(10, 13, 1, 1, 'delivered',         '2024-11-08 19:00:00', '2024-11-08 19:35:00', '9 Broadway, New York',    2.99,  38.97, 'card',   NULL),
(11, 10, 2, 6, 'delivered',         '2024-11-09 13:15:00', '2024-11-09 13:50:00', '17 5th Ave, New York',    2.99,  31.97, 'wallet', 'Well done patty'),
(12, 4,  7, 1, 'delivered',         '2024-11-10 20:30:00', '2024-11-10 21:05:00', '88 Park Ave, New York',   2.99,  39.46, 'card',   NULL),
(13, 2,  9, 4, 'delivered',         '2024-11-11 10:00:00', '2024-11-11 10:30:00', '99 Sunset Blvd, LA',      2.99,  30.97, 'card',   NULL),
(14, 6,  3, 2, 'delivered',         '2024-11-12 19:45:00', '2024-11-12 20:20:00', '55 Wilshire Blvd, LA',    2.99,  35.96, 'card',   'No wasabi'),
(15, 14, 4, 7, 'cancelled',         '2024-11-13 12:00:00', NULL,                  '30 Melrose Ave, LA',      2.99,  15.48, 'card',   NULL),
(16, 7,  1, 6, 'delivered',         '2024-11-14 18:00:00', '2024-11-14 18:40:00', '5 River Rd, New York',    2.99,  45.96, 'wallet', 'Extra garlic bread'),
(17, 9,  5, 3, 'delivered',         '2024-11-15 19:30:00', '2024-11-15 20:05:00', '22 Lake St, Chicago',     2.99,  38.44, 'card',   NULL),
(18, 3,  8, 5, 'delivered',         '2024-11-16 16:00:00', '2024-11-16 16:45:00', '33 Maple Ave, Chicago',   2.99,  42.47, 'cash',   NULL),
(19, 1,  2, 1, 'delivered',         '2024-11-17 12:45:00', '2024-11-17 13:20:00', '12 Oak St, New York',     2.99,  27.97, 'card',   NULL),
(20, 11, 3, 2, 'delivered',         '2024-11-18 20:00:00', '2024-11-18 20:35:00', '77 Venice Blvd, LA',      2.99,  38.96, 'card',   NULL),
(21, 5,  5, 8, 'delivered',         '2024-11-19 18:15:00', '2024-11-19 18:50:00', '11 Michigan Ave, Chicago',2.99,  37.45, 'wallet', 'Mild spice'),
(22, 8,  9, 4, 'delivered',         '2024-11-20 11:00:00', '2024-11-20 11:30:00', '44 Palm Dr, LA',          2.99,  33.97, 'card',   NULL),
(23, 12, 6, 3, 'delivered',         '2024-11-21 13:30:00', '2024-11-21 14:05:00', '66 Clark St, Chicago',    2.99,  31.47, 'card',   NULL),
(24, 13, 7, 6, 'delivered',         '2024-11-22 19:00:00', '2024-11-22 19:40:00', '9 Broadway, New York',    2.99,  47.45, 'card',   NULL),
(25, 4,  5, 5, 'delivered',         '2024-11-23 18:30:00', '2024-11-23 19:10:00', '88 Park Ave, New York',   2.99,  40.44, 'wallet', 'Extra naan'),
(26, 2,  4, 4, 'delivered',         '2024-11-24 12:00:00', '2024-11-24 12:35:00', '99 Sunset Blvd, LA',      2.99,  26.47, 'card',   NULL),
(27, 6,  9, 2, 'delivered',         '2024-11-25 10:30:00', '2024-11-25 11:00:00', '55 Wilshire Blvd, LA',    2.99,  33.97, 'card',   NULL),
(28, 7,  8, 1, 'delivered',         '2024-11-26 17:30:00', '2024-11-26 18:15:00', '5 River Rd, New York',    2.99,  51.46, 'wallet', 'Birthday dinner!'),
(29, 10, 1, 6, 'delivered',         '2024-11-27 19:45:00', '2024-11-27 20:20:00', '17 5th Ave, New York',    2.99,  35.97, 'card',   NULL),
(30, 3,  6, 8, 'delivered',         '2024-11-28 12:15:00', '2024-11-28 12:55:00', '33 Maple Ave, Chicago',   2.99,  30.47, 'cash',   NULL),
(31, 15, 8, 3, 'delivered',         '2024-11-29 18:00:00', '2024-11-29 18:45:00', '88 Rush St, Chicago',     2.99,  38.47, 'card',   NULL),
(32, 1,  5, 5, 'delivered',         '2024-11-30 19:00:00', '2024-11-30 19:35:00', '12 Oak St, New York',     2.99,  42.44, 'card',   NULL),
(33, 14, 3, 4, 'delivered',         '2024-12-01 20:30:00', '2024-12-01 21:05:00', '30 Melrose Ave, LA',      2.99,  36.96, 'wallet', NULL),
(34, 9,  4, 3, 'delivered',         '2024-12-02 13:00:00', '2024-12-02 13:35:00', '22 Lake St, Chicago',     2.99,  28.46, 'card',   NULL),
(35, 11, 9, 2, 'delivered',         '2024-12-03 10:00:00', '2024-12-03 10:30:00', '77 Venice Blvd, LA',      2.99,  32.97, 'card',   NULL),
(36, 4,  2, 6, 'delivered',         '2024-12-04 18:45:00', '2024-12-04 19:20:00', '88 Park Ave, New York',   2.99,  35.97, 'wallet', NULL),
(37, 13, 5, 5, 'delivered',         '2024-12-05 19:30:00', '2024-12-05 20:05:00', '9 Broadway, New York',    2.99,  41.44, 'card',   'Extra spicy'),
(38, 8,  8, 3, 'preparing',         '2025-01-10 17:00:00', NULL,                  '44 Palm Dr, LA',          2.99,  50.47, 'card',   NULL),
(39, 12, 6, 8, 'out_for_delivery',  '2025-01-10 12:30:00', NULL,                  '66 Clark St, Chicago',    2.99,  26.97, 'cash',   NULL),
(40, 15, 5, NULL,'pending',         '2025-01-10 20:00:00', NULL,                  '88 Rush St, Chicago',     2.99,  30.45, 'card',   'Ring doorbell twice');

-- ============================================================
-- TABLE 7: order_items
-- ============================================================
CREATE TABLE order_items (
    order_item_id   INT AUTO_INCREMENT PRIMARY KEY,
    order_id        INT NOT NULL,
    item_id         INT NOT NULL,
    quantity        INT NOT NULL DEFAULT 1,
    unit_price      DECIMAL(6,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (item_id)  REFERENCES menu_items(item_id)
);

INSERT INTO order_items VALUES
-- order 1: Pizza Palace
(1,  1,  1, 2, 5.99), (2,  1,  3, 1, 15.99), (3,  1,  4, 1, 16.99),
-- order 2: Burger Barn
(4,  2,  8, 1, 12.99), (5,  2,  9, 1, 16.99), (6,  2, 11, 1, 5.99),
-- order 3: The Greek Corner
(7,  3, 37, 1, 7.49), (8,  3, 39, 2, 15.99), (9,  3, 41, 1, 5.99),
-- order 4: Sushi Sakura
(10, 4, 13, 1, 4.99), (11, 4, 16, 2, 14.99), (12, 4, 18, 1, 3.49),
-- order 5: Taco Fiesta
(13, 5, 19, 1, 6.49), (14, 5, 20, 1, 11.99), (15, 5, 23, 1, 3.99),
-- order 6: Green Bowl
(16, 6, 48, 1, 14.99), (17, 6, 50, 1, 12.99), (18, 6, 52, 1, 4.99),
-- order 7: Curry House
(19, 7, 25, 2, 5.49), (20, 7, 27, 1, 15.99), (21, 7, 29, 2, 3.49),
-- order 8: BBQ Bros
(22, 8, 42, 2, 9.99), (23, 8, 43, 1, 22.99),
-- order 9: Dragon Wok
(24, 9, 32, 1, 5.99), (25, 9, 34, 1, 10.99), (26, 9, 35, 1, 14.49),
-- order 10: Pizza Palace
(27, 10, 2, 1, 13.99), (28, 10, 3, 1, 15.99), (29, 10, 6, 3, 2.49),
-- order 11: Burger Barn
(30, 11, 8, 1, 12.99), (31, 11, 10, 1, 12.49), (32, 11, 12, 1, 6.49),
-- order 12: The Greek Corner
(33, 12, 37, 1, 7.49), (34, 12, 40, 2, 16.49),
-- order 13: Green Bowl
(35, 13, 48, 1, 14.99), (36, 13, 49, 1, 10.99),
-- order 14: Sushi Sakura
(37, 14, 13, 1, 4.99), (38, 14, 15, 2, 8.99), (39, 14, 16, 1, 14.99),
-- order 15: Taco Fiesta (cancelled)
(40, 15, 19, 1, 6.49), (41, 15, 22, 1, 10.99),
-- order 16: Pizza Palace
(42, 16, 1, 3, 5.99), (43, 16, 2, 1, 13.99), (44, 16, 4, 1, 16.99),
-- order 17: Curry House
(45, 17, 26, 1, 5.99), (46, 17, 27, 1, 15.99), (47, 17, 28, 1, 13.99),
-- order 18: BBQ Bros
(48, 18, 42, 1, 9.99), (49, 18, 44, 1, 14.99), (50, 18, 45, 2, 3.49), (51, 18, 46, 2, 4.99),
-- order 19: Burger Barn
(52, 19, 9, 1, 16.99), (53, 19, 11, 2, 5.99),
-- order 20: Sushi Sakura
(54, 20, 14, 2, 7.99), (55, 20, 16, 1, 14.99), (56, 20, 17, 1, 9.99),
-- order 21: Curry House
(57, 21, 25, 1, 5.49), (58, 21, 28, 1, 13.99), (59, 21, 29, 3, 3.49), (60, 21, 30, 2, 2.99),
-- order 22: Green Bowl
(61, 22, 49, 2, 10.99), (62, 22, 51, 2, 5.99),
-- order 23: Dragon Wok
(63, 23, 33, 1, 13.99), (64, 23, 34, 1, 10.99), (65, 23, 36, 4, 1.49),
-- order 24: The Greek Corner
(66, 24, 38, 2, 8.99), (67, 24, 39, 1, 15.99), (68, 24, 40, 1, 16.49),
-- order 25: Curry House
(69, 25, 27, 1, 15.99), (70, 25, 28, 1, 13.99), (71, 25, 29, 4, 3.49),
-- order 26: Taco Fiesta
(72, 26, 20, 1, 11.99), (73, 26, 21, 1, 13.49),
-- order 27: Green Bowl
(74, 27, 48, 1, 14.99), (75, 27, 50, 1, 12.99), (76, 27, 52, 1, 4.99),
-- order 28: BBQ Bros
(77, 28, 42, 2, 9.99), (78, 28, 43, 1, 22.99), (79, 28, 46, 1, 4.99),
-- order 29: Pizza Palace
(80, 29, 2, 2, 13.99), (81, 29, 5, 1, 7.99),
-- order 30: Dragon Wok
(82, 30, 32, 2, 5.99), (83, 30, 35, 1, 14.49),
-- order 31: BBQ Bros
(84, 31, 44, 1, 14.99), (85, 31, 45, 2, 3.49), (86, 31, 46, 2, 4.99), (87, 31, 47, 2, 3.49),
-- order 32: Curry House
(88, 32, 27, 1, 15.99), (89, 32, 28, 1, 13.99), (90, 32, 29, 3, 3.49), (91, 32, 31, 2, 4.49),
-- order 33: Sushi Sakura
(92, 33, 13, 1, 4.99), (93, 33, 14, 1, 7.99), (94, 33, 16, 1, 14.99), (95, 33, 17, 1, 9.99),
-- order 34: Taco Fiesta
(96, 34, 20, 1, 11.99), (97, 34, 22, 1, 10.99), (98, 34, 24, 1, 3.99),
-- order 35: Green Bowl
(99, 35, 48, 1, 14.99), (100, 35, 52, 2, 4.99),
-- order 36: Burger Barn
(101, 36, 8, 1, 12.99), (102, 36, 9, 1, 16.99),
-- order 37: Curry House
(103, 37, 25, 2, 5.49), (104, 37, 27, 1, 15.99), (105, 37, 29, 2, 3.49),
-- order 38: BBQ Bros (preparing)
(106, 38, 42, 2, 9.99), (107, 38, 43, 1, 22.99), (108, 38, 44, 1, 14.99),
-- order 39: Dragon Wok (out for delivery)
(109, 39, 33, 1, 13.99), (110, 39, 34, 1, 10.99),
-- order 40: Curry House (pending)
(111, 40, 25, 1, 5.49), (112, 40, 27, 1, 15.99), (113, 40, 30, 2, 2.99);

-- ============================================================
-- TABLE 8: reviews
-- ============================================================
CREATE TABLE reviews (
    review_id      INT AUTO_INCREMENT PRIMARY KEY,
    order_id       INT NOT NULL,
    customer_id    INT NOT NULL,
    restaurant_id  INT NOT NULL,
    rating         TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment        VARCHAR(300),
    review_date    DATE,
    FOREIGN KEY (order_id)      REFERENCES orders(order_id),
    FOREIGN KEY (customer_id)   REFERENCES customers(customer_id),
    FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id)
);

INSERT INTO reviews VALUES
(1,  1,  1,  1, 5, 'Best pizza in New York! The BBQ chicken is incredible.',          '2024-11-02'),
(2,  2,  4,  2, 4, 'Really juicy burgers, fries were a bit cold on arrival.',          '2024-11-03'),
(3,  3,  7,  7, 5, 'Authentic Greek food! Moussaka was perfect.',                      '2024-11-03'),
(4,  4,  2,  3, 5, 'Freshest sushi I have ever had delivered. Will order again!',      '2024-11-04'),
(5,  5,  8,  4, 4, 'Tacos were flavourful, guacamole was fresh.',                      '2024-11-05'),
(6,  6,  11, 9, 5, 'Love Green Bowl! The acai bowl never disappoints.',                '2024-11-06'),
(7,  7,  3,  5, 5, 'Curry House is amazing. Butter chicken was rich and creamy.',      '2024-11-06'),
(8,  8,  9,  8, 5, 'Brisket was fall-apart tender. Best BBQ in Chicago!',             '2024-11-07'),
(9,  9,  5,  6, 3, 'Food was okay, nothing special. Took a while to arrive.',          '2024-11-08'),
(10, 10, 13, 1, 4, 'Solid pizza, generous toppings. Would order again.',               '2024-11-09'),
(11, 11, 10, 2, 4, 'Good burgers, love the veggie option. Milkshake was excellent.',   '2024-11-10'),
(12, 12, 4,  7, 5, 'Spanakopita was flaky and delicious. Great baklava too.',          '2024-11-11'),
(13, 13, 2,  9, 4, 'Buddha bowl was very filling and nutritious.',                     '2024-11-12'),
(14, 14, 6,  3, 5, 'Dragon Roll was stunning. Perfect for a date night dinner.',       '2024-11-13'),
(15, 16, 7,  1, 5, 'Three portions of garlic bread was the right call. Perfection.',   '2024-11-15'),
(16, 17, 9,  5, 5, 'Palak paneer and butter chicken combo is unbeatable.',             '2024-11-16'),
(17, 18, 3,  8, 4, 'Great BBQ spread, coleslaw was creamy and well seasoned.',         '2024-11-17'),
(18, 19, 1,  2, 3, 'Burger was good but arrived lukewarm. Driver took long route.',    '2024-11-18'),
(19, 20, 11, 3, 5, 'Sushi always so fresh from Sakura. Gyoza are addictive!',          '2024-11-19'),
(20, 21, 5,  5, 4, 'Curry was delicious though a touch spicier than expected.',        '2024-11-20'),
(21, 22, 8,  9, 5, 'Avocado toast was so fresh, sweet potato fries were amazing.',     '2024-11-21'),
(22, 24, 13, 7, 4, 'Nice Greek food, Souvlaki was tender.',                            '2024-11-23'),
(23, 25, 4,  5, 5, 'Four naans was absolutely the right decision. 10/10.',             '2024-11-24'),
(24, 28, 7,  8, 5, 'Birthday dinner was a hit! Brisket was insane quality.',           '2024-11-27'),
(25, 29, 10, 1, 4, 'Good pizza, tiramisu was a lovely touch to end the meal.',         '2024-11-28');

-- ============================================================
--  VERIFY: quick sanity check counts
-- ============================================================
SELECT 'restaurants' AS tbl, COUNT(*) AS rows FROM restaurants UNION ALL
SELECT 'categories',          COUNT(*) FROM categories           UNION ALL
SELECT 'menu_items',          COUNT(*) FROM menu_items           UNION ALL
SELECT 'customers',           COUNT(*) FROM customers            UNION ALL
SELECT 'drivers',             COUNT(*) FROM drivers              UNION ALL
SELECT 'orders',              COUNT(*) FROM orders               UNION ALL
SELECT 'order_items',         COUNT(*) FROM order_items          UNION ALL
SELECT 'reviews',             COUNT(*) FROM reviews;

-- ============================================================
--  ✅ DATABASE READY! Happy practising!
-- ============================================================