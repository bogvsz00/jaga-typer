-- Tabela użytkowników
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL
);

-- Tabela meczów
CREATE TABLE IF NOT EXISTS matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team1 VARCHAR(255) NOT NULL,
    team2 VARCHAR(255) NOT NULL,
    result1 INT,
    result2 INT,
    match_date DATE NOT NULL
);

-- Tabela obstawień użytkowników
CREATE TABLE IF NOT EXISTS user_picks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    match_id INT,
    pick_result1 INT,
    pick_result2 INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (match_id) REFERENCES matches(id)
);

-- Tabela wyników użytkowników
CREATE TABLE IF NOT EXISTS user_scores (
    user_id INT PRIMARY KEY,
    score INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
