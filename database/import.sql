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
    match_round INT NOT NULL,
    match_date INT NOT NULL,
    is_jagiellonia bool NOT NULL,
);

-- Tabela obstawień użytkowników
CREATE TABLE IF NOT EXISTS user_picks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    match_id INT NOT NULL,
    pick_result1 INT,
    pick_result2 INT,
    jagiellonia_player_pick_id INT,
    FOREIGN KEY (jagiellonia_player_pick_id) REFERENCES jagiellonia_players(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (match_id) REFERENCES matches(id)
);

CREATE TABLE IF NOT EXISTS user_scores (
    user_id INT PRIMARY KEY,
    score_extrakolejki INT DEFAULT 0,
    score_extra INT DEFAULT 0,
    score_kolejki INT DEFAULT 0,
    score_ogolna INT DEFAULT 0
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS jagiellonia_players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(64) INT NOT NULL,
    surname varchar(64) INT NOT NULL,
)