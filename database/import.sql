-- Tabela użytkowników
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    is_admin tinyint(1) NOT NULL DEAFULT 0,
    admin_password varchat(64) NOT NULL
);

-- Tabela meczów
CREATE TABLE IF NOT EXISTS matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team1 VARCHAR(255) NOT NULL,
    team2 VARCHAR(255) NOT NULL,
    result1 INT,
    result2 INT,
    match_round INT NOT NULL,
    match_date DATE NOT NULL,
    is_jagiellonia BOOLEAN NOT NULL
);

-- Tabela zawodników Jagiellonii
CREATE TABLE IF NOT EXISTS jagiellonia_players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    surname VARCHAR(64) NOT NULL
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

-- Tabela wyników użytkowników
CREATE TABLE IF NOT EXISTS user_scores (
    user_id INT PRIMARY KEY,
    score_extrakolejki INT DEFAULT 0,
    score_extra INT DEFAULT 0,
    score_kolejki INT DEFAULT 0,
    score_ogolna INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- WIDOKI
CREATE VIEW IF NOT EXISTS extra_table AS
    SELECT
        u.id AS user_id,
        u.username,
        us.score_extra
    FROM users u
    JOIN user_scores us ON u.id = us.user_id;

CREATE VIEW IF NOT EXISTS extrakolejki_table AS
    SELECT
        u.id AS user_id,
        u.username,
        us.score_extrakolejki
    FROM users u
    JOIN user_scores us ON u.id = us.user_id;

CREATE VIEW IF NOT EXISTS kolejki_table AS
    SELECT
        u.id AS user_id,
        u.username,
        us.score_kolejki
    FROM users u
    JOIN user_scores us ON u.id = us.user_id;

CREATE VIEW IF NOT EXISTS ogolna_table AS
    SELECT
        u.id AS user_id,
        u.username,
        us.score_ogolna
    FROM users u
    JOIN user_scores us ON u.id = us.user_id;
