use vaccine_center;

CREATE TABLE IF NOT EXISTS centre (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    vaccin1 VARCHAR(20) NOT NULL,
    vaccin2 VARCHAR(20),
    vaccin3 VARCHAR(20),
    rue CHAR(50),
    cp VARCHAR(5),
    telephone INT(10) NOT NULL,
    email VARCHAR(60) NOT NULL,    
);
    
    
    