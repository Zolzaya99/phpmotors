-- insert --

INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 1, 'I am the real Ironman');

-- change to clientlevel 3 --

UPDATE clients
SET clientLevel = '3'
WHERE clientfirstName = "Tony";

-- replace the word --

UPDATE inventory
SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE invId = 12;

-- pull SUV ones --

SELECT i.invModel, c.classificationName
FROM inventory i
INNER JOIN carclassification c ON i.classificationId = c.classificationId
WHERE c.classificationName = 'SUV';

-- remove jeep wrangler --

DELETE FROM inventory
WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

-- update --

UPDATE inventory
SET invImage = CONCAT('/phpmotors', invImage),
    invThumbnail = CONCAT('/phpmotors', invThumbnail);


