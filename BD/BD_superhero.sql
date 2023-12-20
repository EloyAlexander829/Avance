use superhero;

SELECT *
FROM alignment;
-- BANDOS

SELECT *
FROM attribute;
-- atributos/características

SELECT *
FROM colour;
-- lista de colores

SELECT *
FROM comic;
-- No se utilizará 

SELECT *
FROM gender;
-- Géneros

SELECT *
FROM publisher;
-- Casa publicación / distribuidores

SELECT *
FROM race;
-- Razas

SELECT *
FROM superhero;
-- Super Heroes 

SELECT *
FROM superpower;
-- No se utilizará


--------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_superhero_buscar(IN _publisher_name VARCHAR
(50))
BEGIN
    SELECT
        SUP.id,
        PUB.publisher_name,
        SUP.superhero_name,
        SUP.full_name,
        GEN.gender,
        RAC.race
    FROM superhero.superhero SUP
        INNER JOIN superhero.gender GEN ON GEN.id = SUP.gender_id
        INNER JOIN superhero.race RAC ON RAC.id = SUP.race_id
        INNER JOIN superhero.publisher PUB ON PUB.id = SUP.publisher_id
    WHERE PUB.publisher_name = _publisher_name;
END
$$
DELIMITER ;

CALL spu_superhero_buscar
('Hanna-Barbera');

------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_publisher_listar()
BEGIN
    SELECT
        id,
        publisher_name
    FROM superhero.publisher
    ORDER BY publisher_name;
END
$$

CALL spu_publisher_listar
();
--------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_resumen_alignment()
BEGIN
    SELECT
        a.alignment,
        count(alignment_id) AS 'Total'
    FROM superhero.alignment a
        LEFT JOIN superhero.superhero s ON s.alignment_id = a.id
    GROUP BY a.alignment
    ORDER BY Total;
END
$$

CALL spu_resumen_alignment
();
------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_resumen_publisher(IN _publisher_name VARCHAR
(50))
BEGIN
    SELECT
        ALI.alignment,
        COUNT(SUP.id) AS Total
    FROM superhero.superhero SUP
        INNER JOIN superhero.publisher PUB ON PUB.id = SUP.publisher_id
        INNER JOIN superhero.alignment ALI ON ALI.id = SUP.alignment_id
    WHERE PUB.publisher_name = _publisher_name
    GROUP BY ALI.alignment;
END
$$
DELIMITER ;

CALL spu_resumen_publisher
('Marvel Comics');

