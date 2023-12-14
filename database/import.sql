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
    result1 INT NOT NULL,
    result2 INT NOT NULL,
    match_round INT NOT NULL,
);

-- Tabela obstawień użytkowników
CREATE TABLE IF NOT EXISTS user_picks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    match_id INT NOT NULL,
    pick_result1 INT NOT NULL,
    pick_result2 INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (match_id) REFERENCES matches(id)
);

CREATE TABLE IF NOT EXISTS user_scores (
    user_id INT PRIMARY KEY,
    score INT DEFAULT  0,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
