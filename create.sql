CREATE TABLE users {
  id text NOT NULL PRIMARY KEY,
  firstname text NOT NULL,
  lastname text NOT NULL,
  username text NOT NULL,
  password text NOT NULL,
  role int DEFAULT 0,
  resultGrade text DEFAULT '',
  createdTests text DEFAULT ''
}

CREATE TABLE tests {
  id text NOT NULL PRIMARY KEY,
  testName text NOT NULL,
  questions text NOT NULL,
  answers text NOT NULL,
  correctAnswers text NOT NULL
}

INSERT INTO users (id, firstname, lastname, username, password, role)
  VALUES ('1', 'Dimitar', 'Kolev', 'kol', 'kol', 2)

INSERT INTO users (id, firstname, lastname, username, password, role)
  VALUES ('2', 'Martin', 'Penev', 'pen', 'pen', 2)

INSERT INTO users (id, firstname, lastname, username, password, role)
  VALUES ('3', 'Mariyan', 'Momchilov', 'mom', 'mom', 1)

INSERT INTO users (id, firstname, lastname, username, password, role)
  VALUES ('4', 'Dimitar', 'Dimitrov', 'dim', 'dim', 1)

INSERT INTO users (id, firstname, lastname, username, password, role)
  VALUES ('5', 'Hristo', 'Todorov', 'tod', 'tod', 1)

INSERT INTO users (id, firstname, lastname, username, password, role)
  VALUES ('6', 'Pesho', 'Goshov', 'gosh', 'gosh', 1)
