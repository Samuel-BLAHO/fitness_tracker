CREATE DATABASE IF NOT EXISTS fitness_tracker
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE fitness_tracker;

DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE services (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  description TEXT NULL,
  image VARCHAR(255) NOT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE reviews (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  rating TINYINT UNSIGNED NOT NULL,
  title VARCHAR(150) NULL,
  review_text TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_reviews_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE,
  INDEX idx_reviews_user_id (user_id),
  INDEX idx_reviews_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO admins (name, email, password_hash) VALUES
('Site Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO services (title, description, image, sort_order, is_active) VALUES
('CROSSFIT TRAINING', 'High-intensity workouts for strength, stamina, and confidence.', 'images/s-1.jpg', 1, 1),
('FITNESS', 'Balanced gym training for everyday fitness and better movement.', 'images/s-2.jpg', 2, 1),
('DYNAMIC STRENGTH TRAINING', 'Progressive strength sessions focused on safe technique.', 'images/s-3.jpg', 3, 1),
('HEALTH', 'Fitness habits and coaching that support a healthier lifestyle.', 'images/s-4.jpg', 4, 1),
('WORKOUT', 'Guided workout sessions for different training goals.', 'images/s-5.jpg', 5, 1),
('STRATEGIES', 'Personal training plans and progress strategies.', 'images/s-6.jpg', 6, 1);

INSERT INTO users (username, email, password_hash) VALUES
('johnfit', 'johnfit@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('mariaactive', 'mariaactive@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('lukassport', 'lukassport@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO reviews (user_id, rating, title, review_text) VALUES
(
    1,
    5,
    'Excellent Gym',
    'Great atmosphere, professional trainers, and modern equipment. I highly recommend this fitness center to everyone.'
),
(
    2,
    4,
    'Very Good Experience',
    'I have been training here for several months and I can already see great progress. Friendly staff and clean environment.'
),
(
    3,
    5,
    'Best Choice',
    'The training plans are well prepared and motivating. Every visit is enjoyable and helps me stay consistent with my goals.'
);

INSERT INTO reviews (user_id, rating, title, review_text)
SELECT id, 5, 'Excellent Gym',
       'Great atmosphere, professional trainers, and modern equipment. I highly recommend this fitness center to everyone.'
FROM users
WHERE username = 'johnfit';

INSERT INTO reviews (user_id, rating, title, review_text)
SELECT id, 4, 'Very Good Experience',
       'I have been training here for several months and I can already see great progress. Friendly staff and clean environment.'
FROM users
WHERE username = 'mariaactive';

INSERT INTO reviews (user_id, rating, title, review_text)
SELECT id, 5, 'Best Choice',
       'The training plans are well prepared and motivating. Every visit is enjoyable and helps me stay consistent with my goals.'
FROM users
WHERE username = 'lukassport';