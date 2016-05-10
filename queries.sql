CREATE TABLE IF NOT EXISTS `Account` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) NOT NULL,
  `Firstname` varchar(20) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `Password` char(40) NOT NULL,
  `Email` varchar(30) NOT NULL,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_ID` (`User_ID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
);

CREATE TABLE Friends (
    User_ID INTEGER NOT NULL,
    Friend_ID INTEGER NOT NULL,
    CONSTRAINT FOREIGN KEY (User_ID) REFERENCES Account(User_ID),
    CONSTRAINT FOREIGN KEY (Friend_ID) REFERENCES Account(User_ID),
    CONSTRAINT PRIMARY KEY (Friend_ID, User_ID)
);

CREATE TABLE Posts (
    User_ID INTEGER NOT NULL,
    Post_ID INTEGER NOT NULL AUTO_INCREMENT,
    Post_Desc VARCHAR(200),
    Location CHAR(20),
    Time_Stamp CHAR(30),
    CONSTRAINT FOREIGN KEY (User_ID) 
    			REFERENCES Account(User_ID),
    CONSTRAINT PRIMARY KEY (Post_ID)
);

CREATE TABLE Participants (
    Post_ID INTEGER NOT NULL,
    Participant_ID INTEGER NOT NULL,
    CONSTRAINT FOREIGN KEY (Participant_ID) 
    			REFERENCES Account(User_ID)
);

CREATE TABLE User_String_Pairs(
User_ID INTEGER NOT NULL ,
Random_String CHAR( 6 ) UNIQUE ,
PRIMARY KEY ( User_ID ) ,
CONSTRAINT FOREIGN KEY ( User_ID ) REFERENCES Account( User_ID )
);

