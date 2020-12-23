-- Start of file

CREATE DATABASE quizDBCW;
USE quizDBCW;

CREATE TABLE IF NOT EXISTS `User` (
	`ID` int NOT NULL,
	`Forename` varchar(255) NOT NULL,
	`Surname` varchar(255) NOT NULL,
	`Password` varchar(255) NOT NULL,
	`isStaff` BOOLEAN NOT NULL,
	PRIMARY KEY (`ID`)
) DEFAULT CHARSET = utf8;


CREATE TABLE IF NOT EXISTS `Quiz` (
	`ID` int NOT NULL,
	`Name` varchar(255),
	`AuthorID` int NOT NULL,
	`Available` BOOLEAN NOT NULL,
	PRIMARY KEY (`ID`),
	FOREIGN KEY (`AuthorID`) REFERENCES `User`(`ID`) ON DELETE CASCADE
) DEFAULT CHARSET = utf8;


CREATE TABLE IF NOT EXISTS `Attempt` (
	`StudentID` int NOT NULL,
	`Date` varchar(100) NOT NULL,
	`QuizID` int NOT NULL,
	`Score` decimal(5,2) NOT NULL,
	PRIMARY KEY (`StudentID`, `QuizID`),
	FOREIGN KEY (`QuizID`) REFERENCES `Quiz`(`ID`) ON DELETE CASCADE,
	FOREIGN KEY (`StudentID`) REFERENCES `User`(`ID`) ON DELETE CASCADE
) DEFAULT CHARSET = utf8;


CREATE TABLE IF NOT EXISTS `Question` (
	`QuizID` int NOT NULL,
	`Number` smallint NOT NULL,
	`Statement` TEXT NOT NULL,
	PRIMARY KEY (`QuizID`, `Number`),
	FOREIGN KEY (`QuizID`) REFERENCES `Quiz`(`ID`) ON DELETE CASCADE
) DEFAULT CHARSET = utf8;


CREATE TABLE IF NOT EXISTS `Answer` (
	`QuizID` int NOT NULL,
	`QuestionNumber` smallint NOT NULL,
	`AnswerChoice` varchar(1000) NOT NULL,
	`isCorrect` BOOLEAN NOT NULL,
	PRIMARY KEY (`QuizID`, `QuestionNumber`, `AnswerChoice`),
	FOREIGN KEY (`QuizID`, `QuestionNumber`) REFERENCES `Question`(`QuizID`, `Number`) ON DELETE CASCADE
) DEFAULT CHARSET = utf8;


-- Insert some data for testing

insert into User values ('44', 'Duncan', 'Hull', 'dbcw', '0');
insert into User values ('45', 'Jovan', 'Petreski', 'test1', '0');
insert into User values ('46', 'T1', 'T2', 'test2', '0');
insert into User values ('56', 'John', 'Johnson', 'jjohn', '1');
insert into User values ('55', 'Peter', 'Parker', 'abcd', '1');

insert into Quiz values ('34', 'SQL', '55', '1');
insert into Quiz values ('35', 'TEST', '55', '1');
insert into Quiz values ('36', 'TriggerTest', '55', '1');
insert into Quiz values ('37', 'TriggerTest2', '56', '1');

insert into Attempt values ('44', '22/11/2020', '34', '0.45');
insert into Attempt values ('45', '22/11/2020', '34', '0.3');
insert into Attempt values ('46', '22/11/2020', '34', '0.25');
insert into Attempt values ('46', '22/11/2020', '35', '0.12');
insert into Attempt values ('45', '22/11/2020', '37', '0.15');

insert into Question values ('34', '1', 'Which SQL statement is used to extract data from a database?');
insert into Question values ('34', '2', 'Which SQL statement is used to insert new data in a database?');
insert into Question values ('34', '3', 'With SQL, how do you select all the records from a table named “Persons” where the value of the column “FirstName” is “Peter”?');

insert into Answer values ('34', '1', 'SELECT', '1');
insert into Answer values ('34', '1', 'OPEN', '0');
insert into Answer values ('34', '1', 'EXTRACT', '0');
insert into Answer values ('34', '1', 'GET', '0');

insert into Answer values ('34', '2', 'INSERT NEW', '0');
insert into Answer values ('34', '2', 'INSERT INTO', '1');
insert into Answer values ('34', '2', 'ADD RECORD', '0');
insert into Answer values ('34', '2', 'ADD NEW', '0');

insert into Answer values ('34', '3', 'SELECT * FROM Persons WHERE FIRSTNAME <> ‘Peter’', '0');
insert into Answer values ('34', '3', 'SELECT [all] FROM Persons WHERE FirstName = ‘Peter’', '0');
insert into Answer values ('34', '3', 'SELECT * FROM PERSONS WHERE FirstName = ‘Peter’', '1');
insert into Answer values ('34', '3', 'SELECT [all] FROM Persons WHERE FirstName LIKE ‘Peter’', '0');


-- End of sql file


-- Stored procedure:

DELIMITER ^^
CREATE PROCEDURE GetQuizResultsLessThan40percent()
BEGIN
	SELECT 
		User.Forename, User.Surname, Attempt.Score, Attempt.QuizID
	FROM 
		User, Attempt, Quiz
	WHERE
		User.ID = Attempt.StudentID AND
		Quiz.ID = Attempt.QuizID AND
		Attempt.Score < 0.4;
END ^^
DELIMITER ;



-- Trigger:
-- Log staff id, quiz id and current date and time after delete

CREATE TABLE Deleted_quiz_audit (
	`StaffID` int NOT NULL,
	`QuizID` int NOT NULL,
	`CurrentDate` date NOT NULL,
	`CurrentTime` time NOT NULL
);


DELIMITER $$
CREATE TRIGGER Delete_quiz
	AFTER DELETE ON `Quiz` FOR EACH ROW
	BEGIN
		INSERT INTO `Deleted_quiz_audit`
		SET `StaffID` = OLD.AuthorID,
			`QuizID` = OLD.ID,
			`CurrentDate` = NOW(),
			`CurrentTime` = NOW();
	END $$
DELIMITER ;


